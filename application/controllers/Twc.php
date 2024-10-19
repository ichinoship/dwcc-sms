<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Twc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Applicant_model');
        $this->load->model('Profile_model');
        $this->load->library('form_validation');
        $this->load->library('session');

        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') !== 'TWC') {
            $this->session->set_flashdata('error', 'Unauthorized access. Please log in as Committee.');
            redirect('auth/login');
        }
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('Sc_model');

        $data['assigned_programs'] = $this->Sc_model->get_programs_by_twc($user_id);
        $this->load->view('twc/dashboard', $data);
    }

    public function search()
    {
        $this->load->model('Twc_model');
        $this->load->model('Applicant_model');

        $user_id = $this->session->userdata('user_id');
        $search_query = $this->input->post('search_query');
        $assigned_programs = $this->Twc_model->get_scholarship_programs_by_user($user_id);
        $data['applicants'] = $this->Twc_model->search_applicants_by_programs($search_query, $assigned_programs);
        $data['shortlisted_applicants'] = $this->Twc_model->get_shortlisted_applicants($search_query, $assigned_programs);

        $this->load->view('twc/search_results', $data);
    }

    public function app_review()
    {
        $user_id = $this->session->userdata('user_id');
        $data['applicants'] = $this->Applicant_model->get_applicants_by_twc($user_id);
        $data['applicants'] = array_filter($data['applicants'], function ($applicant) {
            return in_array($applicant->status, ['pending', 'conditional']);
        });
        $this->load->view('twc/app-review', $data);
    }
    public function update_status()
    {
        $applicant_no = $this->input->post('applicant_no');
        $status = $this->input->post('status');

        if ($applicant_no && $status) {
            $this->load->model('Twc_model');
            $result = $this->Twc_model->update_applicant_status($applicant_no, $status);

            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }
    public function view_applicant($applicant_no)
    {
        $this->load->model('Applicant_model');
        $data['applicant'] = $this->Applicant_model->get_application_by_no($applicant_no);

        if (!$data['applicant']) {
            show_404();
        }
        $this->load->view('twc/view_applicant', $data);
    }


    public function evaluate_applicant()
    {
        $applicant_no = $this->input->post('applicant_no');
        $status = $this->input->post('status');
        $comment = $this->input->post('comment');
        $discount = $this->input->post('discount');

        if ($applicant_no && $status) {
            $this->load->model('Twc_model');

            $applicant_email = $this->Twc_model->get_applicant_email($applicant_no);
            $applicant_firstname = $this->Twc_model->get_applicant_firstname($applicant_no);
            $result = false;

            if ($status === 'conditional') {
                $result = $this->Twc_model->update_conditional_applicant($applicant_no, $status, $comment);
                if ($result && $applicant_email) {
                    $this->send_conditional_email($applicant_email, $comment, $applicant_firstname);
                }
            } elseif ($status === 'qualified') {
                $result = $this->Twc_model->evaluate_applicant($applicant_no, $status, $comment, $discount);
                if ($result && $applicant_email) {
                    $this->send_approval_email($applicant_email, $applicant_firstname);
                }
            } elseif ($status === 'not qualified') {
                $result = $this->Twc_model->evaluate_applicant($applicant_no, $status, $comment, $discount);
                if ($result && $applicant_email) {
                    $this->send_decline_email($applicant_email, $comment, $applicant_firstname);
                }
            }

            if ($result) {
                echo 'success';
            } else {
                log_message('error', 'Evaluation failed for applicant: ' . $applicant_no);
                echo 'error';
            }
        } else {
            log_message('error', 'Missing data: applicant_no or status is not set.');
            echo 'error';
        }
    }


    private function send_approval_email($email, $firstname)
    {
        $this->load->library('email');
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Application Approved');
        $this->email->message("
        Dear $firstname,<br><br>
        We are pleased to inform you that your application has been <strong>approved</strong> by the Technical Working Committee (TWC).<br><br>
        Please note that you will now need to wait for the final evaluation from the Scholarship Coordinator.<br><br>
        If you have any questions or need further information, please feel free to reach out.<br><br>
        Best regards,<br>
        Divine Word College of Calapan<br>
        Scholarship Management Team
    ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        }
    }

    private function send_decline_email($email, $comment, $firstname)
    {
        $this->load->library('email');
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Application Declined');
        $this->email->message("
        Dear $firstname,<br><br>
        We regret to inform you that your application has been <strong>declined</strong>.<br><br>
        TWC Note:<br>
        <p>$comment</p><br>
        If you have any questions or would like further clarification, please do not hesitate to reach out.<br><br>
        Best regards,<br>
        Divine Word College of Calapan<br>
        Scholarship Management Team
    ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        }
    }

    private function send_conditional_email($email, $comment, $firstname)
    {
        $this->load->library('email');
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Conditional Application Status');
        $this->email->message("
        Dear $firstname,<br><br>
        Your application has been evaluated and is currently marked as <strong>conditional</strong>.<br><br>
        TWC Note:<br>
        <p>$comment</p><br>
        Please address the comments and update your application accordingly.<br><br>
        If you have any questions, feel free to reach out.<br><br>
        Best regards,<br>
        Divine Word College of Calapan<br>
        Scholarship Management Team
    ");
        if (!$this->email->send()) {
            log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        }
    }
    public function shortlist()
    {
        $this->load->model('Twc_model');
        $user_id = $this->session->userdata('user_id');
        $assigned_programs = $this->Twc_model->get_scholarship_programs_by_user($user_id);

        if (!empty($assigned_programs)) {
            $program_codes = array_column($assigned_programs, 'scholarship_program');
            $data['shortlist'] = $this->Twc_model->get_shortlist_by_programs($program_codes);
        } else {
            $data['shortlist'] = [];
        }
        $this->load->view('twc/shortlist', $data);
    }

    public function view_shortlist_applicant($shortlist_id)
    {
        $this->load->model('Twc_model');
        $data['applicants'] = $this->Twc_model->get_application_by_shortlist_id($shortlist_id);

        if (!$data['applicants']) {
            show_404();
        }
        $this->load->view('twc/view_shortlist_applicant', $data);
    }

    public function reports()
    {
        $this->load->model('Twc_model');
        $user_id = $this->session->userdata('user_id');

        $assigned_programs = $this->Twc_model->get_scholarship_programs_by_user($user_id);
        $program_codes = array_column($assigned_programs, 'scholarship_program');

        $data['report_counts'] = $this->Twc_model->get_report_counts_by_programs($program_codes);
        $data['scholarship_programs'] = $this->Twc_model->get_scholarship_programs_with_grantees($program_codes);
        $this->load->view('twc/reports', $data);
    }

    public function update_info()
    {
        $this->load->model('Profile_model');
        $user_id = $this->session->userdata('user_id');

        $data['user'] = $this->Profile_model->get_user_by_id($user_id);
        $this->load->view('twc/update_info', $data);
    }

    public function update_profile()
    {
        $this->load->model('Profile_model');
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'required|regex_match[/^\d{11}$/]', [
            'regex_match' => 'The Contact Number must be exactly 11 digits long.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->update_info();
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_user_data = $this->Profile_model->get_user($user_id);

            $data = [
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'email' => $this->input->post('email'),
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender')
            ];

            if (
                $current_user_data->name === $data['name'] &&
                $current_user_data->contact === $data['contact'] &&
                $current_user_data->email === $data['email'] &&
                $current_user_data->birthdate === $data['birthdate'] &&
                $current_user_data->gender === $data['gender']
            ) {

                $this->session->set_flashdata('info', 'No changes were made.');
            } else {
                if ($this->Profile_model->update_user($user_id, $data)) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Profile update failed.');
                }
            }
            redirect('twc/update_info');
        }
    }

    public function change_password()
    {
        $this->load->view('twc/change_pass');
    }

    public function update_password()
    {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->change_password();
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            if ($this->Profile_model->change_password($user_id, $current_password, $new_password)) {
                $this->session->set_flashdata('success', 'Password changed successfully.');
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect.');
            }

            redirect('twc/change_password');
        }
    }
}
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

    public function app_evaluation()
    {
        $user_id = $this->session->userdata('user_id');
        $data['applicants'] = $this->Applicant_model->get_applicants_by_twc($user_id);
        $data['applicants'] = array_filter($data['applicants'], function ($applicant) {
            return in_array($applicant->status, ['pending', 'not qualified']);
        });
        $this->load->view('twc/app_evaluation', $data);
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
            $result = false;

            if ($status === 'conditional') {
                $result = $this->Twc_model->update_conditional_applicant($applicant_no, $status, $comment);
                if ($result) {
                    $this->send_conditional_email($applicant_no);
                }
            } elseif ($status === 'qualified') {
                $result = $this->Twc_model->evaluate_applicant($applicant_no, $status, $comment, $discount);
            } elseif ($status === 'not qualified') {
                $result = $this->Twc_model->evaluate_applicant($applicant_no, $status, $comment, $discount);
            }

            if ($result) {
                // Return a JSON success response
                echo json_encode(['status' => 'success']);
            } else {
                log_message('error', 'Evaluation failed for applicant: ' . $applicant_no);
                echo json_encode(['status' => 'error', 'message' => 'Evaluation failed.']);
            }
        } else {
            log_message('error', 'Missing data: applicant_no or status is not set.');
            echo json_encode(['status' => 'error', 'message' => 'Missing data: applicant_no or status is not set.']);
        }
    }

    private function send_conditional_email($applicant_no)
    {
        $this->load->library('email');

        $applicant = $this->Twc_model->get_applicant_details($applicant_no);
        $email = $applicant->email;
        $firstname = $applicant->firstname;

        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Scholarship Application Status');

        $this->email->message("
        Dear $firstname, <br><br>
        We are writing to inform you that your scholarship application status has been marked as <strong>Conditional</strong>.<br><br>
        Please review the following comment from the evaluation committee: <br><br>
        <em>{$this->input->post('comment')}</em> <br><br>
        If you have any questions or need further assistance, please feel free to contact us.<br><br>
        Best regards,<br>
        Divine Word College of Calapan<br>
        Scholarship Management Team
    ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent to applicant: ' . $applicant_no . ' - ' . $this->email->print_debugger());
        }
    }


    public function shortlist()
    {
        $this->load->model('Twc_model');
        $user_id = $this->session->userdata('user_id');
        $assigned_programs = $this->Twc_model->get_scholarship_programs_by_user($user_id);

        if (!empty($assigned_programs)) {
            $program_codes = array_column($assigned_programs, 'scholarship_program');
            $data['shortlist'] = $this->Twc_model->get_applicants_by_programs($program_codes);
        } else {
            $data['shortlist'] = [];
        }
        $this->load->view('twc/shortlist', $data);
    }

    public function view_shortlist_applicant($applicant_no)
    {
        $this->load->model('Twc_model');
        $data['applicants'] = $this->Twc_model->get_application_by_applicant_no($applicant_no);

        if (!$data['applicants']) {
            show_404();
        }
        $this->load->view('twc/view_shortlist_applicant', $data);
    }

    public function reports()
    {
        $this->load->model('Twc_model');
        $this->load->model('Sc_model');

        $user_id = $this->session->userdata('user_id');
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        $data['scholarship_programs'] = $this->Twc_model->get_scholarship_programs_by_user($user_id);

        $academic_year = $this->input->post('academic_year');
        $semester = $this->input->post('semester');
        $program_type = $this->input->post('program_type');
        $year = $this->input->post('year');
        $program = $this->input->post('program');
        $campus = $this->input->post('campus');
        $status = $this->input->post('status');
        $scholarship_program = $this->input->post('scholarship_program');

        // Prepare filters array
        $filters = array();
        if (!empty($academic_year)) {
            $filters['academic_year'] = $academic_year;
        }
        if (!empty($semester)) {
            $filters['semester'] = $semester;
        }
        if (!empty($semester)) {
            $filters['program_type'] = $program_type;
        }
        if (!empty($year)) {
            $filters['year'] = $year;
        }
        if (!empty($program)) {
            $filters['program'] = $program;
        }
        if (!empty($campus)) {
            $filters['campus'] = $campus;
        }
        if (!empty($status)) {
            $filters['status'] = $status;
        }
        if (!empty($scholarship_program)) {
            $filters['scholarship_program'] = $scholarship_program;
        }

        $data['applicants'] = $this->Applicant_model->get_applicants_report_by_twc($user_id, $filters);
        $data['applicants'] = array_filter($data['applicants'], function ($applicant) {
            return in_array($applicant->status, ['qualified', 'conditional']);
        });



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

            if (!empty($_FILES['user_photo']['name'])) {

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 10240; 
                $config['file_name'] = $user_id . '_photo';
                $this->upload->initialize($config);

                if ($this->upload->do_upload('user_photo')) {

                    $data['user_photo'] = $this->upload->data('file_name');

                    if ($current_user_data->user_photo) {
                        $old_photo_path = './uploads/' . $current_user_data->user_photo;
                        if (file_exists($old_photo_path)) {
                            unlink($old_photo_path);
                        }
                    }

                    $this->session->set_userdata('user_image', $data['user_photo']);
                } else {
                    $this->session->set_flashdata('error', 'Failed to upload the photo. ' . $this->upload->display_errors());
                    redirect('twc/update_info');
                    return;
                }
            }

            if (
                $current_user_data->name === $data['name'] &&
                $current_user_data->contact === $data['contact'] &&
                $current_user_data->email === $data['email'] &&
                $current_user_data->birthdate === $data['birthdate'] &&
                $current_user_data->gender === $data['gender'] &&
                $current_user_data->user_photo === $data['user_photo']
            ) {
                $this->session->set_flashdata('info', 'No changes were made.');
            } else {
                if ($this->Profile_model->update_user($user_id, $data)) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Profile update failed.');
                }
            }

            $this->session->set_userdata('user_name', $data['name']);
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

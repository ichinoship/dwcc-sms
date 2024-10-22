<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Applicant extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Applicant_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->library('email');

        $excluded_methods = ['register', 'accept'];
        if (!in_array($this->router->method, $excluded_methods)) {
            if ($this->session->userdata('user_type') != 'applicant') {
                $this->session->set_flashdata('error', 'Unauthorized access. Please log in as applicant.');
                redirect('auth/applicant_login');
            }
        }
    }

    public function dashboard_applicant()
    {
        $id_number = $this->session->userdata('user_id_number');

        $applications = $this->Applicant_model->get_applicant_applications($id_number);

        $data['status'] = null;
        $data['comment'] = null;
        $data['has_conditional'] = false;

        if ($applications) {
            foreach ($applications as $application) {
                if ($application->status === 'conditional') {
                    $data['status'] = 'conditional';
                    $data['comment'] = $application->comment;
                    $data['has_conditional'] = true;
                    break;
                }
            }
        }

        $this->load->view('applicant/dashboard_applicant', $data);
    }

    public function register()
    {
        $this->form_validation->set_rules('id_number', 'ID Number', 'required|max_length[5]|is_unique[applicants.id_number]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('middlename', 'Middle Name');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('program_type', 'Program Type', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required|numeric|is_unique[applicants.contact]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('program', 'Program', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('applicant_residence', 'Residence', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('applicant_registration');
        } else {

            $firstname = ucwords(strtolower($this->input->post('firstname')));
            $middlename = ucwords(strtolower($this->input->post('middlename')));
            $lastname = ucwords(strtolower($this->input->post('lastname')));

            $program_type = $this->input->post('program_type');
            $campus = '';

            if ($program_type == 'College') {
                $campus = 'Janssen';
            } elseif (in_array($program_type, ['Senior High School', 'Junior High School', 'Grade School'])) {
                $campus = 'Freinademetz';
            }

            $data = array(
                'id_number' => $this->input->post('id_number'),
                'firstname' => $firstname,
                'middlename' => $middlename,
                'lastname' => $lastname,
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact'),
                'email' => $this->input->post('email'),
                'program_type' => $this->input->post('program_type'),
                'year' => $this->input->post('year'),
                'program' => $this->input->post('program'),
                'address' => $this->input->post('address'),
                'applicant_residence' => $this->input->post('applicant_residence'),
                'campus' => $campus
            );

            // Register applicant
            if ($this->Applicant_model->register_applicant($data)) {
                $this->session->set_flashdata('success', 'Registration successful! We will send you an email once you are approved.');
                redirect('applicant/register');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                redirect('applicant/register');
            }
        }
    }
    public function accept($applicant_no)
    {
        $applicant = $this->Applicant_model->get_applicant_by_id($applicant_no);

        if (!$applicant) {
            $this->session->set_flashdata('error', 'Applicant not found.');
            redirect('admin/account_review');
            return;
        }

        $default_password = 'DWCC' . $applicant->id_number;
        $hashed_password = password_hash($default_password, PASSWORD_BCRYPT);
        $data = array(
            'status' => 'accepted',
            'password' => $hashed_password
        );

        if ($this->Applicant_model->update_applicant($applicant_no, $data)) {
            $this->send_email_notification($applicant->email, $applicant->firstname);
            $this->session->set_flashdata('success', 'Applicant accepted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to accept applicant.');
        }

        redirect('admin/account_review');
    }
    //
    private function send_email_notification($email, $firstname)
    {
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Account Registration Confirmation');
        $this->email->message("
            Dear $firstname, <br><br>
            We are pleased to inform you that your account has been successfully registered. <br><br>
            As part of the next steps, you can now access your account using the following login credentials:<br>
            <strong>Username:</strong> idnumber<br>
            <strong>Password:</strong> DWCC+idnumber<br><br>
            Should you have any questions or require further assistance, please feel free to contact us. <br><br>
            Best regards,<br>
            Divine Word College of Calapan<br>
            Scholarship Management Team
        ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        }
    }

    public function update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('middlename', 'Middle Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('campus', 'Campus', 'required');
        $this->form_validation->set_rules('account_status', 'Account Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            $response = array(
                'success' => false,
                'message' => validation_errors()
            );
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact'),
                'email' => $this->input->post('email'),
                'campus' => $this->input->post('campus'),
                'account_status' => $this->input->post('account_status'),
            );

            $applicant_no = $this->input->post('applicant_no');
            if ($this->Applicant_model->update_applicant($applicant_no, $data)) {
                $response = array(
                    'success' => true,
                    'message' => 'Applicant updated successfully.'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to update applicant.'
                );
            }
        }

        echo json_encode($response);
    }

    public function edit_info()
    {
        $id_number = $this->session->userdata('user_id_number');
        $data['applicant'] = $this->Applicant_model->get_applicant_by_id_number($id_number);
        $this->load->view('applicant/update_info', $data);
    }

    public function update_info()
    {
        $id_number = $this->session->userdata('user_id_number');
        $this->form_validation->set_rules('contact', 'Contact Number', 'required|regex_match[/^\d{11}$/]', [
            'regex_match' => 'The Contact Number must be exactly 11 digits long.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_info();
        } else {
            $current_data = $this->Applicant_model->get_info($id_number);
            $new_data = [
                'contact' => $this->input->post('contact'),
                'email' => $this->input->post('email'),
                'year' => $this->input->post('year'),
                'address' => $this->input->post('address'),
                'applicant_residence' => $this->input->post('applicant_residence'),
            ];

            $changes_made = false;
            foreach ($new_data as $key => $value) {
                if ($current_data->$key != $value) {
                    $changes_made = true;
                    break;
                }
            }

            if ($changes_made) {
                if ($this->Applicant_model->update_info($id_number, $new_data)) {
                    $this->session->set_flashdata('success', 'Information updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update information.');
                }
            } else {
                $this->session->set_flashdata('info', 'No changes detected.');
            }

            redirect('applicant/edit_info');
        }
    }


    public function change_password()
    {
        $this->load->view('applicant/change_pass');
    }

    public function merit_programs()
    {
        $data['merit_programs'] = $this->Applicant_model->get_merit_programs();
        $this->load->view('applicant/merit_programs', $data);
    }

    public function non_merit_programs()
    {
        $data['non_merit_programs'] = $this->Applicant_model->get_non_merit_programs();
        $this->load->view('applicant/non_merit_programs', $data);
    }

    public function get_program_details()
    {
        $program_code = $this->input->get('program_code');
        $program = $this->Applicant_model->get_program_by_code($program_code);

        if ($program) {
            echo json_encode($program);
        } else {
            echo json_encode(['error' => 'Program not found']);
        }
    }
    public function update_password()
    {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {

            $this->change_password();
        } else {

            $id_number = $this->session->userdata('user_id_number');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            if ($this->Applicant_model->verify_password($id_number, $current_password)) {

                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                if ($this->Applicant_model->update_password($id_number, $hashed_password)) {
                    $this->session->set_flashdata('success', 'Password changed successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to change password. Please try again.');
                }
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect.');
            }

            redirect('applicant/change_password');
        }
    }
    public function apply_scholarship()
    {
        $this->load->model('Applicant_model');
        $this->load->model('Sc_model');

        $id_number = $this->session->userdata('user_id_number');

        $latest_academic_year = $this->Applicant_model->get_latest_academic_year();

        $program_code = $this->input->get('program_code', TRUE);
        $applicant = $this->Applicant_model->get_info($id_number);
        $data['applicant'] = $applicant;
        $data['latest_academic_year'] = $latest_academic_year;

        $scholarship_programs = $this->Sc_model->get_all_active_scholarship_programs();

        $current_date = date('Y-m-d');

        $filtered_programs = array_filter($scholarship_programs, function ($program) use ($applicant, $current_date) {
            return ($program->campus == $applicant->campus || $program->campus == 'All Campus')
                && ($program->start_date <= $current_date && $program->end_date >= $current_date); // Check date range
        });

        $data['scholarship_programs'] = $filtered_programs;
        $data['selected_program_code'] = $program_code;

        $this->load->view('applicant/apply_scholarship', $data);
    }

    public function submit_application()
    {
        $this->load->model('Applicant_model');
        $this->load->library('upload');
        $this->form_validation->set_rules('contact', 'Contact', 'required|numeric|max_length[11]|is_unique[applicants.contact]');

        $id_number = $this->input->post('id_number');
        $academic_year = $this->input->post('academic_year');
        $semester = $this->input->post('semester');
        $scholarship_program = $this->input->post('scholarship_program');

        $application_count = $this->Applicant_model->get_application_count($id_number, $academic_year, $semester);

        if ($application_count >= 2) {
            $this->session->set_flashdata('error', 'You have reached the 2-application limit for this semester.');
            redirect('applicant/apply_scholarship');
            return;
        }

        $account_no = $this->Applicant_model->get_account_no($this->session->userdata('user_id_number'));
        if (!$account_no) {
            $this->session->set_flashdata('error', 'Account number does not exist. Please register first.');
            redirect('applicant/apply_scholarship');
            return;
        }

        $data['applicant_no'] = $this->Applicant_model->get_next_applicant_no();

        $id_number = $this->input->post('id_number');
        $scholarship_program = $this->input->post('scholarship_program');

        $existing_application = $this->Applicant_model->check_duplicate_application($id_number, $scholarship_program, $semester, $academic_year);

        if ($existing_application) {
            $this->session->set_flashdata('error', 'You have already applied for this scholarship program in the same semester and academic year.');
            redirect('applicant/apply_scholarship');
            return;
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf|docx';
        $config['max_size'] = 10240;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('applicant_photo')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', "Error uploading applicant photo: " . $error);
            redirect('applicant/apply_scholarship');
            return;
        }
        $applicant_photo = $this->upload->data('file_name');

        $requirements_files = $_FILES['requirements'];
        $requirements = [];

        for ($i = 0; $i < count($requirements_files['name']); $i++) {
            $_FILES['file'] = [
                'name'     => $requirements_files['name'][$i],
                'type'     => $requirements_files['type'][$i],
                'tmp_name' => $requirements_files['tmp_name'][$i],
                'error'    => $requirements_files['error'][$i],
                'size'     => $requirements_files['size'][$i]
            ];

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', "Error uploading requirements: " . $error);
                redirect('applicant/apply_scholarship');
                return;
            }

            $requirements[] = $this->upload->data('file_name');
        }

        $form_data = [
            'applicant_no' => $data['applicant_no'],
            'account_no' => $account_no,
            'applicant_photo' => $applicant_photo,
            'id_number' => $this->input->post('id_number'),
            'firstname' => $this->input->post('firstname'),
            'middlename' => $this->input->post('middlename'),
            'lastname' => $this->input->post('lastname'),
            'birthdate' => $this->input->post('birthdate'),
            'gender' => $this->input->post('gender'),
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'program_type' => $this->input->post('program_type'),
            'year' => $this->input->post('year'),
            'program' => $this->input->post('program'),
            'campus' => $this->input->post('campus'),
            'address' => $this->input->post('address'),
            'applicant_residence' => $this->input->post('applicant_residence'),
            'academic_year' => $this->input->post('academic_year'),
            'semester' => $this->input->post('semester'),
            'application_type' => $this->input->post('application_type'),
            'scholarship_program' => $this->input->post('scholarship_program'),
            'requirements' => implode(',', $requirements)
        ];

        $this->Applicant_model->insert_application($form_data);
        $this->session->set_flashdata('success', 'Your application has been successfully submitted and is currently under review for approval.');
        redirect('applicant/dashboard_applicant');
    }

    public function my_application()
    {
        $this->load->model('Applicant_model');
        $this->load->model('Sc_model');
        $id_number = $this->session->userdata('user_id_number');
        $data['applications'] = $this->Applicant_model->get_applications_by_id_number($id_number);
        $data['academic_filter_years'] = $this->Sc_model->get_academic_filter_years();
        $applicant_status_data = $this->Applicant_model->get_applicant_status($id_number);


        $data['status'] = null;
        $data['comment'] = null;

        if ($applicant_status_data) {
            $data['status'] = $applicant_status_data->status;
            $data['comment'] = $applicant_status_data->comment;
        }
        $this->load->view('applicant/my_application', $data);
    }

    public function view_form($applicant_no)
    {
        $this->load->model('Applicant_model');
        $data['application'] = $this->Applicant_model->get_application_by_no($applicant_no);

        if (!$data['application']) {
            show_404();
        }
        $this->load->view('applicant/view_form', $data);
    }

    public function edit_application($applicant_no)
    {
        $this->load->model('Applicant_model');
        $this->load->model('Sc_model');

        $data['application'] = $this->Applicant_model->get_application_by_no($applicant_no);
        $data['scholarship_programs'] = $this->Sc_model->get_all_scholarship_programs();

        $data['existing_requirements'] = !empty($data['application']->requirements) ? explode(',', $data['application']->requirements) : [];

        $this->load->view('applicant/edit_application', $data);
    }

    public function update_application()
    {
        $this->load->model('Applicant_model');
        $this->load->library('upload');

        $applicant_no = $this->input->post('applicant_no');
        $data = [
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'academic_year' => $this->input->post('academic_year'),
            'semester' => $this->input->post('semester'),
            'scholarship_program' => $this->input->post('scholarship_program'),
            'campus' => $this->input->post('campus'),
            'applicant_residence' => $this->input->post('applicant_residence'),
            'application_type' => $this->input->post('application_type'),
        ];

        // Handle applicant photo upload
        if (!empty($_FILES['applicant_photo']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10240;

            $this->upload->initialize($config);
            if ($this->upload->do_upload('applicant_photo')) {
                $data['applicant_photo'] = $this->upload->data('file_name');
            }
        }
        $existing_application = $this->Applicant_model->get_application_by_no($applicant_no);
        $existing_requirements = !empty($existing_application->requirements) ? explode(',', $existing_application->requirements) : [];

        $remove_requirements = $this->input->post('remove_requirements');
        if ($remove_requirements) {
            $existing_requirements = array_diff($existing_requirements, $remove_requirements);
        }
        if (!empty($_FILES['requirements']['name'][0])) {
            $files = $_FILES['requirements'];
            $file_count = count($files['name']);

            if ($file_count > 20) {
                $this->session->set_flashdata('error', 'You can only upload up to 20 files.');
                redirect('applicant/edit_application/' . $applicant_no);
                return;
            }

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx';
            $config['max_size'] = 10240;

            $this->load->library('upload', $config);
            $uploaded_data = [];

            for ($i = 0; $i < $file_count; $i++) {
                $_FILES['file']['name'] = $files['name'][$i];
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];

                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $uploaded_data[] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('applicant/edit_application/' . $applicant_no);
                    return;
                }
            }

            $data['requirements'] = implode(',', array_merge($existing_requirements, $uploaded_data));
        } else {
            $data['requirements'] = implode(',', $existing_requirements);
        }
        $this->Applicant_model->update_application($applicant_no, $data);
        $this->session->set_flashdata('success', 'Application updated successfully.');
        redirect('applicant/view_form/' . $applicant_no);
    }
}

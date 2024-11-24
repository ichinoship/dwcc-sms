<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->library('upload');

        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') !== 'Admin') {
            $this->session->set_flashdata('error', 'Unauthorized access. Please log in as admin.');
            redirect('auth/login');
        }
    }

    public function dashboard()
    {
        $data['accepted_applicants_count'] = $this->Admin_model->count_accepted_applicants();
        $data['coordinator_count'] = $this->Admin_model->count_scholarship_coordinators();
        $data['twc_count'] = $this->Admin_model->count_twc();

        $this->load->view('admin/dashboard', $data);
    }

    public function search()
    {
        $search_query = $this->input->post('search_query');
        $data['applicant_results'] = $this->Admin_model->search_applicants($search_query);
        $data['user_results'] = $this->Admin_model->search_users($search_query);
        // Load a view to display results
        $this->load->view('admin/search_results', $data);
    }

    public function get_scholarship_coordinator_count()
    {
        $this->load->model('Admin_model');
        $count = $this->Admin_model->count_scholarship_coordinators();
        return $count;
    }

    public function get_twc_count()
    {
        $this->load->model('Admin_model');
        $count = $this->Admin_model->count_twc();
        return $count;
    }

    public function toggle_applicant_status()
    {
        $account_no = $this->input->post('account_no');
        $new_status = $this->input->post('status') == 'active' ? 'active' : 'inactive';

        $this->Admin_model->update_app_status($account_no, $new_status);

        echo json_encode(['success' => true]);
    }

    public function manage()
    {
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') !== 'Admin') {
            $this->load->view('errors/unauthorized');
            return;
        }

        $data['users'] = $this->Admin_model->get_all_users();
        $this->load->view('admin/manage', $data);
    }

    public function add()
    {
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') !== 'Admin') {
            $this->load->view('errors/unauthorized');
            return;
        }
        $this->load->view('admin/add_user');
    }

    public function insert()
    {
        $this->form_validation->set_rules('id_number', 'ID Number', 'required|is_unique[users.id_number]');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[male,female,other]');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|is_unique[users.contact]|regex_match[/^\d{11}$/]', [
            'regex_match' => 'Contact number must be 11 digits.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');

        $this->load->library('upload');

        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors);
            $this->load->view('admin/add_user');
        } else {
            // Configure the upload settings for user_photo
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // Limit to 2MB
            $config['file_name'] = $this->input->post('id_number') . '_photo';

            $this->upload->initialize($config);

            $user_photo = '';
            if (!empty($_FILES['user_photo']['name'])) {
                if ($this->upload->do_upload('user_photo')) {
                    $user_photo = $this->upload->data('file_name');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', "Invalid file format for user photo. Only JPG, JPEG, and PNG formats are allowed. " . $error);
                    redirect('admin/add_user');
                    return;
                }
            }

            $data = array(
                'id_number' => $this->input->post('id_number'),
                'name' => $this->input->post('name'),
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact_number'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'usertype' => $this->input->post('user_type'),
                'user_photo' => $user_photo
            );

            $this->Admin_model->insert_user($data);
            $this->session->set_flashdata('success', 'User added successfully');
            redirect('admin/manage');
        }
    }


    public function update()
    {
        $this->form_validation->set_rules('id_number', 'ID Number', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|exact_length[11]');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[male,female,other]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $user_id = $this->input->post('user_id');
            $user_data = [
                'id_number' => $this->input->post('id_number'),
                'name' => $this->input->post('name'),
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact_number'),
                'email' => $this->input->post('email'),
                'usertype' => $this->input->post('user_type'),
                'status' => $this->input->post('status')
            ];
            if ($this->Admin_model->update_user($user_id, $user_data)) {
                echo json_encode(['success' => 'User updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update user']);
            }
        }
    }

    public function account_review()
    {
        $data['applicants'] = $this->Admin_model->get_pending_applicants();
        $this->load->view('admin/account-review', $data);
    }

    public function approve_applicant($id)
    {
        if ($this->Admin_model->update_applicant_status($id, 'accepted')) {
            $this->session->set_flashdata('success', 'Application accepted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to accept application.');
        }

        redirect('admin/account_review');
    }

    public function decline_applicant($id)
    {
        $applicant = $this->Admin_model->get_applicant_by_id($id);

        if ($this->Admin_model->update_applicant_status($id, 'declined')) {

            $this->send_decline_email_notification($applicant->email, $applicant->firstname);
            $this->session->set_flashdata('success', 'Application declined successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to decline application.');
        }

        redirect('admin/account_review');
    }

    private function send_decline_email_notification($email, $firstname)
    {
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Account Status Update');
        $this->email->message("
        Dear $firstname, <br><br>
        We regret to inform you that your account for the DWCC Scholarship has been declined. <br><br>
        If you have any questions or would like further information, please feel free to contact us. <br><br>
        Best regards,<br>
        Divine Word College of Calapan<br>
        Scholarship Management Team
    ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        }
    }

    public function app_list()
    {
        $data['applicants'] = $this->Admin_model->get_accepted_applicants();
        $this->load->view('admin/app-list', $data);
    }

    public function twc_dashboard()
    {
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') !== 'Admin') {
            $this->session->set_flashdata('error', 'Unauthorized access. Please log in as admin.');
            redirect('auth/login');
        }
    }

    public function update_info()
    {
        $this->load->model('Profile_model');
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->Profile_model->get_user_by_id($user_id);
        $this->load->view('admin/update_info', $data);
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

            // Handle the photo upload
            if (!empty($_FILES['user_photo']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 10240; // 10 MB
                $config['file_name'] = $user_id . '_photo';
                $this->upload->initialize($config);

                if ($this->upload->do_upload('user_photo')) {

                    if ($current_user_data->user_photo) {
                        $old_photo_path = './uploads/' . $current_user_data->user_photo;
                        if (file_exists($old_photo_path)) {
                            unlink($old_photo_path);
                        }
                    }
                    $data['user_photo'] = $this->upload->data('file_name');
                    $this->session->set_userdata('user_image', $data['user_photo']);
                } else {
                    $this->session->set_flashdata('error', 'Failed to upload the photo. ' . $this->upload->display_errors());
                    redirect('admin/update_info');
                    return;
                }
            }

            // Check if there are any changes in the data
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
                // Update the user profile
                if ($this->Profile_model->update_user($user_id, $data)) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Profile update failed.');
                }
            }

            // Update the session with the new name
            $this->session->set_userdata('user_name', $data['name']);
            redirect('admin/update_info');
        }
    }

    public function change_password()
    {
        $this->load->view('admin/change_pass');
    }

    public function update_password()
    {
        $this->load->model('Profile_model');
        if ($this->session->userdata('user_type') != 'Admin') {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect('auth/login');
        }

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
            redirect('admin/change_password');
        }
    }
}

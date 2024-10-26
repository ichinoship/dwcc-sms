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
        $new_status = $this->input->post('status') == 'activate' ? 'active' : 'deactivated';

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

        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors);
            $this->load->view('admin/add_user');
        } else {
            $data = array(
                'id_number' => $this->input->post('id_number'),
                'name' => $this->input->post('name'),
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact_number'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'usertype' => $this->input->post('user_type')
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

    public function profile()
    {
        $data['users'] = $this->Admin_model->get_all_users();
        $this->load->view('admin/profile', $data);
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
        if ($this->Admin_model->update_applicant_status($id, 'declined')) {
            $this->session->set_flashdata('success', 'Application declined successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to decline application.');
        }

        redirect('admin/account_review');
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
}

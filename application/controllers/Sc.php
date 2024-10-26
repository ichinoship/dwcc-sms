<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Applicant_model');
        $this->load->model('Profile_model');
        $this->load->model('Sc_model');
        $this->load->library('form_validation');
        $this->load->library('upload');

        if ($this->session->userdata('user_type') != 'Scholarship Coordinator') {
            $this->session->set_flashdata('error', 'Unauthorized access. Please log in as Coordinator.');
            redirect('auth/login'); //LOGIN
        }
    }

    public function dashboard()
    {
        $data['total_applicants'] = $this->Applicant_model->count_all_applicants();
        $data['approve_applicants'] = $this->Applicant_model->count_approved_applicants();
        $data['pending_applicants'] = $this->Applicant_model->count_pending_applicants();
        $data['conditional_applicants'] = $this->Applicant_model->count_conditional_applicants();
        $data['not_approve_applicants'] = $this->Applicant_model->count_not_approve_applicants();
        $data['total_school_years'] = $this->Sc_model->count_school_years();
        $data['total_scholarship_programs'] = $this->Sc_model->count_scholarship_programs();
        $this->load->view('sc/dashboard', $data);
    }

    public function search()
    {
        $search_query = $this->input->post('search_query');
        $this->load->model('Sc_model');
        $data['applicant_results'] = $this->Sc_model->searchApplicants($search_query);
        $data['program_results'] = $this->Sc_model->searchScholarshipPrograms($search_query);
        $data['shortlist_results'] = $this->Sc_model->searchShortlistedApplicant($search_query);
        $data['final_list_results'] = $this->Sc_model->searchFinalApplicant($search_query);
        $data['school_year_results'] = $this->Sc_model->searchSchoolYear($search_query);
        $data['requirement_results'] = $this->Sc_model->searchRequirement($search_query);
        $this->load->view('sc/search_results', $data);
    }

    public function app_list($program_code)
    {
        $data['applicants'] = $this->Applicant_model->get_all_application();
        $data['applicants'] = $this->Sc_model->get_applicants_by_program($program_code);
        $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
        $this->load->view('sc/app-list', $data);
    }
    public function scholarship_program()
    {
        $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
        $data['twc_users'] = $this->Sc_model->get_twcs();
        $data['requirements'] = $this->Sc_model->get_all_reqs();
        $data['academic_years'] = $this->Sc_model->get_all_academic_years(); // Make sure to implement this in your model
        $data['current_academic_year'] = $this->Sc_model->get_current_academic_year();

        $this->load->view('sc/scholarship_program', $data);
    }

    public function set_scholarship_dates()
    {
        $program_codes = $this->input->post('scholarship_programs');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if ($program_codes && $start_date && $end_date) {
            foreach ($program_codes as $program_code) {
                $data = [
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ];

                $this->db->where('program_code', $program_code);
                $update = $this->db->update('scholarship_programs', $data);

                if (!$update) {
                    echo 'error';
                    return;
                }
            }
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function manage_requirements()
    {
        $this->form_validation->set_rules('requirement_name', 'Requirement Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['requirements'] = $this->Sc_model->get_all_requirements();
            $this->load->view('sc/manage_requirements', $data);
        } else {
            $program_code = $this->input->post('program_name');
            $data = array(
                'requirement_name' => $this->input->post('requirement_name'),
            );

            $this->Sc_model->insert_requirement($data);
            $this->session->set_flashdata('success_message', 'Requirement added successfully!');
            redirect('sc/manage_requirements');
        }
    }
    public function update_requirement()
    {
        $id = $this->input->post('id');
        $updated_data = array(
            'requirement_name' => $this->input->post('requirement_name')
        );

        $this->Sc_model->update_requirement($id, $updated_data);
        $this->session->set_flashdata('success_message', 'Requirement updated successfully!');
        redirect('sc/manage_requirements');
    }
    public function delete_requirement($id)
    {
        $this->Sc_model->delete_requirement($id);
        $this->session->set_flashdata('success_message', 'Requirement deleted successfully!');
        redirect('sc/manage_requirements');
    }

    public function add_scholarship_program()
    {
        $this->form_validation->set_rules('scholarship_program', 'Scholarship Program Name', 'required');
        $this->form_validation->set_rules('scholarship_type', 'Scholarship Type', 'required');
        $this->form_validation->set_rules('percentage', 'Percentage', 'required');
        $this->form_validation->set_rules('program_status', 'Program Status', 'required');

        if (empty($this->input->post('requirements'))) {
            $this->form_validation->set_rules('requirements[]', 'Requirements', 'required', array('required' => 'Please select at least one requirement.'));
        }

        // Fetch academic years from school_year table
        $data['academic_years'] = $this->Sc_model->get_all_academic_years();

        if ($this->form_validation->run() == FALSE) {
            $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
            $data['twc_users'] = $this->Sc_model->get_twcs();
            $data['requirements'] = $this->Sc_model->get_all_reqs();
            $this->load->view('sc/scholarship_program', $data);
        } else {
            $existing_program = $this->Sc_model->get_program_by_details(
                $this->input->post('scholarship_program'),
                $this->input->post('campus'),
                $this->input->post('academic_year'),
                $this->input->post('semester')
            );

            if ($existing_program) {
                $this->session->set_flashdata('error', 'Scholarship program already exists.');
                redirect('sc/scholarship_program');
            } else {
                $data = array(
                    'scholarship_program' => $this->input->post('scholarship_program'),
                    'campus' => $this->input->post('campus'),
                    'academic_year' => $this->input->post('academic_year'),
                    'semester' => $this->input->post('semester'),
                    'scholarship_type' => $this->input->post('scholarship_type'),
                    'program_status' => $this->input->post('program_status'),
                    'assigned_to' => $this->input->post('assigned_to'),
                    'description' => $this->input->post('description'),
                    'qualifications' => $this->input->post('qualifications'),
                    'percentage' => $this->input->post('percentage'),
                    'requirements' => implode(';', $this->input->post('requirements'))
                );

                $this->Sc_model->insert_program($data);
                $this->session->set_flashdata('message', 'Scholarship program added successfully!');
                redirect('sc/scholarship_program');
            }
        }
    }

    public function edit_scholarship_program($program_code)
    {
        // Set validation rules
        $this->form_validation->set_rules('program_code', 'Program Code', 'required');
        $this->form_validation->set_rules('scholarship_program', 'Scholarship Program Name', 'required');
        $this->form_validation->set_rules('scholarship_type', 'Scholarship Type', 'required');
        $this->form_validation->set_rules('percentage', 'Percentage', 'required');
        $this->form_validation->set_rules('program_status', 'Program Status', 'required');

        if (empty($this->input->post('requirements'))) {
            $this->form_validation->set_rules(
                'requirements[]',
                'Requirements',
                'required',
                array('required' => 'Please select at least one requirement.')
            );
        }

        // Fetch academic years for the dropdown
        $data['academic_years'] = $this->Sc_model->get_all_academic_years();

        if ($this->form_validation->run() == FALSE) {
            $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
            $data['twc_users'] = $this->Sc_model->get_twcs();
            $data['requirements'] = $this->Sc_model->get_all_reqs();
            $this->load->view('sc/scholarship_program', $data);
        } else {
            $data = array(
                'scholarship_program' => $this->input->post('scholarship_program'),
                'campus' => $this->input->post('campus'),
                'academic_year' => $this->input->post('academic_year'),
                'semester' => $this->input->post('semester'),
                'scholarship_type' => $this->input->post('scholarship_type'),
                'program_status' => $this->input->post('program_status'),
                'assigned_to' => $this->input->post('assigned_to'),
                'description' => $this->input->post('description'),
                'qualifications' => $this->input->post('qualifications'),
                'percentage' => $this->input->post('percentage'),
                'requirements' => implode(';', $this->input->post('requirements'))
            );

            $this->Sc_model->update_program($program_code, $data);
            $this->session->set_flashdata('message', 'Scholarship program updated successfully!');
            redirect('sc/scholarship_program');
        }
    }


    public function get_twcs()
    {
        $this->load->model('Sc_model');
        $twcs = $this->Sc_model->get_twcs();
        echo json_encode($twcs);
    }

    public function get_scholarship_program()
    {
        $program_code = $this->input->get('program_code');
        $program = $this->Sc_model->get_scholarship_program_by_code($program_code);
        echo json_encode($program);
    }

    public function school_year()
    {
        $filter_semester = $this->input->get('filter_semester');
        $filter_campus = $this->input->get('filter_campus');

        $data['school_years'] = $this->Sc_model->get_filtered_school_years($filter_semester, $filter_campus);
        $this->load->view('sc/school_year', $data);
    }

    public function add_school_year()
    {
        $this->form_validation->set_rules('academic_year', 'Academic Year', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('sc/school_year');
        } else {
            $data = array(
                'academic_year' => $this->input->post('academic_year')
            );

            $this->Sc_model->insert_school_year($data);
            $this->session->set_flashdata('message', 'School Year added successfully!');
            redirect('sc/school_year');
        }
    }

    public function view_list($school_year_id)
    {
        $this->load->model('Applicant_model');
        $this->load->model('Sc_model');
        $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
        $school_year = $this->db->get_where('school_year', ['school_year_id' => $school_year_id])->row();

        if (!$school_year) {
            show_404();
        }
        $applicants = $this->Applicant_model->get_applicants_by_academic_year($school_year->academic_year);

        $data['applicants'] = $applicants;
        $data['academic_year'] = $school_year->academic_year;

        $this->load->view('sc/view_list', $data);
    }

    public function app_evaluation()
    {
    
        $this->load->model('Sc_model');
        
        $scholarship_program = $this->input->get('scholarship_program');
        $data['scholarship_programs'] = $this->Sc_model->get_filter_scholarship_programs();

        $academic_year = $this->input->get('academic_year');
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        
        $semester = $this->input->get('semester');
        
        $data['applicants'] = $this->Sc_model->get_filter_short_list($academic_year, $semester);

        $shortlist = $this->Sc_model->get_shortlist($scholarship_program);
        $data['shortlist'] = $shortlist;

        $this->load->view('sc/app_evaluation', $data);
    }

    public function view_shortlist_applicant($shortlist_id)
    {
        $this->load->model('Applicant_model');
        $data['applicant'] = $this->Applicant_model->get_shortlisted_applicant_by_id($shortlist_id);
        if (!$data['applicant']) {
            show_404();
        }
        $this->load->view('sc/view_applicant', $data);
    }

    public function update_shortlist()
    {
        $shortlist_id = $this->input->post('shortlist_id');
        $status = $this->input->post('status');
        $discount = $this->input->post('discount');

        $this->Sc_model->update_shortlist($shortlist_id, $status, $discount);

        redirect('sc/app_evaluation');
    }

    public function submit_to_final_list()
    {
        $shortlist_id = $this->input->post('shortlist_id');
        $discount = $this->input->post('discount');
        $shortlistedApplicant = $this->Sc_model->get_shortlist_applicant($shortlist_id);

        $data = [
            'applicant_no' => $shortlistedApplicant->applicant_no,
            'id_number' => $shortlistedApplicant->id_number,
            'firstname' => $shortlistedApplicant->firstname,
            'middlename' => $shortlistedApplicant->middlename,
            'lastname' => $shortlistedApplicant->lastname,
            'program_type' => $shortlistedApplicant->program_type,
            'year' => $shortlistedApplicant->year,
            'program' => $shortlistedApplicant->program,
            'campus' => $shortlistedApplicant->campus,
            'application_type' => $shortlistedApplicant->application_type,
            'academic_year' => $shortlistedApplicant->academic_year,
            'semester' => $shortlistedApplicant->semester,
            'scholarship_program' => $shortlistedApplicant->scholarship_program,
            'discount' => $discount,
        ];

        $this->Sc_model->insert_into_final_list($data);
        $this->Sc_model->remove_from_shortlist($shortlist_id);

        $this->send_email_notification($shortlistedApplicant->email, $shortlistedApplicant->firstname);

        echo json_encode(['status' => 'success']);
    }

    private function send_email_notification($email, $firstname)
    {
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Congratulations on making it to the final list!');
        $this->email->message("
            Dear $firstname, <br><br>
            We are pleased to inform you that you have been successfully selected for the final list of scholars. <br><br>
            Congratulations on this achievement! If you have any questions or require further assistance, please feel free to contact us. <br><br>
            Best regards,<br>
            Divine Word College of Calapan<br>
            Scholarship Management Team
        ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        }
    }
    public function reports()
    {
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        $data['scholarship_programs'] = $this->Sc_model->get_filter_scholarship_programs();

        $data['academic_year'] = $this->Sc_model->get_academic_years();
        $data['scholarship_programs'] = $this->Sc_model->get_all_scholarship_programs();
        $data['applicant_counts'] = $this->Applicant_model->get_applicant_counts();
        $data['total_programs'] = $this->Sc_model->count_scholarship_programs();
        $data['final_list'] = $this->Sc_model->get_final_list_reports();

        $filters = array(
            'academic_year' => $this->input->post('academic_year'),
            'semester' => $this->input->post('semester'),
            'application_type' => $this->input->post('application_type'),
            'status' => $this->input->post('status'),
            'scholarship_program' => $this->input->post('scholarship_program')
        );

        foreach ($data['scholarship_programs'] as $program) {
            $program->number_of_grantees = $this->Applicant_model->count_grantees_by_program($program->scholarship_program, $program->academic_year, $program->semester);
        }

        // Filter the statuses in the query
        $filters['status'] = array('qualified', 'not qualified');

        $data['applications'] = $this->Sc_model->get_applications($filters);

        $this->load->view('sc/reports', $data);
    }



    public function update_info()
    {
        $this->load->model('Profile_model');
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->Profile_model->get_user_by_id($user_id);
        $this->load->view('sc/update_info', $data);
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
            redirect('sc/update_info');
        }
    }

    public function change_password()
    {
        $this->load->view('sc/change_pass');
    }

    public function update_password()
    {
        if ($this->session->userdata('user_type') != 'Scholarship Coordinator') {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect('auth/sc_login');
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
            redirect('sc/change_password');
        }
    }
   

    public function program_list()
    {
        $this->load->model('Sc_model');
        $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
        $this->load->view('sc/program_list', $data);
    }

    public function program_app_list()
    {
        $this->load->model('Sc_model');
        $data['programs'] = $this->Sc_model->get_programs_with_applicant_count();
        $this->load->view('sc/program_app_list', $data);
    }

    public function final_list()
    {

        $this->load->model('Sc_model');
        $academic_year = $this->input->get('academic_year');
        $semester = $this->input->get('semester');
        $scholarship_program = $this->input->get('scholarship_program');
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        $data['scholarship_programs'] = $this->Sc_model->get_filter_scholarship_programs();
        $data['applicants'] = $this->Sc_model->get_filter_final_list($academic_year, $semester, $scholarship_program);
        $this->load->view('sc/final_list', $data);
    }
}


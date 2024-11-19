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
            redirect('auth/login');
        }
    }

    public function dashboard()
    {
        $this->load->model('Applicant_model');
        $activeAcademicYear = $this->Applicant_model->getActiveAcademicYear();
        $data['totalApplicants'] = $this->Applicant_model->getTotalApplicants($activeAcademicYear);
        $data['pendingApplicants'] = $this->Applicant_model->getApplicantsByStatus($activeAcademicYear, 'pending');
        $data['qualifiedApplicants'] = $this->Applicant_model->getApplicantsByStatus($activeAcademicYear, 'qualified');
        $data['notQualifiedApplicants'] = $this->Applicant_model->getApplicantsByStatus($activeAcademicYear, 'not qualified');
        $data['conditionalApplicants'] = $this->Applicant_model->getApplicantsByStatus($activeAcademicYear, 'conditional');
        $this->load->view('sc/dashboard', $data);
    }

    public function add_announcement()
    {
        $this->load->model('Sc_model');
        $data['announcements'] = $this->Sc_model->get_all_announcements();
        $data['message'] = $this->session->flashdata('message');
        $this->load->view('sc/add_announcement', $data);
    }

    public function submit_announcement()
    {
        $this->load->model('Sc_model');
        $this->load->library('upload');
        date_default_timezone_set('Asia/Manila');

        $data = [
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
            'announcement_date' => date('Y-m-d'),
            'announcement_time' => date('h:i:s A'),
            'content' => $this->input->post('content')
        ];

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10240;
        $this->upload->initialize($config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        if ($this->upload->do_upload('image')) {
            $data['image'] = $this->upload->data('file_name');
        } else {
            $data['image'] = null;
        }

        if ($this->Sc_model->add_announcement($data)) {
            $this->session->set_flashdata('message', 'Announcement added successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to add announcement.');
        }

        redirect('sc/add_announcement');
    }


    public function update_announcement()
    {
        $this->load->model('Sc_model');
        date_default_timezone_set('Asia/Manila');
        $id = $this->input->post('id');

        $data = [
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
            'announcement_date' => date('Y-m-d'),
            'announcement_time' => date('h:i:s A'),
            'content' => $this->input->post('content'),
        ];

        if ($_FILES['image']['name']) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 10240;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $data['image'] = $this->upload->data('file_name');
            } else {
                $data['image'] = null;
            }
        }

        if ($this->Sc_model->update_announcement($id, $data)) {
            $this->session->set_flashdata('message', 'Announcement updated successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to update announcement.');
        }

        redirect('sc/add_announcement');
    }

    public function delete_announcement($id)
    {
        $this->load->model('Sc_model');

        if ($this->Sc_model->delete_announcement($id)) {
            $this->session->set_flashdata('message', 'Announcement deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete announcement.');
        }

        redirect('sc/add_announcement');
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
        $current_date = date('Y-m-d');
        $data['current_date'] = $current_date;
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


        if ($this->form_validation->run() == FALSE) {
            $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
            $data['twc_users'] = $this->Sc_model->get_twcs();
            $data['requirements'] = $this->Sc_model->get_all_reqs();
            $this->load->view('sc/scholarship_program', $data);
        } else {
            $existing_program = $this->Sc_model->get_program_by_details(
                $this->input->post('scholarship_program'),
                $this->input->post('campus')
            );

            if ($existing_program) {
                $this->session->set_flashdata('error', 'Scholarship program already exists.');
                redirect('sc/scholarship_program');
            } else {
                $data = array(
                    'scholarship_program' => $this->input->post('scholarship_program'),
                    'campus' => $this->input->post('campus'),
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

        if ($this->form_validation->run() == FALSE) {
            $data['programs'] = $this->Sc_model->get_all_scholarship_programs();
            $data['twc_users'] = $this->Sc_model->get_twcs();
            $data['requirements'] = $this->Sc_model->get_all_reqs();
            $this->load->view('sc/scholarship_program', $data);
        } else {
            $data = array(
                'scholarship_program' => $this->input->post('scholarship_program'),
                'campus' => $this->input->post('campus'),
                'scholarship_type' => $this->input->post('scholarship_type'),
                'program_status' => $this->input->post('program_status'),
                'assigned_to' => $this->input->post('assigned_to'),
                'description' => $this->input->post('description'),
                'qualifications' => $this->input->post('qualifications'),
                'percentage' => $this->input->post('percentage'),
                'requirements' => implode(';', $this->input->post('requirements'))
            );

            $scholarship_program_name = $this->input->post('scholarship_program');

            $this->Sc_model->update_program($program_code, $data);

            if ($data['program_status'] == 'inactive') {
                $this->Sc_model->delete_applications_by_program_name($scholarship_program_name);
            }

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
            $this->Sc_model->all_inactive_school_years();

            $data = array(
                'academic_year' => $this->input->post('academic_year'),
                'year_status' => 'active'
            );
            // Insert the new academic year
            $this->Sc_model->insert_school_year($data);
            // Set success message and redirect
            $this->session->set_flashdata('message', 'School Year added successfully!');
            redirect('sc/school_year');
        }
    }

    public function edit_school_year()
    {
        $this->form_validation->set_rules('academic_year', 'Academic Year', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('sc/school_year');
        } else {
            $data = array(
                'academic_year' => $this->input->post('academic_year'),
            );

            $school_year_id = $this->input->post('school_year_id');
            $this->Sc_model->update_school_year($school_year_id, $data);

            $this->session->set_flashdata('message', 'School Year updated successfully!');
            redirect('sc/school_year');
        }
    }

    public function semester()
    {
        $data['semesters'] = $this->Sc_model->get_all_semesters();
        $this->load->view('sc/semester', $data);
    }

    public function toggle_semester_status()
    {
        $semester_id = $this->input->post('semester_id');
        $status = $this->input->post('status');

        $this->load->model('Sc_model');

        $semester = $this->Sc_model->get_semester_by_id($semester_id);

        if ($status == 'active') {
            $other_semester = ($semester->semester == '1st Semester') ? '2nd Semester' : '1st Semester';
            $this->Sc_model->update_semester_status_by_name($other_semester, 'inactive');
        }

        $data = array('status' => $status);
        $result = $this->Sc_model->update_semester_status($semester_id, $data);

        if ($result) {
            echo 'success';
        } else {
            echo 'failure';
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
        $shortlist = $this->Sc_model->get_application_list($scholarship_program);
        $data['shortlist'] = $shortlist;
        $this->load->view('sc/app_evaluation', $data);
    }

    public function view_shortlist_applicant($applicant_no)
    {
        $this->load->model('Applicant_model');
        $data['applicant'] = $this->Applicant_model->get_applicant_by_no($applicant_no);
        if (!$data['applicant']) {
            show_404();
        }
        $this->load->view('sc/view_applicant', $data);
    }

    public function update_shortlist()
    {
        $applicant_no = $this->input->post('applicant_no');
        $status = $this->input->post('status');
        $discount = $this->input->post('discount');
        $comment = $this->input->post('comment');

        if ($status === 'not qualified' || $status === 'conditional') {
            $discount = 0;
        }

        $this->Sc_model->update_application_form($applicant_no, $status, $discount, $comment);

        if ($status === 'conditional') {
            $this->send_conditional_email($applicant_no, $comment);
        } elseif ($status === 'not qualified') {
            $this->send_not_qualified_email($applicant_no);
        }
        $this->session->set_flashdata('success', true);
        redirect('sc/app_evaluation');
    }

    private function send_conditional_email($applicant_no, $comment)
    {
        $this->load->library('email');

        $applicant = $this->Sc_model->get_applicant_details($applicant_no);
        $email = $applicant->email;
        $firstname = $applicant->firstname;

        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Scholarship Application Status');

        $this->email->message("
            Dear $firstname, <br><br>
            We are writing to inform you that your scholarship application status has been marked as <strong>Conditional</strong>.<br><br>
            Please review the following comment from the evaluation committee: <br><br>
            <em>$comment</em> <br><br>
            If you have any questions or need further assistance, please feel free to contact us.<br><br>
            Best regards,<br>
            Divine Word College of Calapan<br>
            Scholarship Management Team
            ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent to applicant: ' . $applicant_no . ' - ' . $this->email->print_debugger());
        }
    }

    private function send_not_qualified_email($applicant_no)
    {
        $this->load->library('email');

        $applicant = $this->Sc_model->get_applicant_details($applicant_no);
        $email = $applicant->email;
        $firstname = $applicant->firstname;

        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Scholarship Application Status');

        $this->email->message("
            Dear $firstname, <br><br>
            We regret to inform you that your scholarship application has been marked as <strong>Not Qualified</strong>.<br><br>
            We appreciate your interest in the scholarship program. If you have any questions or need further clarification, please feel free to contact us.<br><br>
            Best regards,<br>
            Divine Word College of Calapan<br>
            Scholarship Management Team
            ");

        if (!$this->email->send()) {
            log_message('error', 'Email not sent to applicant: ' . $applicant_no . ' - ' . $this->email->print_debugger());
        }
    }

    public function submit_to_final_list()
    {
        $applicant_no = $this->input->post('applicant_no');
        $discount = $this->input->post('discount');

        $applicant = $this->Sc_model->get_applicant_by_id($applicant_no);

        if ($applicant->status !== "qualified") {
            echo json_encode(['status' => 'error', 'message' => 'Only qualified applicants can be submitted to the final list.']);
            return;
        }

        $existingEntry = $this->Sc_model->check_final_list_duplicate($applicant->id_number, $applicant->academic_year, $applicant->semester);

        if ($existingEntry) {
            echo json_encode(['status' => 'error', 'message' => 'This applicant is already in the final list for the same semester and academic year.']);
            return;
        }

        $data = [
            'applicant_no' => $applicant->applicant_no,
            'id_number' => $applicant->id_number,
            'firstname' => $applicant->firstname,
            'middlename' => $applicant->middlename,
            'lastname' => $applicant->lastname,
            'program_type' => $applicant->program_type,
            'year' => $applicant->year,
            'program' => $applicant->program,
            'campus' => $applicant->campus,
            'application_type' => $applicant->application_type,
            'academic_year' => $applicant->academic_year,
            'semester' => $applicant->semester,
            'scholarship_program' => $applicant->scholarship_program,
            'discount' => $discount,
        ];

        $this->Sc_model->insert_into_final_list($data);
        $this->send_email_notification($applicant->email, $applicant->firstname);
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
    // Controller (update reports method)
    public function reports()
    {
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        $data['scholarship_programs'] = $this->Sc_model->get_all_scholarship_programs();
        $data['applicant_counts'] = $this->Applicant_model->get_applicant_counts();
        $data['total_programs'] = $this->Sc_model->count_scholarship_programs();

        // Filter for scholarship reports
        $scholarship_filters = array(
            'academic_year' => $this->input->post('academic_year'),
            'semester' => $this->input->post('semester'),
            'program_type' => $this->input->post('program_type'),
            'year' => $this->input->post('year'),
            'scholarship_program' => $this->input->post('scholarship_program'),
            'discount' => $this->input->post('discount'),
            'program' => $this->input->post('program'),
            'status' => $this->input->post('status')
        );

        $data['applications'] = $this->Sc_model->get_applications($scholarship_filters);
        $this->load->view('sc/reports', $data);
    }

    public function grants()
    {
        // Fetching common data for the view
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        $data['scholarship_programs'] = $this->Sc_model->get_all_scholarship_programs();

        // Filter for grants
        $grants_filters = array(
            'academic_year' => $this->input->post('academic_year'),
            'semester' => $this->input->post('semester')
        );

        // Store selected filters for grants
        $data['selected_academic_year'] = $grants_filters['academic_year'];
        $data['selected_semester'] = $grants_filters['semester'];

        // Fetch grantee counts based on grants filters
        $data['grantee_counts'] = $this->Sc_model->get_grantee_counts($grants_filters);

        // Load the grants view
        $this->load->view('sc/grants', $data);
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
                    redirect('sc/update_info');
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
        $campus = $this->input->get('campus');
        $scholarship_program = $this->input->get('scholarship_program');
        $data['academic_years'] = $this->Sc_model->get_academic_filter_years();
        $data['scholarship_programs'] = $this->Sc_model->get_filter_scholarship_programs();
        $data['applicants'] = $this->Sc_model->get_filter_final_list($academic_year, $semester, $campus, $scholarship_program);
        $this->load->view('sc/final_list', $data);
    }
}

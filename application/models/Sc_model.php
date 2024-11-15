<?php
class Sc_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_scholarship_program($data)
    {
        return $this->db->insert('scholarship_programs', $data);
    }

    public function update_scholarship_program($program_code, $data)
    {
        $this->db->where('program_code', $program_code);
        $this->db->update('scholarship_programs', $data);
    }

    public function insert_program($data)
    {
        $this->db->insert('scholarship_programs', $data);
    }

    public function update_program($program_code, $data)
    {
        $this->db->where('program_code', $program_code);
        $this->db->update('scholarship_programs', $data);
    }

    public function delete_applications_by_program_name($scholarship_program_name)
    {
        $this->db->where('scholarship_program', $scholarship_program_name);
        $this->db->delete('application_form');
    }

    public function get_grantee_counts($grants_filters)
    {
        $this->db->select('scholarship_program, COUNT(*) as grantee_count');
        $this->db->from('final_list');

        // Apply filters if present
        if (!empty($grants_filters['academic_year'])) {
            $this->db->where('academic_year', $grants_filters['academic_year']);
        }
        if (!empty($grants_filters['semester'])) {
            $this->db->where('semester', $grants_filters['semester']);
        }

        $this->db->group_by('scholarship_program');
        $query = $this->db->get();

        return $query->result();
    }

    public function update_semester_dates($semester_id, $start_date, $end_date)
    {

        $data = [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        $this->db->where('semester_id', $semester_id);
        return $this->db->update('semester', $data);
    }

    public function update_semester_status_by_name($semester_name, $status)
{
    $this->db->where('semester', $semester_name);
    $this->db->update('semester', array('status' => $status));
}

    public function get_all_semesters()
    {
        $this->db->select('*');
        $this->db->from('semester');
        $query = $this->db->get();
        return $query->result();
    }


    public function delete_scholarship_program($program_code)
    {
        $this->db->where('program_code', $program_code);
        return $this->db->delete('scholarship_programs');
    }
    public function get_scholarship_programs($type)
    {
        $this->db->where('scholarship_type', $type);
        $query = $this->db->get('scholarship_programs');
        return $query->result();
    }

    public function insert_semester($data)
    {
        return $this->db->insert('semester', $data);
    }

    public function update_semester_status($semester_id, $data)
    {
        $this->db->where('semester_id', $semester_id);
        return $this->db->update('semester', $data);
    }

    public function get_all_academic_years()
    {
        $this->db->select('school_year_id, academic_year');
        $query = $this->db->get('school_year');
        return $query->result_array();
    }

    public function get_scholarship_program_by_name($scholarship_program)
    {
        $this->db->where('scholarship_program', $scholarship_program);
        return $this->db->get('scholarship_programs')->row();
    }


    public function get_twcs()
    {
        $this->db->select('id, name');
        $this->db->from('users');
        $this->db->where('usertype', 'TWC');
        $query = $this->db->get();
        return $query->result();
    }



    public function get_scholarship_program_by_code($program_code)
    {
        return $this->db->get_where('scholarship_programs', ['program_code' => $program_code])->row();
    }

    public function get_current_academic_year()
    {
        // Fetch the latest academic year based on created_at or the latest academic_year
        return $this->db->select('academic_year')
            ->order_by('created_at', 'DESC') // Get the most recently created program
            ->limit(1)
            ->get('scholarship_programs') // Table name
            ->row()->academic_year; // Return the academic_year field
    }



    public function get_all_scholarship_programs()
    {
        $query = $this->db->get('scholarship_programs');
        return $query->result();
    }

    public function get_filter_scholarship_programs()
    {
        $this->db->select('scholarship_program');
        $this->db->distinct();
        $this->db->from('scholarship_programs');
        $query = $this->db->get();
        return $query->result();
    }



    public function get_applications($filters = array())
    {
        $this->db->select('id_number, firstname, middlename, lastname, academic_year,semester, program_type, scholarship_program, discount');
        $this->db->from('final_list fl');

        if (!empty($filters['academic_year'])) {
            $this->db->where('fl.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['semester'])) {
            $this->db->where('fl.semester', $filters['semester']);
        }
        if (!empty($filters['program_type'])) {
            $this->db->where('fl.program_type', $filters['program_type']);
        }

        if (!empty($filters['scholarship_program'])) {
            $this->db->where('fl.scholarship_program', $filters['scholarship_program']);
        }

        if (!empty($filters['discount'])) {
            $this->db->where('fl.discount', $filters['discount']);
        }
        $query = $this->db->get();
        return $query->result();
    }


    public function get_all_school_years()
    {
        $query = $this->db->get('school_year');
        return $query->result();
    }

    public function insert_school_year($data)
    {
        return $this->db->insert('school_year', $data);
    }
    public function update_school_year($school_year_id, $data)
    {
        $this->db->where('school_year_id', $school_year_id);
        $this->db->update('school_year', $data);
    }
    public function get_application_list($scholarship_program = null)
    {
        $this->db->select('application_form.applicant_no, application_form.id_number, application_form.lastname, application_form.middlename, application_form.firstname, application_form.academic_year, application_form.semester, application_form.scholarship_program, application_form.application_type, application_form.discount, application_form.status');
        $this->db->from('application_form');
        $this->db->join('school_year', 'application_form.academic_year = school_year.academic_year');
        $this->db->join('final_list', 'application_form.applicant_no = final_list.applicant_no', 'left');
        $this->db->where('final_list.applicant_no IS NULL');
        $this->db->where('school_year.year_status', 'active');
        $this->db->where_in('application_form.status', ['qualified', 'not qualified', 'conditional']);

        if ($scholarship_program) {
            $this->db->where('application_form.scholarship_program', $scholarship_program);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_shortlist_scholarship_program()
    {
        $this->db->distinct();
        $this->db->select('scholarship_program');
        $query = $this->db->get('shortlist');
        return $query->result();
    }

    public function insert_final_list($data)
    {
        $this->db->insert('final_list', $data);
    }

    public function searchApplicants($query)
    {
        $this->db->like('id_number', $query);
        $this->db->or_like('firstname', $query);
        $this->db->or_like('lastname', $query);
        $this->db->or_like('email', $query);
        return $this->db->get('applicants')->result();
    }

    public function searchScholarshipPrograms($query)
    {
        $this->db->like('scholarship_program', $query);
        $this->db->or_like('program_code', $query);
        $this->db->or_like('scholarship_type', $query);
        return $this->db->get('scholarship_programs')->result();
    }

    public function searchShortlistedApplicant($query)
    {
        $this->db->like('shortlist_id', $query);
        $this->db->or_like('firstname', $query);
        $this->db->or_like('lastname', $query);
        $this->db->or_like('scholarship_program', $query);
        $this->db->or_like('status', $query);
        return $this->db->get('shortlist')->result();
    }

    public function get_all_active_scholarship_programs()
    {
        $this->db->where('program_status', 'Active');
        $query = $this->db->get('scholarship_programs');
        return $query->result();
    }

    public function get_academic_year()
    {
        $this->db->select('school_year_id, academic_year');
        $query = $this->db->get('school_year');
        return $query->result_array();
    }



    public function searchFinalApplicant($query)
    {
        $this->db->like('final_list_id', $query);
        $this->db->or_like('firstname', $query);
        $this->db->or_like('lastname', $query);
        $this->db->or_like('scholarship_program', $query);
        return $this->db->get('final_list')->result();
    }

    public function get_program_by_details($program_name, $campus)
    {
        $this->db->where('scholarship_program', $program_name);
        $this->db->where('campus', $campus);
        $query = $this->db->get('scholarship_programs');
        return $query->row();
    }



    public function searchSchoolYear($query)
    {
        $this->db->like('school_year_id', $query);
        $this->db->or_like('academic_year', $query);
        return $this->db->get('school_year')->result();
    }

    public function searchRequirement($query)
    {
        $this->db->like('id', $query);
        $this->db->or_like('requirement_name', $query);
        return $this->db->get('requirements')->result();
    }

    public function update_application_form($applicant_no, $status, $discount, $comment)
    {
        $this->db->where('applicant_no', $applicant_no);
        return $this->db->update('application_form', [
            'status' => $status,
            'discount' => $discount,
            'comment' => $comment
        ]);
    }

    public function get_applicant_details($applicant_no)
    {
        $this->db->select('firstname, email');
        $this->db->from('application_form');
        $this->db->where('applicant_no', $applicant_no);
        return $this->db->get()->row();
    }

    public function insert_into_final_list($data)
    {
        return $this->db->insert('final_list', $data);
    }

    public function get_applicants_by_program($program_code)
    {
        $this->db->select('af.*, sp.scholarship_program');
        $this->db->from('application_form af');
        $this->db->join('scholarship_programs sp', 'af.scholarship_program = sp.scholarship_program');
        $this->db->where('sp.program_code', $program_code);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_programs_with_applicant_count()
    {
        $this->db->select('sp.*, COUNT(af.applicant_no) AS applicant_count');
        $this->db->from('scholarship_programs sp');
        $this->db->join('application_form af', 'sp.scholarship_program = af.scholarship_program', 'left');
        $this->db->group_by('sp.program_code');
        $query = $this->db->get();

        return $query->result();
    }

    public function remove_from_shortlist($shortlist_id)
    {
        $this->db->where('shortlist_id', $shortlist_id);
        $this->db->delete('shortlist');
    }
    public function get_academic_filter_years()
    {
        $this->db->distinct(); // Ensure we get distinct academic years
        $this->db->select('academic_year');
        $query = $this->db->get('school_year');
        return $query->result(); // Return the result as an array of objects
    }

    public function get_academic_years()
    {
        return $this->db->get('school_year')->result();
    }

    public function count_scholarship_programs()
    {
        return $this->db->count_all('scholarship_programs');
    }

    public function count_school_years()
    {
        return $this->db->count_all('school_year');
    }

    public function get_program($program_code)
    {
        $this->db->where('program_code', $program_code);
        $query = $this->db->get('scholarship_programs');
        return $query->row_array();
    }


    public function insert_requirement($data)
    {
        $this->db->insert('requirements', $data);
    }


    public function get_all_requirements()
    {
        $this->db->select('id, requirement_name');
        $this->db->from('requirements');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_reqs()
    {
        $this->db->select('id, requirement_name');
        $query = $this->db->get('requirements');
        return $query->result();
    }

    public function get_requirement_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('requirements');
        return $query->row_array();
    }

    public function update_requirement($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('requirements', $data);
    }

    public function delete_requirement($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('requirements');
    }

    public function get_programs_by_twc($twc_id)
    {
        $this->db->select('*');
        $this->db->from('scholarship_programs');
        $this->db->where('assigned_to', $twc_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_final_list($program_code = null)
    {
        $this->db->select('final_list.*, scholarship_programs.scholarship_program');
        $this->db->from('final_list');
        $this->db->join('scholarship_programs', 'final_list.scholarship_program = scholarship_programs.scholarship_program');

        if ($program_code) {
            $this->db->where('scholarship_programs.program_code', $program_code);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_final_list_reports()
    {
        $query = $this->db->select('campus, academic_year, semester, program')
            ->from('final_list')
            ->get();
        return $query->result();
    }

    public function get_program_by_code($program_code)
    {
        $this->db->where('program_code', $program_code);
        $query = $this->db->get('scholarship_programs');
        return $query->row();
    }

    public function get_filtered_school_years($filter_semester = null, $filter_campus = null)
    {
        $this->db->select('*');
        $this->db->from('school_year');

        if (!empty($filter_semester)) {
            $this->db->where('semester', $filter_semester);
        }

        if (!empty($filter_campus)) {
            $this->db->where('campus', $filter_campus);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_final_list_by_academic_year($academic_year)
    {
        $this->db->select('*');
        $this->db->from('final_list');
        $this->db->where('academic_year', $academic_year);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_filtered_final_list($academic_year, $semester, $campus)
    {
        $this->db->select('*');
        $this->db->from('final_list');

        if (!empty($academic_year)) {
            $this->db->where('academic_year', $academic_year);
        }

        if (!empty($semester)) {
            $this->db->where('semester', $semester);
        }

        if (!empty($campus)) {
            $this->db->where('campus', $campus);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_application_list($semester = null, $status = null)
    {
        $this->db->select('*');
        $this->db->from('application_form');

        if ($semester) {
            $this->db->where('semester', $semester);
        }
        if ($status) {
            $this->db->where('status', $status);
        }

        $query = $this->db->get();
        return $query->result();
    }

    // Function to get filtered applicants
    public function get_filter_final_list($academic_year = null, $semester = null, $scholarship_program = null)
    {
        $this->db->select('*');
        $this->db->from('final_list');

        // Apply filters if provided
        if ($academic_year) {
            $this->db->where('academic_year', $academic_year);
        }
        if ($semester) {
            $this->db->where('semester', $semester);
        }
        if ($scholarship_program) {
            $this->db->where('scholarship_program', $scholarship_program);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function all_inactive_school_years()
    {
        $this->db->set('year_status', 'inactive');
        $this->db->update('school_year');
    }
    public function get_semester_by_id($semester_id)
    {
        return $this->db->where('semester_id', $semester_id)->get('semester')->row();
    }


    public function add_announcement($data)
    {
        return $this->db->insert('announcements', $data);
    }
    public function get_all_announcements()
    {
        return $this->db->get('announcements')->result(); // Adjust the table name as necessary
    }

    public function update_announcement($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('announcements', $data);
    }

    public function delete_announcement($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('announcements');
    }

    public function get_applicant_by_id($applicant_no)
    {
        $this->db->where('applicant_no', $applicant_no);
        $query = $this->db->get('application_form');
        return $query->row();
    }

    public function check_final_list_duplicate($id_number, $academic_year, $semester)
{
    $this->db->where('id_number', $id_number);
    $this->db->where('academic_year', $academic_year);
    $this->db->where('semester', $semester);
    $query = $this->db->get('final_list');

    return $query->num_rows() > 0;
}
}

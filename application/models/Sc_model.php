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
        $this->db->select('applicant_no, id_number, firstname, middlename, lastname, scholarship_program, status, academic_year, semester, application_type');
        $this->db->from('application_form af');

        if (!empty($filters['academic_year'])) {
            $this->db->where('af.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['semester'])) {
            $this->db->where('af.semester', $filters['semester']);
        }
        if (!empty($filters['application_type'])) {
            $this->db->where('af.application_type', $filters['application_type']);
        }
        // Filter for statuses 'qualified' and 'not qualified'
        if (!empty($filters['status']) && is_array($filters['status'])) {
            $this->db->where_in('af.status', $filters['status']);
        }
        if (!empty($filters['scholarship_program'])) {
            $this->db->where('af.scholarship_program', $filters['scholarship_program']);
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

    public function delete_school_year($school_year_id)
    {
        $this->db->where('school_year_id', $school_year_id);
        return $this->db->delete('school_year');
    }



    public function get_shortlist($scholarship_program = null)
    {
        if ($scholarship_program) {
            $this->db->where('scholarship_program', $scholarship_program);
        }

        $query = $this->db->get('shortlist');
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

    public function get_program_by_details($program_name, $campus, $academic_year, $semester)
    {
        $this->db->where('scholarship_program', $program_name);
        $this->db->where('campus', $campus);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('semester', $semester);
        $query = $this->db->get('scholarship_programs');
        return $query->row();
    }



    public function searchSchoolYear($query)
    {
        $this->db->like('school_year_id', $query);
        $this->db->or_like('academic_year', $query);
        $this->db->or_like('semester', $query);
        $this->db->or_like('campus', $query);
        return $this->db->get('school_year')->result();
    }

    public function searchRequirement($query)
    {
        $this->db->like('id', $query);
        $this->db->or_like('requirement_name', $query);
        return $this->db->get('requirements')->result();
    }


    public function get_shortlist_applicant($shortlist_id)
    {
        $this->db->where('shortlist_id', $shortlist_id);
        $query = $this->db->get('shortlist');
        return $query->row();
    }

    public function update_shortlist($shortlist_id, $status, $discount)
    {
        $this->db->where('shortlist_id', $shortlist_id);
        return $this->db->update('shortlist', ['status' => $status, 'discount' => $discount]);
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

    // Function to retrieve the final list of applicants filtered by academic year
    public function get_final_list_by_academic_year($academic_year)
    {
        $this->db->select('*');
        $this->db->from('final_list'); // Assuming 'final_list' is the table for storing final applicants
        $this->db->where('academic_year', $academic_year);
        $query = $this->db->get();
        return $query->result();
    }

    // Fetch filtered final list of applicants based on academic year and semester
    public function get_filtered_final_list($academic_year, $semester)
    {
        $this->db->select('*');
        $this->db->from('final_list'); // Adjust to your actual final list table

        // Apply academic year filter
        if (!empty($academic_year)) {
            $this->db->where('academic_year', $academic_year);
        }

        // Apply semester filter
        if (!empty($semester)) {
            $this->db->where('semester', $semester);
        }

        $query = $this->db->get();
        return $query->result();
    }


    // Function to get filtered applicants
    public function get_filter_final_list()
    {
        $this->db->select('*');
        $this->db->from('final_list');

        // Apply filters based on posted values (will be used in JS)
        if ($this->input->post('academic_year')) {
            $this->db->where('academic_year', $this->input->post('academic_year'));
        }
        if ($this->input->post('semester')) {
            $this->db->where('semester', $this->input->post('semester'));
        }
        if ($this->input->post('scholarship_program')) {
            $this->db->where('scholarship_program', $this->input->post('scholarship_program'));
        }

        return $this->db->get()->result();
    }
}

<?php
class Applicant_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Register a new applicant.
     *
     * @param array $data - Applicant data
     * @return bool - Returns TRUE on success, FALSE on failure
     */
    public function register_applicant($data)
    {
        return $this->db->insert('applicants', $data);
    }

    /**
     * Retrieve an applicant by ID.
     *
     * @param int $applicant_no - The applicant's registration ID
     * @return object - The applicant's data
     */
    public function get_applicant_by_id($id_number)
    {
        $this->db->where('account_no', $id_number);
        $query = $this->db->get('applicants');
        return $query->row();
    }

    public function get_user_by_id($user_id)
    {
        $this->db->where('id', $user_id);
        return $this->db->get('users')->row();
    }

    public function get_all_announcements()
    {
        return $this->db->get('announcements')->result(); // Adjust the table name as necessary
    }

    public function get_application_status($id_number)
    {
        $this->db->select('status');
        $this->db->from('application_form');
        $this->db->where('id_number', $id_number);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_active_semesters($semester_types = [])
    {
        $this->db->where_in('semester', $semester_types);
        $this->db->where('status', 'active');
        $query = $this->db->get('semester');
        return $query->result();
    }

    public function get_academic_filter_years()
    {
        $this->db->distinct();
        $this->db->select('academic_year');
        $query = $this->db->get('application_form');
        return $query->result();
    }

    public function get_applicant_applications($id_number)
    {
        $this->db->where('id_number', $id_number);
        $query = $this->db->get('application_form');
        return $query->result();
    }


    public function get_applicant_status($id_number)
    {
        $this->db->select('status, comment');
        $this->db->from('application_form');
        $this->db->where('id_number', $id_number);
        return $this->db->get()->row();
    }


    public function get_applicant_by_id_number($id_number)
    {
        $this->db->where('id_number', $id_number);
        $query = $this->db->get('applicants');
        return $query->row();
    }

    public function get_applications_by_id_number($id_number)
    {
        $this->db->where('id_number', $id_number);
        $query = $this->db->get('application_form'); // Assuming 'applications' is the table name
        return $query->result();
    }

    public function update_info($id_number, $data)
    {
        $this->db->where('id_number', $id_number);
        return $this->db->update('applicants', $data);
    }

    public function get_info($id_number)
    {
        $this->db->where('id_number', $id_number);
        $query = $this->db->get('applicants');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function get_application_count($id_number, $academic_year, $semester)
    {
        $this->db->where('id_number', $id_number);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('semester', $semester);
        $query = $this->db->get('application_form');

        return $query->num_rows(); // Returns the count of applications for this semester and academic year
    }
    /**
     * Update applicant details.
     *
     * @param int $applicant_no - The applicant's registration ID
     * @param array $data - Data to update
     * @return bool - Returns TRUE on success, FALSE on failure
     */
    public function update_applicant($applicant_no, $data)
    {
        $this->db->where('account_no', $applicant_no);
        return $this->db->update('applicants', $data);
    }

    /**
     * Delete an applicant by ID.
     *
     * @param int $applicant_no - The applicant's registration ID
     * @return bool - Returns TRUE on success, FALSE on failure
     */
    public function delete_applicant($applicant_no)
    {
        $this->db->where('account_no', $applicant_no);
        return $this->db->delete('applicants');
    }

    /**
     * Retrieve all applicants.
     *
     * @return array - List of applicants
     */
    public function get_all_applicants()
    {
        $query = $this->db->get('applicants');
        return $query->result();
    }

    public function get_applicant($applicant_no)
    {
        return $this->db->get_where('application_form', ['applicant_no' => $applicant_no])->row_array();
    }

    public function get_account_no($id_number)
    {

        $this->db->select('account_no');
        $this->db->from('applicants');
        $this->db->where('id_number', $id_number);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->row()->account_no;
        } else {
            return false;
        }
    }

    public function get_current_requirements($applicant_no)
    {
        $this->db->select('requirements');
        $this->db->from('application_Form');
        $this->db->where('applicant_no', $applicant_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->requirements;
        }
        return null;
    }

    public function get_all_accepted_applicants()
    {
        $this->db->where('status', 'accepted');
        $query = $this->db->get('applicants');
        return $query->result();
    }
    public function get_pending_applicants()
    {
        $this->db->where('status', 'pending');
        $query = $this->db->get('applicants');
        return $query->result();
    }

    public function verify_password($id_number, $password)
    {
        $this->db->where('id_number', $id_number);
        $query = $this->db->get('applicants');
        $applicant = $query->row();

        if ($applicant && password_verify($password, $applicant->password)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_password($id_number, $hashed_password)
    {
        $this->db->where('id_number', $id_number);
        return $this->db->update('applicants', ['password' => $hashed_password]);
    }

    public function add_scholarship_program($data)
    {
        return $this->db->insert('scholarship_programs', $data);
    }

    public function get_all_scholarship_programs()
    {
        $query = $this->db->get('scholarship_programs');
        return $query->result();
    }

    public function get_merit_programs()
    {
        $this->db->where('scholarship_type', 'Merit');
        $this->db->where('program_status', 'active');
        return $this->db->get('scholarship_programs')->result();
    }

    public function get_non_merit_programs()
    {
        $this->db->where('scholarship_type', 'Non-Merit');
        $this->db->where('program_status', 'active');
        return $this->db->get('scholarship_programs')->result();
    }
    public function get_program_by_code($program_code)
    {
        $this->db->where('program_code', $program_code);
        $query = $this->db->get('scholarship_programs');
        return $query->row();
    }

    public function get_next_applicant_no()
    {
        $this->db->select_max('applicant_no');
        $query = $this->db->get('application_form');
        $row = $query->row();
        $next_applicant_no = isset($row->applicant_no) ? $row->applicant_no + 1 : 1;
        return $next_applicant_no;
    }

    public function get_all_application()
    {
        $this->db->select('*');
        $this->db->from('application_form');
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_application($data)
    {
        return $this->db->insert('application_form', $data);
    }

    public function get_application_by_no($applicant_no)
    {
        $this->db->where('applicant_no', $applicant_no);
        $query = $this->db->get('application_form');
        return $query->row();
    }

    public function update_application($applicant_no, $data)
    {
        $this->db->where('applicant_no', $applicant_no);
        $this->db->update('application_form', $data);
    }
    public function get_applicants_by_twc($twc_id)
    {
        $this->db->select('application_form.applicant_no, application_form.id_number, application_form.lastname, application_form.firstname, application_form.program, application_form.year, scholarship_programs.scholarship_program, application_form.status');
        $this->db->from('application_form');
        $this->db->join('scholarship_programs', 'application_form.scholarship_program = scholarship_programs.scholarship_program');
        $this->db->join('school_year', 'application_form.academic_year = school_year.academic_year');
        $this->db->where('scholarship_programs.assigned_to', $twc_id);
        $this->db->where('school_year.year_status', 'active'); // Only get applicants in the active academic year

        $query = $this->db->get();
        return $query->result();
    }


    public function get_applicants_report_by_twc($twc_id, $filters = array())
    {
        $this->db->select('application_form.applicant_no, application_form.id_number,  application_form.lastname,  application_form.firstname, application_form.program, application_form.year, scholarship_programs.scholarship_program, application_form.academic_year, application_form.semester,  application_form.campus, application_form.status');
        $this->db->from('application_form');
        $this->db->join('scholarship_programs', 'application_form.scholarship_program = scholarship_programs.scholarship_program');
        $this->db->where('scholarship_programs.assigned_to', $twc_id);

        // Apply filters
        if (!empty($filters)) {
            if (isset($filters['academic_year'])) {
                $this->db->where('academic_year', $filters['academic_year']);
            }
            if (isset($filters['semester'])) {
                $this->db->where('semester', $filters['semester']);
            }
            if (isset($filters['campus'])) {
                $this->db->where('campus', $filters['campus']);
            }
            if (isset($filters['status'])) {
                $this->db->where('status', $filters['status']);
            }
            if (isset($filters['scholarship_program'])) {
                $this->db->where('scholarship_program', $filters['scholarship_program']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_applicants_by_academic_year($academic_year)
    {
        $this->db->where('academic_year', $academic_year);
        $query = $this->db->get('final_list');
        return $query->result();
    }
    public function get_shortlisted_applicant_by_id($shortlist_id)
    {
        $this->db->select('*');
        $this->db->from('applicants');
        $this->db->join('shortlist', 'shortlist.id_number = applicants.id_number');
        $this->db->where('shortlist.shortlist_id', $shortlist_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function get_applicant_counts()
    {
        $this->db->select("COUNT(*) as total");
        $total = $this->db->get('application_form')->row()->total;

        $this->db->where('status', 'qualified');
        $qualified = $this->db->get('application_form')->num_rows();

        $this->db->where('status', 'not qualified');
        $not_qualified = $this->db->get('application_form')->num_rows();

        $this->db->where('status', 'pending');
        $pending = $this->db->get('application_form')->num_rows();

        $this->db->where('status', 'conditional');
        $conditional = $this->db->get('application_form')->num_rows();

        return [
            'total' => $total,
            'qualified' => $qualified,
            'not qualified' => $not_qualified,
            'pending' => $pending,
            'conditional' => $conditional
        ];
    }

    public function getActiveAcademicYear()
    {
        $this->db->select('academic_year');
        $this->db->from('school_year');
        $this->db->where('year_status', 'active');
        $query = $this->db->get();
        return $query->row()->academic_year;
    }

    public function getTotalApplicants($academicYear)
    {
        return $this->db->where('academic_year', $academicYear)->count_all_results('application_form');
    }

    public function getApplicantsByStatus($academicYear, $status)
    {
        return $this->db->where('academic_year', $academicYear)
            ->where('status', $status)
            ->count_all_results('application_form');
    }

    public function get_uploaded_requirements($applicant_no)
    {
        // Query to fetch uploaded requirements
        $this->db->select('requirements');
        $this->db->from('application_form'); // Change to your actual table name
        $this->db->where('applicant_no', $applicant_no);
        $query = $this->db->get();

        return $query->result_array(); // Assuming the file names are stored in this format
    }

    public function count_qualified_applicants()
    {
        return $this->db->where('status', 'qualified')->count_all_results('shortlist');
    }

    public function count_not_qualified_applicants()
    {
        return $this->db->where('status', 'not qualified')->count_all_results('shortlist');
    }

    public function count_applications($id_number, $academic_year, $semester)
    {
        $this->db->where('id_number', $id_number);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('semester', $semester);
        $this->db->from('application_form');
        return $this->db->count_all_results();
    }
    public function check_duplicate_application($id_number, $scholarship_program, $semester, $academic_year)
    {
        $this->db->where('id_number', $id_number);
        $this->db->where('scholarship_program', $scholarship_program);
        $this->db->where('semester', $semester);
        $this->db->where('academic_year', $academic_year);
        $query = $this->db->get('application_form');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_active_academic_year()
    {
        $this->db->select('academic_year');
        $this->db->from('school_year');
        $this->db->where('year_status', 'active');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->academic_year;
        } else {
            return null;
        }
    }
}

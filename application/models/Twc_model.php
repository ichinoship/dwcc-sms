<?php
class Twc_model extends CI_Model
{

    public function update_applicant_status($applicant_no, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('applicant_no', $applicant_no);
        return $this->db->update('application_form');
    }

    public function evaluate_applicant($applicant_no, $status, $comment, $discount)
    {
        $this->update_applicant_status($applicant_no, $status);
        $applicant = $this->get_applicant_by_no($applicant_no);
        $data = [
            'applicant_no' => $applicant->applicant_no,
            'applicant_photo' => $applicant->applicant_photo,
            'id_number' => $applicant->id_number,
            'firstname' => $applicant->firstname,
            'middlename' => $applicant->middlename,
            'lastname' => $applicant->lastname,
            'birthdate' => $applicant->birthdate,
            'gender' => $applicant->gender,
            'contact' => $applicant->contact,
            'email' => $applicant->email,
            'program_type' => $applicant->program_type,
            'year' => $applicant->year,
            'program' => $applicant->program,
            'campus' => $applicant->campus,
            'address' => $applicant->address,
            'applicant_residence' => $applicant->applicant_residence,
            'academic_year' => $applicant->academic_year,
            'semester' => $applicant->semester,
            'application_type' => $applicant->application_type,
            'scholarship_program' => $applicant->scholarship_program,
            'requirements' => $applicant->requirements,
            'comment' => $comment,
            'discount' => $discount,
            'status' => $status,
        ];

        $insert_result = $this->db->insert('shortlist', $data);
        if ($status === 'not qualified') {
            $this->db->where('applicant_no', $applicant_no);
            $update_result = $this->db->update('application_form', ['comment' => $comment, 'status' => $status]);
            return $insert_result && $update_result;
        }
        return $insert_result;
    }

    public function update_conditional_applicant($applicant_no, $status, $comment)
    {
        $this->db->where('applicant_no', $applicant_no);
        return $this->db->update('application_form', ['status' => $status, 'comment' => $comment]);
    }

    public function get_applicant_details($applicant_no)
    {
        $this->db->select('firstname, email');
        $this->db->from('application_form');
        $this->db->where('applicant_no', $applicant_no);
        return $this->db->get()->row();
    }

    public function get_applicant_email($applicant_no)
    {
        $this->db->select('email');
        $this->db->from('application_form');
        $this->db->where('applicant_no', $applicant_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->email;
        }
        return false;
    }

    public function search_applicants_by_programs($search_query, $assigned_programs)
    {
        $program_names = array_map(function ($program) {
            return $program->scholarship_program;
        }, $assigned_programs);

        $this->db->select('*');
        $this->db->from('application_form');
        $this->db->where_in('scholarship_program', $program_names);

        $this->db->group_start();
        $this->db->like('id_number', $search_query);
        $this->db->or_like('firstname', $search_query);
        $this->db->or_like('lastname', $search_query);
        $this->db->or_like('email', $search_query);
        $this->db->or_like('program', $search_query);
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }

    public function get_shortlisted_applicants($search_query, $assigned_programs)
    {
        $program_names = array_map(function ($program) {
            return $program->scholarship_program;
        }, $assigned_programs);

        $this->db->select('*');
        $this->db->from('shortlist');
        $this->db->where_in('scholarship_program', $program_names);

        $this->db->group_start();
        $this->db->like('id_number', $search_query);
        $this->db->or_like('firstname', $search_query);
        $this->db->or_like('lastname', $search_query);
        $this->db->or_like('email', $search_query);
        $this->db->or_like('program', $search_query);
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }


    public function get_applicant_by_no($applicant_no)
    {
        $this->db->where('applicant_no', $applicant_no);
        return $this->db->get('application_form')->row();
    }
    public function get_scholarship_programs_by_user($user_id)
    {
        $this->db->select('scholarship_program');
        $this->db->where('assigned_to', $user_id);
        $query = $this->db->get('scholarship_programs');
        return $query->result();
    }

    public function get_shortlist_by_programs($program_codes)
    {
        $this->db->where_in('scholarship_program', $program_codes);
        $this->db->where_in('status', ['qualified', 'not qualified', 'conditional']);
        $query = $this->db->get('shortlist');
        return $query->result();
    }

    public function get_applicants_by_twc($user_id)
    {
        $this->db->where('scholarship_program', $user_id);
        $this->db->where_in('status', ['pending', 'conditional']);
        $query = $this->db->get('application_form');
        return $query->result();
    }

    public function get_application_by_shortlist_id($shortlist_id)
    {
        $this->db->where('shortlist_id', $shortlist_id);
        return $this->db->get('shortlist')->row();
    }

    public function get_report_counts_by_programs($program_codes)
    {
        $this->db->select('
            SUM(CASE WHEN status = "qualified" THEN 1 ELSE 0 END) as qualified,
            SUM(CASE WHEN status = "not qualified" THEN 1 ELSE 0 END) as not_qualified,
            SUM(CASE WHEN status = "conditional" THEN 1 ELSE 0 END) as conditional,
            SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending,
            COUNT(*) as total
        ');
        $this->db->where_in('scholarship_program', $program_codes);
        $query = $this->db->get('application_form');
        return $query->row_array();
    }

    public function get_scholarship_programs_with_grantees($program_codes)
    {
        $this->db->select('
            sp.program_code,
            sp.scholarship_program,
            sp.percentage,
            COUNT(a.applicant_no) as num_grantees
        ');
        $this->db->from('scholarship_programs sp');
        $this->db->join('application_form a', 'sp.scholarship_program = a.scholarship_program AND a.status = "qualified"', 'left');
        $this->db->where_in('sp.scholarship_program', $program_codes);
        $this->db->group_by('sp.program_code, sp.scholarship_program, sp.percentage');
        $query = $this->db->get();
        return $query->result_array();
    }
}

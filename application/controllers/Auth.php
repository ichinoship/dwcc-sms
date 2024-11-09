<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login()
    {
        $this->form_validation->set_rules('id_number', 'ID Number', 'required', [
            'required' => 'ID Number is required.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password is required.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login');
        } else {
            $id_number = $this->input->post('id_number');
            $password = md5($this->input->post('password'));
            $user = $this->Admin_model->get_user_by_credentials($id_number, $password);

            if ($user) {
                if ($user->status == 1) {
                    $this->session->set_userdata([
                        'user_id' => $user->id,
                        'user_type' => $user->usertype,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                        'user_image' => $user->image
                    ]);

                    switch ($user->usertype) {
                        case 'Admin':
                            redirect('admin/dashboard');
                            break;
                        case 'Scholarship Coordinator':
                            redirect('sc/dashboard');
                            break;
                        default:
                            redirect('twc/dashboard');
                            break;
                    }
                } else {
                    $this->session->set_flashdata('error_account', 'Your account is inactive. Please contact the admin.');
                    redirect('auth/login');
                }
            } else {
                $id_number_exists = $this->Admin_model->get_user_by_id_number($id_number);
                if (!$id_number_exists) {
                    $this->session->set_flashdata('error_id_number', 'Invalid ID number. Please try again.');
                }
                $this->session->set_flashdata('error_password', 'Invalid password. Please try again.');
                redirect('auth/login');
            }
        }
    }


    public function applicant_login()
    {
        $this->form_validation->set_rules('id_number', 'ID Number', 'required', [
            'required' => 'ID Number is required.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password is required.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login_applicant');
        } else {
            $id_number = $this->input->post('id_number');
            $password = $this->input->post('password');
            $applicant = $this->Admin_model->get_applicant_by_id_number($id_number);

            if ($applicant) {
                // Check password
                if (password_verify($password, $applicant->password)) {
                    if ($applicant->account_status == 'active') {
                        if ($applicant->status == 'accepted') {
                            $this->session->set_userdata([
                                'user_id' => $applicant->id,
                                'user_type' => 'applicant',
                                'first_name' => $applicant->firstname,
                                'last_name' => $applicant->lastname,
                                'user_id_number' => $applicant->id_number,
                                'user_image' => $applicant->image
                            ]);
                            redirect('applicant/dashboard_applicant');
                        } elseif ($applicant->status == 'inactive') {
                            $this->session->set_flashdata('error_password', 'Your account has been inactive. Please contact the admin.');
                            redirect('auth/applicant_login');
                        } else {
                            $this->session->set_flashdata('error_password', 'Your application is not yet approved.');
                            redirect('auth/applicant_login');
                        }
                    } else {
                        $this->session->set_flashdata('error_password', 'Your account is inactive. Please contact the admin.');
                        redirect('auth/applicant_login');
                    }
                } else {
                    $this->session->set_flashdata('error_password', 'Incorrect password. Please try again.');
                    redirect('auth/applicant_login');
                }
            } else {
                $this->session->set_flashdata('error_id_number', 'Invalid ID Number. Please try again.');
                redirect('auth/applicant_login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function applicant_logout()
    {
        $this->session->sess_destroy();
        redirect('auth/applicant_login');
    }

    public function applicant_forgot_password()
    {
        $this->load->view('applicant_forgot_password');
    }

    //Applicant Reset Password
    public function applicant_send_verification_code()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('applicant_forgot_password');
        } else {
            $email = $this->input->post('email');
            $applicant = $this->Admin_model->get_applicant_by_email($email);

            if ($applicant) {
                $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT); // Generate a 6-digit code
                $this->session->set_userdata('verification_code', $code);
                $this->session->set_userdata('email', $email);

                $this->applicant_send_verification_email($email, $code);
                $this->session->set_flashdata('message', 'A verification code has been sent to your email.');
                redirect('auth/applicant_verify_code');
            } else {
                $this->session->set_flashdata('error', 'Email address not found.');
                redirect('auth/applicant_forgot_password');
            }
        }
    }

    private function applicant_send_verification_email($email, $code)
    {
        $subject = 'Password Reset Verification Code';
        $message = "Your verification code is: $code";

        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }

    public function applicant_verify_code()
    {
        $this->load->view('applicant_verify_code');
    }

    public function applicant_check_verification_code()
    {
        $this->form_validation->set_rules('code[]', 'Verification Code', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('applicant_verify_code');
        } else {

            $code = implode('', $this->input->post('code'));


            if ($code === $this->session->userdata('verification_code')) {
                redirect('auth/applicant_reset_password');
            } else {
                $this->session->set_flashdata('error', 'Invalid verification code.');
                redirect('auth/applicant_verify_code');
            }
        }
    }

    public function applicant_reset_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('applicant_reset_password');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('email');
            $this->Admin_model->update_password($email, $password);
            $this->applicant_send_password_reset_email($email);
            $this->session->set_flashdata('message', 'Your password has been reset successfully. You can now log in.');
            redirect('auth/applicant_login');
        }
    }

    private function applicant_send_password_reset_email($email)
    {
        $this->load->library('email');
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Password Reset Successful');

        $message = "
        <h2>Password Reset Successful</h2>
        <p>Dear applicant,</p>
        <p>Your password has been successfully reset. You can now log in using your new password.</p>
        <p>If you did not request this change, please contact our support team immediately.</p>
        <p>Thank you,<br>DWCC Scholarship Management System</p>
    ";

        $this->email->message($message);
        if (!$this->email->send()) {
            log_message('error', 'Email failed to send to ' . $email);
        }
    }

    //User Reset Password
    public function user_forgot_password()
    {
        $this->load->view('user_forgot_password');
    }

    public function user_send_verification_code()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('user_forgot_password');
        } else {
            $email = $this->input->post('email');
            $user = $this->Admin_model->get_user_by_email($email);

            if ($user) {
                $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $this->session->set_userdata('verification_code_user', $code);
                $this->session->set_userdata('email_user', $email);

                $this->user_send_verification_email($email, $code);
                $this->session->set_flashdata('message', 'A verification code has been sent to your email.');
                redirect('auth/user_verify_code');
            } else {
                $this->session->set_flashdata('error', 'Email address not found.');
                redirect('auth/user_forgot_password');
            }
        }
    }

    private function user_send_verification_email($email, $code)
    {
        $subject = 'Password Reset Verification Code';
        $message = "Your verification code is: $code";

        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }

    public function user_verify_code()
    {
        $this->load->view('user_verify_code');
    }

    public function user_check_verification_code()
    {
        $this->form_validation->set_rules('code[]', 'Verification Code', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('user_verify_code');
        } else {
            $code = implode('', $this->input->post('code'));

            if ($code === $this->session->userdata('verification_code_user')) {
                redirect('auth/user_reset_password');
            } else {
                $this->session->set_flashdata('error', 'Invalid verification code.');
                redirect('auth/user_verify_code');
            }
        }
    }

    public function user_reset_password()
    {

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('user_reset_password');
        } else {

            $password = md5($this->input->post('password'));
            $email = $this->session->userdata('email_user');

            $this->Admin_model->update_password_user($email, $password);
            $this->user_send_password_reset_email($email);
            $this->session->set_flashdata('message', 'Your password has been reset successfully.');
            redirect('auth/login');
        }
    }

    private function user_send_password_reset_email($email)
    {
        $this->email->from('dwcc.sms@gmail.com', 'DWCC Scholarship Management System');
        $this->email->to($email);
        $this->email->subject('Password Reset Successful');

        $message = "
    <h2>Password Reset Successful</h2>
    <p>Your password has been successfully reset. You can now log in using your new password.</p>
    <p>Thank you,<br>DWCC Scholarship Management System</p>
    ";
    
        $this->email->message($message);
        $this->email->send();
    }
}

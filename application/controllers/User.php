<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *       http://example.com/index.php/welcome
     *   - or -
     *       http://example.com/index.php/welcome/index
     *   - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        /*
         * constructor : load parent constructor , models and all important libraries we need.
         */
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');

        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->helper(array('form', 'url'));
    }

    /*
    * load login view
    * */
    public function loadLogin()
    {
        $this->load->view('login');
    }

    /*
     * load register view
     * */
    public function loadRegister()
    {
        $this->load->view('register');
    }

    /*
     * take input from user form
     * check input using form validation
     * redirect to suitable page with suitable message
     * */
    public function register()
    {
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.user_email]');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('age', 'age', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect('user/loadRegister');
        } else {

            $user_name = $this->input->post('username');
            $email = $this->input->post('email');
            $age = $this->input->post('age');
            $city = $this->input->post('city');
            $password = sha1($this->input->post('password'));
//array for data 
            $data = array(
                'user_name' => $user_name,
                'user_email' => $email,
                'user_password' => $password,
                'user_age' => $age,
                'user_city' => $city,
            );
            $email_check = $this->user_model->emailCheck($email);
            if ($email_check) {
                $res = $this->user_model->register($data);
                if ($res) {
                    $this->session->set_userdata('register_done', 'Registered successfully.Now login to your account.');
                    redirect('user/loadLogin');
                } //data for one reuest then automaticlly cleared
                else {
                    $this->session->set_userdata('register_error', 'Something error please try again ');
                }
                redirect('user/loadRegister');
            } else {
                $this->session->set_userdata('email_exist', 'This email is already Regestred Log in Now.');
                redirect('user/loadLogin');
            }
        }
    }

    /*
     * take input from user form
     * check user name and password
     * redirect to suitable page with suitable message
     */
    public function login()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = sha1($this->input->post('password'));
            $data = array(
                'user_email' => $email,
                'user_password' => $password,
            );
            $info = $this->user_model->loginUser($email, $password);
            if ($info) {
                $this->session->set_userdata('user_id', $info['user_id']);
                $this->session->set_userdata('user_email', $info['user_email']);
                $this->session->set_userdata('user_name', $info['user_name']);
                $this->session->set_userdata('user_age', $info['user_age']);
                $this->session->set_userdata('user_city', $info['user_city']);
                redirect('lists/index');
            } else {
                $this->session->set_userdata('error_msglog', 'Error occured,Try again.');
                redirect('user/loadLogin');
            }
        }
    }//

    /*
     * destroy all session and redirct user to log in page
     * */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user/loadLogin');
    }
}
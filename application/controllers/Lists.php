<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller
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
        //load model , session and helper
        parent::__construct();
        $this->load->model('list_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->helper(array('form', 'url'));
    }


    /*
     * redirect uer to suitable page index or login
    * if user logged in correctly then to suitable index page with his data
    * else : to login .

     */
    public function index()
    {
        if ($this->session->userdata('user_id')) {
            $list_data = $this->list_model->getList($this->session->userdata('user_id'));
            $this->session->set_userdata('lists', $list_data);
            $this->load->view('user_profile');
        } else {
            redirect(base_url() . 'user/loadLogin');
        }


    }


    /*
     * add list to database
     * take input from user and call add_list from lists model
     */
    public function addList()
    {
        if ($this->session->userdata('user_id')) {
            $event['event_start'] = $this->input->post('t_start');;
            $event['event_end'] = $this->input->post('t_end');;
            $event['event_name'] = $this->input->post('t_name');
            $event['user_id'] = $this->session->userdata('user_id');
            $event['is_completed'] = '0';
            $this->list_model->addList($event);
            $list_data = $this->list_model->getList($this->session->userdata('user_id'));
            $this->session->set_userdata('lists', $list_data);
        } else {
            redirect(base_url() . 'user/loadLogin');

        }
    }

    /*
     * delete list from database
     *  take input from user and call delete_list from lists model
     */
    public function deleteList()
    {
        if ($this->session->userdata('user_id')) {
            $id = $this->input->post('id');
            $this->list_model->deleteList($id);
        } else {
            redirect(base_url() . 'user/loadLogin');

        }

    }

    /*
     *  update list in database
     *  take input from user and call get_statues from lists model to indicate if task complete or not
     * call update_list from lists model
     */
    public function updateList()
    {
        if ($this->session->userdata('user_id')) {
            $id = $this->input->post('id');
            $res = $this->list_model->getStatus($id);

            if ($res['0']['is_completed'] == 1) {
                echo 'complete';
                $arr = array(
                    'is_completed' => '0'
                );
                $this->list_model->updateList($id, $arr);
            } else {
                echo 'not';
                $arr = array(
                    'is_completed' => '1'
                );
                $this->list_model->updateList($id, $arr);
            }
        }else{
            redirect(base_url() . 'user/loadLogin');
        }


    }
}

?>
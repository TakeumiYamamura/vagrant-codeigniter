<?php

class Twitterlogin extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Twitter_members_model');
    }
    function index()
    {   
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'パスワード', 'trim|required|md5|min_length[5]|alpha_numeric');       
        if($this->form_validation->run() == false){
            $this->load->view('login');
            return(true);
        }
        $this->Twitter_members_model->login();
    }
}
?>
<?php

class Twitterregister extends CI_Controller {
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
        $this->form_validation->set_rules('name', 'ユーザ名', 'trim|required');
        $this->form_validation->set_rules('password', 'パスワード', 'trim|required|min_length[5]|md5|alpha_numeric');
        $this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email|callback_email_check');
        if($this->form_validation->run() == false){
            $this->load->view('register');
            return true;
        }
        $data['name']      =$_POST['name'];
        $data['password']  =$_POST['password'];
        $data['email']     =$_POST['email'];
        $this->Twitter_members_model->register_db($data);
        $this->load->view('formsuccess');
    }
  
    function email_check($str)
    {
        $this->Twitter_members_model->email_validation($str);
        return true;
    }
}
?>
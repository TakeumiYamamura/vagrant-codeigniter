<?php
class Twitterregister extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Twitter_members_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        $this->form_validation->set_rules('name', 'ユーザ名', 'trim|required');
        $this->form_validation->set_rules('password', 'パスワード', 'trim|required|min_length[6]|alpha_numeric|md5');
        $this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email|callback_email_check');
        if($this->form_validation->run() == false){
            return $this->load->view('register');
        }
        $data['name']      = $this->input->post('name');
        $data['password']  = $this->input->post('password');
        $data['email']     = $this->input->post('email');
        $this->Twitter_members_model->register_db($data);
        redirect("twittermain/index");
    }

    public function email_check($str)
    {
        $query = $this->Twitter_members_model->email_validation($str);
        if($query->num_rows() != NULL){
            $this->form_validation->set_message('email_check', 'すでに登録したメールアドレスは使えません');
            return false;
        }
        return true;        
    }

}
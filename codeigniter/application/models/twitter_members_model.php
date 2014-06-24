<?php
class Twitter_members_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function login()
    {
        $this->db->select('*')->from('members')->where(array('password'=>$_POST['password'],'email'=>$_POST['email'],));
        $query =$this->db->get();
        if($query->num_rows() != 0){
           $this->load->view('formsuccess');
           //setcookie('myId');
           return true;
        }
								$this->load->view('login');
    }
    function register_db($data)
    {       
        $this->db->insert('members',$data);
        //$this->session->set_userdata($data);
        //echo $thid->session->userdata('email');
     }
     function email_validation($str)
     {
        $this->db->select('*')->from('members')->where('email',$str);
        $query =$this->db->get();
        if($query->num_rows() != NULL){
            $this->form_validation->set_message('email_check', 'すでに登録したメールアドレスは使えません');
            return false;
        }
        return true;
      }


    /*function set_customer_info($data)//登録フォームでの入力データをセッションに保存
    {
        foreach ($data as $key => $val){
            $this->session->set_userdata($key, $val);
        }
    }
    function get_customer_info_from_session()//登録フォームでの入力データを　セッションから取得
    {
        $data['username']  =$this ->session->set_userdata('username'); 
        $data['password']  =$this ->session->set_userdata('password');
        $data['email']     =$this ->session->set_userdata('email');
        return $data;
    }
    function email_get_from_db()
    {   
    }
    function set_cookie()
    {
    }*/
}
?>
<?php
class Twitter_members_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        //$this->load->library('session'); なぜかエラーが生じる
        //session start();
    }
    function login()
    {
        $this->db->select('*')->from('members')->where(array('password'=>$_POST['password'],'email'=>$_POST['email'],));
        $query =$this->db->get();
        //var_dump($query);
        if($query->num_rows() != 0){
           $row = $query->row_array();
           setcookie('id',$row['id'],time() +60 * 60);
           setcookie('name',$row['name'],time() +60 * 60);
        }
    }
    function register_db($data)
    {       
        $this->db->insert('members',$data);
        //$this->session->set_userdata($data);
        //echo $thid->session->userdata('email');
        $this->db->select('*')->from('members')->where('name',$data['name']);
        $query =$this->db->get();
        $row = $query->row_array();
        setcookie('id',$row['id'],time() +60 * 60);
        setcookie('name',$data['name'],time() +60 * 60);
     }
    function email_validation($str)
     {
        $this->load->library('form_validation');
        $this->db->select('*')->from('members')->where('email',$str);
        $query =$this->db->get();
        return($query);

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
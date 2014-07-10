<?php
class Twitter_members_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function login()
    {
        $this->db->select('*')->from('members')->where(array('password'=>$_POST['password'],'email'=>$_POST['email'],));
        $query =$this->db->get();
        if($query->num_rows() != 0){
           $row = $query->row_array();
           $newdata = array(
                   'id' => $row['id'],
                   'name' => $row['name']
               );
           $this->session->set_userdata($newdata);
        }
    }

    function register_db($data)
    {       
        $this->db->insert('members',$data);
        $this->db->select('*')->from('members')->where('name',$data['name']);
        $query =$this->db->get();
        $row = $query->row_array();
        $newdata = array(
                   'id' => $row['id'],
                   'name' => $row['name']
            );
        $this->session->set_userdata($newdata);
    }

    function email_validation($str)
    {
        $this->load->library('form_validation');
        $this->db->select('*')->from('members')->where('email',$str);
        $query =$this->db->get();
        return($query);
    }

}
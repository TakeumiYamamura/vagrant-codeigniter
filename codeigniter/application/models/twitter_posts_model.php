<?php
class Twitter_posts_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function register($data)
    {       
        $this->db->insert('posts',$data);
        return $this->db->insert_id();
    }

    public function get_tweet()
    {   
        $name=$this->session->userdata('name');
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->join('members','members.id = posts.id');
        $this->db->where('name', $name);
        $query =$this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function session_destroy()
    {
        $this->session->sess_destroy();
    }
}
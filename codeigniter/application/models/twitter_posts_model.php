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
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->join('members','members.id = posts.id');
        $query =$this->db->get();
        $row = $query->result_array();
        return $row;
    }
}
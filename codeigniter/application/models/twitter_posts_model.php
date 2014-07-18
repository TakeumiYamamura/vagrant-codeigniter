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
        $this->db->insert('posts', $data);
        return $this->db->insert_id();
    }

    public function get_tweet($page ,$add)
    {   
        $id = $this->session->userdata('user_id');
        $offset = ($page - 1) * 10 + $add; 
        $this->db->select('*')->from('posts')->join('members', 'members.user_id = posts.user_id')->where('posts.user_id', $id)->order_by("tweet_id", "desc")->limit(10, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_simple()
    {
        $this->db->select('*')->from('posts')->join('members', 'members.user_id = posts.user_id')->order_by("tweet_id", "desc")->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function session_destroy()
    {
        $this->session->sess_destroy();
    }
    
}
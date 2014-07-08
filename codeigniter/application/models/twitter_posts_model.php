<?php
class Twitter_posts_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        session_start();
    }
    function start()
    {
        $data['name'] = $_COOKIE['name'];
        $data['id']   = $_COOKIE['id'];

    }
    function register($data)
    {       
        $this->db->insert('posts',$data);
    }
    function get_tweet()
    {
        $query =$this->db->get('posts');
        $row = $query->result_array();
        return $row;
    }
}
?>
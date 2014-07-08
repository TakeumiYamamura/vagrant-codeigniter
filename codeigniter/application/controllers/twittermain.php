<?php

class Twittermain extends CI_Controller
{
    function __construct()
	{
	    parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('javascript');
		$this->load->model('Twitter_posts_model');
	}

	public function index()
	{
        $this->Twitter_posts_model->start();
        if (!isset($_COOKIE['id'])) {
        	return redirect("twitterlogin/index");
        }
        $this->load->view('formsuccess');	
	}

	public function get_list()
	{
        $json = $this->Twitter_posts_model->get_tweet();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));

	}

	public function register()
	{
	    $data['message']  =$_POST['message'];
	    $data['name']     =$_COOKIE['name'];
		$data['id']       =$_COOKIE['id'];
		$this->Twitter_posts_model->register($data);         
	}
}

?>


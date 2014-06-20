<?php

class Twitterlogin extends CI_Controller {
    function __construct()
	{
	    parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('twitter_model');
	}
		

	function index()
	{   
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('twitter_model');
		
		
		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'パスワード', 'trim|required|md5|min_length[5]|alpha_numeric');       
		
		
		if($this->form_validation->run() == true)
		{
		    
			$this->load->database();
		    $this->db->select('*');
			$this->db->from('members');
			$this->db->where('password',$_POST['password']);
			$this->db->where('email',$_POST['email']);
			$query =$this->db->get();
			if($query->num_rows() != 0)
			{
				$this->load->view('formsuccess');
			}
		
		
		}
		else
		{
			$this->load->view('login');
		}
		
		
	}
}

?>
	
	
	
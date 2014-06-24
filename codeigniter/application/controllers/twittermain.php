<?php

class Twittermain extends CI_Controller {
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
		//$this->load->library('session');
		
		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'パスワード', 'trim|required|md5|min_length[5]|alpha_numeric');       
		
		$this->load->view->('formsuccess');
		if($this->form_validation->run() == true)
		{
		    
		    //$data['password']  =$_POST['password'];
		    //$data['email']     =$_POST['email'];
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
			//$this->Twitter_model->set_customer_info($data);
			//dbに情報をいれる
			$this->load->database();
		}
		else
		{
			$this->load->view('login');
		}
		
		
	}
}

?>
<?php

class Twitterregister extends CI_Controller {
    function __construct()
	{
	    parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
		

	function index()
	{   
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'ユーザ名', 'trim|required');
        $this->form_validation->set_rules('password', 'パスワード', 'trim|required|min_length[5]|md5|alpha_numeric');
        $this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email|callback_email_check');

		
		if($this->form_validation->run() == true)
		{
		    $data['name']      =$_POST['name'];
		    $data['password']  =$_POST['password'];
		    $data['email']     =$_POST['email'];
			
			//dbに情報をいれる
			$this->load->database();
			$this->db->insert('members',$data);
			$this->load->view('formsuccess');
		}
		else
		{
			$this->load->view('register');
		}
		
		
	}
	
	function email_check($str)
	{
        $this->load->database();
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('email',$str);
		$query =$this->db->get();
		if($query->num_rows() != NULL)
		{
			$this->form_validation->set_message('email_check', 'すでに登録したメールアドレスは使えません');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

?>
<?php
class Twittermain extends CI_Controller
{
    function __construct()
	{
	    parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session','javascript'));
		$this->load->model('Twitter_posts_model');
	}

	public function index()
	{
		$check = $this->session->userdata('name');
        if ($check == "") {
        	return redirect("twitterlogin");
        }
        $this->load->view('main');	
	}

	public function get_list()
	{
		$pages = $this->input->post('page');
        $json = $this->Twitter_posts_model->get_tweet($pages);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
	}

	public function register()
	{
	    $str =$this->input->post('message');
	    $data['message']=$str;
		$data['user_id']     =$this->session->userdata('user_id');
	    $this->form_validation->set_rules('message', 'メッセージ', 'trim|required');
        if($this->form_validation->run() == true){
        	$data['message'] =str_replace("\n", "<br>", $str);
        	echo $this->Twitter_posts_model->register($data);
        }
	}

	public function logout()
	{
		$this->Twitter_posts_model->session_destroy();
		redirect(base_url("index.php/twitterlogin/index"));
	}

}
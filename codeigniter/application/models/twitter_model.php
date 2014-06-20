<?php
class Twitter_model extends CI_Model{
    

    function __construct()
	{
	    parent::__construct();
	    $this->load->database();
	}
	function set_customer_info($data)//登録フォームでの入力データをセッションに保存
    {
	    foreach ($data as $key => $val)
	    {
		    $this->session->set_userdata($key, $val);
	    }
    }
    function get_customer_info_from_session()//登録フォームでの入力データを　セッションから取得
    {
		$data['username']  =$this ->session->set_userdata('username');
		$data['password']  =$this ->session->set_userdata('password');
		$data['email']     =$this ->session->set_userdata('email');
		
		return $data;
	}	
	
	function email_get_from_db()
	{
	   
	   
    }
}
?>
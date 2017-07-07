<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Mod_manager');
	}
	function test(){
		$data = array(
			'id'=> uniqid(), //以目前時間建立
			'email'=>'lb01640000@gmail.com',
			'phone'=>'0982772589',
			'password'=> sha1('1234'),
			'nickname'=>'Lavit',
			'create_date'=>date('Y-m-d'),
			'create_time'=>date('H:i:s')
			);
		echo $this->db->insert('manager_main',$data);
	}
}

?>
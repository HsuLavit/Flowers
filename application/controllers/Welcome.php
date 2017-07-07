<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->Model('Mod_product');
		}
	function index(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop",
			'path'=>'index',
			'page'=>'flower.php',
			'menu'=>'index'
			);

		$view_data['feature'] = $this->Mod_product->get_feature();

		$this->load->view('layout',$view_data);
	}
}

?>
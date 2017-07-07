<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_console extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Mod_manager');
		$this->load->model('Mod_member');
		$this->load->model('Mod_category');
		$this->load->model('Mod_product');	
		$this->load->model('Mod_contact');
		$this->load->model('Mod_order');
		$this->load->model('Mod_news');
	}

	/******************************/

	/*********   Manager  *********/

	/******************************/


	function delete_manager(){
		$id = $this->input->post('id');
		if($this->Mod_manager->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}
	
	/******************************/

	/*********  Member * *********/

	/******************************/
	function delete_member(){
		$id = $this->input->post('id');
		if($this->Mod_member->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}

	/******************************/

	/*********  category  *********/

	/******************************/
	function delete_category(){
		$id = $this->input->post('id');
		if($this->Mod_category->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}

	/******************************/

	/*********   Product  *********/

	/******************************/
	function delete_product(){
		$id = $this->input->post('id');
		if($this->Mod_product->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}

	function delete_sub_photo() {
		$id = $this->input->post('id');
		if($this->Mod_product->delete_sub_photo($id)) {
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '刪除成功！';
		}else{
			$dataResponse['sys_code'] = 404;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。';
		}
		echo json_encode($dataResponse);
	}

	function online_product() {
		$id = $this->input->post('id');
		$num = $this->input->post('num');
		if($this->Mod_product->set_online($id, $num)) {
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '設定成功！';
		}else{
			$dataResponse['sys_code'] = 404;
			$dataResponse['sys_msg'] = '發生錯誤，設定失敗。';
		}
		echo json_encode($dataResponse);
	}

	function feature_product() {
		$id = $this->input->post('id');
		$num = $this->input->post('num');
		if($this->Mod_product->set_feature($id, $num)) {
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '設定成功！';
		}else{
			$dataResponse['sys_code'] = 404;
			$dataResponse['sys_msg'] = '發生錯誤，設定失敗。';
		}
		echo json_encode($dataResponse);
	}

	function upload_trumbowyg_image() {

		if(isset($_FILES)) {
			$dataArray['main_photo'] = 'photos/' . uniqid();
			if($_FILES['image']['type'] == 'image/png' ||
				$_FILES['image']['type'] == 'image/jpeg' ||
				$_FILES['image']['type'] == 'image/jpg') {
				if($_FILES['image']['type'] == 'image/png') {
					$dataArray['main_photo'] = $dataArray['main_photo'] . '.png';
				}else{
					$dataArray['main_photo'] = $dataArray['main_photo'] . '.jpg';
				}
				if(!file_exists('photos')) {
					mkdir('photos', 0777, true);
				}
				if(copy($_FILES['image']['tmp_name'], $dataArray['main_photo'])) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '圖片新增成功...';
					$view_data['link'] = $dataArray['main_photo'];
				}else{
					$view_data['sys_code'] = 500;
					$view_data['sys_msg'] = '圖片新增失敗...';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '檔案格式不符合';
			}
		}else{
			$dataArray['main_photo'] = 'assets/img/default.png';
		}

		echo json_encode($view_data);
	}

	function upload_sub_photo() {
		if(isset($_FILES)) {
			$dataArray['id'] = uniqid();
			$dataArray['product_id'] = $this->input->post('id');
			$dataArray['product_image'] = 'photos/' . $dataArray['id'];
			if($_FILES['image']['type'] == 'image/png' ||
				$_FILES['image']['type'] == 'image/jpeg' ||
				$_FILES['image']['type'] == 'image/jpg') {
				if($_FILES['image']['type'] == 'image/png') {
					$dataArray['product_image'] = $dataArray['product_image'] . '.png';
				}else{
					$dataArray['product_image'] = $dataArray['product_image'] . '.jpg';
				}
				if(!file_exists('photos')) {
					mkdir('photos', 0777, true);
				}
				if(copy($_FILES['image']['tmp_name'], $dataArray['product_image'])) {
					$this->Mod_product->insert_sub_photo($dataArray);
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '圖片新增成功...';
					$view_data['link'] = $dataArray['product_image'];
					$view_data['id'] = $dataArray['id'];
				}else{
					$view_data['sys_code'] = 500;
					$view_data['sys_msg'] = '圖片新增失敗...';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '檔案格式不符合';
			}
		}

		echo json_encode($view_data);
	}

	/******************************/

	/*********   Contact  *********/

	/******************************/

	function delete_contact(){
		$id = $this->input->post('id');
		if($this->Mod_contact->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}

	/******************************/

	/*********   Text     *********/

	/******************************/

	function delete_order(){
		$id = $this->input->post('id');
		if($this->Mod_order->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}

	/******************************/

	/*********   News  * *********/

	/******************************/
	function delete_news(){
		$id = $this->input->post('id');
		if($this->Mod_news->delete($id)){
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '刪除成功。' ;	
		}else{
			$dataResponse['sys_code'] = 200 ;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。' ;	
		}
		echo json_encode($dataResponse);
	}

}
?>
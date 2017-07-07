<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->Model('Mod_manager');
		$this->load->Model('Mod_member');
		$this->load->Model('Mod_category');
		$this->load->Model('Mod_product');
		$this->load->Model('Mod_order');
		$this->load->Model('Mod_contact');
		$this->load->Model('Mod_news');
		$this->load->Model('Mod_hot');
	}
	function index(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Index",
			'path'=>'console/index',
			'page'=>'dashboard.php',
			'menu'=>'dashboard'
			);
		if($this->Mod_manager->chk_login_status()){
			$this->load->view('console/layout',$view_data);
		}else{
			redirect(base_url('index.php/console/login'));}
	}
	
	function login(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop Console",
			'path'=>'console/login',
			'page'=>'console/login.php'
			);
 
		if($this->input->post('rule') == 'login'){
			$email = $this->input->post('email');
			$pwd = $this->input->post('password');

			if($this->Mod_manager->chk_login($email,$pwd)){
				// 登入中
				$this->Mod_manager->do_login($email);
				redirect(base_url('index.php/console')) ;
			}else{
				$view_data['error'] = '登入失敗，信箱或密碼錯誤。';
				}
			}
		else{ 
				if($this->Mod_manager->chk_login_status()) {
					redirect(base_url('index.php/console'));
				}
			}	
		$this->load->view($view_data['path'],$view_data);

	}
	function logout() {
		if($this->Mod_manager->logout()) {
			redirect(base_url('index.php/console/login'));
		} 
	}

	/******************************/

	/*********   Manager  *********/

	/******************************/
	function manager_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Manager",
			'path'=>'index.php/console/manager',
			'page'=>'manager_list.php',
			'menu'=>'manager'
			);
		
		$view_data['list'] = $this->Mod_manager->get_all();

		$view_data['total'] = $this->Mod_manager->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function manager_insert(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Manager",
			'path'=>'index.php/console/manager/insert',
			'page'=>'manager_insert.php',
			'menu'=>'manager'
			);
		if($this->input->post('rule') == 'insert'){
			$dataArray = array(
			'id'=> uniqid(), //以目前時間建立
			'email'=> $this->input->post('email'),
			'password'=> $this->input->post('password'),
			'nickname'=> $this->input->post('nickname'),
			'phone'=> $this->input->post('phone'),
			);
			if($dataArray['email'] != '' && $dataArray['password'] != '' && $dataArray['nickname'] != '' &&  $this->input->post('confirmPassword') !='') {

				if($dataArray['password'] === $this->input->post('confirmPassword')){

					if(!$this->Mod_manager->get_once_by_email($dataArray['email'])){

						$dataArray['password'] = sha1($dataArray['password']) ;
						$dataArray['create_date'] = date('Y-m-d');
						$dataArray['create_time'] = date('H-i-s');

						if($this->Mod_manager->insert($dataArray)){
							$view_data['sys_code'] = 200 ;
							$view_data['sys_msg']='新增成功。';
							redirect(base_url('index.php/console/manager'));
						}else{
							$view_data['sys_code'] = 404 ;
							$view_data['sys_msg']= '新增失敗，發生錯誤。';

						}
					}else{
						$view_data['sys_code'] = 404 ;
						$view_data['sys_msg']='信箱重複。';

					}
				}
				else{
					$view_data['sys_code'] = 404 ;
					$view_data['sys_msg']='您輸入的密碼不一致。';
				}

			}
			else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}
		}

		$this->load->view('console/layout',$view_data);
	}

	function manager_update($id){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Manager",
			'path'=>'index.php/console/manager/update/'.$id,
			'page'=>'manager_update.php',
			'menu'=>'manager'
			);

		if($this->input->post('rule') == 'update'){
			$id = $this->input->post('id');
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone')
				);

			if($dataArray['email'] != '' && $dataArray['nickname'] != ''){
				
				if(!$this->Mod_manager->chk_repeat_email($id,$dataArray['email'])){
					if(($this->input->post('password') != '' 
							&& $this->input->post('password') === $this->input->post('confirmPassword')) || $this->input->post('password') =='' ) {
						if($this->input->post('password') != '' 
							&& $this->input->post('password') === $this->input->post('confirmPassword')) {
								$dataArray['password'] = sha1($this->input->post('password'));
						}
							if($this->Mod_manager->update($id,$dataArray)){
						
								$view_data['sys_code'] = 200 ;
								$view_data['sys_msg']='更新成功。';
								redirect(base_url('index.php/console/manager'));
					
							}else{
								$view_data['sys_code'] = 404 ;
								$view_data['sys_msg']= '更新失敗，發生錯誤。';
	
							}
					}else{
						$view_data['sys_code'] = 404 ;
						$view_data['sys_msg']= '密碼不一致。';
					}
				
						
				}else{
					$view_data['sys_code'] = 404 ;
					$view_data['sys_msg'] = '信箱重複。' ;
				}
			}else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}

		}

		$view_data['res'] = $this->Mod_manager->get_once($id);

		if($view_data['res']){
			$this->load->view('console/layout',$view_data);
		}else{
			redirect(base_url('index.php/console/manager'));
		}		
	}


	/**********************************/

	/*********   Pagination  **********/

	/**********************************/

	function pagination($url, $total, $per){
			// 載入分頁內容
		$this->load->library('pagination');	

		$config['base_url']= base_url($url) ;
		$config['total_rows'] = $total ;
		$config['per_page'] = $per ;
		//  顯示實際頁面數
		$config['use_page_numbers'] = TRUE;
		// 實際顯示PAGE在網址上
		$config['page_query_string'] = TRUE;
		// 分頁左右加入TAG標籤
		$config['full_tag_open'] = '<div class="ui right floated pagination menu">';
		$config['full_tag_close'] = '</div>' ;
		// 自訂起始分頁連結名稱
		$config['first_link'] = '第一頁' ; 
		$config['first_tag_open'] = '<li class="item">' ;
		$config['first_tag_close'] = '</li>' ; 
		 // 自訂結束分頁連結名稱
		$config['last_link'] = '最後一頁' ; 
		$config['last_tag_open'] = '<li class="item">' ;
		$config['last_tag_close'] = '</li>' ;  
		// 下一頁
		$config['next_link'] = '<i class="right chevron icon"></i>' ; 
		$config['next_tag_open'] = '<li class="icon item">' ;
		$config['next_tag_close'] = '</li>' ;  
		// 上一頁
		$config['prev_link'] = '<i class="left chevron icon"></i>' ; 
		$config['prev_tag_open'] = '<li class="icon item">' ;
		$config['prev_tag_close'] = '</li>' ;  
		// 自訂目前的頁面連結名稱
		$config['cur_tag_open'] = '<li class="item active"><a href="#">' ;
		$config['cur_tag_close'] = '</a></li>' ;  
		// 自訂f其他的頁面連結名稱
		$config['num_tag_open'] = '<li class="item">' ;
		$config['num_tag_close'] = '</li>' ;  

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}



	/**********************************/

	/*********   Member   ************/

	/**********************************/
	function member_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Member",
			'path'=>'index.php/console/member',
			'page'=>'member_list.php',
			'menu'=>'member'
			);
		
		$view_data['list'] = $this->Mod_member->get_all();

		$view_data['total'] = $this->Mod_member->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function member_insert(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Member",
			'path'=>'index.php/console/member/insert',
			'page'=>'member_insert.php',
			'menu'=>'member'
			);
		if($this->input->post('rule') == 'insert'){
			$dataArray = array(
			'id'=> uniqid(), //以目前時間建立
			'email'=> $this->input->post('email'),
			'password'=> $this->input->post('password'),
			'nickname'=> $this->input->post('nickname'),
			'phone'=> $this->input->post('phone'),
			'address'=> $this->input->post('address')
			);
			if($dataArray['email'] != '' && $dataArray['password'] != '' && $dataArray['nickname'] != '' &&  $this->input->post('confirmPassword') !='') {

				if($dataArray['password'] === $this->input->post('confirmPassword')){

					if(!$this->Mod_member->get_once_by_email($dataArray['email'])){

						$dataArray['password'] = sha1($dataArray['password']) ;
						$dataArray['create_date'] = date('Y-m-d');
						$dataArray['create_time'] = date('H-i-s');

						if($this->Mod_member->insert($dataArray)){
							$view_data['sys_code'] = 200 ;
							$view_data['sys_msg']='新增成功。';
							redirect(base_url('index.php/console/member'));
						}else{
							$view_data['sys_code'] = 404 ;
							$view_data['sys_msg']= '新增失敗，發生錯誤。';

						}
					}else{
						$view_data['sys_code'] = 404 ;
						$view_data['sys_msg']='信箱重複。';

					}
				}
				else{
					$view_data['sys_code'] = 404 ;
					$view_data['sys_msg']='您輸入的密碼不一致。';
				}

			}
			else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}
		}

		$this->load->view('console/layout',$view_data);
	}

	function member_update($id){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Member",
			'path'=>'index.php/console/member/update/'.$id,
			'page'=>'member_update.php',
			'menu'=>'member'
			);

		if($this->input->post('rule') == 'update'){
			$id = $this->input->post('id');
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone'),
				'address'=> $this->input->post('address')
				);

			if($dataArray['email'] != '' && $dataArray['nickname'] != ''){
				
				if(!$this->Mod_member->chk_repeat_email($id,$dataArray['email'])){
					if(($this->input->post('password') != '' 
							&& $this->input->post('password') === $this->input->post('confirmPassword')) || $this->input->post('password') =='' ) {
						if($this->input->post('password') != '' 
							&& $this->input->post('password') === $this->input->post('confirmPassword')) {
								$dataArray['password'] = sha1($this->input->post('password'));
						}
							if($this->Mod_member->update($id,$dataArray)){
						
								$view_data['sys_code'] = 200 ;
								$view_data['sys_msg']='更新成功。';
								redirect(base_url('index.php/console/member'));
					
							}else{
								$view_data['sys_code'] = 404 ;
								$view_data['sys_msg']= '更新失敗，發生錯誤。';
	
							}
					}else{
						$view_data['sys_code'] = 404 ;
						$view_data['sys_msg']= '密碼不一致。';
					}
				
						
				}else{
					$view_data['sys_code'] = 404 ;
					$view_data['sys_msg'] = '信箱重複。' ;
				}
			}else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}

		}

		$view_data['res'] = $this->Mod_member->get_once($id);

		if($view_data['res']){
			$this->load->view('console/layout',$view_data);
		}else{
			redirect(base_url('index.php/console/member'));
		}		
	}
	
	/**********************************/

	/*********   Category  ************/

	/**********************************/
	function category_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Category",
			'path'=>'index.php/console/category',
			'page'=>'category_list.php',
			'menu'=>'category'
			);
		
		$view_data['list'] = $this->Mod_category->get_all();

		$view_data['total'] = $this->Mod_category->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function category_insert(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Category",
			'path'=>'index.php/console/category/insert',
			'page'=>'category_insert.php',
			'menu'=>'category'
			);
		if($this->input->post('rule') == 'insert'){
			$dataArray = array(
			'id'=> uniqid(), //以目前時間建立
			'type'=> $this->input->post('type')
			);
			if($dataArray['type'] != '' ) {				

					if($this->Mod_category->insert($dataArray)){
						$view_data['sys_code'] = 200 ;
						$view_data['sys_msg']='新增成功。';
						redirect(base_url('index.php/console/category'));
					}else{
						$view_data['sys_code'] = 404 ;
						$view_data['sys_msg']= '新增失敗，發生錯誤。';
					}
					
			}else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}
		}
		$this->load->view('console/layout',$view_data);
	}

	function category_update($id){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Category",
			'path'=>'index.php/console/category/update/'.$id,
			'page'=>'category_update.php',
			'menu'=>'category'
			);

		if($this->input->post('rule') == 'update'){
			$id = $this->input->post('id');
			$dataArray = array(
				'type'=> $this->input->post('type')
				);

			if($dataArray['type'] != ''){

				if($this->Mod_category->update($id,$dataArray)){
			
					$view_data['sys_code'] = 200 ;
					$view_data['sys_msg']='更新成功。';
					redirect(base_url('index.php/console/category'));
					
				}else{
					$view_data['sys_code'] = 404 ;
					$view_data['sys_msg']= '更新失敗，發生錯誤。';
	
				}
			}else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}

		}

		$view_data['res'] = $this->Mod_category->get_once($id);

		if($view_data['res']){
			$this->load->view('console/layout',$view_data);
		}else{
			redirect(base_url('index.php/console/category'));
		}		
	}

	/**********************************/

	/*********   Product   ************/

	/**********************************/
	function product_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Product",
			'path'=>'index.php/console/product',
			'page'=>'product_list.php',
			'menu'=>'product'
			);
		
		$view_data['list'] = $this->Mod_product->get_all();

		$view_data['total'] = $this->Mod_product->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function product_insert(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Product",
			'path'=>'index.php/console/product/insert',
			'page'=>'product_insert.php',
			'menu'=>'product'
			);

		$dataArray['id'] = uniqid() ;
		$dataArray['title'] = 'Default' ;

		if($this->Mod_product->insert($dataArray)){
			redirect(base_url('index.php/console/product/update/'.$dataArray['id']));
		}else{
			redirect(base_url('index.php/console/product/'));
		}
	}

	function product_update($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Flower - Console Product",
			'path'=> 'index.php/console/product/update/'.$id,
			'page'=> 'product_update.php',
			'menu'=> 'product'
			);


		if($this->input->post('rule') == 'update') {
			$id = $this->input->post('id');
			$dataArray = array(
				'title'=> $this->input->post('title'),
				'sub_title'=> $this->input->post('sub_title'),
				'category'=> $this->input->post('category'),
				'price'=> $this->input->post('price'),
				'cost'=> $this->input->post('cost'),
				'reserve'=> $this->input->post('reserve'),
				'content'=> $this->input->post('trumbowyg-content'),
				'online'=> $this->input->post('online'),
				'feature'=> $this->input->post('feature')
				);

			if($_FILES['main_photo_file']['type']) {
				$dataArray['main_photo'] = 'photos/' . uniqid();

				if($_FILES['main_photo_file']['type'] == 'image/png' ||
					$_FILES['main_photo_file']['type'] == 'image/jpeg' ||
					$_FILES['main_photo_file']['type'] == 'image/jpg') {
					if($_FILES['main_photo_file']['type'] == 'image/png') {
						$dataArray['main_photo'] = $dataArray['main_photo'] . '.png';
					}else{
						$dataArray['main_photo'] = $dataArray['main_photo'] . '.jpg';
					}

					if(!file_exists('photos')) {
						mkdir('photos', 0777, true);
					}

					if(copy($_FILES['main_photo_file']['tmp_name'], $dataArray['main_photo'])) {
						$view_data['sys_code'] = 200;
						$view_data['sys_msg'] = '圖片新增成功...';
					}else{
						$view_data['sys_code'] = 500;
						$view_data['sys_msg'] = '圖片新增失敗...'; //failed to open stream: Permission denied  
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '檔案格式不符合';
				}
			}

			if($dataArray['title'] != '') {
				if($this->Mod_product->update($id, $dataArray)) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '更新成功！';
					redirect(base_url('index.php/console/product'));
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '更新失敗，發生錯誤。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}

		$view_data['res'] = $this->Mod_product->get_once($id);
		$view_data['category'] = $this->Mod_category->get_all();
		$view_data['sub_photo'] = $this->Mod_product->get_sub_all_photo($id);
		
		if($view_data['res']) {
			$this->load->view('console/layout', $view_data);
		}else{
			redirect(base_url('index.php/console/product'));
		} 
	}

	/**********************************/

	/*********    Order    ************/

	/**********************************/
	function order_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Order",
			'path'=>'index.php/console/order',
			'page'=>'order_list.php',
			'menu'=>'order'
			);
		
		$view_data['list'] = $this->Mod_order->get_all();

		$view_data['total'] = $this->Mod_order->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function order_details($id){    // 查看單筆訂單有哪些資料
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Order",
			'path'=>'index.php/console/order',
			'page'=>'order_details.php',
			'menu'=>'order'
			);

		if($this->input->post('rule') == 'update'){
			$id = $this->input->post('id');
			$dataArray = array(
				'status'=> $this->input->post('status')
				);

			if($dataArray['status'] != ''){

				if($this->Mod_order->update($id,$dataArray)){
			
					$view_data['sys_code'] = 200 ;
					$view_data['sys_msg']='更新成功。';
					redirect(base_url('index.php/console/order'));
					
				}else{
					$view_data['sys_code'] = 404 ;
					$view_data['sys_msg']= '更新失敗，發生錯誤。';
	
				}
			}else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;
			}

		}

		$view_data['res'] = $this->Mod_order->get_once($id);

		if($view_data['res']){
			$this->load->view('console/layout',$view_data);
		}else{
			redirect(base_url('index.php/console/order'));
		}		
	}

	function order_insert(){  // 測試用
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Order",
			'path'=>'index.php/console/order/insert',
			'page'=>'order_insert.php',
			'menu'=>'order'
			);
		if($this->input->post('rule') == 'insert'){
			$dataArray = array(
			'id'=> uniqid(), //以目前時間建立
			'buy_id'=> $this->input->post('buy_id'),
			'buy_name'=> $this->input->post('buy_name'),
			'buy_email'=> $this->input->post('buy_email'),
			'buy_phone'=> $this->input->post('buy_phone'),
			'buy_name'=> $this->input->post('buy_name'),
			'buy_addr'=> $this->input->post('buy_addr'),
			'buy_remark'=> $this->input->post('buy_remark')
			);

			if($dataArray['buy_id'] != '' && $dataArray['buy_name'] != '' && $dataArray['buy_email'] != '' &&  $this->input->post('buy_phone') !='' &&  $this->input->post('buy_addr') !='') {

						$dataArray['create_date'] = date('Y-m-d');
						$dataArray['create_time'] = date('H-i-s');

						if($this->Mod_order->insert($dataArray)){
							$view_data['sys_code'] = 200 ;
							$view_data['sys_msg']='新增成功。';
							redirect(base_url('index.php/console/order'));
						}else{
							$view_data['sys_code'] = 404 ;
							$view_data['sys_msg']= '新增失敗，發生錯誤。';
						}
			}
			else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';

			}
		}


		$this->load->view('console/layout',$view_data);
	}

	/**********************************/

	/*********    Contact  ************/

	/**********************************/
	function contact_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Contact",
			'path'=>'index.php/console/contact',
			'page'=>'contact_list.php',
			'menu'=>'contact'
			);
		
		$view_data['list'] = $this->Mod_contact->get_all();

		$view_data['total'] = $this->Mod_contact->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function contact_details($id){    // 查看單筆訂單有哪些資料
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Contact",
			'path'=>'index.php/console/contact',
			'page'=>'contact_details.php',
			'menu'=>'contact'
			);


		$view_data['res'] = $this->Mod_contact->get_once($id);

		if($view_data['res']){
			$this->load->view('console/layout',$view_data);
		}else{
			redirect(base_url('index.php/console/contact'));
		}		
	}

	function contact_insert(){  // 測試用
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Contact",
			'path'=>'index.php/console/contact/insert',
			'page'=>'contact_insert.php',
			'menu'=>'contact'
			);
		if($this->input->post('rule') == 'insert'){
			$dataArray = array(
			'id'=> uniqid(), //以目前時間建立
			'name'=> $this->input->post('name'),
			'email'=> $this->input->post('email'),
			'phone'=> $this->input->post('phone'),
			'message'=> $this->input->post('message')
			);

			if($dataArray['name'] != '' && $dataArray['email'] != '' &&  $this->input->post('phone') !='' &&  $this->input->post('message') !='') {

						$dataArray['create_date'] = date('Y-m-d');
						$dataArray['create_time'] = date('H-i-s');

						if($this->Mod_contact->insert($dataArray)){
							$view_data['sys_code'] = 200 ;
							$view_data['sys_msg']='新增成功。';
							redirect(base_url('index.php/console/contact'));
						}else{
							$view_data['sys_code'] = 404 ;
							$view_data['sys_msg']= '新增失敗，發生錯誤。';
						}
			}
			else{
				$view_data['sys_code'] = 404 ;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。' ;

			}
		}

		$this->load->view('console/layout',$view_data);
	}

	/**********************************/

	/*********    Test     ************/

	/**********************************/
	function hot_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console Hot",
			'path'=>'index.php/console/hot_list',
			'page'=>'hot_list.php',
			'menu'=>'product'
			);
		
		$view_data['list'] = $this->Mod_hot->get_all();

		$view_data['total'] = $this->Mod_hot->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}


	/**********************************/

	/*********     News    ************/

	/**********************************/
	function news_list(){
		// 頁面資訊
		$view_data = array( 
			'title'=>"FlowerShop - Console News",
			'path'=>'index.php/console/news',
			'page'=>'news_list.php',
			'menu'=>'news'
			);
		
		$view_data['list'] = $this->Mod_news->get_all();

		$view_data['total'] = $this->Mod_news->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'],$view_data['total'],10);


		$this->load->view('console/layout',$view_data);
	}

	function news_insert() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console News",
			'path'=> 'console/news/insert',
			'page'=> 'news_insert.php',
			'menu'=> 'news'
			);

		if($this->input->post('rule') == 'insert') {
			$dataArray = array(
				'title'=> $this->input->post('title'),
				'description'=> $this->input->post('description'),
				'create_date'=> date('Y-m-d'),
				'create_time'=> date('H:i:s'),
				'release_date'=> $this->input->post('release_date'),
				'release_time'=> $this->input->post('release_time')
				);

			if($_FILES['image']['type']) {
				$dataArray['image'] = 'photos/' . uniqid();

				if($_FILES['image']['type'] == 'image/png' ||
					$_FILES['image']['type'] == 'image/jpeg' ||
					$_FILES['image']['type'] == 'image/jpg') {
					if($_FILES['image']['type'] == 'image/png') {
						$dataArray['image'] = $dataArray['image'] . '.png';
					}else{
						$dataArray['image'] = $dataArray['image'] . '.jpg';
					}

					if(!file_exists('photos')) {
						mkdir('photos', 0777, true);
					}

					if(copy($_FILES['image']['tmp_name'], $dataArray['image'])) {
						$view_data['sys_code'] = 200;
						$view_data['sys_msg'] = '圖片新增成功...';
					}else{
						$view_data['sys_code'] = 500;
						$view_data['sys_msg'] = '圖片新增失敗...';
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '檔案格式不符合';
				}
			}

			if($dataArray['title'] != '' && $dataArray['release_date'] != '' && $dataArray['release_time'] != '') {
				$dataArray['id'] = uniqid();
				if($this->Mod_news->insert($dataArray)) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '新增成功！';
					redirect(base_url('index.php/console/news'));
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '新增失敗，發生錯誤。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}
		$this->load->view('console/layout', $view_data);
	}

	function news_update($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console News",
			'path'=> 'console/news/update/'.$id,
			'page'=> 'news_update.php',
			'menu'=> 'news'
			);
		if($this->input->post('rule') == 'update') {
			$id = $this->input->post('id');
			$dataArray = array(
				'title'=> $this->input->post('title'),
				'description'=> $this->input->post('description'),
				'create_date'=> date('Y-m-d'),
				'create_time'=> date('H:i:s'),
				'release_date'=> $this->input->post('release_date'),
				'release_time'=> $this->input->post('release_time')
				);


			if($_FILES['image']['type']) {
				$dataArray['image'] = 'photos/' . uniqid();

				if($_FILES['image']['type'] == 'image/png' ||
					$_FILES['image']['type'] == 'image/jpeg' ||
					$_FILES['image']['type'] == 'image/jpg') {
					if($_FILES['image']['type'] == 'image/png') {
						$dataArray['image'] = $dataArray['image'] . '.png';
					}else{
						$dataArray['image'] = $dataArray['image'] . '.jpg';
					}

					if(!file_exists('photos')) {
						mkdir('photos', 0777, true);
					}

					if(copy($_FILES['image']['tmp_name'], $dataArray['image'])) {
						$view_data['sys_code'] = 200;
						$view_data['sys_msg'] = '圖片新增成功...';
					}else{
						$view_data['sys_code'] = 500;
						$view_data['sys_msg'] = '圖片新增失敗...';
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '檔案格式不符合';
				}
			}

			if($dataArray['title'] != '' && $dataArray['release_date'] != '' && $dataArray['release_time'] != '') {
				if($this->Mod_news->update($id, $dataArray)) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '更新成功！';
					redirect(base_url('index.php/console/news'));
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '更新失敗，發生錯誤。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}
		$view_data['res'] = $this->Mod_news->get_once($id);
		
		if($view_data['res']) {
			$this->load->view('console/layout', $view_data);
		}else{
			redirect(base_url('index.php/console/news'));
		}
	}
}

?>
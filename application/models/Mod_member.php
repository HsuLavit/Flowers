<?php

class Mod_member extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    // 取得會員資料
    function get_once_by_email($email){
    	$this->db->where('email',$email);
    	return $this->db->get('user_main')->row_array();
    }

    function chk_repeat_email($id,$email){
        $this->db->where('email',$email);
        $this->db->where('id !=',$id);
        return $this->db->get('user_main')->row_array();
    }


	/**********************************/

	/*********   Member   ************/

	/**********************************/


        // 取得會員清單
    function get_all(){
        $this->db->select('id,nickname,email,address');
        return $this->db->get('user_main')->result_array();
    }
    // 取得特定會員
    function get_once($id){
    	$this->db->select('id,nickname,email,phone,address');
        $this->db->where('id',$id);
        return  $this->db->get('user_main')->row_array();
    }

    // 查詢會員數量
    function get_total(){
        return $this->db->count_all_results('user_main');
    }

    // 新增會員
    function insert($dataArray){
        return  $this->db->insert('user_main', $dataArray);
    }

    // 更新會員
    function update($id,$dataArray){
        $this->db->where('id',$id);  
        return  $this->db->update('user_main', $dataArray);
    }

    // 刪除會員
    function delete($id){
         $this->db->where('id',$id); 
         return  $this->db->delete('user_main');
    }


}
	


?>
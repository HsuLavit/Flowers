<?php

class Mod_order extends CI_Model {
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

	/*********   Order   ************/

	/**********************************/


        // 取得訂單清單
    function get_all(){
        $res = $this->db->get('order_main')->result_array();
        foreach ($res as $key => $value) {
            $res[$key] = $this->get_sub_once($value) ;
        }
        return $res ;
    }
    // 取得特定訂單
    function get_once($id){
        $this->db->where('id',$id);
        $res =  $this->db->get('order_main')->row_array();
        return $this->get_sub_once($res);
    }

    function get_sub_once($res){
        $this->db->where('order_id',$res['id']);
        $res['sub_order'] = $this->db->get('order_sub')->result_array();
        $res['total']= 0;
        foreach($res['sub_order'] as $key => $value){
                $res['total'] = $res['total'] + $value['product_price'] * $value['product_qty'] ;
        }
        return $res ;
    }

    // 查詢訂單數量
    function get_total(){
        return $this->db->count_all_results('order_main');
    }

    // 新增訂單
    function insert($dataArray){
        return  $this->db->insert('order_main', $dataArray);
    }

    // 更新訂單
    function update($id,$dataArray){
        $this->db->where('id',$id);  
        return  $this->db->update('order_main', $dataArray);
    }

    // 刪除訂單
    function delete($id){
         $this->db->where('id',$id); 
         return  $this->db->delete('order_main');
    }

    

}
	


?>
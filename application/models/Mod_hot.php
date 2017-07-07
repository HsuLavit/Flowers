<?php

class Mod_hot extends CI_Model {
    public function __construct(){
        parent::__construct();
    }




	/**********************************/

	/*********   Hot   ************/

	/**********************************/


        // 取得商品清單
    function get_all(){
        return $this->db->get('Hot')->result_array();
    }
    // 取得特定商品


    // 查詢商品數量
    function get_total(){
        return $this->db->count_all_results('Hot');
    }


}
	


?>
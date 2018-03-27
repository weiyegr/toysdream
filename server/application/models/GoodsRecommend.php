<?php
/**
 * Copyright (c) 2018. toysdream.
 * 开发人员 ZhuoJianHe.
 */

/**
 * Created by PhpStorm.
 * User: yc
 * Date: 2018-01-08
 * Time: 9:57
 */

class GoodsRecommend extends CI_Model{

    //免币推荐
    public function getFreeRecommendList(){
        $query=$this->db->query('select * from goods_free_home_recommend');
        if(!$query){
            return false;
        }

        return $query->result_array();
    }

    
}
<?php
include "GoodsImage.php";

/**
 * 商品详情获取商品附图类
 */
class GoodsImageGoodsDetail extends GoodsImage
{

    /**
     * 获取指定商品的附图
     */
    public function getGoodsImageList()
    {
        //参数是否为空
        if(
            $this->isNullGoodsId()
        ){
            return false;
        }
        //参数是否合法
        if(
            !$this->isLegalGoodsId()
        ){
            return false;
        }

        $query=$this->db->query("select * from goods_image where goods_id=".$this->goods_id);
        if(!$query){
            return false;
        }
        return $query->result_array();
    }

}

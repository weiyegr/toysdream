<?php
include "GoodsDamaged.php";

/**
 * 商品详情商品损伤图类
 */
class GoodsDamagedGoodsDetail extends GoodsDamaged
{

    /**
     * 获取用户商品损伤图列表
     */
    public function getGoodsDamagedList()
    {
        //参数是否为空
        if(
            $this->isNullGoodsId() ||
            $this->isNullPage() ||
            $this->isNullPageNum()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalGoodsId() ||
            !$this->isLegalPage() ||
            !$this->isLegalPageNum()
        ){
            return false;
        }

        $query = $this->db->query('SELECT * FROM goods_damaged where goods_id='.$this->goods_id.' order by goods_damaged_id desc limit '.(($this->page-1)*$this->pageNum).','.$this->pageNum);
        if(!$query){
            return false;
        }
        return $query->result_array();
    }

}

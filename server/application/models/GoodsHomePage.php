<?php
include "Goods.php";

/**
 *
 */
class GoodsHomePage extends Goods
{

    /**
     * 获取猜您喜欢商品列表
     */
    public function getGuessLikeGoodsList()
    {
        //参数是否合法
        if(
           !$this->isNullPageNum() && !$this->isLegalPageNum() ||
           !$this->isNullPage() && !$this->isLegalPage()
        ){
            return false;
        }
        $query=$this->db->query("select goods_id,goods_name,share_price,buy_price,buy_time,goods_description,free_friends_pid,cat_id,	brand_id,add_time,goods_image,is_free from goods where goods_status=".$this->canSaleStatus." order by edit_time desc limit ".(($this->page-1)*$this->pageNum).",".$this->pageNum);
        if(!$query || empty($query->result_array()[0])){
            return false;
        }
        return $query->result_array();
    }

    /**
     * 获取本地商品列表
     */
    public function getLocalGoodsList()
    {
        // TODO: implement here
    }

    /**
     * 获取我的好友共享商品列表
     */
    public function getFiendsGoodsList()
    {
        // TODO: implement here
    }

    /**
     * 获取最新共享商品
     */
    public function getNewGoodsList()
    {
        // TODO: implement here
    }

    /**
     * 获取优质共享商品
     */
    public function getHighQualityGoodsList()
    {
        // TODO: implement here
    }
    
    /**
     * 获取商品详情
     */
    public function getGoodsDetail(){
        //参数是否为空
        if($this->isNullGoodsId()){
            return false;
        }
        //参数是否合法
        if(!$this->isLegalGoodsId()){
            return false;
        }

        $query=$this->db->query("select goods_id,goods_name,share_price,buy_price,buy_time,goods_description,free_friends_pid,cat_id,	brand_id,add_time,goods_image,is_free from goods where goods_id=".$this->goods_id." and goods_status=".$this->canSaleStatus." limit 1");
        if(!$query || empty($query->result_array()[0])){
            return false;
        }
        return $query->result_array()[0];
    }

}

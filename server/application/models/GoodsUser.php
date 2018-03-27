<?php

include "Goods.php";
/**
 *
 */
class GoodsUser extends Goods
{


    /**
     * @var void 商品发布用户ID
     */
    private $user_id;

    /**
     * 是否提交审核
     */
    private $isCheck;

    /**
     * 商品状态 1、2、3、4
     */

    private $goodsStatus;

    /**
     * @return mixed
     */
    public function getGoodsStatus()
    {
        return $this->goodsStatus;
    }

    /**
     * @return mixed
     */
    public function isNullGoodsStatus()
    {
        return !isset($this->goodsStatus) ? true : false;
    }

    /**
     * @return mixed
     */
    public function isLegalGoodsStatus()
    {
        return $this->goodsStatus==1 || $this->goodsStatus==2 || $this->goodsStatus==3 || $this->goodsStatus==4? true : false;
    }

    /**
     * @param mixed $goodsStatus
     */
    public function setGoodsStatus($goodsStatus)
    {
        $this->goodsStatus = $goodsStatus;
    }



    /**
     * @return mixed
     */
    public function getIsCheck()
    {
        return $this->isCheck;
    }

    /**
     * @return mixed
     */
    public function isNullIsCheck()
    {
        return !isset($this->isCheck) ? true : false;
    }

    /**
     * @return mixed
     */
    public function isLegalIsCheck()
    {
        return $this->isCheck==0 || $this->isCheck==1 ? true : false;
}

    /**
     * @param mixed $isCheck
     */
    public function setIsCheck($isCheck)
    {
        $this->isCheck = $isCheck;
    }



    /**
     * @return void
     */
    public function isNullUserId()
    {
        return !isset($this->user_id)?true:false;
    }

    /**
     * @return void
     */
    public function isLegalUserId()
    {
        return is_numeric($this->user_id)?true:false;
    }

    /**
     * @param void $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    /**
     * 添加商品
     */
    public function userGoodsAdd()
    {
        //检验必填参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullBrandId() ||
            $this->isNullBuyPrice() ||
            $this->isNullCatId() ||
            $this->isNullBuyTime() ||
            $this->isNullGoodsName() ||
            $this->isNullIsFree() || 
            $this->isNullGoodsImage()
        ){
            return false;
        }


        //检验必填参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalBrandId() ||
            !$this->isLegalBuyPrice() ||
            !$this->isLegalCatId() ||
            !$this->isLegalBuyTime() ||
            !$this->isLegalGoodsName() ||
            !$this->isLegalIsFree()
            //!$this->isLegalGoodsImage()
        ){
            return false;
        }

        $data=array(
            "user_id"=>$this->user_id,
            "brand_id"=>$this->brand_id,
            "buy_price"=>$this->buy_price,
            "cat_id"=>$this->cat_id,
            "edit_time"=>time(),
            "buy_time"=>$this->buy_time,
            "goods_description"=>$this->goods_description,
            "goods_name"=>$this->goods_name,
            "is_free"=>$this->is_free,
            "goods_image"=>$this->goods_image
        );



        $status=$this->db->insert('goods', $data);
        if(!$status){
            return false;
        }

        $insert_id=$this->db->insert_id();

        return $insert_id;

    }

    /**
     * 当前状态是否可以修改
     */
    public function isCanUpdate(){
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullGoodsId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalGoodsId()
        ){
            return false;
        }

        $query=$this->db->query("select goods_status from goods where user_id=".$this->user_id." and goods_id=".$this->goods_id." limit 1");
        $row=$query->result_array()[0];
        if(!in_array($row['goods_status'],[2])){
            return true;
        }
        return false;
    }

    /**
     * 更新商品
     */
    public function userGoodsUpdate()
    {
        //检验必填参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullGoodsId() ||
            $this->isNullBrandId() &&
            $this->isNullBuyPrice() &&
            $this->isNullCatId() &&
            $this->isNullBuyTime() &&
            $this->isNullGoodsName() &&
            $this->isNullIsFree() &&
            $this->isNullGoodsImage()

        ){
                return false;
        }

        //检验必填参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalGoodsId() ||
            !$this->isNullBrandId() && !$this->isLegalBrandId() ||
            !$this->isNullCatId() && !$this->isLegalCatId() ||
            !$this->isNullBuyTime() && !$this->isLegalBuyTime() ||
            !$this->isNullGoodsName() && !$this->isLegalGoodsName() ||
            !$this->isNullIsFree() && !$this->isLegalIsFree()
            //!$this->isNullGoodsImage() && !$this->isLegalGoodsImage()
        ){
            return false;
        }

        //当前状态是否可修改
        if(!$this->isCanUpdate()){
            return false;
        }



        $data=null;
        if(isset($this->brand_id)){
            $data["brand_id"]=$this->brand_id;
        }
        if(isset($this->buy_price)){
            $data["buy_price"]=$this->buy_price;
        }
        if(isset($this->cat_id)){
            $data["cat_id"]=$this->cat_id;
        }
        if(isset($this->buy_time)){
            $data["buy_time"]=$this->buy_time;
        }
        if(isset($this->goods_description)){
            $data["goods_description"]=$this->goods_description;
        }
        if(isset($this->goods_name)){
            $data["goods_name"]=$this->goods_name;
        }
        if(isset($this->is_free)){
            $data["is_free"]=$this->is_free;
        }
        if(isset($this->goods_image)){
            $data["goods_image"]=$this->goods_image;
        }

        if(count($data)==0){
            return false;
        }

        $where=array(
            "user_id"=>$this->user_id,
            "goods_id"=>$this->goods_id
        );

        $status=$this->db->update("goods",$data,$where);
        if(!$status){
            return false;
        }

        return true;
    }


    /**
     * 删除商品
     */
    public function userGoodsDelete()
    {
        //检验必填参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullGoodsId()
        ){
            return false;
        }

        //检验必填参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalGoodsId()
        ){
            return false;
        }

        $where=array(
            "user_id"=>$this->user_id,
            "goods_id"=>$this->goods_id
        );

        $status=$this->db->delete("goods",$where);

        if(!$status){
            return false;
        }

        return true;


    }


    /**
     * 获取用户添加的商品
     */
    public function getUserGoodsList()
    {
        //检验必填参数是否为空
        if(
            $this->isNullUserId()
        ){
            return false;
        }

        //检验必填是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isNullPage() && !$this->isLegalPage() ||
            !$this->isNullPageNum() && !$this->isLegalPageNum()
        ){
            return false;
        }

        $query=$this->db->query("select * from goods where user_id=".$this->user_id." order by edit_time desc limit ".(($this->page-1)*$this->pageNum).",".$this->pageNum);
        if(!$query){
            return false;
        }

        $goods_list=$query->result_array();

        $goods_status = $this->config->item('goods_status');

        foreach($goods_list as $key=>$item){
            $goods_list[$key]['goods_status_c']=$goods_status[$item['goods_status']];
        }

        return $goods_list;
    }

    /**
     * 获取用户商品详情
     */
    public function getUserGoodsInfo(){
        //检验必填参数是否为空
        if(
           $this->isNullUserId() ||
           $this->isNullGoodsId()
        ){
            return false;
        }

        //检验参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalGoodsId()
        ){
            return false;
        }

        $query=$this->db->query("select * from goods where user_id=".$this->user_id." and goods_id=".$this->goods_id." limit 1");
        if(!$query){
            return false;
        }
        return $query->result_array()[0];
    }

    /**
     * 判断商品是否可提交审核
     */
    public function isCanCheck(){
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullGoodsId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalGoodsId()
        ){
            return false;
        }

        $query=$this->db->query("select goods_status from goods where user_id=".$this->user_id." and goods_id=".$this->goods_id." limit 1");
        $row=$query->result_array()[0];
        if(in_array($row['goods_status'],[1,3,4])){
            return true;
        }
        return false;
    }

    /**
     * 提交审核
     */
    public function submitCheck(){
        //参数是否为空
        if(
            $this->isNullIsCheck() ||
            $this->isNullGoodsId() ||
            $this->isNullUserId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalGoodsId() ||
            !$this->isLegalIsCheck()
        ){
            return false;
        }

        //是否可提交审核
        if(!$this->isCanCheck()){
            return false;
        }

        $data=array(
            "goods_status"=>2
        );

        $where=array(
            "user_id"=>$this->user_id,
            "goods_id"=>$this->goods_id
        );

        $status=$this->db->update("goods",$data,$where);
        if(!$status){
            return false;
        }

        return true;


    }

}

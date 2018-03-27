<?php


/**
 *
 */
class OrderUser extends Order
{

    /**
     * 获取指定用户的订单列表
     */
    public function getUserOrderList()
    {
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullOrderId() ||
            $this->isNullPage() ||
            $this->isNullPageNum()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalOrderId() ||
            !$this->isLegalPage() ||
            !$this->isLegalPageNum()
        ){
            return false;
        }

        $query=$this->db->query("select * from order where user_id=".$this->user_id." and order_id=".$this->order_id." order_by order_id desc limit ".(($this->page-1)*$this->pageNum).",".$this->pageNum);
        if(!$query){
            return false;
        }
        return $query->result_array();
    }

    /**
     * 获取指定用户和订单ID的订单信息
     */
    public function getUserOrderInfo()
    {
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullOrderId()
        ){
            return false;
        }
        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalOrderId()
        ){
            return false;
        }

        $where=array(
            "user_id"=>$this->user_id,
            "order_id"=>$this->order_id
        );
        $status=$this->db->select("order",$where);
        if(!$status){
            return false;
        }

        return $status;


    }

    /**
     * 用户生成订单
     */
    public function addUserOrder()
    {
        //参数是否为空
        if(
            $this->isNullOrderId() ||
            $this->isNullUserId() ||
            $this->isNullBuyerId() ||
            $this->isNullAddress() ||
            $this->isNullAddressId() ||
            $this->isNullEndTime() ||
            $this->isNullName() ||
            $this->isNullOrderPrice() ||
            $this->isNullOrderSn() ||
            $this->isNullOrderStatus() ||
            $this->isNullPhone() ||
            $this->isNullShippingStatus() ||
            $this->isNullStartTime()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalOrderId() ||
            !$this->isLegalUserId() ||
            !$this->isLegalBuyerId() ||
            !$this->isLegalAddress() ||
            !$this->isLegalAddressId() ||
            !$this->isLegalEndTime() ||
            !$this->isLegalName() ||
            !$this->isLegalOrderPrice() ||
            !$this->isLegalOrderSn() ||
            !$this->isLegalOrderStatus() ||
            !$this->isLegalPhone() ||
            !$this->isLegalShippingStatus() ||
            !$this->isLegalStartTime()
        ){
            return false;
        }


    }

    //验证用户ID是否为买家
    public function isOrderUserBuyer(){
        //参数是否为空
        if(
            $this->isNullBuyerId() ||
            $this->isNullOrderId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalBuyerId() ||
            !$this->isLegalOrderId()
        ){
            return false;
        }
        $where=array(
            "buyer_id"=>$this->buyer_id,
            "order_id"=>$this->order_id
        );
        $row=$this->db->select("order",$where);
        if(!$row){
            return false;
        }
        return true;
    }

    //校验订单是否为可取消状态
    public function isOrderCanCance(){
        //参数是否为空
        if($this->isNullOrderId()){
            return false;
        }

        //参数是否合法
        if(!$this->isLegalOrderId()){
            return false;
        }

        $where=array(
            "order_id"=>$this->order_id,
        );
        $row=$this->db->select("order",$where);
        if(!$row || $row['order_status']!=1 || $row['shipping_status']!=1){
            return false;
        }
        return true;
    }


    /**
     * 用户取消订单
     */
    public function cancelUserOrder()
    {
        //参数是否为空
        if(
            $this->isNullBuyerId() ||
            $this->isNullOrderId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalBuyerId() ||
            !$this->isLegalOrderId()
        ){
            return false;
        }

        //验证用户ID是否为买家
        if(!$this->isOrderUserBuyer()){
            return false;
        }

        //校验订单是否为可取消状态
        if(!$this->isOrderCanCance()){
            return false;
        }

        //取消订单
        $data=array(
            "order_status"=>2
        );
        $where=array(
            "order_id"=>$this->order_id,
            "buyer_id"=>$this->buyer_id
        );
        $status=$this->db->update("order",$data,$where);
        if(!$status){
            return false;
        }

        return true;
    }

    /**
     * 用户操作订单发货
     */
    public function deliverUserOrder()
    {
        // TODO: implement here
    }

    /**
     * 用户确认订单收货
     */
    public function confirmReceiptUserOrder():void
    {
        // TODO: implement here
    }

}

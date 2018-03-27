<?php


/**
 * 订单商品类
 */
class OrderGoods extends CI_Model
{

    /**
     * @var void 订单ID
     */
    public $order_id;

    /**
     * @var void 商品名称
     */
    public $goods_name;

    /**
     * @var void 共享价
     */
    public $share_price;

    /**
     * @var void 商品图片
     */
    public $goods_image;

    /**
     * @var void 商品ID
     */
    public $goods_id;

    /**
     * @return void
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return void
     */
    public function isNullOrderId()
    {
        return !isset($this->order_id) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalOrderId()
    {
        return is_numeric($this->order_id) ? true : false;
}

    /**
     * @param void $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * @return void
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * @return void
     */
    public function isNullGoodsName()
    {
        return !isset($this->goods_name) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalGoodsName()
    {
        return is_numeric($this->goods_name) ? true : false;
}

    /**
     * @param void $goods_name
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;
    }

    /**
     * @return void
     */
    public function getSharePrice()
    {
        return $this->share_price;
    }

    /**
     * @return void
     */
    public function isNullSharePrice()
    {
        return !isset($this->share_price) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalSharePrice()
    {
        return is_numeric($this->share_price) ? true : false;
}

    /**
     * @param void $share_price
     */
    public function setSharePrice($share_price)
    {
        $this->share_price = $share_price;
    }

    /**
     * @return void
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * @return void
     */
    public function isNullGoodsImage()
    {
        return !isset($this->goods_image) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalGoodsImage()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->goods_image) ? true : false;
}

    /**
     * @param void $goods_image
     */
    public function setGoodsImage($goods_image)
    {
        $this->goods_image = $goods_image;
    }

    /**
     * @return void
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * @return void
     */
    public function isNullGoodsId()
    {
        return !isset($this->goods_id) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalGoodsId()
    {
        return is_numeric($this->goods_id) ? true : false;
}

    /**
     * @param void $goods_id
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;
    }



    /**
     *
     */
    public function add()
    {
        //参数是否为空
        if(
            $this->isNullOrderId() ||
            $this->isNullGoodsId() ||
            $this->isNullGoodsImage() ||
            $this->isNullGoodsName() ||
            $this->isNullSharePrice()
        ){
            return false;
        }
        //参数是否合法
        if(
            !$this->isLegalOrderId() ||
            !$this->isLegalGoodsId() ||
            !$this->isLegalGoodsImage() ||
            !$this->isLegalGoodsName() ||
            !$this->isLegalSharePrice()
        ){
            return false;
        }

        $data=array(
            "order_id"=>$this->order_id,
            "goods_id"=>$this->goods_id,
            "goods_image"=>$this->goods_image,
            "goods_name"=>$this->goods_name,
            "share_price"=>$this->share_price
        );
        $status=$this->db->insert("order_goods",$data);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     *
     */
    public function getGoodsList()
    {
        //参数是否为空
        if(
            $this->isNullOrderId()
        ){
            return false;
        }
        //参数是否合法
        if(
            !$this->isLegalOrderId()
        ){
            return false;
        }
        $where=array(
            "order_id"=>$this->order_id
        );
        $row=$this->db->select("order_goods",$where);
        if(!$row){
            false;
        }
        return $row;
    }

}

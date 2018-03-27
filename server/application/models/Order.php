<?php


/**
 * 订单类
 */
class Order extends CI_Model
{

    /**
     * @var void 订单ID
     */
    public $order_id;

    /**
     * @var void 发货状态  1、未发货  2、已发货  3、已收货  4、已退货
     */
    public $shipping_status;

    /**
     * @var void 订单状态 0.未确认、1.已确认、2.已取消
     */
    public $order_status;

    /**
     * @var void 到期时间
     */
    public $end_time;

    /**
     * @var void 预约时间
     */
    public $start_time;

    /**
     * @var void 订单价格
     */
    public $order_price;

    /**
     * @var void 订单号
     */
    public $order_sn;

    /**
     * @var void 联系电话
     */
    public $phone;

    /**
     * @var void 联系地址
     */
    public $address;

    /**
     * @var void 地址ID
     */
    public $address_id;

    /**
     * @var void 联系人
     */
    public $name;

    /**
     * @var void 用户ID
     */
    public $user_id;
    
    public $page=1;
    
    public $pageNum=10;

    public $buyer_id;

    /**
     * @return mixed
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * @return mixed
     */
    public function isNullBuyerId()
    {
        return !isset($this->buyer_id) ? true : false;
    }

    /**
     * @return mixed
     */
    public function isLegalBuyerId()
    {
        return is_numeric($this->buyer_id) ? true : false;
}

    /**
     * @param mixed $buyer_id
     */
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;
    }
    
    

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function isNullPage()
    {
        return !isset($this->page) ? true : false;
    }

    /**
     * @return int
     */
    public function isLegalPage()
    {
        return is_numeric($this->page) ? true : false;
}

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageNum()
    {
        return $this->pageNum;
    }

    /**
     * @return int
     */
    public function isNullPageNum()
    {
        return !isset($this->pageNum) ? true : false;
    }

    /**
     * @return int
     */
    public function isLegalPageNum()
    {
        return is_numeric($this->pageNum) ? true : false;
}

    /**
     * @param int $pageNum
     */
    public function setPageNum($pageNum)
    {
        $this->pageNum = $pageNum;
    }
    
    

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
    public function getShippingStatus()
    {
        return $this->shipping_status;
    }

    /**
     * @return void
     */
    public function isNullShippingStatus()
    {
        return !isset($this->shipping_status) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalShippingStatus()
    {
        return in_array($this->shipping_status,array(1,2,3,4)) ? true : false;
}

    /**
     * @param void $shipping_status
     */
    public function setShippingStatus($shipping_status)
    {
        $this->shipping_status = $shipping_status;
    }

    /**
     * @return void
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @return void
     */
    public function isNullOrderStatus()
    {
        return !isset($this->order_status) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalOrderStatus()
    {
        return in_array($this->order_status,array(0,1,2)) ? true : false;
}

    /**
     * @param void $order_status
     */
    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
    }

    /**
     * @return void
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @return void
     */
    public function isNullEndTime()
    {
        return !isset($this->end_time) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalEndTime()
    {
        return $this->end_time>1514449019 && $this->end_time<2555828219 ? true : false;
    }

    /**
     * @param void $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return void
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @return void
     */
    public function isNullStartTime()
    {
        return !isset($this->start_time) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalStartTime()
    {
        return $this->start_time>1514449019 && $this->start_time<2555828219 ? true : false;
}

    /**
     * @param void $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return void
     */
    public function getOrderPrice()
    {
        return $this->order_price;
    }

    /**
     * @return void
     */
    public function isNullOrderPrice()
    {
        return !isset($this->order_price) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalOrderPrice()
    {
        return is_numeric($this->order_price) ? true : false;
}

    /**
     * @param void $order_price
     */
    public function setOrderPrice($order_price)
    {
        $this->order_price = $order_price;
    }

    /**
     * @return void
     */
    public function getOrderSn()
    {
        return $this->order_sn;
    }

    /**
     * @return void
     */
    public function isNullOrderSn()
    {
        return !isset($this->order_sn) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalOrderSn()
    {
        return is_numeric($this->order_sn) ? true : false;
}

    /**
     * @param void $order_sn
     */
    public function setOrderSn($order_sn)
    {
        $this->order_sn = $order_sn;
    }

    /**
     * @return void
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return void
     */
    public function isNullPhone()
    {
        return !isset($this->phone) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalPhone()
    {
        return preg_match('/(^1\d{10}$)|(^\d{3}-\d{7,8}$)/',$this->phone) ? true : false;
}

    /**
     * @param void $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return void
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return void
     */
    public function isNullAddress()
    {
        return !isset($this->address) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalAddress()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->address) ? true : false;
    }

    /**
     * @param void $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return void
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * @return void
     */
    public function isNullAddressId()
    {
        return !isset($this->address_id) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalAddressId()
    {
        return is_numeric($this->address_id) ? true : false;
}

    /**
     * @param void $address_id
     */
    public function setAddressId($address_id)
    {
        $this->address_id = $address_id;
    }

    /**
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return void
     */
    public function isNullName()
    {
        return !isset($this->name) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalName()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->name) ? true : false;
}

    /**
     * @param void $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return void
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return void
     */
    public function isNullUserId()
    {
        return !isset($this->user_id) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalUserId()
    {
        return is_numeric($this->user_id) ? true : false;
}

    /**
     * @param void $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }



}

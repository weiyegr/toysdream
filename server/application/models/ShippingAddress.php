<?php


/**
 * 收货地址类
 */
class ShippingAddress extends CI_Model
{

    /**
     * @var void 地址ID
     */
    public $address_id;

    /**
     * @var void 联系人
     */
    public $name;

    /**
     * @var void 性别 1 男 2 女 0未知
     */
    public $sex;

    /**
     * @var void 联系电话
     */
    public $phone;

    /**
     * @var void 省
     */
    public $province;

    /**
     * @var void 市
     */
    public $city;

    /**
     * @var void 区
     */
    public $area;

    /**
     * @var void 详细地址
     */
    public $address;

    public $user_id;

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
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->name) ? false : true;
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
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return void
     */
    public function isNullSex()
    {
        return !isset($this->sex) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalSex()
    {
        return preg_match('/0|1|2/',$this->sex) ? true : false;
}

    /**
     * @param void $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
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
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return void
     */
    public function isNullProvince()
    {
        return !isset($this->province) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalProvince()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->province) ? false : true;
}

    /**
     * @param void $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return void
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return void
     */
    public function isNullCity()
    {
        return !isset($this->city) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalCity()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->city) ? false : true;
}

    /**
     * @param void $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return void
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return void
     */
    public function isNullArea()
    {
        return !isset($this->area) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalArea()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->area) ? false : true;
}

    /**
     * @param void $area
     */
    public function setArea($area)
    {
        $this->area = $area;
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
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->address) ? false : true;
}

    /**
     * @param void $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function isNullUserId()
    {
        return !isset($this->user_id) ? true : false;
    }

    /**
     * @return mixed
     */
    public function isLegalUserId()
    {
        return is_numeric($this->user_id) ? true : false;
}

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    
    

    /**
     * 用户添加地址
     */
    public function userAdd()
    {
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullAddress() ||
            $this->isNullArea() ||
            $this->isNullCity() ||
            $this->isNullName() ||
            $this->isNullPhone() ||
            $this->isNullProvince() ||
            $this->isNullSex()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalAddress() ||
            !$this->isLegalArea() ||
            !$this->isLegalCity() ||
            !$this->isLegalName() ||
            !$this->isLegalPhone() ||
            !$this->isLegalProvince() ||
            !$this->isLegalSex()
        ){
            return false;
        }


        $data="user_id='".$this->user_id."'";
        $data.=",address='".$this->address."'";
        $data.=",area='".$this->area."'";
        $data.=",city='".$this->city."'";
        $data.=",name='".$this->name."'";
        $data.=",phone='".$this->phone."'";
        $data.=",province='".$this->province."'";
        $data.=",sex='".$this->sex."'";

        $status=$this->db->query("insert into shipping_address set ".$data);
        if(!$status){
            return false;
        }

        return true;
    }

    /**
     * 用户更新地址
     */
    public function userUpdate()
    {
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullAddressId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalAddressId() ||
            !$this->isLegalUserId() ||
            $this->isNullAddress() && !$this->isLegalAddress() ||
            $this->isLegalSex() && !$this->isLegalSex() ||
            $this->isNullProvince() && !$this->isLegalProvince() ||
            $this->isNullPhone() && !$this->isLegalPhone() ||
            $this->isNullArea() && !$this->isLegalArea() ||
            $this->isNullCity() && !$this->isLegalCity() ||
            $this->isNullName() && !$this->isLegalName()
        ){
            return false;
        }

        $data=null;
        if(!$this->isNullAddress()){
            $data['address']=$this->address;
        }
        if(!$this->isNullName()){
            $data['name']=$this->name;
        }
        if(!$this->isNullCity()){
            $data['city']=$this->city;
        }
        if(!$this->isNullArea()){
            $data['area']=$this->area;
        }
        if(!$this->isNullProvince()){
            $data['province']=$this->province;
        }
        if(!$this->isNullPhone()){
            $data['phone']=$this->phone;
        }
        if(!$this->isNullSex()){
            $data['sex']=$this->sex;
        }

        $where=array(
            "user_id"=>$this->user_id,
            "address_id"=>$this->address_id
        );
        $status=$this->db->update("shipping_address",$data,$where);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 用户删除地址
     */
    public function userDelete()
    {
        //参数是否为空
        if(
            $this->isNullUserId() ||
            $this->isNullAddressId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalAddressId()
        ){
            return false;
        }

        $where=array(
            "user_id"=>$this->user_id,
            "address_id"=>$this->address_id
        );
        $status=$this->db->delete("shipping_address",$where);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 获取用户地址列表
     */
    public function getUserAddressList()
    {
        //参数是否为空
        if($this->isNullUserId()){
            return false;
        }
        //参数是否合法
        if(!$this->isLegalUserId()){
            return false;
        }


        $query=$this->db->query("select * from shipping_address where user_id=".$this->user_id." order by edit_time desc");
        if(!$query){
            return false;
        }
        $row=$query->result_array();
        return $row;

    }

    /**
     * 获取用户地址详细信息
     */
    public function getUserAddressInfo()
    {
        //参数是否为空
        if(
            $this->isNullAddressId() ||
            $this->isNullUserId()
        ){
            return false;
        }

        //参数是否合法
        if(
            !$this->isLegalUserId() ||
            !$this->isLegalAddressId()
        ){
            return false;
        }

        $query=$this->db->query("select * from shipping_address where address_id=".$this->address_id." and user_id=".$this->user_id." limit 1");
        if(!$query){
            return false;
        }
        $row=$query->row_array();
        return $row;

    }

}

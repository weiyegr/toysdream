<?php


/**
 * 商品附图类
 */
class GoodsImage extends CI_Model
{

    /**
     * @var void 商品ID
     */
    protected $goods_id;

    /**
     * @var void 商品名称
     */
    protected $image_name;
    
    protected $goods_image_id;

    /**
     * @return mixed
     */
    public function getGoodsImageId()
    {
        return $this->goods_image_id;
    }

    /**
     * @return mixed
     */
    public function isNullGoodsImageId()
    {
        return !isset($this->goods_image_id) ? true : false;
    }

    /**
     * @return mixed
     */
    public function isLegalGoodsImageId()
    {
        return is_numeric($this->goods_image_id) ? true : false;
}

    /**
     * @param mixed $goods_image_id
     */
    public function setGoodsImageId($goods_image_id)
    {
        $this->goods_image_id = $goods_image_id;
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
     * @return void
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * @return void
     */
    public function isNullImageName()
    {
        return !isset($this->image_name) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalImageName()
    {
        return preg_match('/^http:\/\/[A-Za-z0-9_\-\/]+\.[A-Za-z]+$/',$this->goods_image)?true:false;
}

    /**
     * @param void $image_name
     */
    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }



}

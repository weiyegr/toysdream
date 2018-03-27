<?php


/**
 * 商品品牌
 */
class Goods_brand extends CI_Model
{

    /**
     * @var void 品牌ID
     */
    private $brand_id;

    /**
     * @var void 品牌名称
     */
    private $brand_name;

    /**
     * @return void
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * @return void
     */
    public function isNullBrandId()
    {
        return !isset($this->brand_id) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalBrandId()
    {
        return is_numeric($this->brand_id) ? true : false;
}

    /**
     * @param void $brand_id
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * @return void
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * @return void
     */
    public function isNullBrandName()
    {
        return !isset($this->brand_name) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalBrandName()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->brand_name) ? true : false;
}

    /**
     * @param void $brand_name
     */
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;
    }



    /**
     * 添加品牌
     */
    public function add()
    {
        //参数是否为空
        if($this->isNullBrandName()){
            return false;
        }
        //参数是否合法
        if(!$this->isLegalBrandName()){
            return false;
        }
        $data=array(
            "brand_name"=>$this->brand_name
        );
        $status=$this->db->insert("goods_brand",$data);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 更新品牌信息
     */
    public function update()
    {
        //参数是否为空
        if(
            $this->isNullBrandName() ||
            $this->isNullBrandId()
        ){
            return false;
        }
        //参数是否合法
        if(
            !$this->isLegalBrandName() ||
            !$this->isLegalBrandId()
        ){
            return false;
        }

        $where=array(
            "brand_id"=>$this->brand_id
        );

        $data=array(
            "brand_name"=>$this->brand_name
        );
        $status=$this->db->update("goods_brand",$data,$where);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 删除品牌
     */
    public function delete()
    {
        //参数是否为空
        if($this->isNullBrandId()){
            return false;
        }
        //参数是否合法
        if(!$this->isLegalBrandId()){
            return false;
        }

        $where=array(
            "brand_id"=>$this->brand_id
        );
        $status=$this->db->delete("goods_brand",$where);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 获取品牌列表
     */
    public function getList()
    {
        $query=$this->db->query("select brand_id as id,brand_name as name from goods_brand");
        if(!$query){
            return false;
        }
        return $query->result_array();
    }

}

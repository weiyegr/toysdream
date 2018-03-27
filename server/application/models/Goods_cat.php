<?php


/**
 * 商品分类
 */
class Goods_cat extends CI_Model
{

    /**
     * @var void 分类名称
     */
    private $cat_name;

    /**
     * @var void 分类ID
     */
    private $cat_id;

    /**
     * @return void
     */
    public function getCatName()
    {
        return $this->cat_name;
    }

    /**
     * @return void
     */
    public function isNullCatName()
    {
        return !isset($this->cat_name) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalCatName()
    {
        return preg_match('/[^\x80-\xff_a-zA-Z0-9\s]/',$this->cat_name) ? true : false;
}

    /**
     * @param void $cat_name
     */
    public function setCatName($cat_name)
    {
        $this->cat_name = $cat_name;
    }

    /**
     * @return void
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * @return void
     */
    public function isNullCatId()
    {
        return !isset($this->cat_id) ? true : false;
    }

    /**
     * @return void
     */
    public function isLegalCatId()
    {
        return is_numeric($this->cat_id) ? true : false;
}

    /**
     * @param void $cat_id
     */
    public function setCatId($cat_id)
    {
        $this->cat_id = $cat_id;
    }
    
    

    /**
     * 添加分类
     */
    public function add()
    {
        //参数是否为空
        if($this->isNullCatName()){
            return false;
        }
        //参数是否合法
        if(!$this->isLegalCatName()){
            return false;
        }
        
        $data=array(
            "cat_name"=>$this->cat_name
        );
        $status=$this->db->insert("goods_cat",$data);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 更新分类
     */
    public function update()
    {
        //参数是否为空
        if(
            $this->isNullCatId() || 
            $this->isNullCatName()
        ){
            return false;
        }
        //参数是否合法
        if(
            !$this->isLegalCatId() || 
            !$this->isLegalCatName()
        ){
            return false;
        }
        
        $where=array(
            "cat_id"=>$this->cat_id
        );
        $data=array(
            "cat_name"=>$this->cat_name
        );
        $status=$this->db->update("goods_cat",$data,$where);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 删除分类
     */
    public function delete()
    {
        //参数是否为空
        if($this->isNullCatId()){
            return false;
        }
        //参数是否合法
        if(!$this->isLegalCatId()){
            return false;
        }
        $where=array(
            "cat_id"=>$this->cat_id
        );
        $status=$this->db->delete("goods_cat",$where);
        if(!$status){
            return false;
        }
        return true;
    }

    /**
     * 获取分类列表
     */
    public function getList()
    {
        $query=$this->db->query("select cat_id as id,cat_name as name from goods_cat");
        return $query->result_array();
    }

}

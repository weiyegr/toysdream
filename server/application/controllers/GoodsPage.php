<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: yc
 * Date: 2018-01-04
 * Time: 15:50
 */
class GoodsPage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Detail()
    {
        $this->load->model('GoodsHomePage');
        $this->GoodsHomePage->setGoodsId($_GET['goods_id']);
        $goods_detail=$this->GoodsHomePage->getGoodsDetail();

        //商品细节图
        $this->load->model('GoodsImageGoodsDetail');
        $this->GoodsImageGoodsDetail->setGoodsId($_GET['goods_id']);
        $goods_images=$this->GoodsImageGoodsDetail->getGoodsImageList();
        $goods_images_arr=array();
        if(!empty($goods_images)){
            foreach($goods_images as $item){
                $goods_images_arr[]=$item['image_name'];
            }
        }
        $goods_detail['goods_images']=$goods_images_arr;
        //商品破损图
        $this->load->model('GoodsDamagedGoodsDetail');
        $this->GoodsDamagedGoodsDetail->setGoodsId($_GET['goods_id']);
        $damaged_images=$this->GoodsDamagedGoodsDetail->getGoodsDamagedList();
        $damaged_images_arr=array();
        if(!empty($damaged_images)){
            foreach($damaged_images as $item){
                $damaged_images_arr[]=$item['image_name'];
            }
        }
        $goods_detail['damaged_images']=$damaged_images_arr;
        
        if($goods_detail!==false){
            $this->json([
                'code' => 0,
                'data' => $goods_detail
            ]);
        }else{
            $this->json([
                'code' => 2,
                'data' => []
            ]);
        }
    }
}
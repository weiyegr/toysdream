<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;
/**
 * Created by PhpStorm.
 * User: yc
 * Date: 2018-01-04
 * Time: 15:50
 */
class Myshare extends CI_Controller
{
    private $user_id;
    public function __construct(){
        parent::__construct();

        $result = LoginService::check();
        if ($result['loginState'] !== Constants::S_AUTH) {
            echo json_encode([
                'code' => -1,
                'data' => []
            ]);
            exit();

        }else{
            $this->user_id=$result['userinfo']['user_id'];
        }

    }
    
    public function index(){
        $this->load->model('GoodsUser');
        $goods=$this->GoodsUser;
        $goods->setUserId($this->user_id);
        $status=$goods->getUserGoodsList();
        if($status!==false){
            $this->json([
                'code' => 0,
                'data' => $status
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }
        
    }
    
    public function detail(){
        $this->load->model('GoodsUser');
        $goods=$this->GoodsUser;
        $goods->setUserId($this->user_id);
        $goods->setGoodsId($_GET['goods_id']);
        $result=$goods->getUserGoodsInfo();
        if($result!==false){
            $goodsDetail=array();
            $goodsDetail['detail']=$result;
            //商品分类列表
            $this->load->model('Goods_cat');
            $cat_list=$this->Goods_cat->getList();
            $goodsDetail['cat']=$cat_list;
            //商品品牌列表
            $this->load->model('Goods_brand');
            $brand_list=$this->Goods_brand->getList();
            $goodsDetail['brand']=$brand_list;
            //商品细节图
            $this->load->model('GoodsImageUser');
            $this->GoodsImageUser->setUserId($this->user_id);
            $this->GoodsImageUser->setGoodsId($_GET['goods_id']);
            $goods_images=$this->GoodsImageUser->getUserGoodsImageList();
            $goods_images_arr=array();
            if(!empty($goods_images)){
                foreach($goods_images as $item){
                    $goods_images_arr[]=$item['image_name'];
                }
            }
            $goodsDetail['goods_images']=$goods_images_arr;
            //商品破损图
            $this->load->model('GoodsDamagedUser');
            $this->GoodsDamagedUser->setUserId($this->user_id);
            $this->GoodsDamagedUser->setGoodsId($_GET['goods_id']);
            $damaged_images=$this->GoodsDamagedUser->getUserGoodsDamagedList();
            $damaged_images_arr=array();
            if(!empty($damaged_images)){
                foreach($damaged_images as $item){
                    $damaged_images_arr[]=$item['image_name'];
                }
            }
            $goodsDetail['damaged_images']=$damaged_images_arr;
            $this->json([
                'code' => 0,
                'data' => $goodsDetail
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }
    }

    public function delete(){
        $this->load->model('GoodsUser');
        $goods=$this->GoodsUser;
        $goods->setUserId($this->user_id);
        $goods->setGoodsId($_GET['goods_id']);
        $result=$goods->userGoodsDelete();
        if($result!==false){
            $this->json([
                'code' => 0,
                'data' => $result
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }
    }

    public function add(){
        $this->load->model('GoodsUser');
        $goods=$this->GoodsUser;
        $goods->setUserId($this->user_id);
        $goods->setBrandId($_GET['brand_id']);
        $goods->setBuyPrice($_GET['buy_price']);
        $goods->setCatId($_GET['cat_id']);
        $goods->setBuyTime($_GET['buy_time']);
        $goods->setGoodsName($_GET['goods_name']);
        $goods->setIsFree($_GET['is_free']);
        $goods->setGoodsImage($_GET['goods_image']);
        $goods->setGoodsDescription($_GET['goods_description']);
        $result=$goods->userGoodsAdd();
        if($result!==false){
            //添加商品细节图
            $this->load->model('GoodsImageUser');
            $this->GoodsImageUser->setUserId($this->user_id);
            $this->GoodsImageUser->setGoodsId($result);
            eval("\$goods_images=".$_GET['goods_images'].";");
            if(!empty($goods_images)){
                foreach($goods_images as $goods_name){
                    $this->GoodsImageUser->setImageName($goods_name);
                    $this->GoodsImageUser->userGoodsAdd();
                }
            }


            //添加共享商品受损图
            $this->load->model('GoodsDamagedUser');
            $this->GoodsDamagedUser->setUserId($this->user_id);
            $this->GoodsDamagedUser->setGoodsId($result);
            eval("\$damaged_images=".$_GET['damaged_images'].";");
            if(!empty($damaged_images)){
                foreach($damaged_images as $goods_name){
                    $this->GoodsDamagedUser->setImageName($goods_name);
                    $this->GoodsDamagedUser->userGoodsAdd();
                }
            }

            $this->json([
                'code' => 0,
                'data' => [
                    'goods_id'=>$result
                ]
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }
    }
    
    public function update(){
        $this->load->model('GoodsUser');
        $goods=$this->GoodsUser;
        $goods->setUserId($this->user_id);
        $goods->setGoodsId($_GET['goods_id']);
        $goods->setBrandId($_GET['brand_id']);
        $goods->setBuyPrice($_GET['buy_price']);
        $goods->setCatId($_GET['cat_id']);
        $goods->setBuyTime($_GET['buy_time']);
        $goods->setGoodsName($_GET['goods_name']);
        $goods->setIsFree($_GET['is_free']);
        $goods->setGoodsImage($_GET['goods_image']);
        $goods->setGoodsDescription($_GET['goods_description']);
        $result=$goods->userGoodsUpdate();
        if($result!==false){
            //添加商品细节图
            $this->load->model('GoodsImageUser');
            $this->GoodsImageUser->setUserId($this->user_id);
            $this->GoodsImageUser->setGoodsId($_GET['goods_id']);
            $this->GoodsImageUser->userGoodsDelete();
            eval("\$goods_images=".$_GET['goods_images'].";");
            if(!empty($goods_images)) {
                foreach ($goods_images as $goods_name) {
                    $this->GoodsImageUser->setImageName($goods_name);
                    $this->GoodsImageUser->userGoodsAdd();
                }
            }

            //添加共享商品受损图
            $this->load->model('GoodsDamagedUser');
            $this->GoodsDamagedUser->setUserId($this->user_id);
            $this->GoodsDamagedUser->setGoodsId($_GET['goods_id']);
            $this->GoodsDamagedUser->userGoodsDelete();
            eval("\$damaged_images=".$_GET['damaged_images'].";");
            if(!empty($damaged_images)) {
                foreach ($damaged_images as $goods_name) {
                    $this->GoodsDamagedUser->setImageName($goods_name);
                    $this->GoodsDamagedUser->userGoodsAdd();
                }
            }

            //提交审核
            if($_GET['check_status']=='1'){
                $goods->setIsCheck(1);
                $goods->submitCheck();
            }


            $this->json([
                'code' => 0,
                'data' => []
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }
    }

    public function get_cat_brand_list(){
        $goodsDetail=array();
        //商品分类列表
        $this->load->model('Goods_cat');
        $cat_list=$this->Goods_cat->getList();
        $goodsDetail['cat']=$cat_list;
        //商品品牌列表
        $this->load->model('Goods_brand');
        $brand_list=$this->Goods_brand->getList();
        $goodsDetail['brand']=$brand_list;

        $this->json([
            'code' => 0,
            'data' => $goodsDetail
        ]);
    }

}
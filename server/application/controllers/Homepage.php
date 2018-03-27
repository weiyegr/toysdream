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
class Homepage extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){

        //免币商品
        $this->load->model('GoodsRecommend');
        $freeGoodsRecommend=$this->GoodsRecommend->getFreeRecommendList();
        $this->load->model('GoodsHomePage');
        $freeGoods=array();
        foreach($freeGoodsRecommend as $item){
            $this->GoodsHomePage->setGoodsId($item['goods_id']);
            $row=$this->GoodsHomePage->getGoodsDetail();
            if($row!=false and $row['is_free']=='1'){
                $freeGoods[]=$row;
            }
        }
        $data=array();
        $data['free_goods']=$freeGoods;
        

        $this->json([
            'code' => 0,
            'data' => $data
        ]);


    }

    //为您推荐
    public function GuessYourLike(){
        $this->load->model('GoodsHomePage');
        if(isset($_GET['page'])){
            $this->GoodsHomePage->setPage($_GET['page']);
        }
        $row=$this->GoodsHomePage->getGuessLikeGoodsList();
        if($row!==false){
            $i=2;
            foreach($row as $key=>$item){
                $row[$key]['i']= (int)($i%2);
                $i++;
            }
            $this->json([
                'code' => 0,
                'data' => $row
            ]);
        }else{
            $this->json([
                'code' => 2,
                'data' => []
            ]);
        }
}
}
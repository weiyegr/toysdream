<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;
/**
 * Created by PhpStorm.
 * User: yc
 * Date: 2018-01-03
 * Time: 14:50
 */
class Myaddress extends CI_Controller
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
        $this->load->model('ShippingAddress');
        $addr=$this->ShippingAddress;
        $addr->setUserId($this->user_id);
        $address_list=$addr->getUserAddressList();
        if($address_list!==false){
            $this->json([
                'code' => 0,
                'data' => $address_list
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }

    }

    public function detail(){
        $this->load->model('ShippingAddress');
        $addr=$this->ShippingAddress;
        $addr->setUserId($this->user_id);
        $addr->setAddressId($_GET['address_id']);
        $address_info=$addr->getUserAddressInfo();
        if($address_info!==false){
            $this->json([
                'code' => 0,
                'data' => $address_info
            ]);
        }else{
            $this->json([
                'code' => -2,
                'data' => []
            ]);
        }
    }

    public function delete(){
        $this->load->model('ShippingAddress');
        $addr=$this->ShippingAddress;
        $addr->setUserId($this->user_id);
        $addr->setAddressId($_GET['address_id']);
        $status=$addr->userDelete();
        if($status){
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

    public function add(){
        $this->load->model('ShippingAddress');
        $addr=$this->ShippingAddress;
        $addr->setUserId($this->user_id);
        $addr->setAddress($_GET['address']);
        $addr->setArea($_GET['area']);
        $addr->setCity($_GET['city']);
        $addr->setName($_GET['name']);
        $addr->setPhone($_GET['phone']);
        $addr->setProvince($_GET['province']);
        $addr->setSex($_GET['sex']);

        $status=$addr->userAdd();
        if($status){
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

    public function update(){
        $this->load->model('ShippingAddress');
        $addr=$this->ShippingAddress;
        $addr->setUserId($this->user_id);
        $addr->setAddressId($_GET['address_id']);
        $addr->setAddress($_GET['address']);
        $addr->setArea($_GET['area']);
        $addr->setCity($_GET['city']);
        $addr->setName($_GET['name']);
        $addr->setPhone($_GET['phone']);
        $addr->setProvince($_GET['province']);
        $addr->setSex($_GET['sex']);
        $status=$addr->userUpdate();
        if($status){
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

}
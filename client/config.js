/**
 * 小程序配置文件
 */

// 此处主机域名修改成腾讯云解决方案分配的域名
var host = 'https://gbo5kg8g.qcloud.la';

var config = {

    // 下面的地址配合云端 Demo 工作
    service: {
        host,

        // 登录地址，用于建立会话
        loginUrl: `${host}/weapp/login`,
        // 测试的请求地址，用于测试会话
        requestUrl: `${host}/weapp/user`,
        // 测试的信道服务地址
        tunnelUrl: `${host}/weapp/tunnel`,
        // 上传图片接口
        uploadUrl: `${host}/weapp/upload`,
        // 我的收货地址列表
        myaddress: `${host}/weapp/myaddress`,
        //收货地址详情
        addressDetail: `${host}/weapp/myaddress/detail`,
        //删除收货地址
        addressDelete: `${host}/weapp/myaddress/delete`,
        //添加收货地址
        addressAdd: `${host}/weapp/myaddress/add`,
        //修改收货地址
        addressUpdate: `${host}/weapp/myaddress/update`,
        //我的共享商品
        myshare: `${host}/weapp/myshare`,
        //共享商品详情
        shareDetail: `${host}/weapp/myshare/detail`,
        //删除共享商品
        shareDelete: `${host}/weapp/myshare/delete`,
        //修改共享商品
        shareUpdate: `${host}/weapp/myshare/update`,
        //添加共享商品
        shareAdd:`${host}/weapp/myshare/add`,
        //获取商品分类和品牌列表
        shareCatBrand: `${host}/weapp/myshare/get_cat_brand_list`,
        //首页
        homeIndex: `${host}/weapp/homepage/index`,
        //首页为您推荐
        GuessYourLike: `${host}/weapp/homepage/GuessYourLike`,
        //商品详情
        GoodsDetail:`${host}/weapp/goods/detail`

        
    }
};

module.exports = config;
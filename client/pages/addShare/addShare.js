//index.js
var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')

Page({
  data: {
    uploadimagef:"/images/upload_image.png",
    userInfo: {},
    logged: false,
    catArray:[],
    catindex:0,
    cat_id:0,
    brandArray:[],
    brandindex:0,
    brand_id:0,
    buy_timeindex:"2017-12-21",
    buy_timestart: "2010-01-01",
    buy_timeend: "2017-12-01",
    goods_image:'',
    goods_images:[],
    damaged_images:[],
    defaultSize: 'default',
    disabled: false,
    plain: false,
    loading: false,
    goods_id:'',
    goods_name:'',
    buy_price:'',
    goods_description:'',
    is_free:0,
    isfree:false,
    goods_status:0

  },
  isfree:function(e){
    if (e.detail.value){
      this.setData({
        is_free:1,
        isfree:true
      })
    }else{
      this.setData({
        is_free: 0,
        isfree: false
      })
    }
  },
  onLoad: function (option) {
    var that = this
    if (option.goods_id != undefined && option.goods_id != '') {

      this.setData({
        goods_id: option.goods_id
      })

      qcloud.request({
        url: config.service.shareDetail + "?goods_id=" + option.goods_id,
        login: true,
        success(result) {
          var goods_info = result.data.data;
          var catindex=0
          for (var i = 0; i < goods_info.cat.length; i++) {
            if (goods_info.cat[i].id == goods_info.detail.cat_id){
              break
              catindex++
            }
            
          }
          if (catindex>=goods_info.cat.length){
            catindex=0
          }

          var brandindex = 0
          for (var i = 0; i < goods_info.brand.length; i++) {
            if (goods_info.brand[i].id == goods_info.detail.brand_id) {
              break
              brandindex++
            }
            
          }
          if (brandindex >=goods_info.brand.length) {
            brandindex = 0
          }

          that.setData({
            goods_name: goods_info.detail.goods_name,
            catindex: catindex,
            brandindex: brandindex,
            cat_id: goods_info.detail.cat_id,
            brand_id: goods_info.detail.brand_id,
            buy_price: goods_info.detail.buy_price,
            buy_timeindex: goods_info.detail.buy_time,
            goods_image: goods_info.detail.goods_image,
            goods_description: goods_info.detail.goods_description,
            catArray: goods_info.cat,
            brandArray: goods_info.brand,
            goods_images: goods_info.goods_images,
            damaged_images: goods_info.damaged_images,
            is_free: goods_info.detail.is_free,
            goods_status: goods_info.detail.goods_status
          })

          if (that.data.is_free==1) {
            that.setData({
              isfree: true
            })
          } else {
            that.setData({
              isfree: false
            })
          }

        }

      })
    }else{
      qcloud.request({
        url: config.service.shareCatBrand,
        login: true,
        success(result) {
          var goods_info = result.data.data;
          that.setData({
            catArray: goods_info.cat,
            brandArray: goods_info.brand,
          })

        }

      })
    }
  },
  onShow: function () {
    this.setData({
      userInfo: getApp().globalData.userInfo,
      logged: getApp().globalData.logged
    });
  },
  goods_name:function(e){
    this.setData({
      goods_name:e.detail.value
    })
  },
  buy_price:function(e){
    this.setData({
      buy_price:e.detail.value
    })
  },
  goods_description:function(e){
    this.data.goods_description=e.detail.value
  },
  bindchangeCat: function (e) {
    this.setData({
      catindex: e.detail.value,
      cat_id: this.data.catArray[e.detail.value].id
    })
  },
  bindchangeBrand: function (e) {
    this.setData({
      brandindex: e.detail.value,
      brand_id: this.data.brandArray[e.detail.value].id
    })
  },
  bindchangeBuyTime: function (e) {
    this.setData({
      buy_timeindex: e.detail.value
    })
  },
  doUpload_goods_image: function (e) {
    this.uploadImage('goods_image')
  },
  doUpload_goods_images: function (e) {
    this.uploadImage('goods_images')
  },
  doUpload_damaged_images: function (e) {
    this.uploadImage('damaged_images')
  },
  delete_goods_images: function (e) {
    this.remove(this.data.goods_images,e.target.id);
    this.setData({
      goods_images: this.data.goods_images
    })
  },
  delete_damaged_images: function (e) {
    this.remove(this.data.damaged_images,e.target.id);
    this.setData({
      damaged_images: this.data.damaged_images
    })
  },
  remove: function (arr, val) {
    for(var i= 0; i<arr.length; i++) {
  if (arr[i] == val) {
    arr.splice(i, 1);
    break;
  }
}
},
  uploadImage: function (image_key){
    var that = this

    // 选择图片
    wx.chooseImage({
      count: 1,
      sizeType: ['compressed'],
      sourceType: ['album', 'camera'],
      success: function (res) {
        util.showBusy('正在上传')
        var filePath = res.tempFilePaths[0]

        // 上传图片
        wx.uploadFile({
          url: config.service.uploadUrl,
          filePath: filePath,
          name: 'file',

          success: function (res) {
            
            

            util.showSuccess('上传图片成功')
            util.showSuccess(res.error)
            if (image_key =='goods_image'){
              that.setData({
                goods_image: res.data.imgUrl
              })
              
            } else if (image_key == 'goods_images') {
              that.data.goods_images.push(res.data.imgUrl)
              that.setData({
                goods_images: that.data.goods_images
              })
            } else if (image_key == 'damaged_images') {
              that.data.damaged_images.push(res.data.imgUrl)
              that.setData({
                damaged_images: that.data.damaged_images
              })
            }
            
          },

          fail: function (e) {
            util.showModel('上传图片失败')
          }
        })

      },
      fail: function (e) {
        console.error(e)
      }
    })
  },
  deleteShare:function(){
    var that = this
    if (this.data.goods_id == '') {
      wx.showToast({
        title: '共享商品ID不存在',
        icon: 'success',
        duration: 2000
      })
    }

    wx.showModal({
      title: '提示',
      content: '确定要删除共享商品'+this.data.goods_name+'吗？',
      success: function (res) {
        if (res.confirm) {
          qcloud.request({
            url: config.service.shareDelete,
            login: true,
            data: {
              goods_id: that.data.goods_id
            },
            success(result) {
              if (result.data.code == 0) {
                wx.showToast({
                  title: '共享商品删除成功',
                  icon: 'success',
                  duration: 2000
                })
                wx.redirectTo({
                  url: '/pages/myShare/myShare',
                })
              } else {
                wx.showToast({
                  title: "共享商品删除失败",
                  icon: 'success',
                  duration: 2000
                })
              }

            }

          })
        }
      }
    })

    
  },

  submitShare: function (e) {
    var that = this

    if (
      this.data.goods_name==''
    ) {
      wx.showToast({
        title: '请填写商品标题',
      })
      return;
    }else if (this.data.goods_price == '') {
      wx.showToast({
        title: '请填写购买价格',
      })
      return;
    } else if (this.data.buy_timeindex == 0) {
      wx.showToast({
        title: '请选择购买日期',
      })
      return;
    } else if (this.data.goods_image == '') {
      wx.showToast({
        title: '请上传商品图片',
      })
      return;
    }

    if (that.data.goods_id == '') {
      qcloud.request({
        url: config.service.shareAdd,
        login: true,
        data: {
          brand_id: that.data.brand_id,
          buy_price: that.data.buy_price,
          cat_id: that.data.cat_id,
          buy_time: that.data.buy_timeindex,
          goods_name: that.data.goods_name,
          is_free: that.data.is_free,
          goods_image: that.data.goods_image,
          goods_images: that.data.goods_images,
          damaged_images: that.data.damaged_images,
          goods_description: that.data.goods_description
        },
        success(result) {
          if (result.data.code == 0) {
            wx.showToast({
              title: '保存成功',
              icon: 'success',
              duration: 2000
            })
            wx.redirectTo({
              url: '/pages/addShare/addShare?goods_id=' + result.data.data.goods_id,
            })
          } else {
            wx.showToast({
              title: "添加失败",
              icon: 'success',
              duration: 2000
            })
          }

        }

      })
    } else {
      qcloud.request({
        url: config.service.shareUpdate,
        login: true,
        data: {
          goods_id: that.data.goods_id,
          brand_id: that.data.brand_id,
          buy_price: that.data.buy_price,
          cat_id: that.data.cat_id,
          buy_time: that.data.buy_timeindex,
          goods_name: that.data.goods_name,
          is_free: that.data.is_free,
          goods_image: that.data.goods_image,
          goods_images: that.data.goods_images,
          damaged_images: that.data.damaged_images,
          goods_description: that.data.goods_description,
          check_status: e.target.dataset.status
        },
        success(result) {
          if (result.data.code == 0) {
            wx.showToast({
              title: '修改成功',
              icon: 'success',
              duration: 2000
            })
            wx.redirectTo({
              url: '/pages/myShare/myShare',
            })
          } else {
            wx.showToast({
              title: "修改失败",
              icon: 'success',
              duration: 2000
            })
          }

        }

      })
    }


  }





})
//index.js
var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')

Page({
  data: {
    userInfo: {},
    logged: false,
    myaddress:[]
  },
  onShow: function () {
    var that = this
    this.setData({
      userInfo: getApp().globalData.userInfo,
      logged: getApp().globalData.logged
    });

    qcloud.request({
      url: config.service.myaddress,
      login: true,
      success(result) {
        console.log(result)
        that.setData({
          myaddress: result.data.data
        })
        
      }
      
    })

    console.log(this.data.myaddress)
    
  },
  addAddress: function (event) {
    wx.redirectTo({
      url: '/pages/addAddress/addAddress?id='+event.target.dataset.id
    })
  }
})
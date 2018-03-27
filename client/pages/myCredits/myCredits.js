//index.js
var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')

Page({
  data: {
    userInfo: {},
    logged: false,
  },
  onShow: function () {
    this.setData({
      userInfo: getApp().globalData.userInfo,
      logged: getApp().globalData.logged
    });
  }
})
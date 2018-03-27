//index.js
var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')

Page({
  data: {
    userInfo: {},
    logged: false,
    region: ['广东省', '广州市', '天河区'],
    sex: 0,
    sexColor: ['#2c2c2c', '#2c2c2c'],
    address_id: 0,
    name: '',
    phone: '',
    address: ''
  },
  onLoad: function (option) {
    var that = this
    if (option.id != undefined && option.id != '') {

      this.setData({
        address_id: option.id
      })

      qcloud.request({
        url: config.service.addressDetail + "?address_id=" + option.id,
        login: true,
        success(result) {
          console.log(result)
          var address_info = result.data.data;
          that.setData({
            region: [address_info.province, address_info.city, address_info.area],
            sex: address_info.sex,
            name: address_info.name,
            phone: address_info.phone,
            address: address_info.address

          })

          if (address_info.sex == 1) {
            that.setData({
              sexColor: ['#1296db', '#2c2c2c']
            })
          } else if (address_info.sex == 2) {
            that.setData({
              sexColor: ['#2c2c2c', '#1296db']
            })
          }

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
  bindRegionChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      region: e.detail.value
    })
  },
  bindsex_1: function () {
    this.setData({
      sex: 1,
      sexColor: ['#1296db', '#2c2c2c']
    })
  },
  bindsex_2: function () {
    this.setData({
      sex: 2,
      sexColor: ['#2c2c2c', '#1296db']
    })
  },
  deleteAddress: function () {
    var that = this
    if (this.data.address_id == '') {
      wx.showToast({
        title: '地址ID不存在',
        icon: 'success',
        duration: 2000
      })
    }


    wx.showModal({
      title: '提示',
      content: '确定删除地址吗？',
      success: function (res) {
        if (res.confirm) {
          qcloud.request({
            url: config.service.addressDelete,
            login: true,
            data: {
              address_id: that.data.address_id
            },
            success(result) {
              if (result.data.code == 0) {
                wx.showToast({
                  title: '地址删除成功',
                  icon: 'success',
                  duration: 2000
                })
                wx.redirectTo({
                  url: '/pages/myAddress/myAddress',
                })
              } else {
                wx.showToast({
                  title: "删除地址失败",
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
      name: function (e) {
        this.setData({
          name: e.detail.value
        })
      },
      phone: function (e) {
        this.setData({
          phone: e.detail.value
        })
      },
      address: function (e) {
        this.setData({
          address: e.detail.value
        })
      },
      submitAddress: function () {
        var that = this

        if (
          this.data.sex != 1 && this.data.sex != 2
        ) {
          wx.showToast({
            title: '请选择性别',
          })
        } else if (this.data.name == '') {
          wx.showToast({
            title: '请填写性名',
          })
        } else if (this.data.region[0] == '') {
          wx.showToast({
            title: '请选择省份',
          })
        } else if (this.data.region[1] == '') {
          wx.showToast({
            title: '请选择城市',
          })
        } else if (this.data.region[2] == '') {
          wx.showToast({
            title: '请选择区',
          })
        } else if (this.data.address == '') {
          wx.showToast({
            title: '请填写收货地址',
          })
        }

        if (that.data.address_id == '') {
          qcloud.request({
            url: config.service.addressAdd,
            login: true,
            data: {
              address: that.data.address,
              area: that.data.region[2],
              city: that.data.region[1],
              name: that.data.name,
              phone: that.data.phone,
              sex: that.data.sex,
              province: that.data.region[0]
            },
            success(result) {
              if (result.data.code == 0) {
                wx.showToast({
                  title: '地址添加成功',
                  icon: 'success',
                  duration: 2000
                })
                wx.redirectTo({
                  url: '/pages/myAddress/myAddress',
                })
              } else {
                wx.showToast({
                  title: "地址添加失败",
                  icon: 'success',
                  duration: 2000
                })
              }

            }

          })
        } else {
          qcloud.request({
            url: config.service.addressUpdate,
            login: true,
            data: {
              address_id: that.data.address_id,
              address: that.data.address,
              area: that.data.region[2],
              city: that.data.region[1],
              name: that.data.name,
              phone: that.data.phone,
              sex: that.data.sex,
              province: that.data.region[0]
            },
            success(result) {
              if (result.data.code == 0) {
                wx.showToast({
                  title: '地址修改成功',
                  icon: 'success',
                  duration: 2000
                })
                wx.redirectTo({
                  url: '/pages/myAddress/myAddress',
                })
              } else {
                wx.showToast({
                  title: "地址修改失败",
                  icon: 'success',
                  duration: 2000
                })
              }

            }

          })
        }


      }


    })

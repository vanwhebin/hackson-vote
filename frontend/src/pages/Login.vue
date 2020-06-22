<template>
  <div class="container">
    <div class="top">
      <div class="main">
        <!--<h3 class="header">登录</h3>-->
        <div class="qrcode-box">
          <div id="wx_reg">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  created () {
    const wxAssets = 'https://rescdn.qqmail.com/node/ww/wwopenmng/js/sso/wwLogin-1.0.0.js'
    this.loadScript(wxAssets, r => this.getWxQR())
  },
  methods: {
    getWxQR () {
      const wxObj = {
        id: 'wx_reg',
        appid: 'ww0f3efc2873ad11c3',
        agentid: '1000036',
        redirect_uri: 'http://review.freebie-queen.com/api/v1/login',
        // state: 'reviewer@aukey',
        state: '',
        href: 'data:text/css;base64,LmltcG93ZXJCb3ggLnFyY29kZSB7d2lkdGg6IDIwMHB4O30NCi5pbXBvd2VyQm94IC50aXRsZSB7ZGlzcGxheTogbm9uZTt9DQouaW1wb3dlckJveCAuaW5mbyB7d2lkdGg6IDIwMHB4O30NCi5zdGF0dXNfaWNvbiB7ZGlzcGxheTogbm9uZX0NCi5pbXBvd2VyQm94IC5zdGF0dXMge3RleHQtYWxpZ246IGNlbnRlcjt9'
      }
      window.WwLogin(wxObj)
    },
    loadScript (src, callback) {
      const script = document.createElement('script')
      script.type = 'text/javascript'
      if (callback) script.onload = callback
      document.querySelector('body').appendChild(script)
      script.src = src
    }
  }
}
</script>

<style scoped>
  .container {
    width: 100%;
    min-height: 1000px;
    background: #f0f2f5 url(../assets/background.svg) no-repeat 50%;
    background-size: 100%;
    padding: 110px 0 144px;
    position: relative;
  }

  a {
    text-decoration: none;
  }

  .top {
    text-align: center;
  }
  .user-layout-login {
    background: #ffffff;
    padding:12px;
    border-radius: 3px;
  }
  .user-layout-login label {
    font-size: 14px;
  }
  .qrcode-box{
    height: 295px;
    padding-top: 100px;
    /*padding-left: 35px;*/
  }
  .bg {
    background: gray;
    height: 100%;
  }

</style>

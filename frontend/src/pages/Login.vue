<template>
  <div class="container">
    <div class="top">
      <div class="main">
        <a-form id="formLogin" class="user-layout-login" ref="formLogin" :form="form" @submit="handleSubmit" :style="{margin: 'auto', 'width': '300px'}">
          <h1>登录</h1>
          <a-alert v-if="isLoginError" type="error" showIcon style="margin-bottom: 24px;" message="账户或密码错误"></a-alert>
          <a-form-item style="margin-top:20px">
            <a-input
              size="large"
              type="text"
              placeholder="账户: 企业邮箱"
              v-decorator="[
                'username',
                {rules: [{ required: true, message: '请输入邮箱' }, { validator: handleUsernameOrEmail }], validateTrigger: 'change'}
              ]"
            >
              <a-icon slot="prefix" type="user" :style="{ color: 'rgba(0,0,0,.25)' }"></a-icon>
            </a-input>
          </a-form-item>

          <a-form-item>
            <a-input
              size="large"
              type="password"
              autocomplete="false"
              placeholder="密码: 123456"
              v-decorator="[
                'password',
                {rules: [{ required: true, message: '请输入密码' }], validateTrigger: 'blur'}
              ]"
            >
              <a-icon slot="prefix" type="lock" :style="{ color: 'rgba(0,0,0,.25)' }"></a-icon>
            </a-input>
          </a-form-item>
          <!--<a-form-item>
            <a-checkbox v-decorator="['rememberMe', { valuePropName: 'checked' }]">自动登录</a-checkbox>
          </a-form-item>-->

          <a-form-item style="margin-top:24px">
            <a-button
              size="large"
              type="primary"
              htmlType="submit"
              class="login-button"
              :style="{width: '100%'}"
              :loading="state.loginBtn"
              :disabled="state.loginBtn"
            >确定</a-button>
          </a-form-item>
        </a-form>
        <!--<div class="qrcode-box">
          <div id="wx_reg">
          </div>
        </div>-->
      </div>
    </div>
  </div>
</template>

<script>
import config from '@/config'
import { setStore } from '@/utils/storage'
import { login } from '@/api/api'
export default {
  name: 'Login',
  data () {
    return {
      isLoginError: false,
      form: this.$form.createForm(this),
      state: {
        time: 60,
        loginBtn: false,
        // login type: 0 email, 1 username, 2 telephone
        loginType: 0,
        smsSendBtn: false
      }
    }
  },
  created () {
    // const wxAssets = 'https://rescdn.qqmail.com/node/ww/wwopenmng/js/sso/wwLogin-1.0.0.js'
    // this.loadScript(wxAssets, r => this.getWxQR())
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
    },
    handleUsernameOrEmail (rule, value, callback) {
      const { state } = this
      const regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
      if (regex.test(value)) {
        state.loginType = 0
      } else {
        state.loginType = 1
      }
      callback()
    },
    handleSubmit (e) {
      e.preventDefault()
      const {
        form: { validateFields },
        state
      } = this

      state.loginBtn = true

      const validateFieldsKey = ['username', 'password']

      validateFields(validateFieldsKey, { force: true }, (err, values) => {
        if (!err) {
          console.log('login form', values)
          const loginParams = { ...values }
          delete loginParams.username
          loginParams['email'] = values.username
          // loginParams.password = md5(values.password)
          login(loginParams)
            .then((res) => this.loginSuccess(res))
            .catch(err => this.requestFailed(err))
            .finally(() => {
              state.loginBtn = false
            })
        } else {
          setTimeout(() => {
            state.loginBtn = false
          }, 600)
        }
      })
    },
    loginSuccess (res) {
      console.log(res)
      setStore(config.token, res.data.access_token)
      this.$router.push({ path: '/' })
      this.isLoginError = false
    },
    requestFailed (err) {
      this.isLoginError = true
      this.$notification['error']({
        message: '错误',
        description: ((err.response || {}).data || {}).message || '请求出现错误，请稍后再试',
        duration: 4
      })
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

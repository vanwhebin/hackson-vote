<template>
  <div class="container">
    <div class="top">
      <div class="main">
        <form id="formLogin" class="user-layout-login" ref="formLogin"  :style="{margin: 'auto', 'width': '300px'}">
          <h5>登录</h5>
          <div id="email">
            <label>
            <input type="text" name="email" placeholder="邮箱" v-model="form.email">
          </label>
          </div>
          <div id="password">
            <label>
            <input  name="password" type="password" placeholder="密码即邮箱" v-model="form.password">
          </label>
          </div>
          <div>
            <button class="btn" @click.prevent="handleSubmit" :disabled="state.loginBtn">提交</button>
          </div>
        </form>
      </div>
    </div>
    <div class="back"><a href="javascript:void(0)" class="link text-yellow" @click="$router.push({name: 'home'})">返回</a></div>
    <div class="toast flex align-center" v-show="toast.status">
        <span class="icon">
            <img :src="toast.img" alt=""/>
        </span>
      <span class="text">{{toast.text}}</span>
    </div>
  </div>
</template>

<script>
  import { postLogin } from '@/api/api'
  import { setStore } from '@/utils/storage'
  import config  from '@/config'
  export default {
    name: 'Login',
    data () {
      return {
        isLoginError: false,
        form: {
          email: null,
          password: null
        },
        state: {
          time: 60,
          loginBtn: false
        },
        toast: {
          status: false,
          img: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjc2NEM0QUM5QUM4NzExRUE5QTUxOThDMDlEOTcyM0MzIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjc2NEM0QUNBQUM4NzExRUE5QTUxOThDMDlEOTcyM0MzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NzY0QzRBQzdBQzg3MTFFQTlBNTE5OEMwOUQ5NzIzQzMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NzY0QzRBQzhBQzg3MTFFQTlBNTE5OEMwOUQ5NzIzQzMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7N6kNaAAAEq0lEQVR42uRbWWwNURj+Z3pdtdzWUlu0qVBLSRqpBFUSDypdHnjAQxNrpEUsL5YH4YFELPWg8VIaa/SBBxFUiUiKhoSKNrS0SGpJSIVShC73+v87/3BbvUtn7pnOOF/yJZM5c+/5/2/OnPP/Z1EGeTJAMMYiqZJU5BTkJORoZDzSw8+0Ir8g3yMbkM+Q9ch7yHcijVMECTADmY/MZafNgMQoR5Yhq+0sAL3NQuRq5FRBL6wOeRJZwq3GFgIMQW5BbkYOA2vwCVmMPIJsMfNHMe7+SYbFQ65CXuamPgCsA9U1H7kW2YysMfpHqsHfpSDvcHNMgL5DAttAtkywSoCl3Bllgn1Atjxi24QJQE2+CHkeGQf2QxzbVsS2RrUPcCPPcC9vd8xBTkReQXZGowWQ85d4XHcK8tlmt1kBqCmdQGaD85DNtitmPoH9yPXgXKTxkHnTiABLONBwOjI5gqzrzScwHlkK/w+Os08RCUDfzGnO1v4XxLNPSiQCrETOFWnNzHQVLpW54UNDrJ90TfcEYy6H7iGToSGcj48QZUXeQhXKSt0QE9P1fieO2Plr2+DqDa9IEZp5PqIlWAvYItJ5wt6d/f5x3t8bx2hlgjGCfeyxBQxGNolOaVvfxoISZGT2+QA8iT+tSKXH6fMJgS1gnRX5vKIYK4sihgWG9GpAz18A8qBQHxF0ATI4gZAFKezzHwGWgnxYFihAtoQCZOsCJIL5qWsnYjIyiQSYDfIigwSYLrEAaSRAqsQCpJIAyRILkEwCjJFYgAQSwCOxAIMtF4ASHiNlguBRra6x8aXPUJkoqBClZeZIsXtfu3/yozvoHpVZjFbLBbhy3QtZi9vg1m0vfP8BftI13aMyi/GNJkQegrajQ0ZUUwtokngUaCIB6iUWoJ4EqJVYgFoS4J7EAtwnAd4gn0voPK1/vNYDoQoJBbimB0KEC1bWnJulQvmFv0tjdJ2zwPKg1O+zvjCicJNIER4J7nDB9s2uHssOFnfAngMdVjj/ArQlMp8uOwXhJaJrpbcczHkClVHrsAAl7HOXlSG6+VlkrZsKXWGf2VjgEu3858CXHSgA5QRCd4Skp6lRecYkigPzn+61kQDNfdk1C14fbGYBIJgAtG6+Q1Ttj2rDZ3vVNUIzQvLtUygBCKeQVSJqP3qsIyrPGEQV+9YFwXaJVYK2VSY2mhY0vvKBqx9A5iw16DBYeqZThPN0GiWn+9sPJQD1lC9BwKJpZZUXap54YdRIBRKGK9DejgH5Ay9s29UuynnCCuTdHvucMAcmDiK3OTzkLQrlQ7idojc5OkxzqPPnkBtCPRBu0KVoaY1Dk6UKtt1nRgBCG3IRaKe2nIIytrkt3IORnheg3ukiaDvJ5tjc+cOgbfCOqEftTdxJTWkraFtLvtrQ8a9s29Zwzd6oAIF59AxRwZKJICfdyLyG0cyD8ul53Ml87EPHP7IN8zhu6TXMnBskPAZtK/ov+Hs4wQpQRHcItKMx900lXwKOztIbEbXrhNYwToDNjs72BOojliPzwPw0G31uV5FnweaHp4NBPz4/DbStafrx+aHIgUhaEv7G+QeR5iZpmv4pWHB8/rcAAwABeg8xXwA/2wAAAABJRU5ErkJggg==',
          text: '帐号密码错误'
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
      validate (values) {
        const regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
        return !!(regex.test(values['email']) && values['password']);
      },
      handleSubmit (e) {
        e.preventDefault()
        // return false
        console.log(this.form)
        const _this = this
        if (this.validate(this.form)) {
          this.state.loginBtn = true
          const data = Object.assign({}, this.form)
          console.log(data)
          postLogin(data)
            .then((res) => {
              _this.loginSuccess(res)
            }).catch((err) => {
              _this.loginFail(err)
            }).finally(() => {
              _this.state.loginBtn = false
          })
        } else {
          setTimeout(() => {
            // this.state.loginBtn = false
          }, 600)
        }
      },
      loginSuccess (res) {
        console.log(res.data)
        setStore(config.token, res.data.access_token)
        this.$router.push({ name: 'programs' })
      },
      loginFail (err) {
        console.log(err)
        this.toast.status = true
        const _this = this
        setTimeout(function(){
          _this.toast.status = false
        }, 1000)
      }
    }
  }
</script>

<style scoped>
  .container {
    width: 100%;
    background-size: 100%;
    padding: 110px 0 144px;
    position: relative;
  }

  .container .back {
    font-size: .5rem;
    margin-top: 6rem;
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
    /*font-size: 14px;*/
  }

  form h5 {
    margin-bottom: 35px;
  }
  form input {
    padding-left: 10px;
    border: 1px solid #d9d9d9;
    border-radius: 2px;
    height: 30px;
    width: 100%;
  }
  form label {
    font-size: 24px;
  }

  form .btn {
    color: #fff;
    width: 100%;
    /*height: */
    background-color: #1890ff;
    /*border-color: #1890ff;*/
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
    -webkit-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.045);
    box-shadow: 0 2px 0 rgba(0, 0, 0, 0.045);
    height: 32px;
    line-height: 1.499;
    position: relative;
    display: inline-block;
    font-weight: 400;
    white-space: nowrap;
    text-align: center;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 2px;
    margin-top: 30px;
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

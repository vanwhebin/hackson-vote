<template>
  <a-layout class="layout">
    <a-layout-header class="layout-header p-header">
      <div class="menu">
        <div class="left-menu">
          <div class="logo"></div>
          <a-menu
            theme="light"
            mode="horizontal"
            :default-selected-keys="['1']"
          >
            <a-menu-item key="1">
              首页
            </a-menu-item>
            <a-menu-item key="2">
              文档
            </a-menu-item>
          </a-menu>
        </div>
        <div class="right-menu">
          <button type="button" class="reser-btn ant-btn" ><span>放码过来</span></button>
        </div>
      </div>

    </a-layout-header>
    <a-layout-content class="content-layout" style="margin-top: 80px">
      <div class="content-box">
        <a-card>
          <a-form layout="vertical" :form="form">
            <a-form-item label="活动标题">
              <a-input placeholder="项目标题内容"
                       v-decorator="['title', { rules: [{required: true, message: '请提供简要标题'}] }]">
              </a-input>
            </a-form-item>
            <a-form-item label="活动描述">
              <a-textarea
                placeholder="活动具体要求"
                rows="5"
                v-decorator="['desc', { rules: [{required: true, message: '请简单描述项目内容'}] }]"
              >
              </a-textarea>
            </a-form-item >
            <a-form-item label="评分人员">
              <a-input-group compact>
                <a-input style="width: 10%" default-value="万伟斌" disabled></a-input>
                <a-input-number
                  :default-value="100"
                  :min="0"
                  :max="100"
                  :formatter="value => `${value}%`"
                  :parser="value => value.replace('%', '')"
                  @change="onChange"></a-input-number>
              </a-input-group>
            </a-form-item>
            <a-form-item >
              <a-button type="primary" @click="onSubmit">提交</a-button>
            </a-form-item>
          </a-form>
        </a-card>
      </div>
    </a-layout-content>
    <a-layout-footer class="layout-footer">
      <div class="footer-content">
        <div class="footer-left">
          <div class="foot-nav" style="color:#9ba5b4;width:300px">
            <h2><a-icon type="github"></a-icon> AUKEY HACKSON</h2>
            <ul>
              <li>Copyright © 2020 </li>
            </ul>
          </div>
        </div>
        <div class="footer-right">
          <div class="foot-nav"><strong>后端语言选型</strong>
            <div role="separator" class="ant-divider ant-divider-horizontal"></div>
            <ul>
              <li><a href="javascript:void(0)" >Java</a></li>
              <li><a href="javascript:void(0)" >Python</a></li>
              <li><a href="javascript:void(0)" >Golang</a></li>
              <li><a href="javascript:void(0)" >PHP</a></li>
            </ul>
          </div>
          <div class="foot-nav"><strong>前端框架</strong>
            <div role="separator" class="ant-divider ant-divider-horizontal"></div>
            <ul>
              <li><a href="javascript:void(0)" >React</a></li>
              <li><a href="javascript:void(0)" >Vue</a></li>
              <li><a href="javascript:void(0)" >jQuery</a></li>
            </ul>
          </div>
          <div class="foot-nav"><strong>其他</strong>
            <div role="separator" class="ant-divider ant-divider-horizontal"></div>
            <ul>
              <li><a href="javascript:void(0)" >OPS</a></li>
              <li><a href="javascript:void(0)" >CI & Workflow</a></li>
              <li><a href="javascript:void(0)" >Docker</a></li>
              <li><a href="javascript:void(0)" >Kubernetes</a></li>
            </ul>
          </div>
        </div>
      </div>
    </a-layout-footer>
  </a-layout>
</template>

<script>
export default {
  name: 'UpdateCampaign',
  data () {
    return {
      form: this.$form.createForm(this),
      formLayout: 'vertical'
    }
  },
  methods: {
    onSubmit () {
      this.form.validateFields((err, values) => {
        if (!err) {
          console.log(values)
        }
      })
    },
    onChange (val) {
      console.log(val)
    }
  }
}
</script>

<style scoped>
  .layout {
    background: white;
  }

  .layout-header {
    background: #fff;
    padding: 0;
    height: 55px;
    line-height: 85px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 5;
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, .1);
  }

  h1 {
    font-size: 2em;
  }

  .layout-header .menu {
    width: 1200px;
    height: 55px;
    margin: auto;
    display: flex;
    justify-content: space-between;
  }

  .left-menu .logo {
    width: 120px;
    float: left;
    height: 55px;
    background: url(../assets/auk.png) no-repeat !important;
    background-position-y: 17px !important;
  }
  .left-menu ul{
    margin-left: 20px;
  }

  .p-header .left-menu {
    display: flex;
    justify-content: flex-start;
  }

  .p-header .right-menu {
    height: 55px;
    align-items: center;
    color: #fff;
    display: flex;
  }

  .layout-header .logo {
    background: inherit;
    border-bottom: none;
    box-shadow: none;
  }
  /*-----footer----------*/

  .layout-footer {
    width: 100%;
    background: #0a1633;
    color: #9ba5b4;
  }
  .layout-footer .footer-content{
    padding: 64px 0;
    display: flex;
    width: 1200px;
    margin: auto;
    justify-content: space-between;
  }

  .layout-footer .foot-nav{
    width: 120px;
    display: inline-block;
    box-sizing: border-box;
    vertical-align: top;
    line-height: 32px;
    margin-left: 48px;
  }

  .footer-left{
    width: 240px;
  }
  .layout-footer .foot-nav ul {
    padding-left: 0;
  }

  .foot-nav ul li{
    list-style-type: none;
    cursor: pointer;
  }

  .foot-nav li a{
    color: #9ba5b4;
    text-decoration: none;
  }

  .foot-nav h2{
    color: #9ba5b4;
  }
  /*---------!footer-------------*/
  .content-layout {
    margin: auto;
    margin-top: 24px;
    display: flex;
    flex-direction: row;
    width: 1200px;
  }

  .content-box {
    background: #FFF;
    min-height: 500px;
    border-radius: 5px;
    width: 100%;
  }
</style>

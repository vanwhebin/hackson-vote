<template>
  <a-layout class="layout">
    <a-layout-header class="layout-header p-header">
      <div class="menu">
        <div class="left-menu">
          <div class="logo" @click="$router.push({name: 'home'})"></div>
          <a-menu
            theme="light"
            mode="horizontal"
          >
            <a-menu-item key="1" @click="$router.push({name: 'home'})">
              首页
            </a-menu-item>
          </a-menu>
        </div>
        <div class="right-menu">
        </div>
      </div>

    </a-layout-header>
    <a-layout-content class="content-layout" style="margin-top: 80px">
      <div class="content-box">

        <a-card>
          <a-form layout="vertical" :form="form">
            <a-form-item label="当前活动">
              <a-input placeholder="项目标题内容" disabled :value="campaign.title">
              </a-input>
            </a-form-item>
            <a-form-item label="项目标题">
              <a-input placeholder="项目标题内容"
                       v-decorator="['title', { rules: [{required: true, message: '请提供简要标题'}] }]">
              </a-input>
            </a-form-item>
            <a-form-item label="项目描述">
              <a-textarea
                placeholder="项目具体实现功能点"
                rows="5"
                v-decorator="['desc', { rules: [{required: true, message: '请简单描述项目内容'}] }]"
              >
              </a-textarea>
            </a-form-item>
            <a-form-item label="其他材料">
              <a-textarea rows="3" v-decorator="['memo']"></a-textarea>
            </a-form-item>
            <a-form-item label="团队成员" has-feedback>
              <a-select
                mode="multiple"
                style="width: 100%"
                placeholder="请选择团队成员"
                option-label-prop="label"
                v-decorator="['team', { rules: [{required: true, message: '请选择团队成员'}] }]"
                @change="changeTeam"
              >
                <a-select-option v-for="(user, ind) in users" :value="user.id" :key="ind" :label="user.name" >
                  {{user.name}}
                </a-select-option>
              </a-select>
            </a-form-item>
            <a-row :gutter="24">
              <a-col :span="4">
                <a-form-item label="产品人员" has-feedback>
                  <a-select v-decorator="['product', { rules: [{required: true, message: '请选择产品'}] }]">
                    <a-select-option v-for="(user, ind) in team" :value="user.id" :key="ind" :label="user.name">
                      {{user.name}}
                    </a-select-option>
                  </a-select>
                </a-form-item>
              </a-col>
              <a-col :span="4">
                <a-form-item label="设计人员" has-feedback>
                  <a-select v-decorator="['design']">
                    <a-select-option v-for="(user, ind) in team" :value="user.id" :key="ind" :label="user.name">
                      {{user.name}}
                    </a-select-option>
                  </a-select>
                </a-form-item>
              </a-col>
              <a-col :span="7">
                <a-form-item label="开发人员" has-feedback>
                  <a-select mode="multiple" v-decorator="['develop', { rules: [{required: true, message: '请选择开发人员'}] }]">
                    <a-select-option v-for="(user, ind) in team" :value="user.id" :key="ind" :label="user.name">
                      {{user.name}}
                    </a-select-option>
                  </a-select>
                </a-form-item>
              </a-col>
              <a-col :span="4">
                <a-form-item label="测试人员" has-feedback>
                  <a-select v-decorator="['test']">
                    <a-select-option v-for="(user, ind) in team" :value="user.id" :key="ind" :label="user.name">
                      {{user.name}}
                    </a-select-option>
                  </a-select>
                </a-form-item>
              </a-col>
              <a-col :span="5">
                <a-form-item label="评分人员" has-feedback>
                  <a-select v-decorator="['rating', { rules: [{required: true, message: '请选择评分人员'}] }]">
                    <a-select-option v-for="(user, ind) in team" :value="user.id" :key="ind" :label="user.name">
                      {{user.name}}
                    </a-select-option>
                  </a-select>
                </a-form-item>
              </a-col>
            </a-row>
            <a-form-item >
              <a-button type="primary" @click="onSubmit">提交</a-button>
            </a-form-item>
          </a-form>
        </a-card>
      </div>
    </a-layout-content>
    <a-layout-footer class="layout-footer" style="margin-top: 30px">
      <div class="footer-content">
        <div class="footer-left">
          <div class="foot-nav" style="color:#9ba5b4;width:300px">
            <h2>
              <a-icon type="github"></a-icon>
              AUKEY HACKSON
            </h2>
            <ul>
              <li>Copyright © 2020</li>
            </ul>
          </div>
        </div>
        <div class="footer-right">
          <div class="foot-nav"><strong>后端语言选型</strong>
            <div role="separator" class="ant-divider ant-divider-horizontal"></div>
            <ul>
              <li><a href="javascript:void(0)">Java</a></li>
              <li><a href="javascript:void(0)">Python</a></li>
              <li><a href="javascript:void(0)">Golang</a></li>
              <li><a href="javascript:void(0)">PHP</a></li>
            </ul>
          </div>
          <div class="foot-nav"><strong>前端框架</strong>
            <div role="separator" class="ant-divider ant-divider-horizontal"></div>
            <ul>
              <li><a href="javascript:void(0)">React</a></li>
              <li><a href="javascript:void(0)">Vue</a></li>
              <li><a href="javascript:void(0)">jQuery</a></li>
            </ul>
          </div>
          <div class="foot-nav"><strong>其他</strong>
            <div role="separator" class="ant-divider ant-divider-horizontal"></div>
            <ul>
              <li><a href="javascript:void(0)">OPS</a></li>
              <li><a href="javascript:void(0)">CI & Workflow</a></li>
              <li><a href="javascript:void(0)">Docker</a></li>
              <li><a href="javascript:void(0)">Kubernetes</a></li>
            </ul>
          </div>
        </div>
      </div>
    </a-layout-footer>
  </a-layout>
</template>

<script>
import { postProgram, getUsers, getLatestCampaign } from '@/api/api'
import { setStore } from '@/utils/storage'
import config from '@/config'
export default {
  name: 'Start',
  data () {
    return {
      form: this.$form.createForm(this),
      formLayout: 'vertical',
      users: [],
      selectedUsers: {
        product: {},
        develop: {},
        test: {},
        rating: {}
      },
      teamUserID: [],
      team: [],
      campaign: {
        title: '',
        UID: ''
      }
    }
  },
  mounted () {
    this.init()
  },
  methods: {
    init () {
      getUsers().then((res) => {
        console.log(res)
        this.users = res.data
      })
      getLatestCampaign().then((res) => {
        console.log(res)
        this.campaign.title = res.data.title
        this.campaign.UID = res.data.uuid
        setStore(config.campaignRef, res.data.uuid)
      })
    },
    changeTeam (selected) {
      console.log(selected)
      const _this = this
      selected.forEach(function (item) {
        for (let i = 0; i < _this.users.length; i++) {
          if (_this.users[i].id === item && _this.teamUserID.indexOf(item) === -1) {
            _this.teamUserID.push(item)
            _this.team.push(_this.users[i])
          }
        }
      })
      console.log(this.team)
    },
    onSubmit () {
      const _this = this
      this.form.validateFields((err, values) => {
        if (!err) {
          console.log(values)
          const data = Object.assign({}, values, { campaignUID: _this.campaign.UID, develop: values['develop'].join(',') })
          postProgram(data).then((res) => {
            console.log(res)
            if (!res.code) {
              _this.$message.success('创建成功')
              _this.form.resetFields()
            }
          })
        }
      })
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

  .left-menu ul {
    margin-left: 20px;
  }

  .left-menu ul li{
    padding-top: 5px;
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
    /*position: fixed;*/
    bottom: 0;
    left: 0;
    width: 100%;
    background: #0a1633;
    color: #9ba5b4;
  }

  .layout-footer .footer-content {
    padding: 64px 0;
    display: flex;
    width: 1200px;
    margin: auto;
    justify-content: space-between;
  }

  .layout-footer .foot-nav {
    width: 120px;
    display: inline-block;
    box-sizing: border-box;
    vertical-align: top;
    line-height: 32px;
    margin-left: 48px;
  }

  .footer-left {
    width: 240px;
  }

  .layout-footer .foot-nav ul {
    padding-left: 0;
  }

  .foot-nav ul li {
    list-style-type: none;
    cursor: pointer;
  }

  .foot-nav li a {
    color: #9ba5b4;
    text-decoration: none;
  }

  .foot-nav h2 {
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

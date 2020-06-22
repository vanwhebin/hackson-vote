<template>
  <a-layout class="layout">
    <a-layout-header class="layout-header p-header">
      <div class="menu">
        <div class="left-menu">
          <div class="logo" @click="$router.push({name: 'home'})"></div>
          <a-menu
            theme="light"
            mode="horizontal"
            :default-selected-keys="['1']"
          >
            <a-menu-item key="1" @click="$router.push({name: 'home'})">
              首页
            </a-menu-item>
          </a-menu>
        </div>
      </div>

    </a-layout-header>
    <a-layout-content class="content-layout" style="margin-top: 100px">
      <div class="content-box">
        <a-card>
          <div class="operate">
            <a-button type="dashed" style="width: 100%" icon="plus" @click="showDrawer()">添加</a-button>
          </div>
          <a-list
            class="demo-loadmore-list"
            :loading="loading"
            item-layout="horizontal"
            :data-source="data"
            :pagination="pagination"
          >
            <a-list-item slot="renderItem" slot-scope="item">
              <a slot="actions" @click="editCampaign(item)">编辑</a>
              <a slot="actions" @click="confirmHide(item)">隐藏</a>
              <a-popconfirm
                title="确认隐藏？"
                ok-text="是"
                cancel-text="否"
                @confirm="confirmHide"
              >
              </a-popconfirm>
              <a-list-item-meta
                :description="item.desc"
              >
                <a slot="title" href="javascript:void(0)">{{ item.title }}</a>
                <a-avatar
                  slot="avatar"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADQAAAA0CAYAAADFeBvrAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAITSURBVGhD7deviwJBFMDx+59EjCIWg2BZmwo2fyQRtNjEJoJRi2g3CYrJJIJWwSBYBIPBaFqY4z3YZVyf3s7srDfIhG9w3lvYD7cn7o9t2+ybMiDdMyDdMyDdMyDdMyDdMyDZjscjKxQKrFgsknNVfQw0Ho9ZJBLBqLmqPgaq1+uIqVQq5FxVSkCNRoOl02m23+/J+f1+Z8lkEkHwl4Kz8/mM18C13v0gBQbBDTmP0na7JXc2m427czgc8OxyubhnKlGBQDxmuVySO9BgMMCdVCr1cA7XqEZJg/xioGq1inutVutppholBRLB3G43Fo1GcXc2m5E7KlHCIBEMtFqt3P3r9UruQKpQQiBRDNTv93E/l8uRcz4VKN8gGQyUz+fxml6vR869BUX5AnW7XSkM/9W8Xq/JHSoe1W63yZ1XhQpaLBZ4TTweJ+evCh0EyTxynU4H92u1Gjmn4jGhPXJOoqhMJoO7k8mEnHsLioGEQJBf1Ol0cvecnzvvUoGBhEGQH9R0OsW5ZVnknE8VBpICQX+hms0mzuD/yDvjU4mBpEHQO1QikcDz+Xz+cM6nGgMFAkE8ynl9gPci+ByLxV7+3NHy9cEJboh/wRuNRnijpVLpaddJ2xc8qnK5jKDhcEjOwywUkPMo7XY7ch5moYCsbFb5o+S3UED/mQHpngHpngHpngHpngHpngHpngHp3peBbPYLOZxI41wXsikAAAAASUVORK5CYII="></a-avatar>
              </a-list-item-meta>
            </a-list-item>
          </a-list>
          <div>
            <a-modal
              :title="campaign.title"
              :width="820"
              :visible="visible"
              :body-style="{ paddingBottom: '80px' }"
              @cancel="onClose"
              :footer="null"
            >
              <a-form :form="form" layout="vertical">
                <a-row :gutter="16">
                  <a-col :span="24">
                    <a-form-item label="标题">
                      <a-input
                        v-decorator="['title',{rules: [{ required: true, message: '请输入标题，建议使用日期加简要描述' }]}]"
                        placeholder="请输入标题"></a-input>
                    </a-form-item>
                  </a-col>
                </a-row>
                <a-row :gutter="16">
                  <a-col :span="12">
                    <a-form-item label="日期">
                      <a-date-picker
                        v-decorator="['date',{rules: [{type:'object', required: true, message: '请选择日期' }]}]"
                        @change="onChangeDatePicker"
                        style="width: 100%"
                        :get-popup-container="trigger => trigger.parentNode"></a-date-picker>
                    </a-form-item>
                  </a-col>
                  <a-col :span="6">
                    <a-form-item label="开始时间" :style="{ display: 'inline-block', width: 'calc(50% - 12px)' }">
                      <a-time-picker
                        @change="onChangeTimePicker"
                        v-decorator="['start_time',{rules: [{type:'object',required: true, message: '请选择开始时间' }]}]">
                      </a-time-picker>
                    </a-form-item>
                  </a-col>
                  <a-col :span="6">
                    <a-form-item label="结束时间" :style="{ display: 'inline-block', width: 'calc(50% - 12px)' }">
                      <a-time-picker
                        @change="onChangeTimePicker"
                        v-decorator="['end_time',{rules: [{type:'object',required: true, message: '请选择结束时间' }]}]">
                      </a-time-picker>
                    </a-form-item>
                  </a-col>
                </a-row>
                <a-row :gutter="16">
                  <a-col :span="24">
                    <a-form-item label="活动规则及描述" >
                      <a-textarea
                        v-decorator="['desc']"
                        :rows="4"
                        placeholder="please enter url description"></a-textarea>
                    </a-form-item>
                  </a-col>
                </a-row>
                <a-row :gutter="16">
                  <a-col :span="24">
                    <a-button type="primary" ghost @click="ratingWeight" v-show="editCurrentCampaign.status">调整评分权重</a-button>
                    <a-button :style="{ marginRight: '8px',marginLeft: '8px' }" @click="onClose">取消</a-button>
                    <a-button type="primary" @click="onSubmit">提交</a-button>
                    <a-drawer
                      title="评分人员权重"
                      width="420"
                      :visible="childrenDrawer"
                      @close="childrenDrawer=false"
                    >
                      <a-form :form="rateForm" layout="horizontal">
                        <a-form-item v-for="(item, key) in raters" :key="key" :label="item.name" :label-col="{span:4}" :wrapper-col="{span:14}">
                          <a-input-number
                            v-decorator="[item.name]"
                            :min="0"
                            :max="100"
                            :formatter="value => `${value}%`"
                            :parser="value => value.replace('%', '')"></a-input-number> <a-icon type="minus-circle" style="margin-left:10px;cursor:pointer" @click="removeRater(key)"></a-icon>
                        </a-form-item>
                      </a-form>
                      <a-button type="primary" ghost @click="addRater">增加评分人员</a-button>
                      <a-button type="primary" @click="onChildrenDrawerClose" style="margin-left:10px" :loading="addLoading">
                        确定
                      </a-button>
                    </a-drawer>
                  </a-col>
                </a-row>
              </a-form>
            </a-modal>
          </div>
          <a-modal v-model="addRaterModal" title="请选择新增评委" @ok="addNewRater">
            <a-select v-model="newRater" label="请选择" style="width:100%">
              <a-select-option v-for="(user, ind) in allUsers" :value="ind" :key="user.id">
                {{ user.name }}
              </a-select-option>
            </a-select>
          </a-modal>
        </a-card>
      </div>
    </a-layout-content>
    <a-layout-footer class="layout-footer" :style="{position: 'fixed',bottom: '0'}">
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
import { getCampaigns, getCampaignRaters, getUsers, saveRule, updateCampaign, createCampaign, hideCampaign } from '@/api/api'
import moment from 'moment'
export default {
  name: 'Index',
  data () {
    return {
      form: this.$form.createForm(this),
      rateForm: this.$form.createForm(this),
      visible: false,
      addRaterModal: false,
      childrenDrawer: false,
      loading: true,
      loadingMore: false,
      editCurrentCampaign: {
        status: false,
        UID: null
      },
      addLoading: false,
      raters: [],
      allUsers: [],
      newRater: {},
      campaign: {
        title: '添加新活动',
        date: '',
        start_time: '',
        end_time: '',
        desc: ''
      },
      pagination: {
        pageSize: 10,
        pageNum: 1
      },
      data: [
      ]
    }
  },
  mounted () {
    this.getData()
    this.loading = false
  },
  methods: {
    showDrawer () {
      this.visible = true
    },
    onClose () {
      this.editCurrentCampaign.status = false
      this.visible = false
      this.form.resetFields()
    },
    editCampaign (item) {
      console.log(item)
      this.campaign.title = '编辑' + item.title
      this.editCurrentCampaign.status = true
      this.editCurrentCampaign.UID = item.uuid
      this.visible = true
      const date = item.start_time * 1000
      const end = item.end_time * 1000
      this.$nextTick(() => {
        this.form.setFieldsValue({'title': item.title})
        this.form.setFieldsValue({'desc': item.desc})
        this.form.setFieldsValue({'date': (moment(date))})
        this.form.setFieldsValue({'start_time': (moment(date))})
        this.form.setFieldsValue({'end_time': (moment(end))})
      })
      this.getRaters(item.uuid)
    },
    getData () {
      const _this = this
      const pagination = { pageSize: 10, pageNum: 1 }
      getCampaigns(pagination).then((res) => {
        _this.data = res.data.data
        _this.pagination.pageNum = parseInt(res.data.current_page)
        _this.pagination.pageSize = parseInt(res.data.per_page)
      })
    },
    getRaters (campaignID) {
      getCampaignRaters(campaignID).then((res) => {
        console.log(res)
        this.raters = res.data
      })
    },
    onChangeTimePicker (time, timeString) {
      console.log(timeString)
    },
    onChangeDatePicker (time, timeString) {
      console.log(timeString)
      // this.rateForm.setFieldsValue('date', timeString)
    },
    ratingWeight () {
      this.childrenDrawer = true
    },
    onChildrenDrawerClose () {
      const values = this.rateForm.getFieldsValue()
      console.log(values)
      if (this.validateWeight(values)) {
        // 保存规则
        saveRule(this.editCurrentCampaign.UID, { rule: values }).then((res) => {
          console.log(res)
          this.childrenDrawer = false
          this.addLoading = false
          this.$message.success('更新规则成功')
        })
      }
    },
    validateWeight (values) {
      this.addLoading = true
      const arr = Object.values(values)
      let sum = 0
      for (let i = 0; i < arr.length; i++) {
        if (!arr[i] || arr[i] > 100) {
          this.$notification.warning({ message: '评分权重有误', description: '请确保评分最小权重大于0' })
          this.addLoading = false
          return false
        }
        sum = sum + parseInt(arr[i])
      }
      if (sum > 100) {
        this.$notification.warning({ message: '评分权重有误', description: '请确保权重之和为100%' })
        this.addLoading = false
        return false
      }
      return true
    },
    addRater () {
      console.log('点击新增评委')
      // 请求所有用户
      this.newRater = null
      this.addRaterModal = true
      getUsers().then((res) => {
        this.allUsers = res.data
      })
    },
    removeRater (key) {
      this.raters.splice(key, 1)
    },
    addNewRater () {
      this.raters.push(this.allUsers[this.newRater])
      this.addRaterModal = false
    },
    onSubmit () {
      const _this = this
      this.form.validateFields((errors, fieldsValue) => {
        console.log(errors)
        console.log(fieldsValue)
        if (!errors) {
          const values = Object.assign({}, fieldsValue,
            { 'date': fieldsValue['date'].format('YYYY-MM-DD'),
              'start_time': fieldsValue['start_time'].format('HH:mm:ss'),
              'end_time': fieldsValue['end_time'].format('HH:mm:ss') }
          )
          console.log(values)
          if (this.editCurrentCampaign.UID) {
            _this.updateCampaign(this.editCurrentCampaign.UID, values)
          } else {
            _this.createCampaign(values)
          }
        } else {
          console.log('error')
        }
      })
    },
    createCampaign (data) {
      createCampaign(data).then((res) => {
        console.log(res)
        if (!res.code) {
          this.visible = false
          this.form.resetFields()
          this.$message.success('创建成功')
          this.getData()
        }
      })
    },
    updateCampaign (campaignUID, data) {
      updateCampaign(campaignUID, data).then((res) => {
        console.log(res)
        if (!res.code) {
          this.$message.success('更新成功')
          this.visible = false
          this.getData()
        }
      })
    },
    confirmHide (item) {
      hideCampaign(item.uuid).then(() => {
        this.getData()
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
    bottom: 0;
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
</style>

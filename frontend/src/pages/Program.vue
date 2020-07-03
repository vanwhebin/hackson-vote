<template>
  <a-layout class="layout">
    <a-layout-header class="layout-header p-header">
      <div class="menu">
        <div class="left-menu">
          <div class="logo" @click="$router.push({name: 'home'})"></div>
          <a-menu
            theme="light"
            mode="horizontal"
            :default-selected-keys="['3']"
          >
            <a-menu-item key="1" @click="$router.push({name: 'home'})">
              首页
            </a-menu-item>
            <a-menu-item key="2" @click="$router.push({name: 'campaign'})">
              活动
            </a-menu-item>
            <a-menu-item key="3" @click="$router.push({name: 'program'})">
              项目
            </a-menu-item>
          </a-menu>
        </div>
      </div>

    </a-layout-header>
    <a-layout-content class="content-layout" :style="{'margin-top': '100px','margin-bottom':'50px','min-height':'500px'}">
      <div class="content-box">
        <a-card>
          <a-list
            class="demo-loadmore-list"
            :loading="loading"
            item-layout="horizontal"
            :data-source="data"
          >
            <a-list-item slot="renderItem" slot-scope="item">
              <a-list-item-meta
                :description="item.desc"
              >
                <a slot="title" href="javascript:void(0)">{{ item.title }}</a>
                <a-avatar
                  slot="avatar"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADQAAAA0CAYAAADFeBvrAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAITSURBVGhD7deviwJBFMDx+59EjCIWg2BZmwo2fyQRtNjEJoJRi2g3CYrJJIJWwSBYBIPBaFqY4z3YZVyf3s7srDfIhG9w3lvYD7cn7o9t2+ybMiDdMyDdMyDdMyDdMyDdMyDZjscjKxQKrFgsknNVfQw0Ho9ZJBLBqLmqPgaq1+uIqVQq5FxVSkCNRoOl02m23+/J+f1+Z8lkEkHwl4Kz8/mM18C13v0gBQbBDTmP0na7JXc2m427czgc8OxyubhnKlGBQDxmuVySO9BgMMCdVCr1cA7XqEZJg/xioGq1inutVutppholBRLB3G43Fo1GcXc2m5E7KlHCIBEMtFqt3P3r9UruQKpQQiBRDNTv93E/l8uRcz4VKN8gGQyUz+fxml6vR869BUX5AnW7XSkM/9W8Xq/JHSoe1W63yZ1XhQpaLBZ4TTweJ+evCh0EyTxynU4H92u1Gjmn4jGhPXJOoqhMJoO7k8mEnHsLioGEQJBf1Ol0cvecnzvvUoGBhEGQH9R0OsW5ZVnknE8VBpICQX+hms0mzuD/yDvjU4mBpEHQO1QikcDz+Xz+cM6nGgMFAkE8ynl9gPci+ByLxV7+3NHy9cEJboh/wRuNRnijpVLpaddJ2xc8qnK5jKDhcEjOwywUkPMo7XY7ch5moYCsbFb5o+S3UED/mQHpngHpngHpngHpngHpngHpngHp3peBbPYLOZxI41wXsikAAAAASUVORK5CYII="></a-avatar>
              </a-list-item-meta>
              <div>需求产品：{{ item.product.name }}</div>
            </a-list-item>
          </a-list>
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
import { getStore, setStore } from '../utils/storage'
import config from '@/config'
import { getLatestCampaign, getProgramList } from '@/api/api'
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
  },
  methods: {
    getData () {
      const campaignUID = getStore(config.campaignRef)
      if (campaignUID) {
        this.getPrograms(campaignUID)
      } else {
        getLatestCampaign().then((r) => {
          if (!r.code) {
            setStore(config.campaignRef, r.data.uuid)
            this.getPrograms(r.data.uuid)
          }
        })
      }
    },
    getPrograms (campaignUID) {
      const _this = this
      const pagination = { pageSize: 10, pageNum: 1 }
      getProgramList(campaignUID, pagination).then((res) => {
        _this.data = res.data.programs
        _this.loading = false
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
  .content-box {
    width: 100%
  }
</style>

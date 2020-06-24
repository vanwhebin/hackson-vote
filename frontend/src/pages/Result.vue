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
          </a-menu>
        </div>
      </div>

    </a-layout-header>
    <a-layout-content class="content-layout" style="margin-top: 200px">
      <div class="content-box">
        <e-charts id="bar" ref="bar" :options="orgOptions" :auto-resize="true" style="margin:auto"></e-charts>
        <!--<a-divider></a-divider>-->
        <!--<e-charts id="pie" ref="pie" :options="polar" style="margin:auto"></e-charts>-->
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
import config from '@/config'
import { getStore } from '@/utils/storage'
import { getResultData } from '@/api/api'
import ECharts from 'vue-echarts'
// import 'echarts/lib/chart/pie'
import 'echarts/lib/chart/bar'
import 'echarts/lib/component/tooltip'
import 'echarts/lib/component/title'
export default {
  name: 'Result',
  components: {
    ECharts
  },
  mounted () {
    const campaignUID = getStore(config.campaignRef)
    this.getResult(campaignUID)
  },
  data () {
    return {
      polar: {
        title: {
          text: '得分比重统计',
          // subtext: '动态数据',
          x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
          show: true,
          orient: 'vertical',
          left: 'left',
          data: ['微信访问', '公众号访问', '扫码进入', '分享进入', '搜索访问']
        },
        series: [
          {
            name: '比重',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: [
              {value: 335, name: '微信访问'},
              {value: 310, name: '公众号访问'},
              {value: 234, name: '扫码进入'},
              {value: 135, name: '分享进入'},
              {value: 1548, name: '搜索访问'}
            ],
            itemStyle: {
              emphasis: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
              }
            }
          }
        ]
      },
      orgOptions: {
        color: ['#3398DB'],
        title: {
          text: '结果统计',
          // subtext: '动态数据',
          x: 'center'
        },
        tooltip: {},
        xAxis: {
          data: []
        },
        yAxis: {},
        series: [{
          name: '得分',
          type: 'bar',
          data: []
        }]
      }
    }
  },
  methods: {
    getResult (campaignUID) {
      const _this = this
      getResultData(campaignUID).then((res) => {
        console.log(res)
        res.data.forEach(function (item) {
          _this.xAxis.data.push(item.title)
          _this.series.data.push(item.rating)
        })
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

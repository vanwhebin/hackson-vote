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
            <a-menu-item key="2" @click="$router.push({name: 'campaign'})">
              活动
            </a-menu-item>
            <a-menu-item key="3" @click="$router.push({name: 'program'})">
              项目
            </a-menu-item>
          </a-menu>
        </div>
        <div class="right-menu">
          <button type="button" class="reser-btn ant-btn" @click="start"><span>放码过来</span></button>
        </div>
      </div>

    </a-layout-header>
    <a-layout-content class="content-layout" style="margin-top: 80px">
      <div class="content-box">

        <div class="page-item">
          <div class="content-slides">
            <a-carousel autoplay effect="fade">
              <div
                slot="prevArrow"
                slot-scope="props"
                class="custom-slick-arrow"
                style="left: 10px;z-index: 1"
              >
                <a-icon type="left-circle"></a-icon>
              </div>
              <div slot="nextArrow" slot-scope="props" class="custom-slick-arrow" style="right: 10px">
                <a-icon type="right-circle"></a-icon>
              </div>
              <div class="slide-item-first"><img src="../../static/img/hson.png" alt=""></div>
              <div class="slide-item-two"><img src="../../static/img/show.png" alt=""></div>
            </a-carousel>
          </div>
        </div>
        <a-divider></a-divider>
        <div class="page-item">
          <div class="content-projects" style="padding: 20px;">
            <div class="justify-content-center" :style="{'text-align':'center'}">
              <h1>覆盖当前所有业务场景</h1>
              <p>以业务为驱动，以结果为导向</p>
            </div>
            <a-row :gutter="16">
              <a-col :span="8">
                <a-card :style="{background: 'url(../../static/img/1.jpg)', 'border-radius': '5px', height: '200px'}">
                  <div :style="{background: '#00000069','text-align': 'center', margin:'auto', 'margin-top': '15%'}">
                    <h1 :style="{color:'white',cursor:'pointer'}">供应链</h1>
                  </div>
                </a-card>
              </a-col>
              <a-col :span="8">
                <a-card
                  :style="{background: 'url(../../static/img/2.jpg)', 'border-radius': '5px', height: '200px'}">
                  <div :style="{background: '#00000069','text-align': 'center', margin:'auto', 'margin-top': '15%'}">
                    <h1 :style="{color:'white',cursor:'pointer'}">销售工具</h1>
                  </div>
                </a-card>
              </a-col>
              <a-col :span="8">
                <a-card
                  :style="{background: 'url(../../static/img/3.jpg)', 'border-radius': '5px', height: '200px'}">
                  <div :style="{background: '#00000069','text-align': 'center', margin:'auto', 'margin-top': '15%'}">
                    <h1 :style="{color:'white',cursor:'pointer'}">信息基础设施</h1>
                  </div>
                </a-card>
              </a-col>
            </a-row>
            <a-row :gutter="16" :style="{'margin-top': '20px'}">
              <a-col :span="8">
                <a-card
                  :style="{background: 'url(../../static/img/4.jpg)',  'border-radius': '5px', height: '200px'}">
                  <div :style="{background: '#00000069','text-align': 'center', margin:'auto', 'margin-top': '15%'}">
                    <h1 :style="{color:'white',cursor:'pointer'}">大数据</h1>
                  </div>
                </a-card>
              </a-col>
              <a-col :span="8">
                <a-card
                  :style="{background: 'url(../../static/img/5.jpg)',  'border-radius': '5px', height: '200px'}">
                  <div :style="{background: '#00000069','text-align': 'center', margin:'auto', 'margin-top': '15%'}">
                    <h1 :style="{color:'white',cursor:'pointer'}">决策分析</h1>
                  </div>
                </a-card>
              </a-col>
              <a-col :span="8">
                <a-card
                  :style="{background: 'url(../../static/img/6.jpg)',  'border-radius': '5px', height: '200px'}">
                  <div :style="{background: '#00000069','text-align': 'center', margin:'auto', 'margin-top': '15%'}">
                    <h1 :style="{color:'white',cursor:'pointer'}">财务管理</h1>
                  </div>
                </a-card>
              </a-col>
            </a-row>
          </div>
        </div>
        <a-divider></a-divider>
        <div class="page-item">
          <div class="content-features">
            <div :style="{'text-align': 'center'}">
              <h1>产品矩阵</h1>
              <p>通过组合，打造出最适合自身团队的实践方案，让效率倍速提升</p>
            </div>
            <div class="features-box">
              <div class="left-feature" >
                <a-card :border="false" :style="{border:'none'}" style="padding-top: 24px">
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="database" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>佰亿</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="cloud-server" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>OPS</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="chrome" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>浏览器</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="area-chart" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>北极星</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="dropbox" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>物流</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="codepen" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>猿人</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="bank" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>仓储</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="transaction" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>业财</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="line-chart" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>DWS</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="dot-chart" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>PPC</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="facebook" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>测评</p>
                  </a-card-grid>
                  <a-card-grid style="text-align:center;margin:5px" class="feature-item">
                    <a-icon type="compass" :style="{'font-size': '24px', 'margin-bottom': '10px'}"></a-icon>
                    <p>西邮</p>
                  </a-card-grid>
                </a-card>
              </div>
              <div class="right-feature">
                <a-row :gutter="16">
                  <a-col :span="12">
                    <a-card :style="{border:'none'}">
                      <h2>佰亿</h2>
                      <p>为刀百辟，唯心不易</p>
                    </a-card>
                  </a-col>
                  <a-col :span="12">
                    <a-card :style="{border:'none'}">
                      <h2>OPS</h2>
                      <p>一切在云中相遇</p>
                    </a-card>
                  </a-col>
                </a-row>

                <a-row :gutter="16">
                  <a-col :span="12">
                    <a-card :style="{border:'none'}">
                      <h2>浏览器</h2>
                      <p>让亚马逊后台更容易</p>
                    </a-card>
                  </a-col>
                  <a-col :span="12">
                    <a-card :style="{border:'none'}">
                      <h2>北极星</h2>
                      <p>找到北，不迷茫</p>
                    </a-card>
                  </a-col>
                </a-row>

                <a-row :gutter="16">
                  <a-col :span="12">
                    <a-card :style="{border:'none'}">
                      <h2>DWS</h2>
                      <p>数据有价值</p>
                    </a-card>
                  </a-col>
                  <a-col :span="12">
                    <a-card :style="{border:'none'}">
                      <h2>测评</h2>
                      <p>你买单，我付钱</p>
                    </a-card>
                  </a-col>
                </a-row>

              </div>
            </div>
          </div>
        </div>
        <a-divider></a-divider>
        <div class="page-item">
          <div class="content-cooperation">
            <div>
              <h1>视野更大，成长更多</h1>
              <p>奇思妙想，分享创造，合作共赢</p>
            </div>
            <img src="../../static/img/cooperation.jpg" alt="">
          </div>
        </div>
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
  name: 'home',
  data () {
    return {}
  },
  methods: {
    onChange (val) {
      console.log(val)
    },
    start () {
      this.$router.push(
        {name: 'start'}
      )
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

  /*--------feature---------*/
  .content-features .features-box{
    display: flex;
  }

  .content-features .left-feature{
    width: 480px;
  }

  .content-features .right-feature{
    width: 480px;
    margin-left: 100px;
  }

  .left-feature .feature-item{
    width: 100px;
    height: 100px;
    cursor: pointer;
    margin-bottom: 16px;
    text-align: center;
    box-shadow: 0 4px 16px rgba(193,205,241,.42);
  }

  .left-feature .feature-item:hover{
    background: #1890ff;
  }

  .right-feature .ant-card-body{
    padding-top:0 !important;
  }
  /*--------!feature---------*/
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

  .content-cooperation {
    text-align: center;
  }

  .ant-carousel >>> .slick-slide {
    text-align: center;
    height: 100%;
    border-radius: 5px;
    line-height: 160px;
    background: #fbfbff;
    overflow: hidden;
  }

  .ant-carousel >>> .slick-slide h3 {
    color: #fff;
  }
  .ant-menu-horizontal {
    line-height: 52px !important;
  }
</style>

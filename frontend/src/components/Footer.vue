<template>
  <a-layout-footer class="layout-footer">
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
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style scoped>
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
</style>

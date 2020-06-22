<template>
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
        <button type="button" class="reser-btn ant-btn"><span>放码过来</span></button>
      </div>
    </div>

  </a-layout-header>
</template>

<script>
  export default {
    name: "Header"
  }
</script>

<style scoped>
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
</style>

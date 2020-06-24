<template>
    <div class="exception">
        <div class="imgBlock">
            <img :src="img" alt="" :style="{margin:'auto', 'max-width': '200px','margin-bottom': '20px'}"/>
        </div>
        <div class="content">
            <h1>{{ title }}</h1>
            <div class="desc">{{ desc }}</div>
            <div class="action notice text-yellow">
                <a @click="handleToHome">返回首页</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "404",
        data () {
            return {
                img: 'https://gw.alipayobjects.com/zos/rmsportal/KpnpchXsobRgLElEozzI.svg',
                title: '404',
                desc: '抱歉，你访问的页面不存在'
            }
        },
        methods: {
            handleToHome () {
                this.$router.push({ name: 'home' })
            }
        }
    }
</script>

<style scoped>
    .exception {
        font-size: 0.575rem;
        margin-top: .55rem;
        color: white;
    }
    .action{
        margin-top: .85rem;
        font-size: 0.375rem;
    }
</style>

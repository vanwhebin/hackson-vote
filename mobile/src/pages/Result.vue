<template>
    <div >
        <div class="submit flex flex-direction align-center justify-center" v-if="submit">
            <div class="img-warp">
                <img src="../assets/images/loading-result.gif" alt=""/>
            </div>
            <div class="text text-yellow">
                提交成功
            </div>
            <a href="javascript:void(0)" class="link text-yellow" @click="submit=false">查看排行</a>
        </div>

        <div class="tops" v-else>
            <div class="topbox" v-if="tops.length > 0">
                <div class="topbox-title flex justify-center align-center">
                    <img src="../assets/images/top/ordering@2x.png"/>
                </div>
                <div class="toplist">
                    <div class="thead text-yellow flex justify-between align-cente">
                        <div class="h1 w1">名次</div>
                        <div class="h1 w2 flex-sub">项目名称</div>
                        <div class="h1 w3">分值</div>
                    </div>
                    <div class="tbody ">
                        <div v-for="(item, index) in tops" :key="index"
                             class="toplist-item flex justify-between align-center">
                            <div class="w1">{{index+1}}</div>
                            <div class="w2 flex-sub">{{item.title |cut}}</div>
                            <div class="w3">{{item.rating}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="statistics flex flex-direction align-center justify-center" v-else>
                <div class="img-warp">
                    <img src="../assets/images/loading-result.gif"  alt=""/>
                </div>
                <div class="text text-yellow">
                    正在计算最后结果，请稍后...
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="link text-yellow" @click="backToList">返回</a>
    </div>

</template>

<script>
import { getRanking } from '@/api/api'
import { getStore } from '@/utils/storage'
import config  from '@/config'
export default {
    name: 'Result',
    data () {
        return {
            submit: false,
            tops: []
        }
    },
    mounted () {
        console.log(this.$router.history.current.query.source)
        const route = this.$router.history.current
        if (route.query.source && route.query.source === 'submit') {
            this.submit = true
        }
        this.checkTop()
    },
    filters: {
      cut (val) {
          if (val.length > 10) {
              return val.substring(0, 10) + '...'
          } else {
              return val
          }
      }
    },
    methods: {
        checkTop () {
            const campaignUID = getStore(config.campaignRef)
            const _this = this
            getRanking(campaignUID).then((res) => {
                console.log(res)
                _this.tops = res.data
            })
        },
        backToList () {
            this.$router.push({name: 'programs'})
        }
    }
}
</script>

<style scoped>
    .submit {
        height: 100vh;
        padding-bottom: 20vh;
    }

    .img-warp {
        width: 2.4rem;
        height: 2.4rem;
        margin-bottom: 0.853rem;
    }

    .text {
        font-size: 0.5333rem;
    }

    .link {
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        bottom: 2.1333rem;
        font-size: 0.3733rem;
    }

    .tops {
        padding: 0.64rem;
        color: #fff;
    }

    .topbox {
        width: 8.8rem;
        height: 15.04rem;
        margin: auto;
        background: url(../assets/images/top/orderingbox@2x.png) no-repeat;
        background-size: contain;
        background-position: left bottom;
    }

    .topbox-title {
        width: 4.56rem;
        height: 1.413rem;
        margin: auto;
    }

    .topbox-title img {
        width: 100%;
        height: auto;
    }

    .toplist {
        padding: 0.74rem 0.32rem;
    }

    .toplist-item,
    .thead {
        padding: 0.42rem 0;
        font-size: 0.42666rem;
        font-weight: 700;
    }

    .toplist .w1 {
        width: 2rem;
        flex: 0 0 2rem;
        text-align: center;
    }

    .toplist .w2 {
        text-align: left;
    }

    .toplist .w3 {
        width: 2rem;
        flex: 0 0 2rem;
        text-align: center;
    }

    .toplist .tbody .w1,
    .toplist .tbody .w3 {
        font-size: 0.42666rem;
    }

    .toplist .tbody .w2 {
        font-size: .3733rem;
    }
    .statistics{
        height: 100vh;
        padding-bottom: 10vh;
    }
    .img-warp{
        width: 4.4rem;
        height: 4.4rem;
        margin-bottom: 0.64rem;
    }
    .text{
        font-size: 0.4266rem;
    }
</style>

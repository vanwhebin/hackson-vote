<template>
    <div class="home bg">
        <div class="box-bg1"></div>
        <div class="box-bg2"></div>
        <div class="event-info">
            <div class="flex justify-center align-center">
                <span class="icon-circle"></span>
                <span class="event-title">搞事时间</span>
                <span class="icon-circle"></span>
            </div>
            <div class="event-time">
                {{ formatTime }}
            </div>
        </div>
        <div class="btn-wrap flex justify-center">
            <div class="btn btn-yellow" @click="startGame"></div>
        </div>

        <div class="toast flex align-center" v-show="!start.status">
			<span class="icon">
				<img src="../assets/images/home/tip@2x.png" alt=""/>
			</span>
            <span class="text">活动还没有开始</span>
        </div>
    </div>
</template>

<script>
import { getCampaignInfo } from '@/api/api'
import config from '@/config'
import { setStore, getStore } from '@/utils/storage'
import { timeStampFormat } from '@/utils/util'

export default {
    name: 'index',
    data () {
        return {
            formatTime: '',
            start: {
                time: null,
                status: false
            }
        }
    },
    created () {
        let ref = window.location.search.substring(1)
        // const
        if (ref) {
            ref = ref.split('=')
            if (ref[0] === 'h') {
                this.getCampaign(ref[1])
                setStore(config.campaignRef, ref[1])
            }
        }
    },
    mounted () {
        this.checkTime()
    },
    methods: {
        startGame (e) {
            if (!this.start) {
                return false
            } else {
                if (!getStore(config.token)) {
                    this.$router.push({name: 'login'})
                    return false
                } else {
                    this.$router.push({name: 'programs'})
                }
            }
        },
        getCampaign (campaignUID) {
            const _this = this
            getCampaignInfo(campaignUID).then((res) => {
                console.log(res)
                _this.start.time = res.data.start_time
                _this.checkTime()
                _this.formatTimeStamp(res.data.start_time, res.data.end_time)
            })
        },
        formatTimeStamp (startTime, endTime) {
            this.formatTime = timeStampFormat(startTime).substring(0, 14) + ' ' + timeStampFormat(endTime, 'time').substring(0,5)
        },
        checkTime () {
            const ts = parseInt((new Date()).getTime() / 1000)
            if (this.start.time) {
                this.start.status = ts >= this.start.time
            }
        }
    }
}
</script>

<style scoped="scoped">
    .home {
        padding-top: 1rem;
        background-image: url(../assets/images/home/background@3x.png);
    }

    .box-bg1 {
        width: 7.866666rem;
        height: 0.7rem;
        margin: auto;
        background-image: url(../assets/images/home/arrow@2x.png);
        background-size: cover;
        background-repeat: no-repeat;
    }

    .box-bg2 {
        width: 8.1067rem;
        height: 5.44rem;
        margin: 1.8667rem auto 0;
        background-image: url(../assets/images/home/box@2x.png);
        background-size: cover;
        background-repeat: no-repeat;
    }

    .event-info {
        margin: 0.6rem 0 0.32rem;
        color: #fff;
        letter-spacing: 3px;
    }

    .event-title {
        padding-left: 3px;
        margin: 0 0.16rem;
        font-size: 0.3733rem;
    }

    .event-time {
        padding-left: 3px;
        margin-top: 0.4rem;
        font-size: 0.3466rem;
    }

    .icon-circle {
        background: url(../assets/images/home/round8-copy@2x.png) no-repeat;
        background-size: cover;
        width: 0.16rem;
        height: 0.16rem;
    }

    .btn-wrap {
        margin-top: 1.68rem;
    }

    .btn-wrap .btn {
        width: 5.3333rem;
        height: 1.7333rem;
        border: none;
        background: url(../assets/images/home/start-btn@2x.png) no-repeat;
        background-size: cover;
    }

    .btn-wrap .btn.disabled {
        background-image: url(../assets/images/home/start-game-noclick@2x.png);
    }

    .toast {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        z-index: 999;
        margin: auto;
        background: #fff;
        width: 5.5rem;
        height: 1.946rem;
        font-size: 0.48rem;
        font-weight: bold;
    }

    .toast .icon {
        width: 0.853rem;
        height: 0.853rem;
        margin: 0 0.4rem;
    }

    .toast .icon img {
        width: 100%;
        height: 100%;
    }

    .toast .text {
        font-size: .42rem;
    }

</style>

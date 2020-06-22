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
                2020-6-13 14:00-16:30
            </div>
        </div>
        <div class="btn-wrap flex justify-center">
            <div class="btn btn-yellow" @click="startGame"></div>
        </div>

        <div class="toast flex align-center">
			<span class="icon">
				<img src="../assets/images/home/tip@2x.png" alt=""/>
			</span>
            <span class="text">活动还没有开始</span>
        </div>
    </div>
</template>

<script>
import config from '@/config'
import { setStore, getStore } from '@/utils/storage'

export default {
    name: 'index',
    data () {
        return {}
    },
    created () {
        const accessToken = window.location.search.substring(1)
        const ref = accessToken.split('=')
        if (accessToken && ref && ref[1]) {
            if (ref[0] === 'h') {
                setStore(config.campaignRef, ref[1])
            } else if (ref[0] === 'access_token') {
                setStore(config.token, ref[1])
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
        checkTime () {
            const ts = parseInt((new Date()).getTime() / 1000)
            this.start = ts >= 1592028000
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

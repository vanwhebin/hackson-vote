<template>
    <div>
        <Loading v-if="loading"></Loading>
        <div v-else>
            <div class="pro-list" :style="{'padding-bottom': '20px'}" v-if="!showDetail">
                <h4 class="h flex align-center justify-center">
                    <span class="icon left"></span>
                    <span class="text-title text-yellow">项目名称</span>
                    <span class="icon right"></span>
                </h4>
                <div class="card-list">
                    <div class="card-item flex" v-for="(item, index) in programs" :key="index">
                        <div class="content flex flex-direction align-center justify-center">
                            <span class="bage">{{index + 1}}</span>
                            <div class="title text-trunct">
                                {{item.title | cut}}
                            </div>
                            <div class="auth">提出人: {{item.product.name}}</div>
                        </div>
                        <div class="actions flex justify-center align-center" v-if="!item.self_rating">
                            <span class=" text-yellow vertical-lr'" @click="commit(item)">评分</span>
                        </div>
                        <div :class="'actions flex flex-direction justify-center align-center' + (item.rating_status===1 ? '':'text-yellow')"
                             v-else>
                            <span class="score-num"><span style="font-size: 0.7466rem">{{item.self_rating}}&nbsp;</span>分</span>
                            <span class="splite"></span>
                            <span class="update" @click="commit(item)">修改</span>
                        </div>
                    </div>
                </div>
                <button class="btn bg-yellow block" @click="submit" v-if="!submitted"></button>
                <button class="check bg-yellow block" @click="$router.push({name: 'result'})" v-else></button>
            </div>
            <score v-else
                   @showDetail="toggleShowDetail"
                   @selectScore="selectScore"
                   :selected="selected"
                   :sum="programs.length"
                   :current="currentIndex">
            </score>
            <div class="toast flex align-center" v-show="toast.status">
                <span class="icon">
                    <img :src="toast.img" alt=""/>
                </span>
                <span class="text">{{toast.text}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { getProgramList, postCampaignVote, getCampaignInfo } from '@/api/api'
    import Score from '@/components/Score'
    import config from '@/config'
    import { getStore, setStore } from '@/utils/storage'
    import Loading from '@/components/Loading'

    export default {
        name: 'list',
        components: {
            Score,
            Loading
        },
        data () {
            return {
                loading: true,
                programs: [],
                submitted: false,
                showDetail: false,
                selected: {},
                currentIndex: 1,
                toast: {
                    img: '',
                    status: false,
                    text: '',
                    success: {
                        img: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKgAAACoCAYAAAB0S6W0AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkQ2QTRFOUVEQUM4MjExRUFBNjYzRUYyMUZDODhFMTRFIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkQ2QTRFOUVFQUM4MjExRUFBNjYzRUYyMUZDODhFMTRFIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RDZBNEU5RUJBQzgyMTFFQUE2NjNFRjIxRkM4OEUxNEUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RDZBNEU5RUNBQzgyMTFFQUE2NjNFRjIxRkM4OEUxNEUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7lDY7XAAAWAklEQVR42uxd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',
                        text: '提交成功',
                    },
                    fail: {
                        img: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjc2NEM0QUM5QUM4NzExRUE5QTUxOThDMDlEOTcyM0MzIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjc2NEM0QUNBQUM4NzExRUE5QTUxOThDMDlEOTcyM0MzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NzY0QzRBQzdBQzg3MTFFQTlBNTE5OEMwOUQ5NzIzQzMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NzY0QzRBQzhBQzg3MTFFQTlBNTE5OEMwOUQ5NzIzQzMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7N6kNaAAAEq0lEQVR42uRbWWwNURj+Z3pdtdzWUlu0qVBLSRqpBFUSDypdHnjAQxNrpEUsL5YH4YFELPWg8VIaa/SBBxFUiUiKhoSKNrS0SGpJSIVShC73+v87/3BbvUtn7pnOOF/yJZM5c+/5/2/OnPP/Z1EGeTJAMMYiqZJU5BTkJORoZDzSw8+0Ir8g3yMbkM+Q9ch7yHcijVMECTADmY/MZafNgMQoR5Yhq+0sAL3NQuRq5FRBL6wOeRJZwq3GFgIMQW5BbkYOA2vwCVmMPIJsMfNHMe7+SYbFQ65CXuamPgCsA9U1H7kW2YysMfpHqsHfpSDvcHNMgL5DAttAtkywSoCl3Bllgn1Atjxi24QJQE2+CHkeGQf2QxzbVsS2RrUPcCPPcC9vd8xBTkReQXZGowWQ85d4XHcK8tlmt1kBqCmdQGaD85DNtitmPoH9yPXgXKTxkHnTiABLONBwOjI5gqzrzScwHlkK/w+Os08RCUDfzGnO1v4XxLNPSiQCrETOFWnNzHQVLpW54UNDrJ90TfcEYy6H7iGToSGcj48QZUXeQhXKSt0QE9P1fieO2Plr2+DqDa9IEZp5PqIlWAvYItJ5wt6d/f5x3t8bx2hlgjGCfeyxBQxGNolOaVvfxoISZGT2+QA8iT+tSKXH6fMJgS1gnRX5vKIYK4sihgWG9GpAz18A8qBQHxF0ATI4gZAFKezzHwGWgnxYFihAtoQCZOsCJIL5qWsnYjIyiQSYDfIigwSYLrEAaSRAqsQCpJIAyRILkEwCjJFYgAQSwCOxAIMtF4ASHiNlguBRra6x8aXPUJkoqBClZeZIsXtfu3/yozvoHpVZjFbLBbhy3QtZi9vg1m0vfP8BftI13aMyi/GNJkQegrajQ0ZUUwtokngUaCIB6iUWoJ4EqJVYgFoS4J7EAtwnAd4gn0voPK1/vNYDoQoJBbimB0KEC1bWnJulQvmFv0tjdJ2zwPKg1O+zvjCicJNIER4J7nDB9s2uHssOFnfAngMdVjj/ArQlMp8uOwXhJaJrpbcczHkClVHrsAAl7HOXlSG6+VlkrZsKXWGf2VjgEu3858CXHSgA5QRCd4Skp6lRecYkigPzn+61kQDNfdk1C14fbGYBIJgAtG6+Q1Ttj2rDZ3vVNUIzQvLtUygBCKeQVSJqP3qsIyrPGEQV+9YFwXaJVYK2VSY2mhY0vvKBqx9A5iw16DBYeqZThPN0GiWn+9sPJQD1lC9BwKJpZZUXap54YdRIBRKGK9DejgH5Ay9s29UuynnCCuTdHvucMAcmDiK3OTzkLQrlQ7idojc5OkxzqPPnkBtCPRBu0KVoaY1Dk6UKtt1nRgBCG3IRaKe2nIIytrkt3IORnheg3ukiaDvJ5tjc+cOgbfCOqEftTdxJTWkraFtLvtrQ8a9s29Zwzd6oAIF59AxRwZKJICfdyLyG0cyD8ul53Ml87EPHP7IN8zhu6TXMnBskPAZtK/ov+Hs4wQpQRHcItKMx900lXwKOztIbEbXrhNYwToDNjs72BOojliPzwPw0G31uV5FnweaHp4NBPz4/DbStafrx+aHIgUhaEv7G+QeR5iZpmv4pWHB8/rcAAwABeg8xXwA/2wAAAABJRU5ErkJggg==',
                        text: '请完成所有评分'
                    }
                }
            }
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
            pop (success, text = '') {
                const _this = this
                if (!success) {
                    _this.toast.img = _this.toast.fail.img
                    _this.toast.text = text ? text : _this.toast.fail.text
                } else {
                    _this.toast.img = _this.toast.success.img
                    _this.toast.text = text ? text : _this.toast.success.text
                }
                _this.toast.status = true
                setTimeout(function () {
                    _this.toast.status = false
                }, 1500)
            },
            submit () {
                const _this = this
                const campaignUID = getStore(config.campaignRef)
                for (let i = 0; i < this.programs.length; i++) {
                    if (!this.programs[i].self_rating) {
                        _this.pop(false)
                        return false
                    }
                }
                postCampaignVote(campaignUID).then((res) => {
                    if (!res.code) {
                        _this.pop(true)
                        _this.submitted = true
                        _this.$router.push({ name: 'result', query: { source: 'submit' } })
                    } else {
                        _this.pop(false)
                        _this.init()
                    }
                })
            },
            init () {
                const _this = this
                const campaignUID = getStore(config.campaignRef)
                if (campaignUID) {
                    this.getProgramList(campaignUID)
                } else {
                    getCampaignInfo().then((res) => {
                        console.log(res)
                        setStore(config.campaignRef, res.data.uuid)
                        _this.getProgramList(res.data.uuid)
                    })
                }
            },
            getProgramList (campaignUID) {
                getProgramList(campaignUID).then((res) => {
                    this.submitted = Boolean(res.data.status)
                    this.programs = res.data.programs
                    this.loading = false
                })
            },
            commit (item) {
                if (item.rating_status) {
                    this.pop(false, '无法修改')
                    return false
                }
                this.showDetail = true
                this.selected = Object.assign({}, this.selected, item)
                this.currentIndex = this.programs.indexOf(item) + 1
            },
            toggleShowDetail (val) {
                this.showDetail = val
                this.init()
            },
            selectScore (val) {
                console.log(this.selected)
                this.selected.self_rating = val
                this.selected = Object.assign({test: (new Date()).getTime()}, this.selected)
            }
        },
        mounted () {
            this.init()
        }
    }
</script>

<style>

    img {
        width: 100%;
        height: 100%;
    }

    .pro-list {
        padding: 0 0.64rem 0.64rem;
    }

    .pro-list .h {
        padding: 0.8533rem 0;
        /*font-size: 500;*/
    }

    .pro-list .h .icon {
        width: 1.6rem;
        height: 0.4267rem;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .pro-list .h .icon.left {
        margin-right: 0.4266rem;
        background-image: url(../assets/images/list/left@2x.png);
    }

    .pro-list .h .icon.right {
        margin-left: 0.4266rem;
        background-image: url(../assets/images/list/right@2x.png);
    }

    .card-item {
        position: relative;
        margin-bottom: 0.513rem;
        height: 3.8rem;
        border-radius: 6px;
        border: 2px solid #fff;
        color: #fff;
        overflow: hidden;
    }

    .card-item .bage {
        position: absolute;
        left: 0;
        top: 0;
        width: 0.933rem;
        height: 0.8rem;
        font-size: 0.64rem;
        font-weight: 700;
        letter-spacing: 2px;
        color: #111;
        background: url(../assets/images/list/label@2x.png) no-repeat;
        background-size: contain;
    }

    .card-item .title {
        margin-bottom: 0.46rem;
        font-size: 0.5867rem;
    }

    .card-item .content {
        flex: 1;
        border-right: 2px solid #fff;
    }

    .card-item .content .auth {
        font-size: 0.32rem;
    }

    .card-item .actions {
        width: 2.133rem;
        flex: 0 0 2.133rem;
        font-size: 0.4266rem;
    }

    .card-item .actions .splite {
        height: 1px;
        width: 1.85rem;
        margin: 0.32rem 0;
        background: #666;
    }

    .pro-list .btn {
        height: 1.74666rem;
        width: 100%;
        display: block;
        border: none;
        background: url(../assets/images/list/submit@2x.png);
        background-size: contain;
        background-repeat: no-repeat;
    }

    .pro-list .check {
        height: 1.74666rem;
        width: 100%;
        display: block;
        border: none;
        background: url(../assets/images/list/check@2x.png);
        background-size: contain;
        background-repeat: no-repeat;
    }

    .vertical-lr {
        white-mode: vertical-lr;
        flex: 0 0 0.1rem;
    }

    .block {
        width: 100%;
        display: block;
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
        color: black;
        padding-left: 10%;
    }
</style>

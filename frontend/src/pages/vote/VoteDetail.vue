<template>
    <div>
      <x-header
        slot="header"
        style="width:100%;position:absolute;left:0;top:0;z-index:100;"
        :title="title"
      >
      </x-header>
      <transition>
        <box gap="45px 10px 0 10px">
          <group>
            <x-input title="组长:" value="王超"></x-input>
            <x-input title="题目:" value="原力ERP请购单逻辑控制"></x-input>
            <x-textarea   value="交货计划逻辑调整：相同sku情况下，要求第一个请购单须全部生成交货计划，然后第二个请购单才能生成交货计划，根据请购单生效时间先后顺序进行控制" ></x-textarea>
          </group>
          <divider>请打分</divider>
          <div>
            <tab :line-width=2 active-color='#ffb431' v-model="index">
              <tab-item class="vux-center" :selected="demo2 === item" v-for="(item, index) in list2" @click="demo2 = item" :key="index">{{item}}</tab-item>
            </tab>
            <swiper v-model="index" height="100px" :show-dots="false">
              <swiper-item v-for="(item, index) in list2" :key="index">
                {{item}}
                <rater v-model="rating" active-color="#ffb431" :max="10" :style="{'text-align': 'center !important',display: 'block','margin-top': '50px'}"></rater>
              </swiper-item>
            </swiper>
          </div>
          <x-button type="primary" :style="{'margin-top': '80px'}">提交</x-button>
        </box>
      </transition>
    </div>
</template>

<script>
import { Cell, XButton, Group, Box, XHeader, XInput, Rater, Divider, XTextarea, Tab, TabItem, Swiper, SwiperItem } from 'vux'
export default {
  name: 'VoteDetail',
  components: {
    Tab,
    TabItem,
    SwiperItem,
    Swiper,
    XTextarea,
    Divider,
    Rater,
    XInput,
    XHeader,
    Box,
    XButton,
    Group,
    Cell
  },
  data () {
    return {
      title: '2020-06-13项目列表',
      rating: 6,
      list2: ['技术', '业务', '审美'],
      demo2: '技术',
      index: 0
    }
  }
}
</script>

<style scoped>

</style>

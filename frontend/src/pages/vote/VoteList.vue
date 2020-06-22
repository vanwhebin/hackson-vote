<template>
  <div>
    <x-header
      slot="header"
      style="width:100%;position:absolute;left:0;top:0;z-index:100;"
      :title="title"
    >
    </x-header>

    <box gap="45px 10px 0 10px" >
      <group>
        <cell v-for="(item, i) in list" :key="i" :title="item.title" :value="item.people" is-link @click.native="rate(item.id)"></cell>
      </group>
      <x-button type="primary">提交</x-button>
    </box>

  </div>
</template>

<script>
import { Group, Cell, XButton, Box, XHeader } from 'vux'
// import { mapState } from 'vuex'
export default {
  name: 'VoteList',
  components: {
    XHeader,
    Box,
    XButton,
    Group,
    Cell
  },
  data () {
    return {
      title: '2020-06-13项目列表',
      list: [
        {
          id: 1,
          people: '邱宇翔',
          title: '审批流程配置工具'
        },
        {
          id: 2,
          people: '郭佳',
          title: 'OCR技术的实操运用'
        },
        {
          id: 3,
          people: '王超',
          title: 'Hackathon打分器'
        },
        {
          id: 4,
          people: '邵长城',
          title: '品牌采购单金额汇总表数据问题'
        },
        {
          id: 5,
          people: '曹延辉',
          title: '项目管理工具'
        },
        {
          id: 6,
          people: '文扬艺',
          title: '中央库存报表sql优化'
        },
        {
          id: 7,
          people: '邱宇翔',
          title: '费用报销-线下广告费'
        },
        {
          id: 8,
          people: '夏灿华',
          title: '【物流追踪、渠道时效统计、物流轨迹的生成、组合】'
        }

      ]
    }
  },
  methods: {
    rate (val) {
      this.$router.push({name: 'vote-program', params: { id: val }})
      console.log(val)
    }
  }
}
</script>

<style scoped>

</style>

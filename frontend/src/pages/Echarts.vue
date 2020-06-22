<template>
  <div>
    <e-charts ref="pie" :options="polar"></e-charts>
    <e-charts ref="bar" :options="orgOptions" :auto-resize="true"></e-charts>
  </div>
</template>

<script>
import ECharts from 'vue-echarts'
import 'echarts/lib/chart/pie'
import 'echarts/lib/chart/bar'
import 'echarts/lib/component/tooltip'
import 'echarts/lib/component/title'
export default {
  name: 'Echarts',
  components: {
    ECharts
  },
  data () {
    return {
      polar: {
        title: {
          text: '会员数据统计',
          subtext: '动态数据',
          x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
          show: true,
          orient: 'vertical',
          left: 'left',
          data: ['微信访问', '公众号访问', '扫码进入', '分享进入', '搜索访问']
        },
        series: [
          {
            name: '访问来源',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: [
              {value: 335, name: '微信访问'},
              {value: 310, name: '公众号访问'},
              {value: 234, name: '扫码进入'},
              {value: 135, name: '分享进入'},
              {value: 1548, name: '搜索访问'}
            ],
            itemStyle: {
              emphasis: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
              }
            }
          }
        ]
      },
      orgOptions: {
        title: {
          text: 'ECharts 入门示例',
          subtext: '动态数据',
          x: 'center'
        },
        tooltip: {},
        xAxis: {
          data: ['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子']
        },
        yAxis: {},
        series: [{
          name: '销量',
          type: 'bar',
          data: [5, 20, 36, 10, 10, 20]
        }]
      }
    }
  }

}
</script>

<style scoped>

</style>

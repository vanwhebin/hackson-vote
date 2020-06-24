<template>
	<div class="tops">
		<div class="topbox">
			<div class="topbox-title flex justify-center align-center">
				<img src="../assets/images/top/ordering@2x.png" />
			</div>
			<div class="toplist">
				<div class="thead text-yellow flex justify-between align-cente">
					<div class="h1 w1">名次</div>
					<div class="h1 w2 flex-sub">项目名称</div>
					<div class="h1 w3">分值</div>
				</div>
				<div class="tbody ">
					<div v-for="(item, index) in tops" :key="index" class="toplist-item flex justify-between align-center">
						<div class="w1">{{index+1}}</div>
						<div class="w2 flex-sub">{{item.title}}</div>
						<div class="w3">{{item.score}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'top',
		data(){
			return {
				tops: [
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10},
					{title: '测试测试', score: 10}
				]			
			}
		}
	}
</script>

<style>
.tops{
	padding: 0.64rem;
	color:#fff;
}
.topbox{
	width: 8.8rem;
	height: 15.04rem;
	margin: auto;
	background: url(../assets/images/top/orderingbox@2x.png) no-repeat;
	background-size: contain;
	background-position: left bottom;
}
.topbox-title{
	width: 4.56rem;
	height: 1.413rem;
	margin: auto;
}
.topbox-title img{
 width: 100%;
 height: auto;
}
.toplist{
	padding:0.74rem 0.32rem;
}
.toplist-item,
.thead{
	padding: 0.42rem 0;
	font-size: 0.42666rem;
	font-weight: 700;
}
.toplist .w1{
	width: 2rem;
	flex: 0 0 2rem;
	text-align: center;
}
.toplist .w2{
	text-align: left;
}
.toplist .w3{
	width: 2rem;
	flex: 0 0 2rem;
	text-align: center;
}
.toplist .tbody .w1,
.toplist .tbody .w3{
	font-size: 0.42666rem;
}
.toplist .tbody .w2{
	font-size: .3733rem;
}
</style>

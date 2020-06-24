<template>
	<div class="score">
		<div class="top-num flex align-center justify-center">
			<span class="text-red">12</span> 
			<span style="font-size: 0.48rem; margin: 0 0.08rem"> / </span> 
			<span style="font-size: 0.32rem; padding-top: .1rem;">12</span>
		</div>
		<div class="h text-white">
			<div class="title">Hankathon打分器</div>
			<div class="auth">提出人: 王超</div>
		</div>
		<div class="h4">
			请选择相应的分数:
		</div>
		<div class="flex grid-num flex-wrap">
			<span class="" :class="['grid-num-item num num'+num, score == num ? 'active': '']" v-for="num in 10" :key="num" @click="evaluate(num)">
				
			</span>
		</div>
		<div class="btns flex align-center justify-center">
			<div class="btn btn-back">
				<img src="../assets/images/score/back@2x.png" />
			</div>
			<div class="btn btn-save">
				<img src="../assets/images/score/save@2x.png" />
			</div>
		</div>
		<div class="notice text-yellow">
			注: 评分后可修改
		</div>
	</div>
</template>

<script>
	export default {
		name: 'score',
		data(){
			return { 
				score: 1
			}
		},
		methods: {
			evaluate(item){
				this.score = item
			}
		}
	}
</script>

<style scoped>
.score{
	padding: 0 0.084;
	color: #fff;
}
.top-num{
	width: 1.8933rem;
	height: 0.7466rem;
	margin: 0 auto 0.8rem;
	font-size: 0.32rem;
	color: #222;
	background: yellow;
}

.h .title{
	font-size: 0.625rem;
	margin-bottom: 0.533rem;
}
.h .auth{
	font-size: 0.32rem;
	margin-bottom: 0.533rem;
}
.h4{
	padding: 0 0.64rem;
	text-align: left;
	margin-bottom: 0.64rem;
	font-size: 0.48rem;
}
.top-num .text-red{
	font-size: 0.4266rem;
	color: rgb(251,92, 122);
}
.grid-num{
	margin-bottom: 0.65rem;
}
.grid-num-item {
	width: 1.6533rem;
	height: 1.6533rem;
	border-radius: 4px;
	flex: 0 0 1.6533rem;
	border: 3px solid #fff;
	margin-left: 0.64rem;
	margin-bottom: 0.64rem;
	background-position: center;
	background-repeat: no-repeat;
	background-size: 50% 50%;
}
.grid-num-item.active{
	background-color: rgb(255,255,0);
	border-color: rgb(255,255,0);
}
.num1{
	background-image: url(../assets/images/score/1@2x.png);
}
.num1.active{
	background-image: url(../assets/images/score/1-@2x.png);
}
.num1{
	background-image: url(../assets/images/score/1@2x.png);
}
.num2{
	background-image: url(../assets/images/score/2@2x.png);
}
.num2.active{
	background-image: url(../assets/images/score/2-@2x.png);
}
.num3{
	background-image: url(../assets/images/score/3@2x.png);
}
.num3.active{
	background-image: url(../assets/images/score/3-@2x.png);
}
.num4{
	background-image: url(../assets/images/score/4@2x.png);
}
.num4.active{
	background-image: url(../assets/images/score/4-@2x.png);
}
.num5{
	background-image: url(../assets/images/score/5@2x.png);
}
.num5.active{
	background-image: url(../assets/images/score/5-@2x.png);
}
.num6{
	background-image: url(../assets/images/score/6@2x.png);
}
.num6.active{
	background-image: url(../assets/images/score/6-@2x.png);
}
.num7{
	background-image: url(../assets/images/score/7@2x.png);
}
.num7.active{
	background-image: url(../assets/images/score/7-@2x.png);
}
.num8{
	background-image: url(../assets/images/score/8@2x.png);
}
.num8.active{
	background-image: url(../assets/images/score/8-@2x.png);
}
.num9{
	background-image: url(../assets/images/score/9@2x.png);
}
.num9.active{
	background-image: url(../assets/images/score/9-@2x.png);
}
.num10{
	background-image: url(../assets/images/score/10@2x.png);
}
.num10.active{
	background-image: url(../assets/images/score/10-@2x.png);
}
.btns .btn{
	width: 3.7066rem;
	background-repeat: no-repeat;
	background-size: contain;
	background-position: center;
}
.btns .btn+.btn{
	margin-left: 0.65rem;
}
.btns .btn-back{
	background-image: url(../assets/images/score/back@2x.png);
}
.btns .btn-save{
	background-image: url(../assets/images/score/save@2x.png);
}
.notice{
	margin-top: .85rem;
	font-size: 0.375rem;
}
</style>

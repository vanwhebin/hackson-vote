<template>
	<div class="pro-list">
		<h4 class="h flex align-center justify-center">
			<span class="icon left"></span>
			<span class="text-title text-yellow">项目名称</span>
			<span class="icon right"></span>
		</h4>
		<div class="card-list">
			<div class="card-item flex" >
				<div class="content flex flex-direction align-center justify-center">
					<span class="bage">01</span>
					<div class="title text-trunct">
						Hankathon打分器...
					</div>
					<div class="auth">提出人: 王超</div>
				</div>
				<div class="actions flex justify-center align-center">
					<span class="text-yellow vertical-lr" @click.stop="commite">评 分</span>
				</div>
			</div>
			
			<div class="card-item flex" >
				<div class="content flex flex-direction align-center justify-center">
					<span class="bage">02</span>
					<div class="title text-trunct">
						Hankathon打分器...
					</div>
					<div class="auth">提出人: 王超</div>
				</div>
				<div class="actions text-yellow flex flex-direction justify-center align-center">
					<span class="score-num"><span style="font-size: 0.7466rem">9</span>分</span>
					<span class="splite" ></span>
					<span class="update" @click="update" >修改</span>
				</div>
			</div>
			
			<div class="card-item flex" >
				<div class="content flex flex-direction align-center justify-center">
					<span class="bage">01</span>
					<div class="title text-trunct">
						Hankathon打分器...
					</div>
					<div class="auth">提出人: 王超</div>
				</div>
				<div class="actions flex justify-center align-center">
					<span class="text-gray vertical-lr">评 分</span>
				</div>
			</div>
		</div>
		<button class="btn bg-yellow block" @click="submit"></button>
	</div>
</template>

<script>
	export default {
		name: 'list',
		methods:{
			update(){}
		}
	}
</script>

<style>
img{
	width: 100%;
	height: 100%;
}
.pro-list{
	padding: 0 0.64rem;
}
.pro-list .h{
	padding: 0.8533rem 0;
	font-size: 500;
}
.pro-list .h .icon{
	width: 1.6rem;
	height: 0.4267rem;
	background-size: contain;
	background-repeat: no-repeat;
}
.pro-list .h .icon.left{
	  margin-right: 0.4266rem;
		background-image: url(../assets/images/list/left@2x.png);
}
.pro-list .h .icon.right{
		margin-left: 0.4266rem;
		background-image: url(../assets/images/list/right@2x.png);
}
.card-item{
	position: relative;
	margin-bottom: 0.513rem;
	height: 3.8rem;
	border-radius: 6px;
	border: 2px solid #fff;
	color: #fff;
	overflow: hidden;
}
.card-item .bage{
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
.card-item .title{
	margin-bottom: 0.46rem;
	font-size: 0.5867rem;
}
.card-item .content{
	flex: 1;
	border-right: 2px solid #fff;
}
.card-item .content .auth{
	font-size: 0.32rem;
}
.card-item .actions{
	width: 2.133rem;
	flex: 0 0 2.133rem;
	font-size: 0.4266rem;
}
.card-item .actions .splite{
	height: 1px;
	width: 1.85rem;
	margin: 0.32rem 0;
	background: #666;
}
.pro-list .btn{
	height: 1.74666rem;
	width: 100%;
	display: block;
	border: none;
	background: url(../assets/images/list/submit@2x.png);
	background-size: contain;
	background-repeat: no-repeat;
}
.vertical-lr{
	white-mode:vertical-lr;
	flex: 0 0 0.1rem;
}
.block{
	width: 100%;
	display: block;
}
</style>

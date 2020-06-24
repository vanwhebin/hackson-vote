<template>
	<div class="submit flex flex-direction align-center justify-center">
		<div class="img-warp">
			<img src="../assets/images/loading-result.gif"  alt=""/>
		</div>
		<div class="text text-yellow">
			提交成功
		</div>
		<router-link to="/top" class="link text-yellow">
			查看排行
		</router-link>
	</div>
</template>

<script>
	export default {
		name: 'submit'
	}
</script>

<style>
	.submit{
		height: 100vh;
		padding-bottom: 20vh;
	}
	.img-warp{
		width: 2.4rem;
		height: 2.4rem;
		margin-bottom: 0.853rem;
	}
	.text{
		font-size: 0.5333rem;
	}
	.link{
		position: absolute;
		left: 0;
		right: 0;
		margin: auto;
		bottom: 2.1333rem;
		font-size: 0.3733rem;
	}
</style>

<template>
	<div class="statistics flex flex-direction align-center justify-center">
		<div class="img-warp">
			<img src="../assets/images/loading-result.gif" />
		</div>
		<div class="text text-yellow">
			正在计算总分，请稍后。。
		</div>
	</div>
</template>

<script>
	export default {
		name: 'statistics'
	}
</script>

<style scoped>
	.statistics{
		height: 100vh;
		padding-bottom: 10vh;
	}
	.img-warp{
		width: 4.4rem;
		height: 4.4rem;
		margin-bottom: 0.64rem;
	}
	.text{
		font-size: 0.4266rem;
	}
</style>

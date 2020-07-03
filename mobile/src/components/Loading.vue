<template>
	<div class="loading flex flex-direction justify-center align-center">
		<div class="loading-bar flex justify-center align-center">
			<div class="processing flex-sub">
				<span class="after" :style="{left:progress}"></span>
			</div>
		</div>
		<div class="loading-percent text-yellow">{{progress}}</div>

	</div>
</template>

<script>
	export default {
		name: 'loading',
		data(){
			return {
				progress: 0,
				start: null
			}
		},
		mounted(){
			this.step()
		},
		methods:{
			step() {
				const timestamp = new Date().getTime()
			  if (!this.start) this.start = timestamp;
			  let progress = timestamp - this.start;
			  this.progress = Math.min(progress / 10, 100) + '%'
				console.log(this.progress)
				if (progress < 10000) {
			  }
			}
		}
	}
</script>

<style scoped>
	.loading{
		height: 80vh;
	}
	.loading-bar{
		width: 4.56rem;
		height: 1.41333rem;
		padding: 0.24rem;
		background-image: url(../assets/images/loading-outer@2x.png);
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
	}
	.processing{
		position: relative;
		width: 4.05333rem;
		height: 0.8533rem;
		background-image: url(../assets/images/loading-bar@2x.png);
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
	}
	.processing .after{
		position: absolute;
		right: 0;
		top: 0;
		bottom:0;
		left: 0;
		background:#00193A;
		transition: width .5s linear;
	}
	.loading-percent{
		margin-top: .48rem;
		font-size: .64rem;
		font-weight: 700;
	}

</style>


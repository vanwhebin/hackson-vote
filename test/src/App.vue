<template>
  <div id="app" class="bg">
		<router-view></router-view>
	</div>
</template>

<script>
export default {
  name: 'app',
  components: {}
}
</script>

<style>
*{
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
body{
	margin: 0;
	padding: 0;
}
#app {
  font-family:'PingFang-SC-Medium', Helvetica, 'Avenir', Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin: auto;
	width: 10rem;
	max-width: 750px;
}
.bg{
	background-image: url(assets/images/background1@2x.png);
	background-size: cover;
	background-repeat: no-repeat;
	min-height: 100vh;
}
.flex {
	display: flex;
}

.basis-xs {
	flex-basis: 20%;
}

.basis-sm {
	flex-basis: 40%;
}

.basis-df {
	flex-basis: 50%;
}

.basis-lg {
	flex-basis: 60%;
}

.basis-xl {
	flex-basis: 80%;
}

.flex-sub {
	flex: 1;
}

.flex-twice {
	flex: 2;
}

.flex-treble {
	flex: 3;
}

.flex-direction {
	flex-direction: column;
}

.flex-wrap {
	flex-wrap: wrap;
}

.align-start {
	align-items: flex-start;
}

.align-end {
	align-items: flex-end;
}

.align-center {
	align-items: center;
}

.align-stretch {
	align-items: stretch;
}

.self-start {
	align-self: flex-start;
}

.self-center {
	align-self: flex-center;
}

.self-end {
	align-self: flex-end;
}

.self-stretch {
	align-self: stretch;
}

.align-stretch {
	align-items: stretch;
}

.justify-start {
	justify-content: flex-start;
}

.justify-end {
	justify-content: flex-end;
}

.justify-center {
	justify-content: center;
}

.justify-between {
	justify-content: space-between;
}

.justify-around {
	justify-content: space-around;
}
.text-trunct{
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
}
.text-center{
	text-align: center;
}
.text-yellow{
	color: rgba(255,255,0,1)
}
.text-gray{
	color: rgba(134,131,117,1)
}
.nav{
	line-height: 2;

}
.nav-item{
	white-space: nowrap;
	margin: 0 0.1rem;
	color: skyblue;
	text-decoration: none;
	font-size: 0.45rem;
}


</style>

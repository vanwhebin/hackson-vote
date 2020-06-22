<template>
  <div class="loading flex flex-direction justify-center align-center">
    <div class="loading-bar flex justify-center align-center">
      <div class="processing flex-sub"></div>
    </div>
    <div class="loading-percent text-yellow">
      70%
    </div>
  </div>
</template>

<script>
export default {
  name: 'loading'
}
</script>

<style scoped>
  .loading {
    height: 80vh;
  }

  .loading-bar {
    width: 4.56rem;
    height: 1.41333rem;
    background-image: url(../assets/images/loading-outer@2x.png);
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
  }

  .processing {
    width: 4.05333rem;
    height: 0.8533rem;
    background-image: url(../assets/images/loading-bar@2x.png);
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
  }

  .loading-percent {
    margin-top: .48rem;
    font-size: .64rem;
    font-weight: 700;
  }

</style>

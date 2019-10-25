<template>
    <div class="container">
        <div class="row block-car">
          <carousel :per-page="1"  :mouse-drag="false" :autoplay="true" paginationActiveColor="#56abc3" :perPageCustom="[[480, 2], [768, 3]]" :loop="true" :speed="6">
              <slide>
                <div class="area-img">
                  <a href="https://www.acuvue.ru" target="_blank">
                    <img src="/imgs/partners/part1.jpg" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                <a href="http://www.luxottica.com" target="_blank">
                  <img src="/imgs/partners/part2.png" alt="part">
                </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                <a href="https://www.essilor.ru/" target="_blank">
                  <img src="/imgs/partners/part3.png" alt="part">
                </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                <a href="http://www.linza-zeiss.ru/" target="_blank">
                  <img src="/imgs/partners/part4.png" alt="part">
                </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="http://www.bausch.ru" target="_blank">
                    <img src="/imgs/partners/part5.jpg" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="https://www.menrad.de" target="_blank">
                    <img src="/imgs/partners/part6.jpg" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="https://www.alcon.ru" target="_blank">
                    <img src="/imgs/partners/part7.jpg" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="https://www.charmant.com" target="_blank">
                    <img src="/imgs/partners/part8.jpg" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="http://www.derigo.com" target="_blank">
                    <img src="/imgs/partners/part9.jpg" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="https://www.rodenstock.com" target="_blank">
                    <img src="/imgs/partners/part10.png" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="http://www.fhg.ru/" target="_blank">
                    <img src="/imgs/part11.png" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="https://www.newoptica.ru/" target="_blank">
                    <img src="/imgs/part12.png" alt="part">
                  </a>
                </div>
              </slide>
              <slide>
                <div class="area-img">
                  <a href="https://www.mondottica.com" target="_blank">
                    <img src="/imgs/part13.png" alt="part">
                  </a>
                </div>
              </slide>
            </carousel>
        </div>
    </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';

    export default {
      components: {
          Carousel,
          Slide
        },
        data() {
          return {

          };
        },

        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
<style lang="scss" scoped>
// @import '~bootstrap/scss/bootstrap';
@import '~bootstrap/scss/_functions';
@import '~bootstrap/scss/_variables';
@import '~bootstrap/scss/mixins/_breakpoints';
.block-car{
  display: block;
  padding-bottom: 30px;
}


img{
  margin: 14px 14px 14px 14px;
  max-width: 150px;
}

.area-img{
  align-items: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100%;
  filter: grayscale(100%);
}

.VueCarousel-dot-button{
    background-color: #56abc3 !important;
}

.content-review{
    text-align: center;
    margin: 0 auto;

    overflow: hidden;

  h3{
    font-weight: 300;
    font-size: 30px;
    color: #1f1f1f;
    @include media-breakpoint-down(sm) {
      font-size: 22px;
    }
  }
  span{
    font-size: 16px;
    color: #1f1f1f;
    font-weight: 300;
  }
  p{
    font-size: 16px;
    color: #1f1f1f;
    font-weight: 300;
    @include media-breakpoint-down(sm) {
      font-size: 14px;
    }
  }
}

</style>

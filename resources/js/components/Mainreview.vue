<template>
    <div class="container">
        <div class="row block-car">
          <carousel :per-page="1"  :mouse-drag="false"  paginationActiveColor="#56abc3" :autoplay="true" :loop="true" :speed="6">
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Елена Большакова
                    </h3>
                    <span>30 января 2019</span>
                    <p>
                      Приятная обстановка в магазине. Доброжелательный персонал и большой ассортимент. Спасибо, что помогли мне выбрать качественные очки по хорошей цене!  
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Маргарита
                    </h3>
                    <span>07 июля 2019</span>
                    <p>
                      Нравится эта оптика. Всегда вежливые консультанты, помогают сделать выбор и очень теплое отношение в клиентам!                     </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Надежда
                    </h3>
                    <span>20 октября 2019</span>
                    <p>
                      Богатый выбор очков и аксессуаров.Классс !!! Очень нравится обслуживание. Советую всем. 
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Антон Белоусов
                    </h3>
                    <span>23 августа 2019</span>
                    <p>
                      Все очень понравилось, милый персонал. Всем рекомендую!!! 
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Екатерина Чернецкая
                    </h3>
                    <span>04 февраля 2019</span>
                    <p>
                      Всегда вежливые продавцы. Единственная оптика, которая поменяла сломанные заушники на новые, за что им очень благодарна. 
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Елена Большакова
                    </h3>
                    <span>31 января 2019</span>
                    <p>
                      Покупала очки в первый раз, поэтому плохо ориентировалась в данной сфере. Решила посетить оптику «Стиль». Хочу сказать огромное спасибо консультанту за помощь и самое дружелюбное обслуживание! 
                    </p>
                  </div>
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
  margin-bottom: 30px;
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

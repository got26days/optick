<template>
    <div class="container">
        <div class="row block-car">
          <carousel :per-page="1"  :mouse-drag="false"  paginationActiveColor="#56abc3" :autoplay="true" :loop="true" :speed="6">
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Зеленская Мария
                    </h3>
                    <span>22.12.2016</span>
                    <p>
                      Посетила Вашу оптику, приобрела 2 пары очков. Очень довольна не только покупкой, но и Вашим персоналом. Все доброжелательные и профессиональные. Спасибо!
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Рысева Людмила
                    </h3>
                    <span>07.07.2014</span>
                    <p>
                      Благодарю салон "Оптика Стиль" за культуру обслуживания, за своевремено выполненную работу. Очень вежливый персонал и высокое качество обслуживания.
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Ознобихин Сергей
                    </h3>
                    <span>24.08.2017</span>
                    <p>
                      Очень вежливые продавцы, широкий ассортимент товара, грамотная консультация. Остался доволен. Рекомендую. И ценники очень даже бюджетные. Молодцы!
                    </p>
                  </div>
                </div>
              </slide>
              <slide>
                <div class="container">
                  <div class="content-review">
                    <h3>
                      Московских Андрей
                    </h3>
                    <span>29.01.2015</span>
                    <p>
                      Огромное спасибо Екатерине Семашко за отличное обслуживание, внимание к клиентам. Всё очень понравилось. Буду рекомендовать своим друзьям и знакомым, и сам ещё не раз сюда вернусь!
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

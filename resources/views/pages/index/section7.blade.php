<div class="section7">
  <div class="container">
    <div class="row title-row">
      <h1>У нас представлен весь <br /> спектр услуг</h1>
    </div>
  </div>
  <div class="btns-sec7">
    <div class="container">
      <a v-bind:class="{ active: maincard == 1 }" @click="maincard=1">1</a>
      <a v-bind:class="{ active: maincard == 2 }" @click="maincard=2" class="margin-btn">2</a>
      <a v-bind:class="{ active: maincard == 3 }" @click="maincard=3" class="margin-btn">3</a>
    </div>
  </div>

    <div class="row padder-none-row">
      <div class="non-row col-sm-12 col-md-12 col-lg-6">

      </div>
      <div class="non-row col-sm-12 col-md-12 col-lg-6" style="padding-right: 0px !important; padding-left: 0px !important;" v-cloak>
        <div class="right-card">
          <div class="container" v-show="maincard == 1">
            <h1>Мы заботимся о Вашем зрении</h1>
            <ul>
              <li>
                Компьютерная диагностика зрения
              </li>
              <li>
                Опытный персонал
              </li>
              <li>
                Подбор контактных линз и обучение в их использовании
              </li>
              <li>
                Сложная коррекция зрения
              </li>
            </ul>
            <a class="rc-btn" href="/services">УЗНАТЬ ПОДРОБНОСТИ</a>
          </div>
          <div class="container" v-show="maincard == 2">
            <h1>Профессиональные консультанты</h1>
            <ul>
              <li>
                Работают опытные специалисты, которые смогут подобрать не только красивые очки, но и учтут все технические аспекты по установки линз согласно вашему рецепту!
              </li>
              <li>
                Подбор солнцезащитных очков, как по форме лица, так и с учетом особенности их применения, будь то отпуск в горах или вождение автомобиля.
              </li>
              <li>
                Консультации по смене цвета глаз с помощью контактных линз.
              </li>
              <li>
                Помощь в заказе прогрессивных очков, подробная консультация, все необходимые замеры оправы, обучение в использовании для быстрой адаптации.
              </li>
            </ul>
            <a class="rc-btn" href="/services">УЗНАТЬ ПОДРОБНОСТИ</a>
          </div>
          <div class="container" v-show="maincard == 3">
            <h1>Работает мастерская по изготовлению и ремонту очков</h1>
            <ul>
              <li>
                Срочное изготовление очков от 15 минут
              </li>
              <li>
                Изготовление очков любой сложности
              </li>
              <li>
                Окраска очковых линз в любой цвет
              </li>
              <li>
                Выправка очков по посадке
              </li>
              <li>
                Ремонт очков
              </li>
              <li>
                Сервисное обслуживание очков (подкручивание всех винтовых соединений, ультрозвуковая чистка)
              </li>
              <li>
                Переточка линз в новую оправу
              </li>
              <li>
                Чистка в ультразвуке
              </li>
            </ul>
            <a class="rc-btn" href="/services">УЗНАТЬ ПОДРОБНОСТИ</a>
          </div>

        </div>
      </div>
    </div>

</div>

<div class="section11">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8 col-lg-6 formcard-area">
        <div class="formcard">
          <h1>Хотите знать подробности?</h1>
          <p>
            Закажите обратный звонок
          </p>
          <form @submit.prevent="postNow">
            <div class="form-group">
              <input type="text" class="form-control sec11-form-input" id="name"  placeholder="Ваше Имя" v-model="name" required>
            </div>
            <div class="form-group">
              {{-- <input class="form-control sec11-form-input" id="phone" placeholder="Телефон" v-model="phone" required  mask="\+\1 (111) 111-1111" type="tel" > --}}
              <masked-input class="form-control sec11-form-input" v-model="phone" mask="\+\7 (111) 111-1111" placeholder="Телефон" type="tel" />
            </div>
            <button type="submit" class="rp-btn">Отправьте, мы перезвоним</button>
          </form>
          <p class="lock">
            <img src="/imgs/lock.png" alt="lock">
            мы не рассылаем спам и никому не передаем сведения о своих
            настоящих или будущих клиентах
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

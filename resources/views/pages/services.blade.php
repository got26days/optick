@extends('layouts.master')

@section('content')

  <div class="services">
    <div class="container">
      <div class="row">
        <h2 class="title-services">Услуги</h2>
      </div>
      <div class="row ser1">
        <div class="col-sm-12 col-md-4 col-lg-4">
          <div class="ser-img-area">
            <img src="/imgs/ser2.jpg" alt="services">
          </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 ser-list-area">
          <h2>Мастерская</h2>
          <ul>
            <li>Изготовление очков любой сложности</li>
            <li>Срочное изготовление очков за 15 минут</li>
            <li>Однотонное и градиентное окрашивание линз</li>
            <li>Разметка и регулировка очков на месте</li>
            <li>Переточка линз в новую оправу</li>
          </ul>
        </div>
      </div>
      <div class="row ser1">
        <div class="col-sm-12 col-md-4 col-lg-4">
          <div class="ser-img-area">
            <img src="/imgs/ser3.jpg" alt="services">
          </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 ser-list-area">
          <h2>Ремонт очков</h2>
          <ul>
            <li>Выправка любой сложности</li>
            <li>Замена носовых упоров</li>
            <li>Установка винтов, гаек, шайб</li>
            <li>Замена лески</li>
            <li>Ультразвуковая чистка очков</li>
            <li>Замена наконечников</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection

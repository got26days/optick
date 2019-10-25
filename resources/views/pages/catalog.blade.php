@extends('layouts.master')

@section('content')

<div class="catalog">
  <div class="container">

    <div class="row filters">
      <div class="col-sm-12 col-md-6 col-lg-4 filterpad">
            <div class="button-group">
               <button type="button" class="btn btn-default btn-sm dropdown-toggle catalog-selector" data-toggle="dropdown"><span class="glyphicon glyphicon-cog">Выберите тип</span> <span class="caret"></span></button>
               <ul class="dropdown-menu catalog-selectorul">
                 <li><a href="#" class="small" data-value="option0" tabIndex="-1"><input type="checkbox" v-model="option0" @change="getCatalog()"/>&nbsp;ВСЕ ТИПЫ</a></li>
                 <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox" v-model="option1" @change="getCatalog()"/>&nbsp;СОЛНЦЕЗАЩИТНЫЕ ОЧКИ</a></li>
                 <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox" v-model="option2" @change="getCatalog()"/>&nbsp;КОНТАКТНЫЕ ЛИНЗЫ</a></li>
                 <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox" v-model="option3" @change="getCatalog()"/>&nbsp;АКСЕССУАРЫ</a></li>
                 <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox" v-model="option4" @change="getCatalog()"/>&nbsp;ОПРАВЫ</a></li>
                 <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox" v-model="option5" @change="getCatalog()"/>&nbsp;СРЕДСТВА ПО УХОДУ</a></li>
                 <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox" v-model="option6" @change="getCatalog()"/>&nbsp;ЛИНЗЫ ДЛЯ ОЧКОВ</a></li>
                 <li><a href="#" class="small" data-value="option7" tabIndex="-1"><input type="checkbox" v-model="option7" @change="getCatalog()"/>&nbsp;ПОДАРОЧНЫЕ КАРТЫ</a></li>
               </ul>
            </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-4 filterpad">

          <select id="exampleFormControlSelect1" class="form-control" v-model="price" @change="getCatalog()">
            <option value="asc">Цена: По возрастанию</option>
            <option value="desc">Цена: По убыванию</option>
          </select>

      </div>
      <div class="col-sm-12 col-md-6 col-lg-4 filterpad">
        <select id="exampleFormControlSelect1" class="form-control" v-model="sendbrand" @change="getCatalog()">
          <option value="Все" selected>Все бренды</option>
          <option :value="brand.brand" v-for="brand in brands">@{{ brand.brand }}</option>
        </select>
      </div>
    </div>

    <div class="container-fluid content-row">
      <div class="row" v-cloak>

        <div class="col-sm-12 col-md-6 col-lg-4 maincard-area d-flex align-items-stretch" v-for="catalog in catalogs.data" :key="catalog.id">
          <a v-bind:href="catalog.id | linkfilter" class="custom-card w-100">
            <div class="card h-100 w-100">
              <img class="card-img-top" :src="catalog.mainimage | imagelink" alt="Card image">
              <div class="card-body">
                <h5 class="card-title">@{{ catalog.title }}</h5>
                <div class="card-price-area">
                  <span class="card-link card-more">Подробнее</span>
                  <span class="card-link card-price-first">@{{ catalog.price }} р.</span>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>


    <div class="cats-pag">
      <pagination :data="catalogs" @pagination-change-page="getCatalog"></pagination>
    </div>



  </div>
</div>


@endsection

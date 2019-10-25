@extends('layouts.master')

@section('content')

  <div class="stock">
    <div class="container">

      <div class="row stock-area">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <img src="/storage/{{ $stock->image }}" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 stock-title-area">
          <h2>{{ $stock->title }}</h2>
          <h5>{{ Carbon\Carbon::parse($stock->created_at)->format('d.m.Y ') }}</h5>
          <hr />
          <p>
            {!! $stock->body!!}
          </p>
        </div>
      </div>



    </div>
  </div>
@endsection

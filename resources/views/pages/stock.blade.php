@extends('layouts.master')

@section('content')

  <div class="stock">
    <div class="container">
      @foreach($stocks as $stock)
      <div class="row stock-area">
        <div class="col-sm-12 col-md-4 col-lg-4">
          <img src="/storage/{{ $stock->image }}" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
          <h3>{{ $stock->title }}</h3>
          <h5>{{ $stock->created_at }}</h5>
          <hr />
          <p>
            {!! str_limit($stock->body, $limit = 200, $end = '...') !!} <a href="/stocksolo/id{{ $stock->id }}">Подробнее</a>
          </p>
        </div>
      </div>
    @endforeach

    <div class="paginate-stock">
      {{ $stocks->links() }}
    </div>

    </div>
  </div>
@endsection

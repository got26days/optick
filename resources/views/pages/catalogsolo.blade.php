@extends('layouts.master')

@section('content')

<div class="catalogsolo">
  <div class="container">
    <div class="row solo-area">
      <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="solo-images-area">
          <img src="/storage/{{ $catalog->mainimage }}" alt="solo">
        </div>
        <div class="minisolo-images-area">
          <div class="images" v-viewer>
            @if ($images != null)
              @foreach($images as $image)
                  <img src="/storage/{{ $image }}">
               @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 area-title-solo">
        <h1>{{ $catalog->title }}</h1>
        <h5>{{ $catalog->brand }}</h5>
        <p>
          {!! nl2br(e($catalog->body)) !!}
        </p>
        <h4>Цена: <span>{{ $catalog->price }} р.</span></h4>
      </div>
    </div>
  </div>
</div>


@endsection

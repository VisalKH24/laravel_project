@extends('frontend.layout')
@section('title')
   NL SHOPPING
@endsection
@section('content')
    <main class="home">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            SEARCH RESULTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $value)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                @if ($value->regular_price!=$value->sale_price)
                                <div class="status">
                                    Promotion
                                </div>
                                @endif
                                <a href="{{route('product',$value->id)}}">
                                    <img src="{{$value->image}}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    {{-- <div class="price d-none">US 10</div> --}}
                                    @if ($value->regular_price!= $value->sale_price)
                                        <div class="regular-price "><strike>{{$value->regular_price}}</strike></div>
                                    @endif
                                    <div class="sale-price ">US {{$value->sale_price}}</div>
                                </div>
                                <h5 class="title">{{$value->product_name}}</h5>
                            </div>
                        </figure>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>





    </main>
@endsection

@extends('Frontend.layout')
@section('title')
    NL SHOPPING
@endsection
@section('content')
    <main class="product-detail">

        <section class="review">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <div class="thumbnail">
                             <img src="{{ $product->image }}" alt="">
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="detail">
                            <div class="price-list">
                                <div class="price d-none">US 30.5</div>

                                @if ($product->sale_price < $product->reqular_price)
                                    <div class="regular-price"><strike>US {{ $product->reqular_price }}</strike></div> <br>
                                @endif

                                <div class="sale-price">US {{ $product->sale_price }}</div>
                            </div>
                            <h5 class="title">{{ $product->product_name }}</h5>
                            <div class="group-size">
                                <span class="title">Color Available</span>
                                <div class="group">
                                    {{ $product->color }}
                                </div>
                            </div>
                            <div class="group-size">
                                <span class="title">Size Available</span>
                                <div class="group">
                                    {{ $product->size }}
                                </div>
                            </div>
                            <div class="group-size">
                                <span class="title">Description</span>
                                <div class="description">
                                    {{ $product->description }}
                                </div>
                            </div>
                            <a href="{{ route('buy-product', $product->id) }}" class="btn btn-primary">BUY NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            RELATED PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($relateProduct as $value)
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    @if ($value->sale_price < $value->reqular_price)
                                        <div class="status">Promotion</div>
                                    @endif
                                    <a href="{{ route('product', $value->id) }}">
                                        <img src="{{ $value->image }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        @if ($value->sale_price < $value->reqular_price)
                                            <div class="regular-price"><strike>US {{ $value->reqular_price }}</strike>
                                            </div>
                                        @endif
                                        <div class="sale-price">US {{ $value->sale_price }}</div>
                                    </div>
                                    <h5 class="title">{{ $value->product_name }}</h5>
                                </div>

                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>
@endsection

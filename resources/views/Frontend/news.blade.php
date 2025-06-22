@extends('Frontend.layout')
@section('title')
    News Blog
@endsection
@section('content')
    <main class="shop news-blog">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            NEWS BLOG
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($allNews as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="{{route('news-detail',$item->id)}}">
                                    <img src="{{$item->thumbnail}}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <h3 class="title">{{$item->title}}</h3>
                                <h5 class="description">{{$item->description}}</h5>
                            </div>
                        </figure>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="mx-5 mt-5">
            {{$allNews->links()}}
        </div>
    </main>
@endsection

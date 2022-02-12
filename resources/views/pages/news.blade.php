@extends('layouts.master')

@section('header')
<title>TIN TỨC</title>
@endsection

@section('css')
@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>TIN TỨC</h3>
        </div>
        <div class="content">
            <div class="news">
                @if(isset($news))
                @foreach($news as $item)
                    <div class="news-item">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="news-image">
                                    <img src="{{asset($item->image ? $item->image : 'assets/images/no-image.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="news-cotent">
                                    <div class="news-title">
                                        <h3><a href="{{route('index.detailNews', ['id' => $item->id, 'slug' => $item->slug])}}">{{$item->title}}</a></h3>
                                    </div>
                                    <div class="news-short-content">
                                        {{$item->short_content}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection


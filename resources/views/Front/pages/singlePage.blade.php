@extends('Front.Layouts.front')

@section('content')
    <div class="single-page">
        <div class="top">
            <p>Articles</p>

            @php
                $currentLocale = session()->get('locale');

                if ($currentLocale === null) {
                    $currentLocale = 'tr';
                }
//                    dd($locale)
            @endphp
            @foreach($blogsss as $blog)
                <h1>{{$blog->translations->first()->title}}</h1>
                <img src="{{asset("storage/$blog->image")}}" alt="{{$blog->translations->first()->title}}">
        </div>
        <div class="container">
            @if($blogTranslation = $blog->translations->where('language.lang', $currentLocale)->first())
                <p>{!! $blogTranslation->description !!}</p>
            @else
                <h2 class="image-title">Translation Not Available</h2>
                <p>Description Not Available</p>
            @endif
        </div>
        @endforeach



        <div class="others-section">
            <h1>Other articles</h1>
            <div class="cols">
                @php
                    $blogs1=\App\Models\Blog::rand(3)->get();
                @endphp
                @foreach($blogs1 as $blog)
                    <div class="col-1">
                        <a href="{{route('front.singlePage',['slug'=>$blog->slug])}}">
                            <img src="{{asset("storage/$blog->image")}}" alt="">
                            <p class="article-title">{{$blog->translations->first()->title}}</p>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="sub-footer">
            <div class="sub-footer-content">
                <span>Homepage</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span>Article</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span>Article's title</span>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/singlepage.css')}}">
@endpush

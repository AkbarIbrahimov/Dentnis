@extends('Front.Layouts.front')

@section('content')

    @php
        $currentLocale = session()->get('locale');

        if ($currentLocale === null) {
            $currentLocale = 'tr';
        }
//                    dd($locale)
    $language=\App\Models\Language::where('lang',$currentLocale)->first();
$languageId=$language->id;
    @endphp
    <div class="single-page">
        <div class="top">
            <p>
                @if($languageId==1)
                    Makaleler
                @elseif($languageId==2)
                    Articles
                @elseif($languageId==3)
                    Статьи
                @endif
            </p>
            @foreach($blogsss as $blog)
                <h1>{{$blog->translations->where('language.lang', $currentLocale)->first()->title}}</h1>
                <img src="{{asset("storage/$blog->image")}}"
                     alt="{{$blog->translations->where('language.lang', $currentLocale)->first()->title}}">
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
            <h1>
                @if($languageId==1)
                   Diğer  makaleler
                @elseif($languageId==2)
                    Other articles
                @elseif($languageId==3)
                    Другие статьи
                @endif

                </h1>
            <div class="cols">
                @php
                    $blogs1=\App\Models\Blog::rand(3)->get();
                @endphp
                @foreach($blogs1 as $blog)
                    <div class="col-1">
                        <a href="{{route('front.singlePage',['slug'=>$blog->slug])}}">
                            <img src="{{asset("storage/$blog->image")}}" alt="">
                            <p class="article-title">{{$blog->translations->where('language.lang', $currentLocale)->first()->title}}</p>
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

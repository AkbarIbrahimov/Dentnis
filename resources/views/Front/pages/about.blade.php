@extends('Front.Layouts.front')

@section('content')
    @php
        $currentLocale = session()->get('locale');

        if ($currentLocale === null) {
            $currentLocale = 'tr';
        }
        $language=\App\Models\Language::where('lang',$currentLocale)->first();
        $langId=$language->id;
    @endphp
    <div class="all">
        <div class="navall" >
            <div class="subhover">
                <h1 class="title" style="font-size: 16px">{{$aboutMenu->translations->where('language_id',$langId)->first()->title}}</h1>
                <a href="{{route('front.index')}}" style="font-size: 16px; color: white; margin-right:20px;text-decoration: none">AnaSayfa</a>
                <span style="font-size: 16px;margin-right:15px ">></span>
                <span style="font-size: 16px">{{$aboutMenu->translations->where('language_id',$langId)->first()->title}}</span>
            </div>
        </div>
        <div class="wraparrall">
            <div class="wrapperall ">
{!! $aboutUs->translations->where('language_id',$langId)->first()->description !!}

            </div>

            <swiper-container class="mySwiper" navigation="true" pagination="true" keyboard="true" mousewheel="true"
                              css-mode="true">
               @foreach($doctorImages as $doctorImage)
                    <swiper-slide><img src="{{asset("storage/$doctorImage->image")}}" alt=""></swiper-slide>

               @endforeach
            </swiper-container>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
        </div>
        <div class="iframe">
            <iframe src="{{$youtubeAbout->url}}" frameborder="0" width="100%" height="400"></iframe>
        </div>
    </div>
        @endsection

        @push('styles')
            <link rel="stylesheet" href="{{asset('assets/front/css/about.css')}}">
        @endpush
        @push('script')
            <link rel="stylesheet" href="{{asset('assets/front/js/about.js')}}">
    @endpush

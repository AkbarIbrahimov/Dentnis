@extends('Front.Layouts.front')
@section('content')
    @php
        $currentLocale = session()->get('locale');

        if ($currentLocale === null) {
            $currentLocale = 'tr';
        }
        $language=\App\Models\Language::where('lang',$currentLocale)->first();
        $languageId=$language->id;
    @endphp

    <div class="all">
        <div class="under-nav">
            <div class="content">
                <div class="top-title">
                    @if($languageId==1)
                        Makaleler
                    @elseif($languageId==2)
                        Articles
                    @elseif($languageId==3)
                        Статьи
                    @endif
                </div>
                <div class="bottom-title">
                    <div class="bottom-left"><a href="{{route('front.index')}}">Anasayfa</a></div>
                    <div class="icon"> ></div>
                    <div class="bottom-right"><a href="">
                            @if($languageId==1)
                                Makaleler
                            @elseif($languageId==2)
                                Articles
                            @elseif($languageId==3)
                                Статьи
                            @endif
                        </a></div>
                </div>
            </div>
        </div>

        <div class="container-article">
            <div class="all-article">
                @foreach($blogs as $blog)
                    @if($blog->category_id!=4)
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset("storage/$blog->image")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            @foreach($blog->translations->where('language_id',$languageId) as $translation)
                            <h3 class="card-title">{{$translation->title}}</h3>
                            <p class="card-text"><span>{{ Str::limit($translation->mini_description,255) }}</span></p>
                            <a href="{{route('front.singlePage',['slug'=>$blog->slug])}}" class="btn btn-primary">
                                @if($languageId==1)
                                    Devamını Oku
                                @elseif($languageId==2)
                                    Read more
                                @elseif($languageId==3)
                                    Читать далее
                                @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/articles.css')}}">
@endpush

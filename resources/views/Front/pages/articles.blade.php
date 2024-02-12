@extends('Front.Layouts.front')
@section('content')
    <div class="all">
        <div class="under-nav">
            <div class="content">
                <div class="top-title">
                    Makaleler
                </div>
                <div class="bottom-title">
                    <div class="bottom-left"><a href="">Anasayfa</a></div>
                    <div class="icon"> ></div>
                    <div class="bottom-right"><a href="">Makaleler</a></div>
                </div>
            </div>
        </div>
        @php
            $currentLocale = session()->get('locale');

            if ($currentLocale === null) {
                $currentLocale = 'tr';
            }
            $language=\App\Models\Language::where('lang',$currentLocale)->first();
            $languageId=$language->id;
        @endphp

        <div class="container-article">
            <div class="all-article">
                @foreach($blogs as $blog)
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset("storage/$blog->image")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            @foreach($blog->translations->where('language_id',$languageId) as $translation)
                            <h3 class="card-title">{{$translation->title}}</h3>
                            <p class="card-text"><span>{{ Str::limit($translation->description,100) }}</span></p>
                            <a href="#" class="btn btn-primary">Devamını Oku</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/articles.css')}}">
@endpush

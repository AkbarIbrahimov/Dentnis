@extends('Front.Layouts.front')
@section('content')
    <div class="subheader">
        <div class="container">
            <div class="columnOne">
                <h1>{{ $matchedBlogsCount }} arama sonucunuz:{{$searchTerm}}</h1>
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
    <div class="result">
        @foreach($blogs as $blog)
            @foreach($blog->translations->where('language_id', $languageId) as $translation)
                @if(stripos($translation->title, $searchTerm) !== false || stripos($translation->description, $searchTerm) !== false)
                    <div class="post">
                        <h2><a href="{{route('front.singlePage',['slug'=>$blog->slug])}}">{{$translation->title}}</a></h2>
                        <h4>{{Str::limit($translation->description,200)}}</h4>
                        <a href="{{route('front.singlePage',['slug'=>$blog->slug])}}"><button>Devamını Oku</button></a>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>

@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/search.css')}}">
@endpush

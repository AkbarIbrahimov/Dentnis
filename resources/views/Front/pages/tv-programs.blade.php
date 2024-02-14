@extends('Front.Layouts.front')
@section('content')
    <div class="all">
        <div class="under-nav">
            <div class="content">
                <div class="top-title">
                    Tv Programs
                </div>
                <div class="bottom-title">
                    <div class="bottom-left"><a href="{{route('front.index')}}">Anasayfa</a></div>
                    <div class="icon"> ></div>
                    <div class="bottom-right"><a href="">TV-Program</a></div>
                </div>
            </div>
        </div>


        <div class="container-article">
            <div class="all-article">
               @foreach($tvPrograms->where('status','active') as $tvProgram)
                    <div class="card" style="width: 18rem;">
                        <iframe class="iframe" width="400" height="228" src="{{$tvProgram->url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <div class="video-title">
                            <b> {{$tvProgram->title}} </b>
                        </div>
                    </div>
               @endforeach

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/articles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/tvPrograms.css')}}">
@endpush

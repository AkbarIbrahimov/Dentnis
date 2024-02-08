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
        <div class="slider">
        <div id="image-container">
            @foreach($sliders as $key=>$slider)
                <a href="{{url($slider->url)}}"><img src="{{asset("storage/$slider->image")}}" alt="{{$slider->name}}}"
                                                     class="{{ $key == 0 ? 'active' : '' }}"></a>
            @endforeach
        </div>
        <div class="buttons">

            <button id="prevBtn" onclick="prevImage()"><</button>
            <button id="nextBtn" onclick="nextImage()"> ></button>
        </div>
    </div>
    <div class="section1">
        <h1>Estetik Diş Hekimliği</h1>

        <div class="row">
            @foreach($quotes as $quote)
                   @foreach($quote->translations->where('language_id', $languageId) as $translation)
                    <div class="col">

                    <img src="{{asset("storage/$quote->image")}}" alt="Quote image {{$quote->id}}">
                        <p class="title">{{$translation->title}}</p>
                        <p>{{$translation->description}}</p>
                   @endforeach
                </div>
            @endforeach

        </div>
    </div>
    <!-- sponsor slider start -->
    <div class="containerSponsor">
        <div class="swiper mySwiper my">
            <div class="swiper-wrapper">
                @foreach($sponsors as $sponsor)
                    <div class="swiper-slide">
                        <div class="ust-padding">
                            <div class="for-padding">
                                <img src="{{asset("storage/$sponsor->image")}}" alt="image{{$sponsor->id}}">

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <!-- sponsor slider end -->
    <!-- YouTube start-->
    <div class="youtube">
        @foreach($youtubes as $youtube)
        <iframe width="918" height="450" src="{{$youtube->url}}"
                title="Dentnis İmplantoloji ve Estetik Diş Kliniği" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>

        </iframe>
        @endforeach
    </div>
    <!-- YouTube end-->
    <!-- Ekibimiz start -->
    <div class="ekibimiz-container">
        <h1>Ekibimiz</h1>
        <div class="swiper-2 mySwiper my2">
            <div class="swiper-wrapper">
               @foreach($teams as $team)
                    @foreach($team->translations->where('language_id', $languageId) as $translation)
                        <div class="swiper-slide mz">
                            <div class="top-section">
                                <img src="{{asset("storage/$team->image")}}" alt="image{{$team->id}}">

                            </div>
                            <div class="bottom-section">
                                <h3 class="doctor-name">{{$team->title}}</h3>
                                <div class="ekibimiz-line"></div>
                                <h5 class="doctor-position">{{$translation->position}}</h5>
                            </div>
                        </div>
                    @endforeach
               @endforeach
            </div>
        </div>
    </div>
    <!--Ekibimiz end-->
    <!--Estetik dis hekimligi start-->
    <div class="section2">
        <h2>Estetik Diş Hekimliği</h2>
        <div class="container1">
            @foreach($blogs as $blog)
                <div class="image-container">
                    <img src="{{asset("storage/$blog->image")}}" alt="Image{{$blog->id}}"
                         style="width: 100%; height: 100%;">
                    <div class="image-overlay"></div>
                    <div class="image-title">{{$blog->translations->first()->title}}</div>
                    <div class="underline"></div>
                </div>
            @endforeach

        </div>
    </div>
    <!--Estetik dis hekimligi end-->
    <!--Article section start-->
    <div class="articles">
        <h2>Makaleler</h2>
        <div class="container1">
            @foreach($blogArticles as $article)
                <div class="col">
                    <div class="image">
                            <img
                                src="{{asset("storage/$article->image")}}"
                                alt="article image {{$article->id}}">

                    </div>
                    <div class="content">
                        <h2>{{$article->translations->first()->title}}</h2>
                        <p>{{$article->translations->first()->description}}</p>
                        <button>Devamını oku</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--Article section end-->
@endsection

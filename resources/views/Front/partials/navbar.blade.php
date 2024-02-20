<div class="header head1">
    <ul class="container1">
        <span class="image">
            <a href="{{route('front.index')}}"><img
                    src="{{asset("storage/$settings->top_logo")}}" alt="logo"></a>
        </span>
        <div>

            @php
                $currentLocale = session()->get('locale');

                if ($currentLocale === null) {
                    $currentLocale = 'tr';
                }
                $language=\App\Models\Language::where('lang',$currentLocale)->first();
                $languageId=$language->id;
            @endphp
            <ul class="navbar">
                @foreach($categories as $category)
                    <li>
                        @if($categoryTranslation = $category->translations->where('language_id', $languageId)->first())
                            <a href="{{-- url($categoryTranslation->slug ?? '') --}}">
                                <span>{{$categoryTranslation->name}}</span>
                            </a>
                        @else
                        @endif
                        <ul>
                            @foreach($category->blogs as $blog)
                                <li>
                                    @if($blogTranslation = $blog->translations->where('language.lang', $currentLocale)->first())
                                        <a href="{{route('front.singlePage',['slug'=>$blog->slug])}}">{{$blogTranslation->title}}</a>
                                    @else
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li>
                    <a href="{{route('front.about')}}">
                        <span>
                            @if($languageId==1)
                                Hakkimizda
                            @elseif($languageId==2)
                                AboutUs
                            @elseif ($languageId==3)
                                О нас
                            @endif
                        </span>
                    </a>
                    <ul>
                        @foreach($blogs->where('category_id',4) as $blog)
                            <li>
                                @if($blogTranslation = $blog->translations->where('language.lang', $currentLocale)->first())
                                    <a href="{{url($blog->slug)}}">{{$blogTranslation->title}}</a>
                                @else
                                @endif
                            </li>
                        @endforeach
                        @if($headDoctor)
                            <li>
                                <a href="{{route('front.headDoctor')}}">Dr.Abulkadir Nadir</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{route('front.contact')}}">
                        <span>
                        @if($languageId==1)
                                Iletisim
                            @elseif($languageId==2)
                                Communication
                            @elseif($languageId==3)
                                Коммуникация
                            @endif
                        </span></a>
                </li>
                @foreach($languageIcon as $language)
                    <a href="{{ route('locale.set', $language->lang) }}"
                       class="lang {{ $currentLocale === $language->lang ? 'd-none' : '' }}">
                        <img src="{{ asset('storage/'. $language->image) }}" alt="{{ $language->lang }}"
                             id="{{ $language->lang }}">
                    </a>
                @endforeach
                <div id="iconContainer"><i class="fa-regular fa-bars iconElement" style="color: #f415cb"
                                           id="iconNav"></i></div>
                <div class="iconMenu" hidden>
                    <div class="sidebar" id="sidebar">
                        <span class="closeMenu"><i class="fa-light fa-x"></i></span>
                        @foreach($categories as $category)
                            @if($categoryTranslation = $category->translations->where('language_id', $languageId)->first())

                                <div class="category">
                                    <div class="plus">
                                        <a href="{{ url($categoryTranslation->slug ?? '') }}">
                                            <span>{{$categoryTranslation->name}}</span>
                                        </a>
                                        <span class="toggle">+</span>
                                    </div>

                                    <ul>
                                        @foreach($category->blogs as $blog)
                                            <li>
                                                @if($blogTranslation = $blog->translations->where('language.lang', $currentLocale)->first())
                                                    <a href="{{route('front.singlePage',['slug'=>$blog->slug])}}">{{$blogTranslation->title}}</a>
                                                @else
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                        <div class="category">

                            <div class="plus">
                                <a href="{{route('front.about')}}">
                        <span>
                            @if($languageId==1)
                                Hakkimizda
                            @elseif($languageId==2)
                                AboutUs
                            @elseif($languageId==3)
                                О нас
                            @endif
                        </span>
                                </a>
                                <span class="toggle">+</span>
                            </div>
                            <ul>
                                @foreach($blogs->where('category_id',4) as $blog)
                                    <li>
                                        @if($blogTranslation = $blog->translations->where('language.lang', $currentLocale)->first())
                                            <a href="{{url($blog->slug)}}">{{$blogTranslation->title}}</a>
                                        @else
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="category">

                            <a href="{{route('front.contact')}}">
                        <span>
                        @if($languageId==1)
                                Iletisim
                            @elseif($languageId==2)
                                Communication
                            @elseif($languageId==3)
                                Коммуникация
                            @endif
                        </span></a>
                        </div>
                    </div>
                </div>
            </ul>
            <span class="search1"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
    </ul>
</div>
<div class="header head2" hidden>
    <div class="input-container">
        <form action="{{route('front.search')}}" method="get" class="searchInput">
            <i class="fa-solid fa-magnifying-glass" style="color: #c7c7c7;"></i>
            <input type="search" id="form1" name="search" class="searchInput1" @if($languageId==1)
                placeholder="Arama..."
                   @elseif($languageId==2)
                       placeholder="Search..."
                   @elseif($languageId==3)
                       placeholder="Поиск..."
                   @endif
                   aria-label="Search"/>
        </form>
        <span class="search2"><i class="fa-light fa-x"></i></span>
    </div>
</div>

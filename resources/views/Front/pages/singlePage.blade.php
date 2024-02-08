@extends('Front.Layouts.front')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h2 class="image-title">{{$blogTranslation->title}}</h2>
                <p>{!! $blogTranslation->description !!}</p>
            @else
                <h2 class="image-title">Translation Not Available</h2>
                <p>Description Not Available</p>
            @endif
        </div>
        @endforeach



        <div class="comment">
            <h3>Add a comment</h3>
            <p>Your email address will not be shared. All fields marked with an * are required</p>

            <form id="comment-form">
                <label for="comment">Comment *</label>
                <textarea id="comment" name="comment" required></textarea>

                <div class="comment-input action='#' method='post' onsubmit='event.preventDefault()';">
                    <div>
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="email">Email address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="save-info" name="saveInfo">
                    <label for="save-info">Remember me</label>

                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <script>
                        function onSubmit(token) {
                            document.getElementById("comment-form").submit();
                        }
                    </script>
                    <div class="g-recaptcha" data-sitekey="SITENİZİN_SITE_KEY_GİRİN"></div>
                </div>

                <button type="submit" onclick="grecaptcha.execute()">Send</button>
            </form>

        </div>
        <div class="others-section">
            <h1>Other articles</h1>
            <div class="cols">
                <div class="col-1">
                    <img src="{{asset('assets/front/images/img.png')}}" alt="">
                    <p class="article-title">Article's title</p>
                </div>
                <div class="col-2">
                    <img src="{{asset('assets/front/images/img.png')}}" alt="">
                    <p class="article-title">Article's title</p>
                </div>
                <div class="col-3">
                    <img src="{{asset('assets/front/images/img.png')}}" alt="">
                    <p class="article-title">Article's title</p>
                </div>
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

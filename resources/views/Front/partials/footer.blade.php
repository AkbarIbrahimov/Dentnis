<footer class="footerMain">
    <div class="top-footer">
        @php
            $currentLocale = session()->get('locale');

            if ($currentLocale === null) {
                $currentLocale = 'tr';
            }
            $language=\App\Models\Language::where('lang',$currentLocale)->first();
            $languageId=$language->id;
        @endphp
        <h2>
            @if($languageId==1)
                Diş Estetiği ile ilgili sorunlarınız mı var?
            @elseif($languageId==2)
                Do you have problems with Dental Aesthetics?
            @elseif($languageId==3)
                Есть ли у вас проблемы с эстетической стоматологией?
            @endif
        </h2>
        <a href="{{route('front.contact')}}">
            @if($languageId==1)
                Bize ulaşın
            @elseif($languageId==2)
                Contact us
            @elseif($languageId==3)
                связаться с нами
            @endif
        </a>
    </div>
    <div class="bottom-footer">
        <div class="upper">
            <div class="logo-part">
                <img src="{{asset("storage/$settings->bottom_logo")}}" alt="">
                <div class="address">
                    <p class="address-line">Adres: {{$settings->address}}</p>
                    <p class="phone-number">Telefon: {{$settings->phone}}</p>
                    <p class="email">Mail: {{$settings->mail}}</p>
                </div>
            </div>
            <div class="titles-part">
                @foreach($blogs as $blog)
                    @foreach($blog->translations->where('language_id', $languageId) as $translation)
                        <p><a href="{{route('front.singlePage',['slug'=>$blog->slug])}}" class="footer-li" >{{$translation->title}}</a></p>

                    @endforeach

                @endforeach
            </div>
        </div>
        <div class="lower">
            <p>© 2024 Tüm hakları www.dentnis.com’a aittir.</p>
            <p>Dentnis.com'da yer alan tüm içerikler sadece kullanıcıyı bilgilendirmek amacı ile sunulmuş olup tıbbi tedavi anlamında tavsiye niteliği taşımamaktadır.</p>
        </div>
    </div>
</footer>

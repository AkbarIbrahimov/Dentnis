@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Edit AboutUs</h2>
        <form action="{{route('admin.aboutUsEdit',['id'=>$aboutUs->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="btn">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            @foreach(config('app.languages') as $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                       id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#tab-{{$lang}}" role="tab"
                                       aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach(config('app.languages') as $index => $lang)
                                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$lang}}" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="form-group">
                                        @php
                                            $langId=\App\Models\Language::where('lang',$lang)->first()->id
                                        @endphp
                                        <label for="summernote">Description</label>
                                        <textarea type="text" placeholder="Description" name="{{$lang}}[description]"
                                                  class="form-control summernote" id="summernote">{{ old($lang.'.description', $aboutUs->translations->where('language_id', $langId)->first()->description ?? '') }}</textarea>
                                        @error("$lang.description")
                                        <span class="text-danger">{{$message}}</span>
                                        <br>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" onclick="this.disabled=true;this.form.submit();">Edit AboutUs</button>
        </form>
    </div>
    <!-- Include Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Include Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabs = new bootstrap.Tab(document.querySelector('#custom-tabs-one-home-tab'));
            tabs.show();

            $('.summernote').each(function () {
                $(this).summernote({
                    placeholder: $(this).attr('placeholder'),
                    height: 200,
                });
            });
        });
    </script>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/add.css')}}">
@endpush

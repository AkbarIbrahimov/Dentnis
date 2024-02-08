@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Edit Team</h2>
        <form action="{{route('admin.teamEdit',['id'=>$teams->id])}}" method="post" enctype="multipart/form-data">
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
                                        <label for="{{$lang}}-position">Position</label>
                                        <input type="text" name="{{$lang}}[position]" class="form-control" id="{{$lang}}-position" value="{{ old($lang.'.title', $teams->translations->where('language_id', $langId)->first()->position ?? '') }}">
                                        @error("$lang.position")
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
            <label for="itemImg">Image:</label>
            <input type="file" id="itemImg" name="itemImg">
            <label for="title">Title:</label>
            <input class="form-control" type="text" id="title" name="title" value="{{$teams->title}}">
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit">Create</button>
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

            @foreach(config('app.languages') as $index => $lang)
            new Summernote($('#summernote{{$index}}'), {
                placeholder: 'desc{{$lang}}',
                height: 200,
            });
            @endforeach
        });
    </script>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/add.css')}}">
@endpush

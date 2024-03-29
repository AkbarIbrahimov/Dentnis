@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Create Tv-Program</h2>
        <form action="{{route('admin.settingCreate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="topLogo">TopLogo:</label>
            <input type="file" id="topLogo" name="topLogo" value="{{old('topLogo')}}">
            @error('topLogo')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="bottomLogo">BottomLogo:</label>
            <input type="file" id="bottomLogo" name="bottomLogo" value="{{old('bottomLogo')}}">
            @error('bottomLogo')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="address">Adsress:</label>
            <input class="form-control" type="text" id="address" name="address" value="{{old('address')}}">
            @error('address')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="mail">Mail:</label>
            <input class="form-control" type="email" id="mail" name="mail" value="{{old('mail')}}">
            @error('mail')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="phone">Phone:</label>
            <input class="form-control" type="text" id="phone" name="phone" value="{{old('phone')}}">
            @error('phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit" onclick="this.disabled=true;this.form.submit();">Create Setting</button>
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
@push('js')
    <script src="{{asset('assets/admin/js/add.js')}}"></script>
@endpush


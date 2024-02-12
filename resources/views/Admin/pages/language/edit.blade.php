@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Edit Blog</h2>
        <form action="{{route('admin.languageEdit',['id'=>$languages->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="lang">Language:</label>
            <input type="text" class="form-control" id="lang" name="lang" value="{{$languages->lang}}">
            @error('$lang')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="itemImg">Image:</label>
            <input type="file" id="itemImg" name="itemImg">
            <button type="submit" onclick="this.disabled=true;this.form.submit();">Edit Language</button>
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

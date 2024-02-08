@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Create Slider</h2>
        <form action="{{route('admin.sliderCreate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name">
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="url">Url:</label>
            <input class="form-control" type="text" id="url" name="url">
            @error('url')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="itemImg">Image:</label>
            <input type="file" id="itemImg" name="itemImg">
            @error('itemImg')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="quote-status">
                <label for="Status">Status:</label>
                <select class="form-select" id="Status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
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
@push('js')
    <script src="{{asset('assets/admin/js/add.js')}}"></script>
@endpush


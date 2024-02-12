@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Edit Setting</h2>
        <form action="{{route('admin.contactFormEdit',['id'=>$contact->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="fName">FirstName:</label>
            <input type="text" id="fName" name="fName" value="{{$contact->firstname }}">
            @error('fName')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{$contact->phone}}">
            @error('phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="email">Email:</label>
            <input class="form-control" type="email" id="email" name="email" value="{{$contact->email}}">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="title">Title:</label>
            <input class="form-control" type="text" id="title" name="title" value="{{$contact->title}}">
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="message">Message:</label>
            <input class="form-control" type="text" id="message" name="message" value="{{$contact->message}}">
            @error('message')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label for="accept">Kvkk accepted:</label>
            <input class="form-control" type="checkbox" id="accept" name="accept" {{ $contact->kvkk_accepted ? 'checked' : '' }}>
            @error('accept')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit" onclick="this.disabled=true;this.form.submit();">Edit Contact</button>
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

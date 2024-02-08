@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Language</h3>
            <form action="{{route('admin.showLanguageCreate')}}" method="get">
                <button>Add Language</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Language</th>
                <th>Image</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            @foreach($languages as $language)
                <tbody>
                <td><a href="{{route('admin.languageEditView',['id'=>$language->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                <td>{{$language->id}}</td>
                <td>{{$language->lang}}</td>
                <td><img src="{{asset("storage/$language->image")}}" alt="image{{$language->id}}"></td>
                <td>{{$language->created_at?$language->created_at->format('Y/m/d'):''}}</td>
                <td ><a href="{{route('admin.languageDelete',['id'=>$language->id])}}"><i class="fa-duotone fa-trash"></i></a></td>
                </tbody>
            @endforeach

        </table>
    </div>

@endsection

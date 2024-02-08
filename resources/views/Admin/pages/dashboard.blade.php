@extends('Admin.layouts.admin')
@section('content')
    <div class="head">
        <h2 >Admins</h2>
        <a href="{{route('admin.adminCreate')}}"><button>Add Admin</button></a>
    </div>
    <div id="appointments" class="table-container">
        @foreach($userprofile as $user)
            <div class="profile-container">
                <h2>Welcome, {{$user->name}}!</h2>
                <img src="{{$user->image}}" alt="Profile Picture">
                <h2>{{$user->name}}</h2>
                <p>Email: {{$user->email}}</p>
                <p>Role: Administrator</p>
            </div>
        @endforeach
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Email</th>
                <th>Created_at</th>
            </tr>
            </thead>
            @foreach($users as $user)

            <tbody>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td><img src="{{$user->image}}" alt=""></td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at?$user->created_at->format('Y/m/d'):''}}</td>
            </tbody>
            @endforeach

        </table>
    </div>
@endsection

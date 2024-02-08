@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Icon</h3>
            <form action="{{route('admin.showIconCreate')}}" method="get">
                <button>Add Icon</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Image</th>
                <th>Url</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($icons as $icon)
                <tr>
                    <td><a href="{{route('admin.showIconEdit',['id'=>$icon->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                    <td>{{$icon->id}}</td>
                    <td><img src="{{asset("storage/$icon->image")}}" alt="image{{$icon->id}}"></td>
                    <td>{{$icon->url}}</td>
                    <td>{{$icon->created_at ? $icon->created_at->format('Y/m/d') : ''}}</td>
                    <td><a href="{{route('admin.iconDelete',['id'=>$icon->id])}}"><i class="fa-duotone fa-trash"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

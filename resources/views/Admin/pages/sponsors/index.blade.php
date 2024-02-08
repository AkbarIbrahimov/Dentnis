@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Sponsors</h3>
            <form action="{{route('admin.showSponsorCreate')}}" method="get">
                <button>Add Sponsor</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Image</th>
                <th>Status</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($sponsors as $sponsor)
                <tr>
                    <td><a href="{{route('admin.showSponsorEdit',['id'=>$sponsor->id])}}"><i
                                class="fa-duotone fa-pen-nib"></i></a></td>
                    <td>{{$sponsor->id}}</td>
                    <td><img src="{{asset("storage/$sponsor->image")}}" alt="image{{$sponsor->id}}"></td>
                    <td>{{$sponsor->status}}</td>
                    <td>{{$sponsor->created_at ? $sponsor->created_at->format('Y/m/d') : ''}}</td>
                    <td ><a href="{{route('admin.sponsorDelete',['id'=>$sponsor->id])}}"><i
                                class="fa-duotone fa-trash"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

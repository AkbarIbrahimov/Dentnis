@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>DoctorImage</h3>
            <form action="{{route('admin.showDoctorImageCreate')}}" method="get">
                <button>Add DoctorImage</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Image</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($doctorImages as $doctorImage)
                <tr>
                    <td><a href="{{route('admin.showDoctorImageEdit',['id'=>$doctorImage->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                    <td>{{$doctorImage->id}}</td>
                    <td><img src="{{asset("storage/$doctorImage->image")}}" alt="image{{$doctorImage->id}}"></td>
                    <td>{{$doctorImage->created_at ? $doctorImage->created_at->format('Y/m/d') : ''}}</td>
                    <td><a href="{{route('admin.DoctorImageDelete',['id'=>$doctorImage->id])}}"><i class="fa-duotone fa-trash"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Sliders</h3>
            <form action="{{route('admin.showSliderCreate')}}" method="get">
                <button>Add Slider</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Name</th>
                <th>Url</th>
                <th>Image</th>
                <th>Status</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($sliders as $slider)
                <tr>
                    <td><a href="{{route('admin.showSliderEdit',['id'=>$slider->id])}}"><i
                                class="fa-duotone fa-pen-nib"></i></a></td>
                    <td>{{$slider->id}}</td>
                    <td>{{$slider->name}}</td>
                    <td>{{$slider->url}}</td>
                    <td><img src="{{asset("storage/$slider->image")}}" alt="image{{$slider->id}}"></td>
                    <td>{{$slider->status}}</td>
                    <td>{{$slider->created_at ? $slider->created_at->format('Y/m/d') : ''}}</td>
                    <td><a href="{{route('admin.sliderDelete',['id'=>$slider->id])}}"><i
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

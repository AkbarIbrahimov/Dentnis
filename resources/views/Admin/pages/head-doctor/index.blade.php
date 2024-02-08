@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>HeadDoctor</h3>
            <form action="{{route('admin.showHeadDoctorCreate')}}" method="get">
                <button>Add HeadDoctor</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Description</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($headDoctor as $head)
                @foreach($head->translations->where('language_id','1') as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td><a href="{{route('admin.showHeadDoctorEdit',['id'=>$head->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$head->id}}</td>
                        <td>{{Str::limit($translation->description,100)}}</td>
                        <td>{{$head->created_at ? $head->created_at->format('Y/m/d') : ''}}</td>
                        <td><a href="{{route('admin.HeadDoctorDelete',['id'=>$head->id])}}"><i class="fa-duotone fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

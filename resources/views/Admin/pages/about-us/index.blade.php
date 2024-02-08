@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>AboutUs</h3>
            <form action="{{route('admin.showAboutUsCreate')}}" method="get">
                <button>Add AboutUs</button>
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
            @foreach($aboutUs as $us)
                @foreach($us->translations->where('language_id','1') as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td><a href="{{route('admin.showAboutUsEdit',['id'=>$us->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$us->id}}</td>
                        <td>{{Str::limit($translation->description,100)}}</td>
                        <td>{{$us->created_at ? $us->created_at->format('Y/m/d') : ''}}</td>
                        <td><a href="{{route('admin.aboutUsDelete',['id'=>$us->id])}}"><i class="fa-duotone fa-trash"></i></a></td>
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

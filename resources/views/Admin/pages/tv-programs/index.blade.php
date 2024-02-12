@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Tv-Program</h3>
            <form action="{{route('admin.showTvProgramCreate')}}" method="get">
                <button>Add TvProgram</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Title</th>
                <th>Url</th>
                <th>Status</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($tvPrograms as $tvProgram)
                    <tr>
                        <td><a href="{{route('admin.showTvProgramEdit',['id'=>$tvProgram->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$tvProgram->id}}</td>
                        <td>{{Str::limit($tvProgram->title,20)}}</td>
                        <td>{{Str::limit($tvProgram->url,100)}}</td>
                        <td>{{$tvProgram->status}}</td>
                        <td>{{$tvProgram->created_at ? $tvProgram->created_at->format('Y/m/d') : ''}}</td>
                        <td><a href="{{route('admin.tvProgramDelete',['id'=>$tvProgram->id])}}" onclick="return confirmDelete();"
                            ><i class="fa-duotone fa-trash"></i></a></td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu TvProgram yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

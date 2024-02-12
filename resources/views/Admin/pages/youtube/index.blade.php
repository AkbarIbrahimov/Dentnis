@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Youtube</h3>
            <form action="{{route('admin.showYoutubeCreate')}}" method="get">
                <button>Add Youtube</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Url</th>
                <th>Status</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            @foreach($youtubes as $youtube)
                <tbody>
                <td><a href="{{route('admin.youtubeEditView',['id'=>$youtube->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                <td>{{$youtube->id}}</td>
                <td>{{$youtube->url}}</td>
                <td>{{$youtube->status}}</td>
                <td>{{$youtube->created_at?$youtube->created_at->format('Y/m/d'):''}}</td>
                <td ><a href="{{route('admin.youtubeDelete',['id'=>$youtube->id])}}" onclick="return confirmDelete();"
                    ><i class="fa-duotone fa-trash"></i></a></td>
                </tbody>
            @endforeach

        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu Youtube yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>

@endsection

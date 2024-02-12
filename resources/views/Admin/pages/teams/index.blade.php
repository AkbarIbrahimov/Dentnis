@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Team</h3>
            <form action="{{route('admin.showTeamCreate')}}" method="get">
                <button>Add Team</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Img</th>
                <th>Title</th>
                <th>Position</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($teams as $team)

                @foreach($team->translations->where('language_id',1) as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td><a href="{{route('admin.showTeamEdit',['id'=>$team->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$team->id}}</td>
                        <td><img src="{{asset("storage/$team->image")}}" alt="image{{$team->id}}"></td>
                        <td>{{$team->title}}</td>
                        <td>{{$translation->position}}</td>
                        <td>{{$team->created_at ? $team->created_at->format('Y/m/d') : ''}}</td>
                        <td><a href="{{route('admin.teamDelete',['id'=>$team->id])}}" onclick="return confirmDelete();"
                            ><i class="fa-duotone fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu Team yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>

@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

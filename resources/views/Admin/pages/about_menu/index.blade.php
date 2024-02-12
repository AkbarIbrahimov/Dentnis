@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>AboutMenu</h3>
{{--            <form action="{{route('admin.showAboutMenuCreate')}}" method="get">--}}
{{--                <button>Add AboutMenu</button>--}}
{{--            </form>--}}
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Slug</th>
                <th>Title</th>
                <th>Start_date</th>
{{--                <th>Delete</th>--}}
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($aboutMenu as $menu)
                @foreach($menu->translations->where('language_id','1') as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td><a href="{{route('admin.showAboutMenuEdit',['id'=>$menu->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->slug}}</td>
                        <td>{{$translation->title}}</td>
                        <td>{{$menu->created_at ? $menu->created_at->format('Y/m/d') : ''}}</td>
{{--                        <td><a href="{{route('admin.aboutMenuDelete',['id'=>$menu->id])}}" onclick="return confirmDelete();"--}}
{{--                            ><i class="fa-duotone fa-trash"></i></a></td>--}}
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu AboutMenu yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>

@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Category</h3>
            <form action="{{route('admin.showCategoryCreate')}}" method="get">
                <button>Add Category</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($categories as $category)
                @foreach($category->translations->where('language_id','1') as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td style="text-align: center"><a href="{{route('admin.categoryEditView',['id'=>$category->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$category->id}}</td>
                        <td>{{$translation->name}}</td>
                        <td>{{$translation->slug}}</td>
                        <td>{{$category->created_at ? $category->created_at->format('Y/m/d') : ''}}</td>
                        <td style="text-align: center"><a href="{{route('admin.categoryDelete',['id'=>$category->id])}}" onclick="return confirmDelete();"><i class="fa-duotone fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu Category yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Blog</h3>
            <form action="{{route('admin.showBlogCreate')}}" method="get">
                <button>Add Blog</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Category Name</th>
                <th>Img</th>
                <th>Slug</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($blogs as $blog)
                @foreach($blog->translations->where('language_id','1') as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td style="text-align: center"><a href="{{route('admin.showBlogEdit',['id'=>$blog->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$blog->id}}</td>
                        <td>
                            @php
                                $category = $blog->category->where('language_id', 1)->first();
                            @endphp
                            @if ($category && $category->name !== null)
                                {{$category->name}}
                            @else
                                Hakkımızda
                            @endif
                        </td>
                        <td><img src="{{asset("storage/$blog->image")}}" alt="image{{$blog->id}}"></td>
                        <td>{{$blog->slug}}</td>
                        <td>{{$translation->title}}</td>
                        <td>{{Str::limit($translation->description,40)}}</td>
                        <td>{{$blog->created_at ? $blog->created_at->format('Y/m/d') : ''}}</td>
                        <td style="text-align: center"><a href="{{route('admin.blogDelete',['id'=>$blog->id])}}" onclick="return confirmDelete();"><i class="fa-duotone fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu bloq yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

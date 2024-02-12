@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Quotes</h3>
            <form action="{{route('admin.showQuoteCreate')}}" method="get">
                <button>Add Quote</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>Image</th>
                <th>Status</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($quotes as $quote)

                @foreach($quote->translations->where('language_id',1) as $translation)
                    <tr class="language-{{$translation->language_id}}">
                        <td style="text-align: center"><a href="{{route('admin.showQuoteEdit',['id'=>$quote->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                        <td>{{$quote->id}}</td>
                        <td><img src="{{asset("storage/$quote->image")}}" alt="image{{$quote->id}}"></td>
                        <td>{{$quote->status}}</td>
                        <td>{{$translation->title}}</td>
                        <td>{{Str::limit($translation->description,40)}}</td>
                        <td>{{$quote->created_at ? $quote->created_at->format('Y/m/d') : ''}}</td>
                        <td style="text-align: center"><a href="{{route('admin.quoteDelete',['id'=>$quote->id])}}" onclick="return confirmDelete();"><i class="fa-duotone fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu Quotes yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

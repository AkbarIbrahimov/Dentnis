@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Setting</h3>
{{--            <form action="{{route('admin.showSettingCreate')}}" method="get">--}}
{{--                <button>Add Setting</button>--}}
{{--            </form>--}}
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>TopLogo</th>
                <th>BottomLogo</th>
                <th>Address</th>
                <th>Mail</th>
                <th>Phone</th>
                <th>Start_date</th>
{{--                <th>Delete</th>--}}
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($settings as $setting)
                <tr>
                    <td><a href="{{route('admin.showSettingEdit',['id'=>$setting->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                    <td>{{$setting->id}}</td>
                    <td><img src="{{asset("storage/$setting->top_logo")}}" alt="image{{$setting->id}}"></td>
                    <td><img src="{{asset("storage/$setting->bottom_logo")}}" alt="image{{$setting->id}}"></td>
                    <td>{{$setting->address}}</td>
                    <td>{{$setting->mail}}</td>
                    <td>{{$setting->phone}}</td>
                    <td>{{$setting->created_at ? $setting->created_at->format('Y/m/d') : ''}}</td>
{{--                    <td><a href="{{route('admin.settingDelete',['id'=>$setting->id])}}" onclick="return confirmDelete();"--}}
{{--                        ><i class="fa-duotone fa-trash"></i></a></td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bu Setting yazısını silmək istədiyinizə əminsiniz?");
        }
    </script>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

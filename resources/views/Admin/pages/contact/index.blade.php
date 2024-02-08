@extends('Admin.layouts.admin')
@section('content')
    <div id="appointments" class="table-container">
        <div class="head">
            <h3>Contact</h3>
            <form action="{{route('admin.showContactFormCreate')}}" method="get">
                <button>Add Contact</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Edit</th>
                <th>Id</th>
                <th>FirstName</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Title</th>
                <th>Message</th>
                <th>kvkk_accepted</th>
                <th>Start_date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="blogTableBody">
            @foreach($contacts as $contact)
                <tr>
                    <td><a href="{{route('admin.showContactFormEdit',['id'=>$contact->id])}}"><i class="fa-duotone fa-pen-nib"></i></a></td>
                    <td>{{$contact->id}}</td>
                    <td>{{$contact->firstname}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->title}}</td>
                    <td>{{$contact->message}}</td>
                    <td>{{$contact->kvkk_accepted}}</td>
                    <td>{{$contact->created_at ? $contact->created_at->format('Y/m/d') : ''}}</td>
                    <td><a href="{{route('admin.contactFormDelete',['id'=>$contact->id])}}"><i class="fa-duotone fa-trash"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
@endpush

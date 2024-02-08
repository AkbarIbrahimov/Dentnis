@extends('Admin.layouts.admin')
@section('content')
    <div class="container">
        <h2>Create Quote</h2>
        <form action="{{route('admin.quoteCreate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="btn">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            @foreach(config('app.languages') as $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                       id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#tab-{{$lang}}"
                                       role="tab"
                                       aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach(config('app.languages') as $index => $lang)
                                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$lang}}"
                                     role="tabpanel"
                                     aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="form-group">
                                        <label for="{{$lang}}-title">Title</label>
                                        <input type="text" placeholder="Başlıq" name="{{$lang}}[title]"
                                               value="{{old($lang.'text', isset($model) ? $model->translateOrDefault($lang)->title : '')}}"
                                               class="form-control" id="{{$lang}}-title">
                                        @error("$lang.title")
                                        <span class="text-danger">{{$message}}</span>
                                        <br>
                                        @enderror

                                        <label for="{{$lang}}-title">Description</label>
                                        <input type="text" placeholder="Başlıq" name="{{$lang}}[description]"
                                               value="{{old($lang.'description', isset($model) ? $model->translateOrDefault($lang)->description : '')}}"
                                               class="form-control" id="{{$lang}}-title">
                                        @error("$lang.description")
                                        <span class="text-danger">{{$message}}</span>
                                        <br>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <label for="itemImg">Image:</label>
            <input type="file" id="itemImg" name="itemImg">
            @error('itemImg')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="quote-status">
                <label for="quoteStatus">Status:</label>
                @php
                    $quotes = \App\Models\Quotes::with('translations', 'languages')->get();
                    $activeCount = 0;
                @endphp

                @foreach ($quotes as $quote)
                    @if ($quote->status === 'active')
                        @php
                            $activeCount++;
                        @endphp
                    @endif
                @endforeach

                <select class="form-select" id="quoteStatus" name="status">
                    @if ($activeCount === 3)
                    @else
                        <option value="active">Active</option>
                    @endif
                    <option value="inactive">Inactive</option>
                </select>
            @error('itemSlug')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit">Create</button>
        </form>
    </div>
    <!-- Include Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Include Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabs = new bootstrap.Tab(document.querySelector('#custom-tabs-one-home-tab'));
            tabs.show();

            @foreach(config('app.languages') as $index => $lang)
            new Summernote($('#summernote{{$index}}'), {
                placeholder: 'desc{{$lang}}',
                height: 200,
            });
            @endforeach
        });
    </script>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/add.css')}}">
@endpush
@push('js')
    <script src="{{asset('assets/admin/js/add.js')}}"></script>
@endpush


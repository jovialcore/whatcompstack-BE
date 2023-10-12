@extends('layouts.app')
@section('content')
    <div class="col-md-10 mx-auto">

        <div class="card mb-4">

            {{-- @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif --}}

            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger"> :message </div>')) !!}
            @endif

            <h5 class="card-header">Add Source 🐾 </h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.source.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Source name</label>
                        <input type="text" name="data_source_name" class="form-control" id="basic-default-fullname"
                            placeholder="source name" value="{{ old('data_source_name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Source Link</label>
                        <input type="text" name="data_source_url" class="form-control" id="basic-default-fullname"
                            placeholder="wwww.something.com" value="{{ old('data_source_url') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection

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

            @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif

            <h5 class="card-header">Add Company 👜</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Company Name</label>
                        <input type="text" name="name" class="form-control" id="basic-default-fullname"
                            placeholder="Company Limited" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-message">About</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-message2" class="input-group-text"><i
                                    class="bx bx-comment"></i></span>
                            <textarea name="about" id="basic-icon-default-message" class="form-control"
                                placeholder="What is the company all about?" aria-label="Hi, Do you have a moment to talk Joe?"
                                aria-describedby="basic-icon-default-message2">{{ old('about') }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-company">Url</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="bx bx-buildings"></i></span>
                            <input name="url" type="text" id="basic-icon-default-company" class="form-control"
                                placeholder="https://company.com" aria-label="ACME Inc."
                                aria-describedby="basic-icon-default-company2" value="{{ old('url') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-company">Source Slug</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="bx bx-code-curly "></i></span>
                            <input name="source_slug" type="text" id="basic-icon-default-company" class="form-control"
                                placeholder="Job source slug." aria-label="JOb source slug."
                                aria-describedby="basic-icon-default-company2" value="{{ old('source_slug') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CEO Name</label>
                        <input type="text" name="ceo" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" value="{{ old('ceo') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CEO Contact</label>
                        <input type="text" name="ceo_contact" class="form-control" id="basic-default-fullname"
                            placeholder="https://ceo-contact-url.com" value="{{ old('ceo_contact') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CTO Name</label>
                        <input type="text" name="cto" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" value="{{ old('cto') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CTO Contact</label>
                        <input type="text" name="cto_contact" class="form-control" id="basic-default-fullname"
                            placeholder="https://cto-contact-url.com" value="{{ old('cto_contact') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Hr Name</label>
                        <input type="text" name="hr" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" value="{{ old('hr') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Hr Contact</label>
                        <input type="text" name="hr_contact" class="form-control" id="basic-default-fullname"
                            placeholder="https://hr-contact-url.com" value="{{ old('hr_contact') }}">
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Company Logo</label>
                        <input class="form-control" name="logo" type="file" id="formFile" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection

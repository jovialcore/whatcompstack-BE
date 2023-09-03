@extends('layouts.app')
@section('content')
    <div class="col-md-10 mx-auto">

        <div class="card mb-4">
            <h5 class="card-header">Add Company 👜</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.datasource.initialize') }}">
                    @csrf()

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-message">About</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-message2" class="input-group-text"><i
                                    class="bx bx-comment"></i></span>
                            <textarea name="about" id="basic-icon-default-message" class="form-control"
                                placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                aria-describedby="basic-icon-default-message2"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-company">Url</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="bx bx-buildings"></i></span>
                            <input name="url" type="text" id="basic-icon-default-company" class="form-control"
                                placeholder="ACME Inc." aria-label="ACME Inc."
                                aria-describedby="basic-icon-default-company2" />
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CEO Name</label>
                        <input type="text" name="ceo_name" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CEO Contact</label>
                        <input type="text" name="ceo_contact" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CTO Name</label>
                        <input type="text" name="ceo_name" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">CTO Contact</label>
                        <input type="text" name="cto_contact" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Hr Name</label>
                        <input type="text" name="company_name" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Hr Contact</label>
                        <input type="text" name="company_name" class="form-control" id="basic-default-fullname"
                            placeholder="John Doe" />
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" id="formFile" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

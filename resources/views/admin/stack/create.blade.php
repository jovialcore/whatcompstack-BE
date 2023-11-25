@extends('layouts.app')
@section('content')
    @push('select2style')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <div class="col-md-10 mx-auto">

        <div class="card mb-4">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger"> :message </div>')) !!}
            @endif

            <h5 class="card-header">Add Stack 🌠</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Company </label>
                        <select name="company" class="form-select stackSelect2Multi" id="exampleFormControlSelect1"
                            aria-label="Default select example" multiple>
                            <option value="all"> All companies are here </option>

                            <option value="all"> Second company </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Select stack </label>
                        <select name="company" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">
                            <option value="all"> All companies are here </option>

                            <option value="all"> Second company </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>


    @push('select2script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(".stackSelect2Multi").select2({

            });
        </script>
    @endpush
@endsection

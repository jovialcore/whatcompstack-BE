@extends('layouts.app')
@section('content')
    <h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Stack /</span> Add Stack </h4>

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
                <form method="POST" action="{{ route('admin.stack.backend.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Select Company </label>
                        <select name="company" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">
                            @foreach ($allStackInfo['allCompanies'] as $company)
                                <option value="{{ $company->id }}"> {{ $company->name }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Programming Language </label>
                        <select name="plangs[]" class="form-select stackSelect2MultiPlang" id=""
                            aria-label="Default select example" multiple>
                            @foreach ($allStackInfo['allPlangs'] as $plang)
                                <option value="{{ $plang->id }}"> {{ $plang->name }} </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Programming Language </label>
                        <select name="frameworks[]" class="form-select stackSelect2MultiFramework" id=""
                            aria-label="Default select example" multiple>
                            @foreach ($allStackInfo['allFrameworks'] as $framework)
                                <option value="{{ $framework->id }}"> {{ $framework->name }} </option>
                            @endforeach

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
            $(".stackSelect2MultiPlang").select2({

                placeholder: "Select Programming Language"

            });
            $(".stackSelect2MultiFramework").select2({
                placeholder: "Select Framework"
            });
        </script>
    @endpush
@endsection

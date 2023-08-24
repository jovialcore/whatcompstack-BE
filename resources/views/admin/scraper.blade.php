@extends('layouts.app')
@section('content')
    <div class="col-md-10 mx-auto">
        <div class="card mb-4">
            <h5 class="card-header">Initiate Data  Sourcing🪚</h5>
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Company </label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Choose company </option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">stack </label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Choose a stack from here </option>
                        @foreach ($stacks as $stack)
                            <option value="{{ $stack->id }}">{{ $stack->name }} 🌊 </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Data source </label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Choose a source </option>
                        @foreach ($dataSources as $ds)
                            <option value="{{ $ds->id }}">{{ $ds->name }} </option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-primary">Shoot !</button>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="col-md-10 mx-auto">

        <div class="card mb-4">
            <h5 class="card-header">Initiate Data Sourcing🪚</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.datasource.initialize') }}">
                    @csrf()
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Company </label>
                        <select name="company" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">

                            @foreach ($companies as $company)
                                <option value="{{ $company->name }}">{{ $company->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">stack </label>
                        <select name="stack" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">

                            @foreach ($stacks as $stack)
                                <option value="{{ $stack->name }}">{{ $stack->name }} 🌊 </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Data source </label>
                        <select name="data_source" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">

                            @foreach ($dataSources as $ds)
                                <option value="{{ $ds->url }}">{{ $ds->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kick off !</button>
                </form>
            </div>
        </div>
    </div>
@endsection

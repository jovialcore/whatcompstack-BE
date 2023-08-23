@extends('layouts.app')
@section('content')
    <div class="col-md-10 mx-auto">
        <div class="card mb-4">
            <h5 class="card-header">Reinitiate Data 🪚</h5>
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Company </label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Choose company </option>
                        <option value="1">Company One </option>
                        <option value="2">Company two </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">stack </label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Choose a stack from here </option>
                        <option value="1">Backend 🌊 </option>
                        <option value="2">Frontend 🌪️</option>
                        <option value="3">Devops 🌤️</option>
                        <option value="4">Product Design 🌕</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Data source </label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Choose a source </option>
                        <option value="1">Source one </option>
                        <option value="2">Source two</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary">Shoot !</button>
            </div>
        </div>
    </div>
@endsection

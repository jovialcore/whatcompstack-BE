@extends('layouts.app')
@section('content')
    <div class="col-lg-12 col-md-4 order-1">
        <h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Stack /</span> Add Backend Stack </h4>

        <div class="row">

            <div class="col-sm-6 col-lg-4 mb-4">
                <a href="{{ route('admin.stack.backend.create') }}">
                    <div class="card bg-white text-dark  p-2">
                        <div class="card-body">
                            <h5 class="card-title">Backend</h5>
                            <p class="card-text">Select to add backend tools </p>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-sm-6 col-lg-4 mb-4">

                <a href="{{ route('admin.stack.frontend.create') }}">
                    <div class="card bg-white text-dark  p-2">
                        <div class="card-body">
                            <h5 class="card-title">Frontend </h5>
                            <p class="card-text">Select to add frontend tools </p>
                        </div>
                    </div>

                </a>
            </div>



            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card bg-white text-dark  p-2">
                    <div class="card-body">
                        <h5 class="card-title ">Product Design <span class="badge bg-label-dark"
                                style="font-size: 12px;">Upcoming</span> </h5>
                        <p class="card-text">Select to add product design tools</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

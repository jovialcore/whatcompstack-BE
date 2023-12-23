@extends('layouts.app')
@section('content')
    <div class="col-md-11 mx-auto">
        <div class="card">
            <h5 class="card-header">{{ $company->name }}</h5>

            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <div class="">
                        <img src="{{ $company->logo }}" alt="user-avatar" class="d-block rounded" height="100" width="100"
                            id="uploadedAvatar" />
                    </div>
                    <div class="button-wrapper">
                        <p class="text-dark mb-0">{{ $company->about }}</p>
                    </div>
                </div>
            </div>

            <hr class="my-0" />
        </div>

        <div class="col-xl-12 mt-3">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-backend" aria-controls="navs-top-home" aria-selected="true">
                            Backend
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                            Frontend
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-mobile" aria-controls="navs-top-profile" aria-selected="false">
                            Mobile
                        </button>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-backend" role="tabpanel">


                        @if (count($company->plangs) > 0)
                            @foreach ($company->plangs as $plang)
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('/assets/img/icons/brands/google.png') }}" alt="google"
                                            class="me-3" height="30" />
                                    </div>
                                    <div class="flex-grow-1 row">
                                        <div class="col-9 mb-sm-0 mb-2">
                                            <h6 class="mb-0">{{ $plang->name }}</h6>
                                            <small class="text-muted">Rated {{ $plang->pivot->rating }}</small>
                                        </div>
                                        <div class="col-3 text-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input float-end" type="checkbox" role="switch" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Stack yet </p>
                        @endif




                    </div>

                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                        @if (isset($company->feFrameworks) && count($company->feFrameworks) > 0)
                            @foreach ($company->feFrameworks as $plang)
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('/assets/img/icons/brands/google.png') }}" alt="google"
                                            class="me-3" height="30" />
                                    </div>
                                    <div class="flex-grow-1 row">
                                        <div class="col-9 mb-sm-0 mb-2">
                                            <h6 class="mb-0">{{ $plang->name }}</h6>
                                            <small class="text-muted">Rated {{ $plang->pivot->rating }}</small>
                                        </div>
                                        <div class="col-3 text-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input float-end" type="checkbox" role="switch" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Frontend yet </p>
                        @endif

                    </div>

                    <div class="tab-pane fade" id="navs-top-mobile" role="tabpanel">
                        @if (count($company->mobilePlangs) > 0)
                            @foreach ($company->mobilePlangs as $plang)
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('/assets/img/icons/brands/google.png') }}" alt="google"
                                            class="me-3" height="30" />
                                    </div>
                                    <div class="flex-grow-1 row">
                                        <div class="col-9 mb-sm-0 mb-2">
                                            <h6 class="mb-0">{{ $plang->name }}</h6>
                                            <small class="text-muted">Rated {{ $plang->pivot->rating }}</small>
                                        </div>
                                        <div class="col-3 text-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input float-end" type="checkbox" role="switch" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Mobile Stack yet </p>
                        @endif

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

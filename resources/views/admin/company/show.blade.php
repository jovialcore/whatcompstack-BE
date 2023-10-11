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
                            data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                            Devops
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-backend" role="tabpanel">

                        <p>Display content from your connected accounts on your site</p>
                        <!-- Connections -->
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

                        <!-- /Connections -->

                    </div>

                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                        <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                            cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice
                            cream
                            cheesecake fruitcake.
                        </p>
                        <p class="mb-0">
                            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu
                            halvah
                            cotton candy liquorice caramels.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                        <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon
                            gummies
                            cupcake gummi bears cake chocolate.
                        </p>
                        <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake.
                            Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding
                            jelly
                            jelly-o tart brownie jelly.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

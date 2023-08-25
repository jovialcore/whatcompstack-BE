@extends('layouts.app')
@section('content')
    <div class="col-md-12 mx-auto">
        <div class="accordion mt-3" id="accordionExample">
            <div class="card accordion-item active">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
                        aria-expanded="true" aria-controls="accordionOne">
                        Existing Stack Preview 🕵️‍♀️
                    </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Frontend:
                        <br>
                        Backend:
                        <br>
                        Design
                        <br>
                        Devops
                        <br>
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                        Newly Sourced Stack 🍖
                    </button>
                </h2>
                <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Frontend:
                        <br>
                        Backend:
                        <br>
                        Design
                        <br>
                        Devops
                        <br>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

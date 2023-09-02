@extends('layouts.app')
@section('content')
    <div class="col-md-12 ">
        <div class="accordion mt-3" id="accordionExample">
            <div class="card accordion-item active">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
                        aria-expanded="true" aria-controls="accordionOne">
                        Existing Stack Preview 🕵️‍♀️
                    </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body" style="padding:0px 7px 0px 7px;">


                        <div class="table-responsive texwrap">
                            <table class="table table-borderless table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Programming Language</th>
                                        <th>Framework</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($oldResult->plangs as $result)
                                        <tr>
                                            <td class="py-2"><i class="fab fa-angular fa-lg text-danger "></i>
                                                {{ $result->name }}
                                                <span
                                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">
                                                    {{ $result->pivot->draft_rating }}</span>
                                            </td>
                                            <td> {{ $result->frameworks[0]->name ?? ' -- ' }}
                                                @if (isset($result->frameworks[0]->companies[0]->pivot->draft_rating))
                                                    <span
                                                        class="  badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $result->frameworks[0]->companies[0]->pivot->draft_rating ?? 'None ' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    <div class="accordion-body" style="padding:0px 7px 0px 7px;">


                        <div class="table-responsive texwrap">
                            <table class="table table-borderless table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Programming Language</th>
                                        <th>Framework</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($newResult->plangs as $result)
                                        <tr>
                                            <td class="py-2"><i class="fab fa-angular fa-lg text-danger "></i>
                                                {{ $result->name }}
                                                <span
                                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">
                                                    {{ $result->pivot->draft_rating }}</span>
                                            </td>
                                            <td> {{ $result->frameworks[0]->name ?? ' -- ' }}
                                                @if (isset($result->frameworks[0]->companies[0]->pivot->draft_rating))
                                                    <span
                                                        class="  badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $result->frameworks[0]->companies[0]->pivot->draft_rating ?? 'None ' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.preview.result.confirm') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary  mt-3">Confirm results</button>
            </form>
        </div>
    </div>
@endsection

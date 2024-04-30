@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="card mt-3 col-3">
            <div class="card-content">
                <div class=" m-0">
                    <div class=" border-light">
                        <div class="card-body">
                            <h5 class="text-white mb-0">
                                Caisse:
                                <span class="float-right">
                                    @if (isset($caisse->montant))
                                        {{ $caisse->montant }}
                                    @else
                                        0
                                    @endif
                                    DT
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

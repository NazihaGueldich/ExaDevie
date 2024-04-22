@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Historiques Payement De M(e).{{$employe->nom}} {{$employe->pnom}}</h5>
                    </div>

                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Virement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histpaymts as $histpaymt)
                            <tr>
                                <td>{{ $histpaymt->date }}</td>
                                <td>{{ $histpaymt->virement }}Dt</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

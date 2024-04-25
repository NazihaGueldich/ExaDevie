@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">{{ $titre }}</h5>
                    </div>

                </div>
                <hr>
                @if ($id == 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($id == 1)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Cause</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->date }}</td>
                                    <td>{{ $data->cause }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($id == 2)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Date Début</th>
                                <th scope="col">Date Fin</th>
                                <th scope="col">Cause</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->dateD }}</td>
                                    <td>{{ $data->dateF }}</td>
                                    <td>{{ $data->cause }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

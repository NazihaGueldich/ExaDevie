@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Devis</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('devis.create') }}" type="button" class="btn btn-light btn-round px-5"><i class="zmdi zmdi-plus"></i>
                            Ajouter</a>

                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Sujet</th>
                            <th scope="col">Client</th>
                            <th scope="col">Etat</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devis as $devi)
                            <tr>
                                <td>{{ $devi->created_at }}</td>
                                <td>{{ $devi->sujet }}</td>
                                <td>{{ $devi->clients->nom }} {{ $devi->clients->prenom }}</td>
                                <td>
                                    @if ($devi->etat == 0)
                                        En cours
                                    @elseif($devi->etat == 1)
                                        Accepter
                                    @elseif($devi->etat == 2)
                                        Refuser
                                    @endif
                                </td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <button class="btn btn-sm btn-warning m-1">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning m-1">
                                        Detaille
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Bondes Commendes</h5>
                    </div>
                    {{-- <div class="d-flex align-items-center">
                        <a href="{{ route('devis.create') }}" type="button" class="btn btn-light btn-round px-5"><i
                                class="zmdi zmdi-plus"></i>
                            Ajouter</a>

                    </div> --}}
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Numéro</th>
                            <th scope="col">Sujet</th>
                            <th scope="col">Client</th>
                            <th scope="col">MTTTC</th>
                            <th scope="col">MTHT</th>
                            <th scope="col">TVA</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factures as $facture)
                            <tr>
                                <td>{{ $facture->created_at }}</td>
                                <td>{{ $facture->num }}</td>
                                <td>{{ $facture->sujet }}</td>
                                <td>{{ $facture->clients->nom }} {{ $facture->clients->prenom }}</td>
                                <td>{{ $facture->MTTTC }}</td>
                                <td>{{ $facture->MTHT }}</td>
                                <td>{{ $facture->totTVA }}</td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <a href="{{ route('factures.pdf', ['id' => $facture->id]) }}" type="button"
                                        class="btn btn-sm btn-warning" target='_blanc'><i class="zmdi zmdi-image-alt"></i>
                                        Pdf</a>
                                    <a href="{{ route('factures.details', ['id' => $facture->id]) }}" class="btn btn-sm btn-info m-1">
                                        Detaille
                                    </a>
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

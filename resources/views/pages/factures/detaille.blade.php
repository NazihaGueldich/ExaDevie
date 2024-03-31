@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="card-title">Information du bonde commende</div>
                <hr>
                <p class="text-lg-right"><strong>Date : </strong>{{ $facture->created_at }}</p>
                <div class="d-flex justify-content-between">
                    <h4>M(e). {{ $facture->clients->nom }} {{ $facture->clients->prenom }} </h4>
                    <div>
                        @if (@isset($facture->id_devi))
                            <a href="{{ route('devis.show', $facture->id_devi) }}" type="button"
                                class="btn btn-sm btn-info"><i class="zmdi zmdi-file-text"></i>
                                Devis</a>
                        @endif
                        <a href="{{ route('factures.pdf', ['id' => $facture->id]) }}" type="button"
                            class="btn btn-sm btn-warning" target='_blanc'><i class="zmdi zmdi-image-alt"></i>
                            Pdf</a>
                    </div>
                </div>
                <hr width="300" class="ml-0">
                <h5>Sujet :</h5>
                <textarea type="text" class="form-control" disabled>{{ $facture->sujet }}</textarea>
                <hr width="300">
                <h5>Lignie de bonde commende :</h5>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Informations</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Prix Totale</th>
                            <th scope="col">TVA</th>
                            <th scope="col">THT</th>
                            <th scope="col">PTTTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ligniefactures as $ligniefacture)
                            <tr>
                                <td>
                                    @if ($ligniefacture->type == 0)
                                        Produits
                                    @else
                                        Services
                                    @endif
                                </td>
                                <td>
                                    @if ($ligniefacture->type == 0)
                                        <strong>Nom: </strong> {{ $ligniefacture->produits->nom }}
                                        <br>
                                        <strong>Quantité: </strong>{{ $ligniefacture->quantiter }}
                                    @else
                                        <strong>Designiation: </strong><br>
                                        {{ $ligniefacture->designiation }}
                                    @endif
                                </td>
                                <td> {{ $ligniefacture->prix }} DT</td>
                                <td> {{ $ligniefacture->prixT }} DT</td>
                                <td> {{ $ligniefacture->tva }}%</td>
                                <td> {{ $ligniefacture->tht }} DT</td>
                                <td> {{ $ligniefacture->ptttc }} DT</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

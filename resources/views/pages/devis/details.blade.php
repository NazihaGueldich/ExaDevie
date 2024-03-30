@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="card-title">Information du devis</div>
                <hr>
                <p class="text-lg-right"><strong>Date : </strong>{{ $devi->created_at }}</p>
                <div class="d-flex justify-content-between">
                    <h4>M(e). {{ $devi->clients->nom }} {{ $devi->clients->prenom }} </h4>
                    <div>
                        <button type="button" class="btn btn-sm btn-info"><i class="zmdi zmdi-file-text"></i>
                            Factoriser</button>
                        <button type="button" class="btn btn-sm btn-warning"><i class="zmdi zmdi-image-alt"></i>
                            Pdf</button>
                        @if ($devi->etat == 0)
                            <a href="{{ route('devis.refuser', ['id' => $devi->id]) }}" type="button"
                                class="btn btn-sm btn-danger"><i class="zmdi zmdi-delete"></i>
                                Refuser</a>
                        @endif
                    </div>
                </div>
                <hr width="300" class="ml-0">
                <h5>Sujet :</h5>
                <textarea type="text" class="form-control" disabled>{{ $devi->sujet }}</textarea>
                <hr width="300">
                <h5>Lignie de devis :</h5>
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
                        @foreach ($ligniedevis as $ligniedevi)
                            <tr>
                                <td>
                                    @if ($ligniedevi->type == 0)
                                        Produits
                                    @else
                                        Services
                                    @endif
                                </td>
                                <td>
                                    @if ($ligniedevi->type == 0)
                                        <strong>Nom: </strong> {{ $ligniedevi->produits->nom }}
                                        <br>
                                        <strong>Quantité: </strong>{{ $ligniedevi->quantiter }}
                                    @else
                                        <strong>Designiation: </strong><br>
                                        {{ $ligniedevi->designiation }}
                                    @endif
                                </td>
                                <td> {{ $ligniedevi->prix }} DT</td>
                                <td> {{ $ligniedevi->prixT }} DT</td>
                                <td> {{ $ligniedevi->tva }}%</td>
                                <td> {{ $ligniedevi->tht }} DT</td>
                                <td> {{ $ligniedevi->ptttc }} DT</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

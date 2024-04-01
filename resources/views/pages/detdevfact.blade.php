@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <h2 class="card-title fw-semibold">{{ $client->nom }} {{ $client->prenom }}</h2>
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <h6 class="card-title fw-semibold"><strong>Telephone: </strong>{{ $client->tel }}</h6>
                    <h6 class="card-title fw-semibold"><strong>E-mail: </strong>{{ $client->email }}</h6>
                    <h6 class="card-title fw-semibold"><strong>Adresse: </strong>{{ $client->adresse }}</h6>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-lg-around mb-9">
                            <a href="{{ route('devis.clients', $client->id) }}">
                                <div>
                                    <img src="https://img.freepik.com/vecteurs-premium/carte-visite-bleue-blanche-stylo-dessus_120816-134390.jpg?w=740"
                                        alt="Devis" style="border-radius: 20px;height:250px">
                                    <h4 class="text-center mt-3">{{ $nbdev }} Devis</h4>
                                </div>
                            </a>
                            <div>
                                <a href="{{ route('factures.clients', $client->id) }}">
                                    <img src="https://img.freepik.com/photos-gratuite/illustration-3d-facture-confirmation-paiement_107791-16608.jpg?t=st=1711947500~exp=1711951100~hmac=5a031edda8cbe1865475fefdbad6b810a6aff01f7b6a5b31e04ad0649461af2c&w=900"
                                        alt="facture" style="border-radius: 20px;height:250px">
                                    <h4 class="text-center mt-3">{{ $nbfact }} Factures</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

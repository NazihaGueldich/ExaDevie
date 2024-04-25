@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-lg-around mb-9">
                            <a href="{{ route('historique_detaille_presence_employe', 0) }}">
                                <div>
                                    <img src="https://img.freepik.com/vecteurs-libre/employe-du-concept-recompense-du-mois_23-2148459375.jpg?t=st=1714052396~exp=1714055996~hmac=c099d4c7591538effa7401a5d64c1da276eee6ec8ba40424bd0b9c4981b4a096&w=740"
                                        alt="Présent" style="border-radius: 20px;height:250px">
                                    <h4 class="text-center mt-3">{{ $presences }} Présents</h4>
                                </div>
                            </a>
                            <a href="{{ route('historique_detaille_presence_employe', 1) }}">
                                <div>
                                    <img src="https://img.freepik.com/photos-gratuite/homme-tir-moyen-besoin-emploi_23-2148773981.jpg?t=st=1714052469~exp=1714056069~hmac=395d7c3c007270a101fe257aff476298a63ad8e2b1cc8a49db4bfc4af2683f94&w=996"
                                        alt="absent" style="border-radius: 20px;height:250px">
                                    <h4 class="text-center mt-3">{{ $absences }} Absences</h4>
                                </div>
                            </a>
                            <a href="{{ route('historique_detaille_presence_employe', 2) }}">
                                <div>
                                    <img src="https://img.freepik.com/photos-gratuite/coup-moyen-homme-demissionnant-boite-carton_23-2149392130.jpg?t=st=1714052508~exp=1714056108~hmac=dc758dd4551addf3e06358dc9b4e1bce7b206bafe6c17e9e4bdcc87303f76cd1&w=360"
                                        alt="Congé" style="border-radius: 20px;height:250px">
                                    <h4 class="text-center mt-3">{{ $nbjConj }} Congés</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

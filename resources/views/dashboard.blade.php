@extends('main')

@section('content')
    <div class="container-fluid">
        {{-- les card loulenin --}}
        <div class="card mt-3 col-3">
            <div class="card-content">
                <div class=" m-0">
                    <div class=" border-light">
                        <a href="{{ route('histcaisse.index') }}">
                            <div class="card-body">
                                <h5 class="text-white mb-0">
                                    Caisse:
                                    <span class="float-right">
                                        @if (isset($caisse->totale))
                                            {{ $caisse->totale }}
                                        @else
                                            0
                                        @endif
                                        DT
                                    </span>
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-content">
                <div class="row row-group m-0">
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <a href="{{ route('client.index') }}">
                            <div class="card-body">
                                @php
                                    $widthnbclient = $nbclientTot > 0 ? ($nbclient * 100) / $nbclientTot : 0;
                                @endphp
                                <h5 class="text-white mb-0">{{ $nbclient }} <span class="float-right"><i
                                            class="zmdi zmdi-male-female"></i></span></h5>
                                <div class="progress my-3" style="height:3px;">
                                    <div class="progress-bar" style="width:{{ $widthnbclient }}%"></div>
                                </div>
                                <p class="mb-0 text-white small-font">Clients </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <a href="{{ route('devis.en_cours') }}">
                            <div class="card-body">
                                <h5 class="text-white mb-0">{{ $nbdevC }} <span class="float-right">
                                        <i class="fa fa-clock-o"></i></span>
                                </h5>
                                @php
                                    $widthnbdevC = $nbDev > 0 ? ($nbdevC * 100) / $nbDev : 0;
                                @endphp
                                <div class="progress my-3" style="height:3px;">
                                    <div class="progress-bar" style="width:{{ $widthnbdevC }}%">
                                    </div>
                                </div>
                                <p class="mb-0 text-white small-font">Devis En Cours </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <a href="{{ route('employes.index') }}">
                            <div class="card-body">
                                @php
                                    $widthnbEmpC = $nbEmplTot > 0 ? ($nbEmplC * 100) / $nbEmplTot : 0;
                                @endphp
                                <h5 class="text-white mb-0">{{ $nbEmplC }} <span class="float-right">
                                        <i class="zmdi zmdi-male-female"></i></span>
                                </h5>
                                <div class="progress my-3" style="height:3px;">
                                    <div class="progress-bar" style="width:{{ $widthnbEmpC }}%"></div>
                                </div>
                                <p class="mb-0 text-white small-font">Employés </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <a href="{{ route('factures.index') }}">
                            <div class="card-body">
                                <h5 class="text-white mb-0">{{ $nbFact }} <span class="float-right"><i
                                            class="zmdi zmdi-assignment"></i></span></h5>
                                <div class="progress my-3" style="height:3px;">
                                    <div class="progress-bar" style="width:55%"></div>
                                </div>
                                <p class="mb-0 text-white small-font">Factures </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- il partie 2 --}}
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">Factures Services - Factures Produits
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
                                    data-toggle="dropdown">
                                    <i class="icon-options"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-circle mr-2 text-white"></i>Factures Services</li>
                            <li class="list-inline-item"><i class="fa fa-circle mr-2 text-light"></i>Factures Produits</li>
                        </ul>
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>

                    <div class="row m-0 row-group text-center border-top border-light-3">
                        <div class="col-12 col-lg-6">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $nbfactS }}</h5>
                                <small class="mb-0">Services Vendues<span> <i class="fa fa-arrow-up"></i>
                                    </span></small>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $nbfactP }}</h5>
                                <small class="mb-0">Produits Vendues <span> <i class="fa fa-arrow-up"></i>
                                    </span></small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-header">Devis</div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center" id="dash">
                            <tbody>
                                <tr>
                                    <td><i class="fa fa-circle text-white mr-2"></i> Accepter</td>
                                    <td>{{ $nbdevA }}</td>
                                    <td>{{ $nbDev }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle text-light-2 mr-2"></i>En Cours</td>
                                    <td>{{ $nbdevC }}</td>
                                    <td>{{ $nbDev }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle text-light-3 mr-2"></i>Refuser</td>
                                    <td>{{ $nbdevR }}</td>
                                    <td>{{ $nbDev }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay toggle-menu"></div>

    </div>

    <script>
        $(function() {
            "use strict";

            // chart 1

            var ctx = document.getElementById('chart1').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($months); ?>,
                    datasets: [{
                        label: 'Produits',
                        data: <?php echo json_encode($gangePSums); ?>,
                        backgroundColor: '#fff',
                        borderColor: "transparent",
                        pointRadius: "0",
                        borderWidth: 3
                    }, {
                        label: 'Services',
                        data: <?php echo json_encode($gangeSSums); ?>,
                        backgroundColor: "rgba(255, 255, 255, 0.25)",
                        borderColor: "transparent",
                        pointRadius: "0",
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                        labels: {
                            fontColor: '#ddd',
                            boxWidth: 40
                        }
                    },
                    tooltips: {
                        displayColors: false
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#ddd'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(221, 221, 221, 0.08)"
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#ddd'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(221, 221, 221, 0.08)"
                            },
                        }]
                    }
                }
            });




            // courbe liftira

            var ctx = document.getElementById("chart2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Accepter", "En Cours", "Refuser"],
                    datasets: [{
                        backgroundColor: [
                            "#ffffff",
                            "rgba(255, 255, 255, 0.70)",
                            "rgba(255, 255, 255, 0.20)"
                        ],
                        data: [
                            {{ $nbdevA }},
                            {{ $nbdevC }},
                            {{ $nbdevR }}
                        ],
                        borderWidth: [0, 0, 0]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: "bottom",
                        display: false,
                        labels: {
                            fontColor: '#ddd',
                            boxWidth: 15
                        }
                    },
                    tooltips: {
                        displayColors: false
                    }
                }
            });
        });
    </script>
@endsection

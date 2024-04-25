@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Employés</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light px-5 mr-2"
                            onclick="openModalEmploye('','','','','','','','','','Ajouter')"><i class="zmdi zmdi-plus"></i>
                            Ajouter</button>

                        @if ($arch == 1)
                            <a href="{{ route('employes.index') }}" type="button" class="btn btn-light px-5">
                                Employés Non Archiver</a>
                        @else
                            <a href="{{ route('Employe.archivee') }}" type="button" class="btn btn-light px-5">
                                Employés Archiver</a>
                        @endif
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Cin</th>
                            <th scope="col">Nom</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">N° téléphone</th>
                            <th scope="col">Salaire</th>
                            <th scope="col">Rib</th>
                            <th scope="col">Etat</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employes as $employe)
                            <tr>
                                <td>{{ $employe->cin }}</td>
                                <td>{{ $employe->nom }} {{ $employe->pnom }}</td>
                                <td>{{ $employe->email }}</td>
                                <td>{{ $employe->adresse }}
                                </td>
                                <td>{{ $employe->tel }}</td>
                                <td>{{ $employe->salaire }}</td>
                                <td>{{ $employe->rib }}</td>
                                <td>
                                    @foreach ($latestPayments as $latestPayment)
                                        @if ($latestPayment->id_employe == $employe->id)
                                            @php
                                                $paymentDate = \Carbon\Carbon::parse($latestPayment->latest_date);
                                                $paymentMonth = $paymentDate->month;
                                                $paymentYear = $paymentDate->year;
                                            @endphp
                                            @if ($paymentMonth == $month && $paymentYear == $year)
                                                <input type="checkbox" class="form-check-input mx-0" onclick="return false;"
                                                    readonly checked />
                                            @else
                                                <input type="checkbox" class="form-check-input mx-0" onclick="return false;"
                                                    readonly  />
                                            @endif
                                        @endif
                                    @endforeach
                                </td>

                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <button class="btn btn-sm btn-warning m-1"
                                        onclick="openModalEmploye('{{ $employe->cin }}','{{ $employe->nom }}','{{ $employe->pnom }}','{{ $employe->email }}','{{ $employe->adresse }}','{{ $employe->tel }}','{{ $employe->salaire }}','{{ $employe->rib }}','{{ $employe->id }}','Modifier')">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success m-1"
                                        onclick="openModalAddHistPaymt('{{ $employe->id }}')">
                                        $
                                    </button>
                                    @if ($employe->etat == 0)
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('Employe.archive', ['id' => $employe->id, 'val' => 1]) }}"><i
                                                class="zmdi zmdi-archive"></i></a>
                                    @else
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('Employe.archive', ['id' => $employe->id, 'val' => 0]) }}"><i
                                                class="zmdi zmdi-archive"></i></a>
                                    @endif
                                    <a href="{{ route('employes.show', $employe->id) }}" class="btn btn-sm btn-info m-1">
                                        Detaille
                                    </a>
                                    <a href="{{ route('presenceEmpl.afficher', ['id' => $employe->id]) }}" class="btn btn-sm btn-info m-1">
                                        Presence
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
    @if (session('success'))
        <input hidden id="successForm" value="{{ session('success') }}">
    @else
        <input hidden id="successForm" value="0">
    @endif
    {{-- Modale --}}
    <div class="modal fade" id="addempl" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" id="addemplLabel"></h5>
                </div>
                <form id="formempl" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <p class="alert alert-danger" style="display:none" id="msgerr"></p>
                        <input class="alert alert-danger" style="display:none" id="modbld" name="modbld" value="2">

                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">CIN</label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control " id="cin" name="cin">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Prénom</label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control " id="pnom" name="pnom">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Nom</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="nom" name="nom">
                            </div>
                        </div>
                        <div class="form-group row mt-lg-3">
                            <label for="name" class="col-sm-4 col-form-label">Adresse </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="adresse" name="adresse">
                            </div>
                        </div>
                        <div class="form-group row mt-lg-3">
                            <label for="name" class="col-sm-4 col-form-label">Numéro téléphone</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control " id="tel" name="tel">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">E-mail</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control " id="email" name="email"
                                    pattern=".+@globex\.com" size="30" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Salaire</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control " id="salaire" name="salaire"
                                    size="30" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Rib</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control " id="rib" name="rib"
                                    size="30" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="verifEmpl()"
                            id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addempl')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modale payement --}}
    <div class="modal fade" id="addpaymt" tabindex="-1" role="dialog" aria-labelledby="addcltLabel"
        aria-hidden="true" class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un virement</h5>
                </div>
                <form id="formaddpymt" method="post" enctype="multipart/form-data" action="histpaymts.store">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8 ">
                                <input type="date" class="form-control " id="date" name="date" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Virement</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="virement" name="virement" required>
                            </div>
                        </div>
                        <input hidden id='id_employe' name='id_employe' value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-success" id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addpaymt')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const RouteStore = "{{ route('employes.store') }}";
        const RouteStorePaymt = "{{ route('histpaymts.store') }}";
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var success = parseInt(document.getElementById('successForm').value);
            if (success === 1) {
                Swal.fire({
                    title: 'Payement',
                    text: "Votre payement est enregistrer",
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        });
    </script>
@endsection

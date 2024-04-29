@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Historique payement de facture numéro {{ $facture->num }}
                            <br>de M(e).{{ $facture->clients->nom }} {{ $facture->clients->prenom }}
                        </h5>
                    </div>

                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Virement</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payementfacts as $payementfact)
                            <tr>
                                <td>{{ $payementfact->date }}</td>
                                <td>
                                    @if ($payementfact->type == 0)
                                        Cash
                                    @elseif($payementfact->type == 1)
                                        Check
                                    @elseif($payementfact->type == 2)
                                        Credit Card
                                    @endif
                                </td>
                                <td>{{ $payementfact->virement }}</td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <button class="btn btn-sm btn-warning m-1"
                                        onclick="openModalEditPaymt('{{ $payementfact->date }}','{{ $payementfact->type }}','{{ $payementfact->virement }}','{{ $payementfact->id }}')">
                                        <i class="zmdi zmdi-edit"></i>
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
    {{-- Modale payement --}}
    <div class="modal fade" id="editpaymtfact" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier un virement</h5>
                </div>
                <form id="formupdpymt" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    <input type="hidden" name="_method" value="put">  <!-- Ensure this is set to 'put' -->
                    
                    <div class="modal-body">
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control" aria-label="Default select example" id="type"
                                    name="type" required>
                                    <option selected disabled value="">Choose a payment type</option>
                                    <option value="0">Cash</option>
                                    <option value="1">Check</option>
                                    <option value="2">Credit Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Virement</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="virement" name="virement" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8 ">
                                <input type="date" class="form-control " id="date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-success" id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addpaymtfact')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

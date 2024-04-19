@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Historiques Payement</h5>
                    </div>

                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Employe</th>
                            <th scope="col">Virement</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histpaymts as $histpaymt)
                            <tr>
                                <td>{{ $histpaymt->date }}</td>
                                <td>{{ $histpaymt->employes->nom }} {{ $histpaymt->employes->pnom }}</td>
                                <td>{{ $histpaymt->virement }}Dt</td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <button class="btn btn-sm btn-warning m-1"
                                        onclick="openModalUpdateHistPaymt('{{ $histpaymt->date }}','{{ $histpaymt->virement }}','{{ $histpaymt->id_employe }}','{{ $histpaymt->id }}')">
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

    {{-- Modale --}}
    <div class="modal fade" id="updpaymt" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" >Modifier le virement</h5>
                </div>
                <form id="formupdpymt" method="post" enctype="multipart/form-data" action="histpaymts.update">
                    @csrf
                    @method('POST')
                    <div class="modal-body">

                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Employés</label>
                            <div class="col-sm-8 ">
                                <select class="form-control" aria-label="Default select example" id='id_employe'
                                    name='id_employe' required>
                                    <option selected disabled>Choisir un employér</option>
                                    @foreach ($employes as $employe)
                                        <option value="{{ $employe->id }}">{{ $employe->nom }} {{ $employe->pnom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                        <input hidden id='id' value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-success" id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addclt')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const RouteStore = "{{ route('client.store') }}";
    </script>
@endsection

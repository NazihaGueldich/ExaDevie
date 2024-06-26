@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Demande Congés</h5>
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Employes</th>
                            <th scope="col">Durée</th>
                            <th scope="col">Cause</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conjs as $conj)
                            <tr>
                                <td>{{ $conj->employes->nom }} {{ $conj->employes->pnom }}</td>
                                <td>Du {{ $conj->dateD }} au {{ $conj->dateF }}</td>
                                <td>{{ $conj->cause }}</td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <a class="btn btn-sm btn-success" onclick="return confirm('Etes vous sure de l accepter?')"
                                        href="{{ route('Demande.etat', ['id' => $conj->id, 'val' => 1]) }}"><i
                                            class="zmdi zmdi-archive"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Etes vous sure de refuser?')"
                                        href="{{ route('Demande.etat', ['id' => $conj->id, 'val' => 2]) }}"><i
                                            class="zmdi zmdi-archive"></i></a>
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
    <div class="modal fade" id="adddemcong" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" id="adddemconjLabel"></h5>
                </div>
                <form id="formdemConj" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <p class="alert alert-danger" style="display:none" id="msgerr"></p>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Date Début</label>
                            <div class="col-sm-8 mb-2">
                                <input type="datetime-local" class="form-control " id="dateD" name="dateD" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Date Fin</label>
                            <div class="col-sm-8 ">
                                <input type="datetime-local" class="form-control " id="dateF" name="dateF">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Cause</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control " rows="3" id="cause" name="cause" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-success" id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('adddemcong')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const RouteStore = "{{ route('demandeConge.store') }}";
    </script>
    <script>
        let table = new DataTable('.table', {
            "order": [
                [3, 'asc']
            ]
        });
    </script>
@endsection

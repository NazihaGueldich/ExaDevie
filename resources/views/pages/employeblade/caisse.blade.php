@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Historiques Caisse</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light px-5 mr-2" onclick="openModalCaisse('','','','Ajouter')"><i
                                class="zmdi zmdi-plus"></i>
                            Ajouter</button>
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Prix</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histcaisses as $histcaisse)
                            <tr>
                                <td>{{ $histcaisse->description }}</td>
                                <td>{{ $histcaisse->prix }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning m-1"
                                        onclick="openModalCaisse('{{ $histcaisse->description }}','{{ $histcaisse->prix }}','{{ $histcaisse->id }}','Modifier')">
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
    <div class="modal fade" id="addhistcaiss" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHistCaisseLabel"></h5>
                </div>
                <form id="formhistcaiss" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <p class="alert alert-danger" style="display:none" id="msgerr"></p>

                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8 mb-2">
                                <textarea type="text" class="form-control " id="description" name="description" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Prix</label>
                            <div class="col-sm-8 ">
                                <input type="number" class="form-control " id="prix" name="prix">
                            </div>
                        </div>
                        <input hidden type="number" class="form-control " id="type" name="type" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-success" id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addhistcaiss')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const RouteStore = "{{ route('histcaisse.store') }}";
    </script>
@endsection

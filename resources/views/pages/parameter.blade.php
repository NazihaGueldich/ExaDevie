@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Produits</h5>
                    </div>
                    @if ($find == 0)
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-light btn-round px-5"
                                onclick="openModalParam('','','','','','','','','','Ajouter')"><i class="zmdi zmdi-plus"></i>
                                Ajouter</button>
                        </div>
                    @endif
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Logo</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Rib</th>
                            <th scope="col">Matricule Fiscale</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Fax</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->nom }}</td>
                                <td scope="row">
                                    <img src="{{ asset('images') }}/{{ $parameter->logo }}" alt="Pas de photo"
                                        width="50" height="60">
                                </td>
                                <td>{{ $parameter->email }}</td>
                                <td>{{ $parameter->tel }}</td>
                                <td>{{ $parameter->rib }}</td>
                                <td>{{ $parameter->mf }}</td>
                                <td>{{ $parameter->adresse }}</td>
                                <td>{{ $parameter->fax }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" type="submit"
                                        onclick="openModalParam('{{ $parameter->nom }}','{{ $parameter->logo }}','{{ $parameter->email }}','{{ $parameter->tel }}','{{ $parameter->rib }}','{{ $parameter->mf }}','{{ $parameter->adresse }}','{{ $parameter->fax }}','{{ $parameter->id }}','Modifier')"
                                        style="margin: 0 auto; "><i class="zmdi zmdi-edit" aria-hidden="true"></i></button>
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
    <div class="modal fade" id="addparam" tabindex="-1" role="dialog" aria-labelledby="addparamLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" id="addparamLabel"></h5>
                </div>
                <form id="formParam" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <p class="alert alert-danger" style="display:none" id="msgerr"></p>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user" id="nom" name="nom">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Logo</label>
                            <div class="col-sm-10">
                                <img src="" alt="Pas de photo" width="50" height="60" id="imgrest">
                                <input type="file" class="form-control-file" id="logo" name="logo"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">E-mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control " id="email" name="email"
                                    pattern=".+@globex\.com" size="30" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-user" id="tel" name="tel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Rib</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-user" id="rib" name="rib">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Matricule Fiscal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user" id="mf"
                                    name="mf">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Adresse</label>
                            <div class="col-sm-10">
                                <input type="test" class="form-control form-control-user" id="adresse"
                                    name="adresse">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mb-3">Fax</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user" id="fax"
                                    name="fax">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="verifparam()"
                            id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addparam')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const RouteStore = "{{ route('parameter.store') }}";
    </script>
@endsection

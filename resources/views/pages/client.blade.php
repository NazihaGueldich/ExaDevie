@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Clients</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light px-5 mr-2"
                            onclick="openModalClient('','','','','','','','','Ajouter')"><i class="zmdi zmdi-plus"></i>
                            Ajouter</button>

                        @if ($arch == 1)
                            <a href="{{ route('client.index') }}" type="button" class="btn btn-light px-5">
                                Clients Non Archiver</a>
                        @else
                            <a href="{{ route('Client.archivee') }}" type="button" class="btn btn-light px-5">
                                Clients Non Archiver</a>
                        @endif
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">cin</th>
                            <th scope="col">Nom</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">N° téléphone</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->cin }}</td>
                                <td>{{ $client->nom }} {{ $client->prenom }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->adresse }}
                                </td>
                                <td>{{ $client->tel }}</td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <button class="btn btn-sm btn-warning m-1"
                                        onclick="openModalClient('{{ $client->cin }}','{{ $client->nom }}','{{ $client->prenom }}','{{ $client->email }}','{{ $client->adresse }}','{{ $client->tel }}','{{ $client->id }}','Modifier')">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    @if ($client->etat == 0)
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('Client.archive', ['id' => $client->id, 'val' => 1]) }}"><i
                                                class="zmdi zmdi-archive"></i></a>
                                    @else
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('Client.archive', ['id' => $client->id, 'val' => 0]) }}"><i
                                                class="zmdi zmdi-archive"></i></a>
                                    @endif
                                    <a href="{{ route('client.show', $client->id) }}" class="btn btn-sm btn-info m-1">
                                        Detaille
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

    {{-- Modale --}}
    <div class="modal fade" id="addclt" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" id="addcltLabel"></h5>
                </div>
                <form id="formclt" method="post" enctype="multipart/form-data" action="">
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
                                <input type="text" class="form-control " id="prenom" name="prenom">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="verifClt()"
                            id='myButton'>Enregistrer</button>
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

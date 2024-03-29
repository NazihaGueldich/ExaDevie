@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Produits</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light btn-round px-5"
                            onclick="openModalProduit('','','','','','','Ajouter')"><i class="zmdi zmdi-plus"></i>
                            Ajouter</button>

                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prix</th>
                            <th scope="col">PTTTC</th>
                            <th scope="col">THT</th>
                            <th scope="col">TVA</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr>
                                <td>{{ $produit->nom }}</td>
                                <td>{{ $produit->prixU }}DT</td>
                                <td>{{ $produit->ptttc }}</td>
                                <td>{{ $produit->tht }}</td>
                                <td>{{ $produit->tva }}</td>
                                <td class=" d-lg-inline text-center">

                                    <button class="btn btn-sm btn-warning m-1"
                                        onclick="openModalProduit('{{ $produit->nom }}','{{ $produit->ptttc }}','{{ $produit->tht }}','{{ $produit->tva }}','{{ $produit->prixU }}','{{ $produit->id }}','Modifier')">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    @if ($produit->etat == 0)
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('produits.archive', ['id' => $produit->id, 'val' => 1]) }}"><i
                                                class="zmdi zmdi-archive"></i></a>
                                    @else
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('produits.archive', ['id' => $produit->id, 'val' => 0]) }}"><i
                                                class="zmdi zmdi-archive"></i></a>
                                    @endif
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
    <div class="modal fade" id="addProd" tabindex="-1" role="dialog" aria-labelledby="addProdLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProdLabel"></h5>
                </div>
                <form id="formProd" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <p class="alert alert-danger" style="display:none" id="msgerr"></p>
                        <div class="form-group row  mb-2">
                            <label for="name" class="col-sm-4 col-form-label ">Nom</label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control " id="nom" name="nom">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">Prix</label>
                            <div class="col-sm-8 mb-2">
                                <input type="number" class="form-control" id="prixU" name="prixU" min="0">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">PTTTC</label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control " id="ptttc" name="ptttc">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">TVA</label>
                            <div class="col-sm-8 mb-2">
                                <input type="number" class="form-control " id="tva" name="tva" min="0"
                                    max="100">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="name" class="col-sm-4 col-form-label">THT</label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control " id="tht" name="tht" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="verifProd()"
                            id='myButton'>Enregistrer</button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning"
                            onclick="closeModal('addProd')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const RouteStore = "{{ route('produits.store') }}";
    </script>
   
@endsection

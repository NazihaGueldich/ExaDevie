@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Modifier Vos Informations</h5>
                    </div>
                </div>
                <hr>
                <div class="tab-pane col-lg-8 offset-2" id="edit">
                    <form method="POST" action="{{ route('employes.modifier') }}">
                        @csrf
                        <input name="id_emp" value="{{ $employe->id }}" hidden />
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">CIN</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="number" value="{{ $employe->cin }}" name="cin"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">First name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{ $employe->nom }}" name="nom"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{ $employe->pnom }}" name="pnom"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" value="{{ $employe->email }}" name="email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Address</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{ $employe->adresse }}" name="adresse"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <button type="submit" class="btn btn-primary" id='myButton'>Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>
@endsection

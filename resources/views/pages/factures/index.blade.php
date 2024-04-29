@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Bondes Commendes</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('factures.create') }}" type="button" class="btn btn-light btn-round px-5"><i
                                class="zmdi zmdi-plus"></i>
                            Ajouter</a>

                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Numéro</th>
                            <th scope="col">Sujet</th>
                            <th scope="col">Client</th>
                            <th scope="col">MTTTC</th>
                            <th scope="col">MTHT</th>
                            <th scope="col">TVA</th>
                            <th scope="col">Payé</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factures as $facture)
                            <tr>
                                <td>{{ $facture->created_at }}</td>
                                <td>{{ $facture->num }}</td>
                                <td>{{ $facture->sujet }}</td>
                                <td>{{ $facture->clients->nom }} {{ $facture->clients->prenom }}</td>
                                <td>{{ $facture->MTTTC }}</td>
                                <td>{{ $facture->MTHT }}</td>
                                <td>{{ $facture->totTVA }}</td>
                                <td>
                                    @if ($facture->rest == 0)
                                        Payé
                                    @else
                                        Reste:{{ $facture->rest }}Dt
                                    @endif
                                </td>
                                <td class=" align-items-center justify-content-center flex-column d-flex">
                                    <a href="{{ route('factures.pdf', ['id' => $facture->id]) }}" type="button"
                                        class="btn btn-sm btn-warning" target='_blanc'><i class="zmdi zmdi-image-alt"></i>
                                        Pdf</a>
                                    @if ($facture->rest != 0)
                                        <button class="btn btn-sm btn-success m-1"
                                            onclick="openModalAddPaymt('{{ $facture->id }}')">
                                            $
                                        </button>
                                    @endif

                                    <a href="{{ route('factures.details', ['id' => $facture->id]) }}"
                                        class="btn btn-sm btn-info m-1">
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
        @if (session('success'))
            <input hidden id="successForm" value="{{ session('success') }}">
            <input hidden id="idfacture" value="{{ session('idfacture') }}">
        @else
            <input hidden id="successForm" value="0">
        @endif
        @if (session('PymtSuccess'))
            <input hidden id="successPymt" value="{{ session('PymtSuccess') }}">
        @else
            <input hidden id="successPymt" value="0">
        @endif
    </div>
    {{-- Modale payement --}}
    <div class="modal fade" id="addpaymtfact" tabindex="-1" role="dialog" aria-labelledby="addcltLabel" aria-hidden="true"
        class="modal hide" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content $">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un virement</h5>
                </div>
                <form id="formpymtFact" method="post" enctype="multipart/form-data" action="paymtsfacts.store">
                    @csrf
                    @method('POST')
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
                        <input hidden id='id_facture' name='id_facture' value="">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const RouteStorePaymt = "{{ route('paymtsfacts.store') }}";


        $(document).ready(function() {

            var today = new Date().toISOString().split('T')[0];
            $('#date').attr('max', today);

            var success = parseInt(document.getElementById('successForm').value);
            if (success === 1) {
                Swal.fire({
                    title: 'Facture',
                    text: "Votre facture est prête",
                    icon: 'success',
                    confirmButtonColor: 'forestgreen',
                    confirmButtonText: 'Afficher',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var factureId = document.getElementById('idfacture').value;
                        var url = '/factures_PDF/' + factureId;
                        //y7ill il lien fi pg o5ra
                        window.open(url, '_blank');
                    }
                });
            }
            var PymtSuccess = parseInt(document.getElementById('successPymt').value);
            if (PymtSuccess === 1) {
                Swal.fire({
                    title: 'Virement',
                    text: "Votre virement est enregistré",
                    icon: 'success',
                });
            }
        });
    </script>
@endsection

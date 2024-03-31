@extends('main')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="card-title">Information du devis</div>
                <hr>
                <form action="{{ route('devis.store') }}" method="POST" id="formdevis">
                    @csrf
                    @method('POST')
                    <p class="alert alert-danger" style="display:none" id="msgerr"></p>
                    <div class="form-group row">
                        <label for="id_client" class="col-sm-1 col-form-label">Clients</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="id_client" name="id_client" required>
                                <option value="" disabled selected>Choisir un client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-2">Sujet</label>
                        <textarea type="text" class="form-control" id="sujet" name="sujet" placeholder="Saisire le sujet du devi"></textarea>
                    </div>
                    {{-- lignie devis --}}
                    <hr style="width: 250px">

                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 mb-3">
                        <div class="mb-3 mb-sm-0">
                            <div class="card-title">Information de contenue</div>
                        </div>
                        <div>
                            <button type="button" id="addBtn" class="btn btn-success">+</button>
                            <input hidden id='nblign' name="nblign" value="0">
                        </div>
                    </div>

                    <div id="lifgnies">
                    </div>

                    <div class="form-group text-lg-right mt-3">
                        <button  type="button" class="btn btn-light px-5" id="myButton"
                            onclick="verifier()">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>

    </div>


    <script>
        let i = 0;
        document.getElementById('addBtn').addEventListener('click', function() {
            i++;

            let contenu = `
            <div class="card" id="card${i}">
                <div class="card-body">
                    <p class="alert alert-danger" style="display:none" id="msgerr${i}"></p>

                    <div class="form-group row mt-lg-3">
                        <label for="name" class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8 row">
                            <label class="container col-sm-6">
                                <input type="radio" id="prod${i}" name="type${i}" value="0" onclick="changeType(${i})">
                                Produits
                                <span class="checkmark"></span>
                            </label>
                            <label class="container col-sm-6">
                                <input type="radio" id="serv${i}" name="type${i}" value="1" onclick="changeType(${i})">
                                Services
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div  id="produit${i}" style="display: none">
                        <div  class="form-group row">
                            <label for="id_produit" class="col-sm-1 offset-1 col-form-label">Produits</label>
                            <div class="col-sm-3 p-0">
                                <select class="form-control " id="id_produit${i}" name="id_produit${i}">
                                    <option value="" disabled selected>Choisir un produit</option>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="input-2" class="col-sm-1 offset-1 col-form-label">Quantité</label>
                            <input type="number" class="form-control col-sm-3" id="quantiter${i}" name="quantiter${i}"
                                placeholder="Saisire la quantité">
                        </div>
                    </div>
                    <div class="form-group row" id="service${i}" style="display: none">
                        <label for="input-2">Deseigniation</label>
                        <textarea type="text" class="form-control" id="designiation${i}" name="designiation${i}" placeholder="Saisire le service"></textarea>
                        <div class="form-group row mt-3">
                            <label for="input-2" class="col-sm-1 offset-1 col-form-label">Prix U</label>
                            <input type="number" class="form-control col-sm-3" id="prix${i}" name="prix${i}"
                                placeholder="Saisire le prix unitair">
                            <label for="input-2" class="col-sm-1 offset-1 col-form-label">TVA</label>
                            <input type="number" class="form-control col-sm-3" id="tva${i}" name="tva${i}"
                                placeholder="Saisire le TVA">
                        </div>
                        <div class="form-group row">
                            <label for="input-2" class="col-sm-1 offset-1 col-form-label">THT</label>
                            <input type="number" class="form-control col-sm-3" id="tht${i}" name="tht${i}"
                                placeholder="Saisire le THT">
                            <label for="input-2" class="col-sm-1 offset-1 col-form-label">PTTTC</label>
                            <input type="number" class="form-control col-sm-3" id="ptttc${i}" name="ptttc${i}"
                                placeholder="Saisire le PTTTC">
                        </div>
                    </div>
                    <div class="text-lg-right">
                        <button type="button" class="btn btn-warning"
                            onclick="deleteCard(${i})">Supprimer lignie</button>
                    </div>
                </div>
            </div>`;

            let temp = document.createElement('div');
            temp.innerHTML = contenu;

            document.getElementById('lifgnies').appendChild(temp);
            document.getElementById('nblign').value = i;
        });


        function deleteCard(x) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "La ligne sera définitivement supprimée!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    let idcard = 'card' + x;
                    let card = document.getElementById(idcard);
                    if (card) {
                        card.remove();
                    }
                    i--;
                    document.getElementById('nblign').value = i;
                }
            });
        }

        function changeType(x) {
            idchek = 'prod' + x;
            produit = document.getElementById(idchek);
            idprodcont = 'produit' + x;
            prodcont = document.getElementById(idprodcont);
            idservisecont = 'service' + x;
            servisecont = document.getElementById(idservisecont);
            if (produit.checked) {
                prodcont.style.display = 'block';
                servisecont.style.display = 'none';
            } else {
                prodcont.style.display = 'none';
                servisecont.style.display = 'block';
            }
        }

        function verifier() {
            msg = '';
            find = 0;
            msgerr = document.getElementById("msgerr");
            var client = $("#id_client").val();
            var sujet = $("#sujet").val().trim();

            if (client === null) {
                msg = msg + "- Vous devez choisir un client !</br>";
                find = 1;
            }
            if (sujet.length == 0) {
                msg = msg + "- Vous devez choisir un sujet !</br>";
                find = 1;
            }
            nblign = document.getElementById('nblign').value;
            if (nblign == 0) {
                msg = msg + "- Vous devez choisir des lignies de devis !</br>";
                find = 1;
            } else {
                for (let d = 1; d <= nblign; d++) {
                    msg2 = '';
                    find2 = 0;
                    idchekprod = 'prod' + d;
                    produit = document.getElementById(idchekprod);
                    idchekserv = 'serv' + d;
                    service = document.getElementById(idchekserv);
                    if (!produit.checked && !service.checked) {
                        msg2 = msg2 + "- Vous devez choisir un type !</br>";
                        find2 = 1;
                    } else {
                        if (produit.checked) {
                            idproduit = 'id_produit' + d;
                            prod = document.getElementById(idproduit).value;
                            if (prod === '') {
                                msg2 = msg2 + "- Vous devez choisir un produits !</br>";
                                find = 1;
                            }
                            idquant = 'quantiter' + d;
                            quant = document.getElementById(idquant).value;
                            if (quant.length == 0) {
                                msg2 = msg2 + "- Vous devez choisir une quantité !</br>";
                                find2 = 1;
                            }
                        } else {
                            iddes = 'designiation' + d;
                            designiation = document.getElementById(iddes).value;
                            if (designiation.length == 0) {
                                msg2 = msg2 + "- Vous devez choisir une designiation !</br>";
                                find2 = 1;
                            }

                            idprix = 'prix' + d;
                            prix = document.getElementById(idprix).value;
                            if (prix.length == 0) {
                                msg2 = msg2 + "- Vous devez choisir un prix !</br>";
                                find2 = 1;
                            }
                            idtva = 'tva' + d;
                            tva = document.getElementById(idtva).value;
                            if (tva.length == 0) {
                                msg2 = msg2 + "- Vous devez choisir une TVA !</br>";
                                find2 = 1;
                            }
                            idtht = 'tht' + d;
                            tht = document.getElementById(idtht).value;
                            if (tht.length == 0) {
                                msg2 = msg2 + "- Vous devez choisir une THT !</br>";
                                find2 = 1;
                            }
                            idptttc = 'ptttc' + d;
                            ptttc = document.getElementById(idptttc).value;
                            if (ptttc.length == 0) {
                                msg2 = msg2 + "- Vous devez choisir une PTTTC !</br>";
                                find2 = 1;
                            }
                        }
                    }

                    idmsgerr = 'msgerr' + d;
                    errmsg = document.getElementById(idmsgerr);
                    if (find2 != 0) {
                        errmsg.innerHTML = msg2;
                        errmsg.style.display = "block";
                        find = 1;
                    } else {
                        errmsg.style.display = "none";
                    }
                }
            }

            if (find == 0 ) {
                const myButton = document.querySelector('#myButton');
                myButton.disabled = true;
                 $("#formdevis").submit();
                console.log('tsagal');
            } else {
                msgerr.style.display = "block";
                msgerr.innerHTML = msg;
            }
        }
    </script>
@endsection

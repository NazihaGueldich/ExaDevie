// close modale:
function closeModal(mod) {
    var idmod = "#" + mod;
    $(idmod).modal('hide');
}

//modale yb9a ma7loul ki nenzel il bara mil modale:
function modaleInclose(idmod) {
    var myModal = new bootstrap.Modal(document.getElementById(idmod), {
        backdrop: 'static',
        keyboard: false
    });
}

/* produits */
function openModalProduit(nom, ptttc, tht, tva, prixU, id, action) {
    if (action == "Modifier") {
        $("#imgrest").show();
        $("#nom").val(nom);
        $("#ptttc").val(ptttc);
        $("#tht").val(tht);
        $("#tva").val(tva);
        $("#prixU").val(prixU);
        $("#formProd").attr('action', "produits/" + id);
        $("input[name='_method']").val('put');
    } else {
        $("#nom").val("");
        $("#ptttc").val("");
        $("#tht").val("");
        $("#tva").val("");
        $("#prixU").val("");
        $("#formProd").attr('action', RouteStore);
        $("input[name='_method']").val('post');
    }
    $("#addProdLabel").html(action + " les informations du produit")
    modaleInclose('addProd');
    $('#addProd').modal("show");
}

function verifProd() {
    msg = '';
    find = 0;
    msgerr = document.getElementById("msgerr");
    var nom = $("#nom").val().trim();
    var ptttc = $("#ptttc").val().trim();
    var tht = $("#tht").val().trim();
    var tva = $("#tva").val().trim();
    var prixU = $("#prixU").val().trim();

    if (nom.length == 0) {
        msg = msg + "- Vous devez choisir le nom !</br>";
        find = 1;
    }
    if (prixU.length == 0) {
        msg = msg + "- Vous devez choisir le prix !</br>";
        find = 1;
    }
    if (ptttc.length == 0) {
        msg = msg + "- Vous devez choisir le PTTTC !</br>";
        find = 1;
    } 
    if (tht.length == 0) {
        msg = msg + "- Vous devez choisir le THT !</br>";
        find = 1;
    }
    if (tva.length == 0) {
        msg = msg + "- Vous devez choisir la TVA !</br>";
        find = 1;
    }

    if (find == 0) {
        const myButton = document.querySelector('#myButton');
        myButton.disabled = true;
        $("#formProd").submit();
        console.log('tsagal');
    } else {
        msgerr.style.display = "block";
        msgerr.innerHTML = msg;
    }
}

//parameter
function openModalParam(nom, logo, email, tel, rib, mf, adresse, fax, id, action) {
    if (action == "Modifier") {
        $("#imgrest").show();
        $("#nom").val(nom);
        $("#email").val(email);
        $("#tel").val(tel);
        $("#rib").val(rib);
        $("#mf").val(mf);
        $("#adresse").val(adresse);
        $("#fax").val(fax);
        $("#imgrest").attr('src', "{{ asset('images') }}/" + logo);
        $("#formParam").attr('action', "parameter/" + id);
        $("input[name='_method']").val('put');
    } else {
        $("#nom").val("");
        $("#email").val("");
        $("#tel").val("");
        $("#rib").val("");
        $("#mf").val("");
        $("#fax").val("");
        $("#imgrest").hide();
        $("#imgrest").hide();
        $("#formParam").attr('action', RouteStore);
        $("input[name='_method']").val('post');
    }
    $("#addparamLabel").html(action + " les informations du societe")
    modaleInclose('addparam');
    $('#addparam').modal("show");
}

function verifparam() {
    msg = '';
    find = 0;
    msgerr = document.getElementById("msgerr");
    var nom = $("#nom").val().trim();
    var email = $("#email").val().trim();
    var tel = $("#tel").val().trim();
    var rib = $("#rib").val().trim();
    var mf = $("#mf").val().trim();
    var adresse = $("#adresse").val().trim();
    var fax = $("#fax").val().trim();

    if (nom.length == 0) {
        msg = msg + "- Vous devez choisir le nom !</br>";
        find = 1;
    }
    if (email.length == 0) {
        msg = msg + "- Vous devez choisir l'adresse e-mail !</br>";
        find = 1;
    } else if (email.indexOf('@') == -1) {
        msg = msg + "- L'e-mail doit conterir @ !</br>";
        find = 1;
    }
    if (tel.length == 0) {
        msg = msg + "- Vous devez choisir le numéro de telephone !</br>";
        find = 1;
    } else if (tel.length != 8) {
        msg = msg + "- Le numéro doit contenir 8 chiffre!</br>";
        find = 1;
    }
    if (rib.length == 0) {
        msg = msg + "- Vous devez choisir le rib !</br>";
        find = 1;
    }
    if (mf.length == 0) {
        msg = msg + "- Vous devez choisir la matricule fiscale !</br>";
        find = 1;
    }
    if (adresse.length == 0) {
        msg = msg + "- Vous devez choisir l'adresse !</br>";
        find = 1;
    }
    if (fax.length == 0) {
        msg = msg + "- Vous devez choisir le numéro de fax !</br>";
        find = 1;
    }

    if (find == 0) {
        const myButton = document.querySelector('#myButton');
        myButton.disabled = true;
        $("#formParam").submit();
        console.log('tsagal');
    } else {
        msgerr.style.display = "block";
        msgerr.innerHTML = msg;
    }
}
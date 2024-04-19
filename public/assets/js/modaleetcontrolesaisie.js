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

 /* clients */
 function openModalClient(cin, nom, prenom, email,  adresse, tel, id, action) {
    if (action == "Modifier") {
        $("#cin").val(cin);
        $("#nom").val(nom);
        $("#prenom").val(prenom);
        $("#email").val(email);
        $("#adresse").val(adresse);
        $("#tel").val(tel);
        $("#formclt").attr('action', "client/" + id);
        $("input[name='_method']").val('put');
        $("#addcltLabel").html("Modifier un Client");
    } else {
        $("#cin").val("");
        $("#nom").val("");
        $("#prenom").val("");
        $("#email").val("");
        $("#adresse").val("");
        $("#tel").val("");
        $("#formclt").attr('action', RouteStore);
        $("input[name='_method']").val('post');
        $("#addcltLabel").html("Ajouter un Client");
    }
    modaleInclose('addclt');

    $('#addclt').modal("show");
}

function verifClt() {
    msg = '';
    find = 0;
    msgerr = document.getElementById("msgerr");
    var cin = $("#cin").val().trim();
    var nom = $("#nom").val().trim();
    var prenom = $("#prenom").val().trim();
    var email = $("#email").val().trim();
    var tel = $("#tel").val().trim();
    var adresse = $("#adresse").val().trim();
   
    if (cin.length == 0) {
        msg = msg + "- Vous devez choisir le CIN ou un MF !</br>";
        find = 1;
    }
    if (nom.length == 0) {
        msg = msg + "- Vous devez choisir le nom !</br>";
        find = 1;
    } 
    if (prenom.length == 0) {
        msg = msg + "-  Vous devez choisir le prénom !</br>";
        find = 1;
    }
    if (adresse.length == 0) {
        msg = msg + "- Vous devez choisir une adresse !</br>";
        find = 1;
    }
    if (tel.length == 0) {
        msg = msg + "- Vous devez choisir le numéro téléphone !</br>";
        find = 1;
    } else if (tel.length != 8) {
        msg = msg + "- Le nombre doit contenir 8 chiffres !</br>";
        find = 1;
    }
    if (email.length == 0) {
        msg = msg + "- Vous devez choisir l’adresse e-mail !</br>";
        find = 1;
    } else if (email.indexOf('@') == -1) {
        msg = msg + "- Vous devez choisir l’adresse email Le email doit contenir @ !</br>";
        find = 1;
    }

    if (find == 0) {
        const myButton = document.querySelector('#myButton');
        myButton.disabled = true;
        $("#formclt").submit();
        console.log('tsagal');
    } else {
        msgerr.style.display = "block";
        msgerr.innerHTML = msg;
    }
}

function openModalEmploye(cin, nom, prenom, email,  adresse, tel,salaire,rib, id, action) {
    if (action == "Modifier") {
        $("#cin").val(cin);
        $("#nom").val(nom);
        $("#pnom").val(prenom);
        $("#email").val(email);
        $("#adresse").val(adresse);
        $("#tel").val(tel);
        $("#salaire").val(salaire);
        $("#rib").val(rib);
        $("#formempl").attr('action', "employes/" + id);
        $("input[name='_method']").val('put');
        $("#addemplLabel").html("Modifier un employé");
    } else {
        $("#cin").val("");
        $("#nom").val("");
        $("#pnom").val("");
        $("#email").val("");
        $("#adresse").val("");
        $("#tel").val("");
        $("#salaire").val("");
        $("#rib").val("");
        $("#formempl").attr('action', RouteStore);
        $("input[name='_method']").val('post');
        $("#addemplLabel").html("Ajouter un employé");
    }
    modaleInclose('addempl');

    $('#addempl').modal("show");
}

function verifEmpl() {
    msg = '';
    find = 0;
    msgerr = document.getElementById("msgerr");
    var cin = $("#cin").val().trim();
    var nom = $("#nom").val().trim();
    var prenom = $("#pnom").val().trim();
    var email = $("#email").val().trim();
    var tel = $("#tel").val().trim();
    var adresse = $("#adresse").val().trim();
    var salaire = $("#salaire").val().trim();
    var rib = $("#rib").val().trim();
   
    if (cin.length == 0) {
        msg = msg + "- Vous devez choisir le CIN ou un MF !</br>";
        find = 1;
    }
    if (nom.length == 0) {
        msg = msg + "- Vous devez choisir le nom !</br>";
        find = 1;
    } 
    if (prenom.length == 0) {
        msg = msg + "-  Vous devez choisir le prénom !</br>";
        find = 1;
    }
    if (adresse.length == 0) {
        msg = msg + "- Vous devez choisir une adresse !</br>";
        find = 1;
    }
    if (tel.length == 0) {
        msg = msg + "- Vous devez choisir le numéro téléphone !</br>";
        find = 1;
    } else if (tel.length != 8) {
        msg = msg + "- Le nombre doit contenir 8 chiffres !</br>";
        find = 1;
    }
    if (email.length == 0) {
        msg = msg + "- Vous devez choisir l’adresse e-mail !</br>";
        find = 1;
    } else if (email.indexOf('@') == -1) {
        msg = msg + "- Vous devez choisir l’adresse email Le email doit contenir @ !</br>";
        find = 1;
    }
    if (salaire.length == 0) {
        msg = msg + "-  Vous devez choisir le salaire !</br>";
        find = 1;
    }
    if (rib.length == 0) {
        msg = msg + "- Vous devez choisir un rib !</br>";
        find = 1;
    }
    if (find == 0) {
        const myButton = document.querySelector('#myButton');
        myButton.disabled = true;
        $("#formempl").submit();
        console.log('tsagal');
    } else {
        msgerr.style.display = "block";
        msgerr.innerHTML = msg;
    }
}

function openModalUpdateHistPaymt(date, virement, id_employe, id) {
    $("#date").val(date);
    $("#virement").val(virement);
    $("#id_employe").val(id_employe);
    $("#formupdpymt").attr('action', "histpaymts/" + id);
    $("input[name='_method']").val('put');
    modaleInclose('updpaymt');

    $('#updpaymt').modal("show");
}
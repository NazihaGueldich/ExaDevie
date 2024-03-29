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
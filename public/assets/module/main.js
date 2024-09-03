
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    // Enregistrer une  nouvelle formation
    //  validation & envoie des infortion en ajax
    $(document).on('click', '#Envoyer', function (e) {
        e.preventDefault();
        let name = $('#nom').val();
        let duree = $('#duree').val();
        let prix = $('#prix').val();
        let prerequit = $('#prerequit').val();
        let note = $('#note').val();
        const sa = document.getElementById("sa-success");
        document.querySelector(".save-load-btn-ma").classList.remove("d-none");
        document.querySelector(".save-bu-ma").classList.add("d-none");
        $.ajax({
            url: "/add-formation",
            method: 'post',
            data: {
                name: name,
                duree: duree,
                prix: prix,
                prerequit: prerequit,
                note: note
            },
            success: function (res) {
                if (res.status == "success") {
                    document.querySelector(".save-load-btn-ma").classList.add("d-none");
                    document.querySelector(".save-bu-ma").classList.remove("d-none");
                    $('#FormationForm')[0].reset();
                    sa.click();
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.errors_calss').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                });
                document.querySelector(".save-load-btn-ma").classList.add("d-none");
                document.querySelector(".save-bu-ma").classList.remove("d-none");
            }
        })

    })

    //Modification d'une formation
    // envoie des informations en ajax

    $(document).on('click', '#ApplieUpdate', function (e) {
        e.preventDefault();
        id = $(this).data('id');
        nom = $(this).data('nom');
        duree = $(this).data('duree');
        note = $(this).data('note');
        prix = $(this).data('prix');
        enligne = $(this).data('Enligne');
        niveau = $(this).data('niveau');

        $("#nom").val(nom);
        $("#duree").val(duree);
        $("#note").val(note);
        $("#prix").val(prix);
        $("#niveau").val(niveau);
        $("#enligne").val(enligne);
        $("#id").val(id);
    })
    $(document).on('click', '#FormationUpdate', function (e) {
        e.preventDefault();
        let nom = $('#nom').val();
        let duree = $('#duree').val();
        let prix = $('#prix').val();
        let niveau = $('#niveau').val();
        let note = $('#note').val();
        let enligne = $('#enligne').val();
        const sa = document.getElementById("sa-success");
        const saModal = document.getElementById("close");
        document.querySelector(".load-btn").classList.remove("d-none");
        document.querySelector(".btn-txt").classList.add("d-none");
        $.ajax({
            url: "/update-formation",
            method: 'post',
            data: {
                nom: nom,
                duree: duree,
                prix: prix,
                niveau: niveau,
                note: note,
                enligne: enligne,
                id: id
            },
            success: function (res) {
                if (res.status == "success") {
                    document.querySelector(".load-btn").classList.add("d-none");
                    document.querySelector(".btn-txt").classList.remove("d-none");
                    $('#FormUpFormation')[0].reset();
                    sa.click();
                    saModal.click();
                    $(' .load-liste').load(location.href + ' .load-liste');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.errors_class').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                });
                document.querySelector(".load-btn").classList.add("d-none");
                document.querySelector(".btn-txt").classList.remove("d-none");
            }
        })
    })
    // Enregistrement d'un etudiant envoie en ajx
    $(document).on('click', '#addParticipantbtn', function (e) {
        e.preventDefault();
        //recuperation des info dans le formulaire en fonction des id
        let nom = $('#nomEtudiant');
        let prenom = $('#prenomEtudiant');
        let telephone = $('#telephoneEtudiant');
        let email = $('#emailEtudiant');
        let dateN = $('#datenEtudiant');
        var sexe = $('input[name="customRadio"]').filter(':checked').val();
        let age = $('#ageEtudiant');
        let cni = $('#cniEtudiant');
        let niveau = $('#niveauEtudiant');
        let formation = $('#formation');
        let anneescolaire = $('#anneescolaire');
        let montant = $('#montant');

        const sa = document.getElementById("sa-success");


        var CptErr = 0; //compteur d'erreurs

        if (nom.val().match(/[^\w\s]/) || nom.val() == "" || nom.val().length < 3) {
            CptErr += 1;
            nom.removeClass("form-control-success");
            nom.addClass("form-control-warning");
            let tagerr = document.querySelector(".errname");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le nom | < 3 carracteres | pas de carracteres speciaux</div>";
        } else {
            nom.removeClass("form-control-warning");
            nom.addClass('form-control-success');
            let tagerr = document.querySelector(".errname");
            tagerr.innerHTML = "";
        }

        if (prenom.val() == "" || prenom.val().length < 3 || prenom.val().match(/[^\w\s]/)) {
            CptErr += 1;
            prenom.removeClass('form-control-success');
            prenom.addClass('form-control-warning');
            let tagerr = document.querySelector(".errprenom");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le prenom | < 3 carracteres | pas de carracteres speciaux</div>";
        } else {
            prenom.removeClass('form-control-warning');
            prenom.addClass('form-control-success');
            let tagerr = document.querySelector(".errprenom");
            tagerr.innerHTML = "";
        }

        if (telephone.val() == "" || telephone.val().length != 9) {
            CptErr += 1;
            telephone.removeClass('form-control-success');
            telephone.addClass('form-control-warning');
            let tagerr = document.querySelector(".errtel");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le telephone | 9 carracteres</div>";
        } else {
            telephone.removeClass('form-control-warning');
            telephone.addClass('form-control-success');
            let tagerr = document.querySelector(".errtel");
            tagerr.innerHTML = "";
        }

        if (email.val() == "") {
            CptErr += 1;
            email.removeClass('form-control-success');
            email.addClass('form-control-warning');
            let tagerr = document.querySelector(".erremail");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez correctement le champ email</div>";
        } else {
            email.removeClass('form-control-warning');
            email.addClass('form-control-success');
            let tagerr = document.querySelector(".erremail");
            tagerr.innerHTML = "";
        }

        if (dateN.val() == "") {
            CptErr += 1;
            dateN.removeClass('form-control-success');
            dateN.addClass('form-control-warning');
            let tagerr = document.querySelector(".errdate");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ email</div>";
        } else {
            dateN.removeClass('form-control-warning');
            dateN.addClass('form-control-success');
            let tagerr = document.querySelector(".errdate");
            tagerr.innerHTML = "";
        }

        if (age.val() == "") {
            CptErr += 1;
            age.removeClass('form-control-success');
            age.addClass('form-control-warning');
            let tagerr = document.querySelector(".errage");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ</div>";
        } else {
            age.removeClass('form-control-warning');
            age.addClass('form-control-success');
            let tagerr = document.querySelector(".errage");
            tagerr.innerHTML = "";
        }

        if (cni.val() == "") {
            CptErr += 1;
            cni.removeClass('form-control-success');
            cni.addClass('form-control-warning');
            let tagerr = document.querySelector(".errcni");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ email</div>";
        } else {
            cni.removeClass('form-control-warning');
            cni.addClass('form-control-success');
            let tagerr = document.querySelector(".errcni");
            tagerr.innerHTML = "";
        }

        if (niveau.val() == "") {
            CptErr += 1;
            let tagerr = document.querySelector(".errniveau");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez un niveau</div>";
        } else {
            let tagerr = document.querySelector(".errniveau");
            tagerr.innerHTML = "";
        }

        if (sexe == undefined) {
            CptErr += 1;
            let tagerr = document.querySelector(".errsex");
            tagerr.innerHTML = "<div class='form-control-feedback'>Choisir un sexe </div>";
        } else {
            let tagerr = document.querySelector(".errsex");
            tagerr.innerHTML = "";
        }

        if (formation.val() == "") {
            CptErr += 1;
            let tagerr = document.querySelector(".errniformation");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez un niveau</div>";
        } else {
            let tagerr = document.querySelector(".errniformation");
            tagerr.innerHTML = "";
        }

        if (anneescolaire.val() == "") {
            CptErr += 1;
            let tagerr = document.querySelector(".erranneescolaire");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez un niveau</div>";
        } else {
            let tagerr = document.querySelector(".erranneescolaire");
            tagerr.innerHTML = "";
        }

        if (montant.val() == "") {
            CptErr += 1;
            montant.removeClass('form-control-success');
            montant.addClass('form-control-warning');
            let tagerr = document.querySelector(".errmontant");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ</div>";
        } else {
            montant.removeClass('form-control-warning');
            montant.addClass('form-control-success');
            let tagerr = document.querySelector(".errmontant");
            tagerr.innerHTML = "";
        }


        if (CptErr == 0) {
            // document.querySelector(".load-btn-addparticipant").classList.remove("d-none");
            // document.querySelector(".load-txt-addparticipant").classList.add("d-none");

            $.ajax({
                url: "/add-participant",
                method: "post",
                data: {
                    nom: nom.val(),
                    prenom: prenom.val(),
                    telephone: telephone.val(),
                    email: email.val(),
                    dateN: dateN.val(),
                    sexe: sexe,
                    age: age.val(),
                    cni: cni.val(),
                    niveau: niveau.val(),
                    formation: formation.val(),
                    anneescolaire: anneescolaire.val(),
                    montant: montant.val(),
                },
                success: function (res) {
                    // if (res.status == "success") {
                    //     document.querySelector(".load-btn-addparticipant").classList.add("d-none");
                    //     document.querySelector(".load-txt-addparticipant").classList.remove("d-none");
                    //     $('#FormaddParticipant')[0].reset();
                    //     $(' #FormaddParticipant').load(location.href + ' #FormaddParticipant');
                    //     sa.click();
                    // }
                    console.log(res.status);
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $('.errors_participant').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    });

                }
            })
        }
    })

    // Suppression d'un etudiant/participant
    $(document).on('click', '#deleteParticipant', function (e) {
        e.preventDefault();
        id = $(this).data('id');
        $("#idDelete").val(id);
    })
    $(document).on('click', '#btnDeleteParticipant', function (e) {
        let id = $('#idDelete').val();
        let modalClose = $('#data-dismiss');
        const sa = document.getElementById("sa-success");
        document.querySelector(".load-btn-Deleteparticipant").classList.remove("d-none");
        document.querySelector(".load-txt-Deleteparticipant").classList.add("d-none");
        $.ajax({
            url: "/delete-participant",
            method: "post",
            data: {
                id: id
            },
            success: function (res) {
                if (res.status == "success") {
                    document.querySelector(".load-btn-Deleteparticipant").classList.add("d-none");
                    document.querySelector(".load-txt-Deleteparticipant").classList.remove("d-none");
                    modalClose.click();
                    $(' #load-table').load(location.href + ' #load-table');
                    sa.click();
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.errors').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                });
                document.querySelector(".load-btn-Deleteparticipant").classList.add("d-none");
                document.querySelector(".load-txt-Deleteparticipant").classList.remove("d-none");
            }
        })
    })

    // update d'un etudiant

    $(document).on('click', '#updateParticipants', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let nom = $(this).data('nom');
        let prenom = $(this).data('prenom');
        let telephone = $(this).data('telephone');
        let email = $(this).data('email');
        let sexe = $(this).data('sexe');
        let age = $(this).data('age');
        let niveau = $(this).data('niveau');
        let dateN = $(this).data('date');
        let cni = $(this).data('cni');

        $("#id").val(id);
        $("#nomEtudiant").val(nom);
        $("#prenomEtudiant").val(prenom);
        $("#telephoneEtudiant").val(telephone);
        $("#emailEtudiant").val(email);
        $("#datenEtudiant").val(dateN);
        $("#ageEtudiant").val(age);
        $("#cniEtudiant").val(cni);
        $("#sexeId").val(sexe);
        $('select option[value="' + niveau + '"]').prop('selected', true);
    })
    $(document).on('click', '#ParticipantUpdate', function (e) {
        e.preventDefault();

        let nom = $('#nomEtudiant');
        let id = $('#id').val();
        let prenom = $('#prenomEtudiant');
        let telephone = $('#telephoneEtudiant');
        let email = $('#emailEtudiant');
        let dateN = $('#datenEtudiant');
        var sexe = $('input[name="customRadio"]').filter(':checked').val();
        let age = $('#ageEtudiant');
        let cni = $('#cniEtudiant');
        let niveau = $('#niveauEtudiant');
        if (sexe == undefined) {
            sexe = $('#sexeId').val();
        }
        // alert(sexe);

        var CptErr = 0; //compteur d'erreurs

        if (nom.val().match(/[^\w\s]/) || nom.val() == "" || nom.val().length < 3) {
            CptErr += 1;
            nom.removeClass("form-control-success");
            nom.addClass("form-control-warning");
            let tagerr = document.querySelector(".errname");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le nom | < 3 carracteres | pas de carracteres speciaux</div>";
        } else {
            nom.removeClass("form-control-warning");
            nom.addClass('form-control-success');
            let tagerr = document.querySelector(".errname");
            tagerr.innerHTML = "";
        }

        if (prenom.val() == "" || prenom.val().length < 3 || prenom.val().match(/[^\w\s]/)) {
            CptErr += 1;
            prenom.removeClass('form-control-success');
            prenom.addClass('form-control-warning');
            let tagerr = document.querySelector(".errprenom");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le prenom | < 3 carracteres | pas de carracteres speciaux</div>";
        } else {
            prenom.removeClass('form-control-warning');
            prenom.addClass('form-control-success');
            let tagerr = document.querySelector(".errprenom");
            tagerr.innerHTML = "";
        }

        if (telephone.val() == "" || telephone.val().length != 9) {
            CptErr += 1;
            telephone.removeClass('form-control-success');
            telephone.addClass('form-control-warning');
            let tagerr = document.querySelector(".errtel");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le telephone | 9 carracteres</div>";
        } else {
            telephone.removeClass('form-control-warning');
            telephone.addClass('form-control-success');
            let tagerr = document.querySelector(".errtel");
            tagerr.innerHTML = "";
        }

        if (email.val() == "") {
            CptErr += 1;
            email.removeClass('form-control-success');
            email.addClass('form-control-warning');
            let tagerr = document.querySelector(".erremail");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez correctement le champ email</div>";
        } else {
            email.removeClass('form-control-warning');
            email.addClass('form-control-success');
            let tagerr = document.querySelector(".erremail");
            tagerr.innerHTML = "";
        }

        if (dateN.val() == "") {
            CptErr += 1;
            dateN.removeClass('form-control-success');
            dateN.addClass('form-control-warning');
            let tagerr = document.querySelector(".errdate");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ email</div>";
        } else {
            dateN.removeClass('form-control-warning');
            dateN.addClass('form-control-success');
            let tagerr = document.querySelector(".errdate");
            tagerr.innerHTML = "";
        }

        if (age.val() == "") {
            CptErr += 1;
            age.removeClass('form-control-success');
            age.addClass('form-control-warning');
            let tagerr = document.querySelector(".errage");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ</div>";
        } else {
            age.removeClass('form-control-warning');
            age.addClass('form-control-success');
            let tagerr = document.querySelector(".errage");
            tagerr.innerHTML = "";
        }

        if (cni.val() == "") {
            CptErr += 1;
            cni.removeClass('form-control-success');
            cni.addClass('form-control-warning');
            let tagerr = document.querySelector(".errcni");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ email</div>";
        } else {
            cni.removeClass('form-control-warning');
            cni.addClass('form-control-success');
            let tagerr = document.querySelector(".errcni");
            tagerr.innerHTML = "";
        }

        if (niveau.val() == "") {
            CptErr += 1;
            let tagerr = document.querySelector(".errniveau");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez un niveau</div>";
        } else {
            let tagerr = document.querySelector(".errniveau");
            tagerr.innerHTML = "";
        }

        if (CptErr == 0) {
            $.ajax({
                url: "/Update-participant",
                method: "post",
                data: {
                    nom: nom.val(),
                    prenom: prenom.val(),
                    telephone: telephone.val(),
                    email: email.val(),
                    dateN: dateN.val(),
                    sexe: sexe,
                    age: age.val(),
                    cni: cni.val(),
                    niveau: niveau.val(),
                },
                success: function (res) {
                    if (res.status == "success") {
                        alert();
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $('.errors_participant').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    });
                }
            })
        }

    })

})

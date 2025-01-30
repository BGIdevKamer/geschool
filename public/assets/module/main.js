
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    // scrool to top function
    function scrollTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    function reset() {
        const dataSelect = document.querySelector('select[name="DataTables_Table_0_length"]');
        const option10 = Array.from(dataSelect.options).find(option => option.value === "25");

        if (option10) {
            option10.select = true;
            dataSelect.dispatchEvent(new Event('change'));
        } else {
            alert('input non valide');
        }
    }
    // Enregistrer une  nouvelle formation
    //  validation & envoie des infortion en ajax
    $(document).on('submit', '#FormationForm', function (e) {
        e.preventDefault();

        let insc = $('#tranche_1').val();
        let pr = $('#tranche_2').val();
        let dr = $('#tranche_3').val();
        let tr = $('#tranche_4').val();
        let prix = $('#prix').val();

        let sum = parseInt(insc) + parseInt(pr) + parseInt(dr) + parseInt(tr);

        if (sum != prix) {
            let tagerr = document.querySelector(".err");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1 text-danger'>la somme des tranche et l'iscription doit etre egale au prix de la  formation</div>";
            return false;
        } else {
            let tagerr = document.querySelector(".err");
            tagerr.innerHTML = "";
        }


        const formData = new FormData(this);

        const sa = document.getElementById("sa-success");
        document.querySelector(".save-load-btn-ma").classList.remove("d-none");
        document.querySelector(".save-bu-ma").classList.add("d-none");
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == "success") {
                    document.querySelector(".save-load-btn-ma").classList.add("d-none");
                    document.querySelector(".save-bu-ma").classList.remove("d-none");
                    $('#FormationForm')[0].reset();
                    sa.click();
                    $(' .errors_calss').load(location.href + ' .errors_calss');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.errors_calss').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                });
                document.querySelector(".save-load-btn-ma").classList.add("d-none");
                document.querySelector(".save-bu-ma").classList.remove("d-none");
                scrollTop();
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
        if (enligne == undefined) {
            enligne = 2;
        }
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
            url: route,
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
    // $(document).on('click', '#addParticipantbtn', function (e) {
    //     e.preventDefault();
    //     //recuperation des info dans le formulaire en fonction des id
    //     let nom = $('#nomEtudiant');
    //     let prenom = $('#prenomEtudiant');
    //     let telephone = $('#telephoneEtudiant');
    //     let email = $('#emailEtudiant');
    //     let dateN = $('#datenEtudiant');
    //     var sexe = $('input[name="customRadio"]').filter(':checked').val();
    //     let age = $('#ageEtudiant');
    //     let cni = $('#cniEtudiant');
    //     let niveau = $('#niveauEtudiant');
    //     let formation = $('#formation');
    //     let anneescolaire = $('#anneescolaire');
    //     let niv = $('#niv');
    //     // let montant = $('#montant');

    //     $(' .load-select').load(location.href + ' .load-select');

    //     const sa = document.getElementById("modal-success");



    //     document.querySelector(".load-btn-addparticipant").classList.remove("d-none");
    //     document.querySelector(".load-txt-addparticipant").classList.add("d-none");

    //     $.ajax({
    //         url: route,
    //         method: "post",
    //         data: {
    //             nom: nom.val(),
    //             prenom: prenom.val(),
    //             telephone: telephone.val(),
    //             email: email.val(),
    //             dateN: dateN.val(),
    //             sexe: sexe,
    //             age: age.val(),
    //             cni: cni.val(),
    //             niveau: niveau.val(),
    //             formation: formation.val(),
    //             anneescolaire: anneescolaire.val(),
    //             niv: niv.val(),
    //         },
    //         success: function (res) {
    //             if (res.status == "success") {
    //                 document.querySelector(".load-btn-addparticipant").classList.add("d-none");
    //                 document.querySelector(".load-txt-addparticipant").classList.remove("d-none");
    //                 $('#FormaddParticipant')[0].reset();
    //                 $(' .errors_participant').load(location.href + ' .errors_participant');
    //                 sa.click();
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $.each(error.errors, function (index, value) {
    //                 $('.errors_participant').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
    //             });
    //             document.querySelector(".load-btn-addparticipant").classList.add("d-none");
    //             document.querySelector(".load-txt-addparticipant").classList.remove("d-none");
    //             scrollTop();
    //         }
    //     })
    //     // }
    // })

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
        var saClose = document.getElementById("sa-success");
        var closeM = document.getElementById("closeModals");
        if (sexe == undefined) {
            sexe = $('#sexeId').val();
        }

        var CptErr = 0; //compteur d'erreurs

        if (nom.val().match(/[^\w\s]/) || nom.val() == "" || nom.val().length < 3) {
            CptErr += 1;
            nom.addClass("form-control-warning");
            let tagerr = document.querySelector(".errname");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le nom | < 3 carracteres | pas de carracteres speciaux</div>";
        }

        if (prenom.val() == "" || prenom.val().length < 3 || prenom.val().match(/[^\w\s]/)) {
            CptErr += 1;
            prenom.addClass('form-control-warning');
            let tagerr = document.querySelector(".errprenom");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le prenom | < 3 carracteres | pas de carracteres speciaux</div>";
        }

        if (telephone.val() == "" || telephone.val().length != 9) {
            CptErr += 1;
            telephone.addClass('form-control-warning');
            let tagerr = document.querySelector(".errtel");
            tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le telephone | 9 carracteres</div>";
        }
        if (email.val() == "") {
            CptErr += 1;
            email.addClass('form-control-warning');
            let tagerr = document.querySelector(".erremail");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez correctement le champ email</div>";
        }
        if (dateN.val() == "") {
            CptErr += 1;
            dateN.addClass('form-control-warning');
            let tagerr = document.querySelector(".errdate");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ email</div>";
        }

        if (age.val() == "") {
            CptErr += 1;
            age.addClass('form-control-warning');
            let tagerr = document.querySelector(".errage");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ</div>";
        }

        if (niveau.val() == "") {
            CptErr += 1;
            let tagerr = document.querySelector(".errniveau");
            tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez un niveau</div>";
        }

        if (CptErr == 0) {
            document.querySelector(".load-btn-addparticipant").classList.remove("d-none");
            document.querySelector(".load-txt-addparticipant").classList.add("d-none");
            $.ajax({
                url: route,
                method: "post",
                data: {
                    nom: nom.val(),
                    id: id,
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
                        document.querySelector(".load-btn-addparticipant").classList.add("d-none");
                        document.querySelector(".load-txt-addparticipant").classList.remove("d-none");
                        $(' .errors_participant').load(location.href + ' .errors_participant');
                        $(' #load-table').load(location.href + ' #load-table');
                        $('#FormaddParticipant')[0].reset();
                        saClose.click();
                        closeM.click();
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $('.errors_participant').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    });
                    document.querySelector(".load-btn-addparticipant").classList.add("d-none");
                    document.querySelector(".load-txt-addparticipant").classList.remove("d-none");
                }
            })
        }

    })

    // $('#CourForm').submit(function (event) {

    //     var fileInput = $('#video')[0];
    //     var file = fileInput.files[0];
    //     var content = $('#content');
    //     var libeller = $('#libeller');
    //     var num = $('#num');
    //     var formation = $('#formation');
    //     var deofile = $('#deofile');
    //     var desc = $('#desc');
    //     var miniatureInput = $('#miniature')[0];
    //     var miniature = miniatureInput.files[0];




    //     if (libeller.val() == "") {
    //         libeller.addClass("form-control-warning");
    //         let tagerr = document.querySelector(".err-libeller");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez titre du cour</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         libeller.removeClass("form-control-warning");
    //         let tagerr = document.querySelector(".err-libeller");
    //         tagerr.innerHTML = "";
    //     }

    //     if (num.val() == "") {
    //         num.addClass("form-control-warning");
    //         let tagerr = document.querySelector(".err-num");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez le numero du cour</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         num.removeClass("form-control-warning");
    //         let tagerr = document.querySelector(".err-num");
    //         tagerr.innerHTML = "";
    //     }

    //     if (!miniature) {
    //         let tagerr = document.querySelector(".err-miniature");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une images pour le cour</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         let tagerr = document.querySelector(".err-miniature");
    //         tagerr.innerHTML = "";
    //     }

    //     var allowedExtensionsImages = ['png', 'jpg', 'webp', 'PNG', 'JPG']; // Formats vidéo acceptés
    //     var extensionImages = miniature.name.split('.').pop().toLowerCase();

    //     if (allowedExtensionsImages.indexOf(extensionImages) === -1) {
    //         let tagerr = document.querySelector(".err-miniature");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une image de format valide</div>";
    //         scrollTop();
    //         return false; // Empêche la soumission du formulaire
    //     } else {
    //         let tagerr = document.querySelector(".err-miniature");
    //         tagerr.innerHTML = "";
    //     }

    //     // Vérification de l'existence d'un fichier
    //     if (!file) {
    //         let tagerr = document.querySelector(".err-video");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une video</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         let tagerr = document.querySelector(".err-video");
    //         tagerr.innerHTML = "";
    //     }

    //     // Vérification du type de fichier
    //     var allowedExtensions = ['mp4', 'webm', 'ogg']; // Formats vidéo acceptés
    //     var extension = file.name.split('.').pop().toLowerCase();

    //     if (allowedExtensions.indexOf(extension) === -1) {
    //         let tagerr = document.querySelector(".err-video");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une video dans un format valide</div>";
    //         scrollTop();
    //         return false; // Empêche la soumission du formulaire
    //     } else {
    //         let tagerr = document.querySelector(".err-video");
    //         tagerr.innerHTML = "";
    //     }

    //     // if (deofile.val() == "") {
    //     //     deofile.addClass("form-control-warning");
    //     //     let tagerr = document.querySelector(".err-deofile");
    //     //     tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez le l'id de la video youtube</div>";
    //     //     scrollTop();
    //     //     return false;
    //     // } else {
    //     //     deofile.removeClass("form-control-warning");
    //     //     let tagerr = document.querySelector(".err-deofile");
    //     //     tagerr.innerHTML = "";
    //     // }

    //     if (formation.val() == "") {
    //         let tagerr = document.querySelector(".err-formation");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller choisir une formation</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         let tagerr = document.querySelector(".err-formation");
    //         tagerr.innerHTML = "";
    //     }

    //     if (desc.val() == "") {
    //         desc.addClass("form-control-warning");
    //         let tagerr = document.querySelector(".err-desc");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une description</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         desc.removeClass("form-control-warning");
    //         let tagerr = document.querySelector(".err-desc");
    //         tagerr.innerHTML = "";
    //     }


    //     if (content.val() == "") {
    //         let tagerr = document.querySelector(".err-content");
    //         tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez le contenue textuel du cour</div>";
    //         scrollTop();
    //         return false;
    //     } else {
    //         let tagerr = document.querySelector(".err-content");
    //         tagerr.innerHTML = "";
    //     }

    //     document.querySelector(".load-btn-cour").classList.remove("d-none");
    //     document.querySelector(".load-txt-cour").classList.add("d-none");

    //     // Si le fichier est valide, la soumission continue normalement
    //     return true; // Permet la soumission du formulaire
    // });




    // Soumission du formulaire en AJAX
    $('#CourForm').on('submit', function (e) {
        e.preventDefault(); // Empêche la soumission par défaut

        var fileInput = $('#video')[0];
        var file = fileInput.files[0];
        var content = $('#content');
        var libeller = $('#libeller');
        var num = $('#num');
        var formation = $('#formation');
        var desc = $('#desc');
        var miniatureInput = $('#miniature')[0];
        var miniature = miniatureInput.files[0];


        if (libeller.val() == "") {
            libeller.addClass("form-control-warning");
            let tagerr = document.querySelector(".err-libeller");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez titre du cour</div>";
            scrollTop();
            return false;
        } else {
            libeller.removeClass("form-control-warning");
            let tagerr = document.querySelector(".err-libeller");
            tagerr.innerHTML = "";
        }

        if (num.val() == "") {
            num.addClass("form-control-warning");
            let tagerr = document.querySelector(".err-num");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez le numero du cour</div>";
            scrollTop();
            return false;
        } else {
            num.removeClass("form-control-warning");
            let tagerr = document.querySelector(".err-num");
            tagerr.innerHTML = "";
        }

        if (!miniature) {
            let tagerr = document.querySelector(".err-miniature");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une images pour le cour</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".err-miniature");
            tagerr.innerHTML = "";
        }

        var allowedExtensionsImages = ['png', 'jpg', 'webp', 'PNG', 'JPG']; // Formats vidéo acceptés
        var extensionImages = miniature.name.split('.').pop().toLowerCase();

        if (allowedExtensionsImages.indexOf(extensionImages) === -1) {
            let tagerr = document.querySelector(".err-miniature");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une image de format valide</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".err-miniature");
            tagerr.innerHTML = "";
        }

        // Vérification de l'existence d'un fichier
        if (!file) {
            let tagerr = document.querySelector(".err-video");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une video</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".err-video");
            tagerr.innerHTML = "";
        }

        // Vérification du type de fichier
        var allowedExtensions = ['mp4', 'webm', 'ogg']; // Formats vidéo acceptés
        var extension = file.name.split('.').pop().toLowerCase();

        if (allowedExtensions.indexOf(extension) === -1) {
            let tagerr = document.querySelector(".err-video");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une video dans un format valide</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".err-video");
            tagerr.innerHTML = "";
        }


        if (formation.val() == "") {
            let tagerr = document.querySelector(".err-formation");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller choisir une formation</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".err-formation");
            tagerr.innerHTML = "";
        }

        if (desc.val() == "") {
            desc.addClass("form-control-warning");
            let tagerr = document.querySelector(".err-desc");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez une description</div>";
            scrollTop();
            return false;
        } else {
            desc.removeClass("form-control-warning");
            let tagerr = document.querySelector(".err-desc");
            tagerr.innerHTML = "";
        }


        if (content.val() == "") {
            let tagerr = document.querySelector(".err-content");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller renseignez le contenue textuel du cour</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".err-content");
            tagerr.innerHTML = "";
        }

        document.querySelector(".load-btn-cour").classList.remove("d-none");
        document.querySelector(".load-txt-cour").classList.add("d-none");
        var sa = document.getElementById("sa-success");
        var saModal = document.getElementById("sa-start");


        // const formData = new FormData(this); // Récupère toutes les données du formulaire
        // filesToUpload.forEach(file => {
        //     formData.append('pieces[]', file); // Ajoute les fichiers au FormData
        // });

        scrollTop();

        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: new FormData(this), // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (event) {
                    if (event.lengthComputable) {
                        let percentComplete = (event.loaded / event.total) * 100;
                        $('.progress').show();
                        $('.progress-bar').css('width', percentComplete + '%');
                        let tagerr = document.querySelector(".progress-bar");
                        tagerr.innerHTML = Math.round(percentComplete) + '%';
                    }
                });
                return xhr;
            },

            success: function (res) {
                if (res.status == "success") {
                    $("#IdCour").val(res.idCour);
                    sa.click();
                    $('#CourForm')[0].reset();
                    document.querySelector(".load-btn-cour").classList.add("d-none");
                    document.querySelector(".load-txt-cour").classList.remove("d-none");
                    $(' .myListe').load(location.href + ' .myListe');
                    saModal.click();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Affichez un message d'erreur
                console.error('Erreur lors du téléchargement', textStatus, errorThrown);
            }
        });
    });

    $('#myFormFiles').on('submit', function (e) {

        e.preventDefault();

        const formData = new FormData(this); // Récupère toutes les données du formulaire
        filesToUpload.forEach(file => {
            formData.append('pieces[]', file); // Ajoute les fichiers au FormData
        });

        filesToUpload.length = 0;

        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                // console.log('effectuer');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Affichez un message d'erreur
                // console.error('Erreur lors du téléchargement', textStatus, errorThrown);
            }
        });
    });

    $('#ExerciceForm').on('submit', function (e) {
        e.preventDefault();

        let cour = $('#cour');
        let libeller = $('#libeller');
        let time = $('#time');
        let desc = $('#desc');

        if (cour.val() == "") {
            let tagerr = document.querySelector(".errExercices");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller Choisir un cour</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".errExercices");
            tagerr.innerHTML = "";
        }

        if (libeller.val() == "") {
            let tagerr = document.querySelector(".errlibeller");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller Renseigner le libeller du cour</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".errlibeller");
            tagerr.innerHTML = "";
        }

        if (time.val() == "") {
            let tagerr = document.querySelector(".errtime");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller Renseigner la durée de l'exercice</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".errtime");
            tagerr.innerHTML = "";
        }

        if (desc.val() == "") {
            let tagerr = document.querySelector(".errdesc");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller Renseigner la description</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".errdesc");
            tagerr.innerHTML = "";
        }

        document.querySelector(".save-load-btn-ma").classList.remove("d-none");
        document.querySelector(".save-bu-ma").classList.add("d-none");
        const sa = document.getElementById("sa-success");


        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == "success") {
                    $('#ExerciceForm')[0].reset();
                    $('#QuestionListe').empty();
                    document.querySelector(".save-load-btn-ma").classList.add("d-none");
                    document.querySelector(".save-bu-ma").classList.remove("d-none");
                    $("#idEx").val(res.idExercices);
                    document.querySelector(".exrcices").classList.add("d-none");
                    document.querySelector(".question").classList.remove("d-none");
                    sa.click();
                } else {
                    document.querySelector(".save-load-btn-ma").classList.add("d-none");
                    document.querySelector(".save-bu-ma").classList.remove("d-none");
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.errors_participant').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                });
                document.querySelector(".load-btn-addparticipant").classList.add("d-none");
                document.querySelector(".load-txt-addparticipant").classList.remove("d-none");
            }
        });
    })

    $('#FormQuestion').on('submit', function (e) {
        e.preventDefault();

        let question = $('#question');
        const sa = document.getElementById("sa-success");



        if (question.val() == "") {
            let tagerr = document.querySelector(".questionLibeller");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller Renseigner le libeller de la question</div>";
            scrollTop();
            return false;
        } else {
            let tagerr = document.querySelector(".questionLibeller");
            tagerr.innerHTML = "";
        }

        const formData = new FormData(this);

        document.querySelector(".save-load-question").classList.remove("d-none");
        document.querySelector(".btn-load-question").classList.add("d-none");


        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {

                if (res.status == "success") {
                    sa.click();
                    $('#FormQuestion')[0].reset();
                    $.each(res.questions, function (index, question) {
                        $('#QuestionListe').append('<div class="row mb-3"> <div class="col-md-6 col-sm-12"> <h5 class="pb-3">' + question.Question + '</h5> <div class="form-group"> <div class="custom-control custom-radio mb-5" id="' + question.id + '"> </div></div></div><div class="col-md-6 col-sm-12 text-right"><button class="btn btn-primary"  id="btnChoix" data-toggle="modal" data-target="#success-modal" data-id="' + question.id + '"><i class="icon-copy fa fa-plus" aria-hidden="true" ></i></button>');
                    });
                    document.querySelector(".save-load-question").classList.add("d-none");
                    document.querySelector(".btn-load-question").classList.remove("d-none");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Affichez un message d'erreur
                console.error('Erreur lors du téléchargement', textStatus, errorThrown);
            }
        });
    })

    $(document).on('click', '#btnChoix', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $("#idQuestion").val(id);
    })

    $('#ChoixForm').on('submit', function (e) {
        e.preventDefault();

        let libellerChoix = $('#libellerChoix');
        let iscorect = $('#iscorect');
        const sa = document.getElementById("sa-success");

        if (libellerChoix.val() == "") {
            let tagerr = document.querySelector(".libellerChoix");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Veiller Renseigner le libeller du choix</div>";
            return false;
        } else {
            let tagerr = document.querySelector(".libellerChoix");
            tagerr.innerHTML = "";
        }

        if (iscorect.val() == "") {
            let tagerr = document.querySelector(".iscorecterr");
            tagerr.innerHTML = "<div class='form-control-feedback pt-1 pb-1'>Renseigner un choix pour la question</div>";
            return false;
        } else {
            let tagerr = document.querySelector(".iscorecterr");
            tagerr.innerHTML = "";
        }

        document.querySelector(".save-load-choix").classList.remove("d-none");
        document.querySelector(".save-choix").classList.add("d-none");

        const formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {

                if (res.status == "success") {
                    $('#ChoixForm')[0].reset();
                    sa.click();
                    // console.log(res.Choixes);
                    $.each(res.Choixes, function (index, choix) {
                        $('#' + choix.question_id + '').append('<div class="custom-control custom-radio mb-5"> <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="' + choix.id + '" /> <label class="custom-control-label" for="customRadio1">' + choix.content + '</label></div>');
                    });
                    document.querySelector(".save-load-choix").classList.add("d-none");
                    document.querySelector(".save-choix").classList.remove("d-none");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Affichez un message d'erreur
                console.error('Erreur lors du téléchargement', textStatus, errorThrown);
            }
        });
    });

    $(document).on('click', '#SelectFormCour', function (e) {
        e.preventDefault();
        let idCour = $('#idCour').val();
        $("#idEx").val(idCour);
        let idEx = $('#idEx').val();
        if (idCour != "") {
            $('#QuestionListe').empty();
            document.querySelector(".exrcices").classList.add("d-none");
            document.querySelector(".question").classList.remove("d-none");
        }

    })

    $(document).on('click', '#NewExercice', function (e) {
        e.preventDefault();
        document.querySelector(".exrcices").classList.remove("d-none");
        document.querySelector(".question").classList.add("d-none");
    })

    // $('#DeleteCour').on('click', function (e) {
    //     e.preventDefault();
    //     let id = $(this).data('id');
    //     alert(id);
    // });

    $(document).on('submit', '#QuizForm', function (e) {
        e.preventDefault();
        let modal = $('#modal-success');
        document.querySelector(".save-load-btn-ma").classList.remove("d-none");
        document.querySelector(".save-bu-ma").classList.add("d-none");
        const formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                document.querySelector(".save-load-btn-ma").classList.add("d-none");
                document.querySelector(".save-bu-ma").classList.remove("d-none");
                if (res.status == "success") {
                    $('#scorePart').append('<h5 class="text-center text-primary">Score : ' + res.score + ' points</h5>');
                    modal.click();
                } else {
                    modal.click();
                }
            },
        });
    })

    $(document).on('submit', '#RegisterParticipant', function (e) {
        e.preventDefault();
        alert();
        const formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData,  // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == "success") {
                    $('#sa-success').click();
                    $('.load-txt').removeClass('d-none');
                    $('.load-btn').addClass('d-none');
                }
            },
            // error: function (jqXHR, textStatus, errorThrown) {
            //     // Affichez un message d'erreur
            //     console.error('Erreur lors du téléchargement', textStatus, errorThrown);
            // }
        });
    })

    $(document).on('submit', '#FormMatieres', function (e) {
        e.preventDefault();
        const sa = document.getElementById("sa-success");
        let close = $('#closeSave');
        document.querySelector(".load-btn-save").classList.remove("d-none");
        document.querySelector(".btn-txt-save").classList.add("d-none");
        const formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                document.querySelector(".load-btn-save").classList.add("d-none");
                document.querySelector(".btn-txt-save").classList.remove("d-none");
                $(' #load-table').load(location.href + ' #load-table');
                $('#FormMatieres')[0].reset();
                sa.click();
                close.click();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Affichez un message d'erreur
                console.error('Erreur lors du téléchargement', textStatus, errorThrown);
            }
        });
    })

    $(document).on('click', '#suppMatieres', function (e) {
        e.preventDefault();
        let id = $('#idDelete').val();
        let modalClose = $('#data-dismiss');
        const sa = document.getElementById("sa-success");
        document.querySelector(".load-btn-Deleteparticipant").classList.remove("d-none");
        document.querySelector(".load-txt-Deleteparticipant").classList.add("d-none");
        $.ajax({
            url: route,
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

    $(document).on('click', '#modifyMatieres', function (e) {
        e.preventDefault();
        let categorie = $(this).data('categorie');
        let id = $(this).data('id');
        let libeller = $(this).data('libeller');
        let heures = $(this).data('heures');
        let coefs = $(this).data('coefs');
        // alert(categorie);

        $('#upId').val(id);
        $('#uplibeller').val(libeller);
        $('#upheure').val(heures);
        $('#upcoefs').val(coefs);
        $('#upcategorie').val(categorie);
    })

    $(document).on('submit', '#FormModifyMatieres', function (e) {
        e.preventDefault();
        const sa = document.getElementById("sa-success");
        let close = $('#close');
        document.querySelector(".load-btn").classList.remove("d-none");
        document.querySelector(".btn-txt").classList.add("d-none");
        const formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                document.querySelector(".load-btn").classList.add("d-none");
                document.querySelector(".btn-txt").classList.remove("d-none");
                $(' #load-table').load(location.href + ' #load-table');
                $('#FormModifyMatieres')[0].reset();
                sa.click();
                close.click();
            },
        });
    })

    $(document).on('submit', '#FormEvaluation', function (e) {
        e.preventDefault();
        const sa = document.getElementById("sa-success");
        let close = $('#close');
        document.querySelector(".load-btn").classList.remove("d-none");
        document.querySelector(".btn-txt").classList.add("d-none");
        const formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'), // URL de la route Laravel
            type: 'POST',
            data: formData, // Envoie les données du formulaire en utilisant FormData
            processData: false,
            contentType: false,
            success: function (res) {
                document.querySelector(".load-btn").classList.add("d-none");
                document.querySelector(".btn-txt").classList.remove("d-none");
                $(' .load-Evaluation').load(location.href + ' .load-Evaluation');
                $('#FormEvaluation')[0].reset();
                sa.click();
                close.click();
            }, error: function (err) {
                $.each(error.errors, function (index, value) {
                    $('.errors').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                });
                document.querySelector(".load-btn").classList.add("d-none");
                document.querySelector(".btn-txt").classList.remove("d-none");
            }
        });
    })

    $(document).on('submit', '#form-charge', function () {
        document.querySelector(".load-btn-ex").classList.remove("d-none");
        document.querySelector(".btn-txt-ex").classList.add("d-none");
    })

    $(document).on('submit', '#form-delete', function () {
        document.querySelector(".load-btn-Delete").classList.remove("d-none");
        document.querySelector(".load-txt-Delete").classList.add("d-none");
    })

    $(document).on('submit', '#form-update', function () {
        document.querySelector(".load-btn-update").classList.remove("d-none");
        document.querySelector(".btn-txt-update").classList.add("d-none");
    })

    $(document).on('click', '#modifySession', function (e) {
        e.preventDefault();
        let libeller = $(this).data('libeller');
        let description = $(this).data('description');
        let numero = $(this).data('numero');
        let id = $(this).data('id');

        $("#idUpdate").val(id);
        $("#libellerSession").val(libeller);
        $("#descriptionSession").val(description);
        $("#numeroSession").val(numero);
    })

    $(document).on('click', '#modifyCategorie', function (e) {
        e.preventDefault();
        let libeller = $(this).data('libeller');
        let id = $(this).data('id');

        $("#categorieId").val(id);
        $("#upcategorieLibeller").val(libeller);
    })

    $(document).on('click', '#deleteCategorie', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $("#idDeleteCategorie").val(id);
    })

    $(document).on('click', '#deleteEnseigant', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $("#idEnseigant").val(id);
    })

    $(document).on('click', '#deleteSalle', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $("#idSalle").val(id);
    })

    $(document).on('click', '#deleteSession', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let emploie_id = $(this).data('emploie_id');

        $("#id").val(id);
        $("#emploie_id").val(emploie_id);
    });

    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $("#id").val(id);
    })

    // if (telephone.val() == "" || telephone.val().length != 9) {
    //     CptErr += 1;
    //     telephone.addClass('form-control-warning');
    //     let tagerr = document.querySelector(".errtel");
    //     tagerr.innerHTML = "<div class='form-control-feedback'>Renseignez correctement le telephone | 9 carracteres</div>";
    // }

    $(document).on('click', '#saveEnseignants', function (e) {
        let telephone = $('#phone');
        if (telephone.val() == "" || telephone.val().length != 9) {
            e.preventDefault();
            telephone.addClass('form-control-warning');
            let tagerr = document.querySelector(".errtel");
            tagerr.innerHTML = "<div class='form-control-feedback has-warning'>Renseignez correctement le telephone | 9 carracteres</div>";
        }
    })

    $(document).ready(function () {
        // Fonction pour mettre à jour l'appréciation en temps réel
        function updateAppreciation(id) {
            const noteInput = $(`input[name="participant_${id}"]`);
            const appreciationInput = $(`input[name="appreciation_${id}"]`);

            // Vérifiez si les champs existent
            if (!noteInput.length || !appreciationInput.length) {
                console.error(`Les champs pour l'ID ${id} n'existent pas.`);
                return;
            }

            const note = parseInt(noteInput.val());

            let appreciation = "";
            if (isNaN(note)) {
                appreciationInput.val("");
                return; // Traiter le cas où la note n'est pas un nombre
            }

            if (note <= 10) {
                appreciation = "Passable";
            } else if (note >= 11) {
                if (note <= 16) {
                    appreciation = "Bien";
                } else if (note > 16) {
                    appreciation = "Excellent";
                } else if (note = 11) {
                    appreciation = "Bien";
                } else {
                    appreciation = "Tres Bien";
                }
            }


            appreciationInput.val(appreciation);
        }

        // Attach event listener à chaque input de note
        $('input[name^="participant_"]').on('input', function () {
            const id = this.name.split('_')[1];
            updateAppreciation(id);
        });

    });

    $(document).on('click', '#ModifyEnseignant', function (e) {
        e.preventDefault();
        let nom = $(this).data('nom');
        let prenom = $(this).data('prenom');
        let phone = $(this).data('phone');
        let email = $(this).data('email');
        let id = $(this).data('id');
        // alert(categorie);

        $('#idEnseignant').val(id);
        $('#nomEnseignant').val(nom);
        $('#prenomEnseignant').val(prenom);
        $('#phoneEnseignant').val(phone);
        $('#emailEnseignant').val(email);
    })

    $(document).on('click', '#modfiySalle', function (e) {
        e.preventDefault();
        let nom = $(this).data('nom');
        let places = $(this).data('places');
        let description = $(this).data('description');
        let id = $(this).data('id');
        // alert(categorie);

        $('#salleId').val(id);
        $('#nomSalle').val(nom);
        $('#placeSalle').val(places);
        $('#descriptionSalle').val(description);
    })

    $(document).on('click', '#modifySession', function (e) {
        e.preventDefault();
        let nom = $(this).data('nom');
        // alert(categorie);

        $('#salleId').val(id);
    })

    $(document).on('click', '#deleteModal', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $('#id').val(id);
    });

    $(document).on('click', '#updateModule', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let libeller = $(this).data('libeller');
        let description = $(this).data('description');
        let formation_id = $(this).data('formation_id');

        $('#idupdate').val(id);
        $('#updatelibeller').val(libeller);
        $('#updatedescription').val(description);
        $('#ancienneValue').val(formation_id);
    })



})


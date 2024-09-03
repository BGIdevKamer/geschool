<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Enregistrer une  nouvelle formation
        //  validation & envoie des infortion en ajax
        $(document).on('click', '#Envoyer', function(e) {
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
                url: "{{route('add.formation')}}",
                method: 'post',
                data: {
                    name: name,
                    duree: duree,
                    prix: prix,
                    prerequit: prerequit,
                    note: note
                },
                success: function(res) {
                    if (res.status == "success") {
                        document.querySelector(".save-load-btn-ma").classList.add("d-none");
                        document.querySelector(".save-bu-ma").classList.remove("d-none");
                        $('#FormationForm')[0].reset();
                        sa.click();
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errors_calss').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    });
                    document.querySelector(".save-load-btn-ma").classList.add("d-none");
                    document.querySelector(".save-bu-ma").classList.remove("d-none");
                }
            })

        })

        //supression d'une formation
        // envoie des informations en ajax

        $(document).on('click', '#ApplieUpdate', function(e) {
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
        $(document).on('click', '#FormationUpdate', function(e) {
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
                url: "{{route('update.formation')}}",
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
                success: function(res) {
                    if (res.status == "success") {
                        document.querySelector(".load-btn").classList.add("d-none");
                        document.querySelector(".btn-txt").classList.remove("d-none");
                        $('#FormUpFormation')[0].reset();
                        sa.click();
                        saModal.click();
                        $(' .load-liste').load(location.href + ' .load-liste');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errors_class').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    });
                    document.querySelector(".load-btn").classList.add("d-none");
                    document.querySelector(".btn-txt").classList.remove("d-none");
                }
            })
        })
        // Enregistrement d'un etudiant envoie en ajx
        $(document).on('click', '#addParticipantbtn', function(e) {
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

            var CptErr = 0; //compteur d'erreurs

            if (nom.val().match(/[^\w\s]/) || nom.val() == "" || nom.val().length < 3) {
                CptErr += 1;
                nom.removeClass("form-control-success");
                nom.addClass("form-control-warning");
                let tagerr = document.querySelector(".errname");
                tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez correctement le champ nom</div>";
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
                tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez correctement le champ prenom</div>";
            } else {
                prenom.removeClass('form-control-warning');
                prenom.addClass('form-control-success');
                let tagerr = document.querySelector(".errprenom");
                tagerr.innerHTML = "";
            }

            if (telephone.val() == "" || telephone.val().length == 9) {
                CptErr += 1;
                telephone.removeClass('form-control-success');
                telephone.addClass('form-control-warning');
                let tagerr = document.querySelector(".errtel");
                tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez correctement le champ telephone</div>";
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
                tagerr.innerHTML = "<div class='form-control-feedback'>Veiller renseignez le champ email</div>";
            } else {
                age.removeClass('form-control-warning');
                age.addclass('form-control-success');
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
                cni.addclass('form-control-success');
                let tagerr = document.querySelector(".errcni");
                tagerr.innerHTML = "";
            }

            if (CptErr == 0) {

            }
        })

    })
</script>
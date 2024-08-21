<script>
  $.ajaxSetup({
    headers : {
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<script>
    $(document).ready(function(){
        // Enregistrer une  nouvelle formation
        //  validation & envoie des infortion en ajax
        $(document).on('click','#Envoyer',function(e){
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
                url:"{{route('add.formation')}}",
                method:'post',
                data:{name:name,duree:duree,prix:prix,prerequit:prerequit,note:note},
                success:function(res){
                    if(res.status == "success"){
                        document.querySelector(".save-load-btn-ma").classList.add("d-none");
                        document.querySelector(".save-bu-ma").classList.remove("d-none");
                         $('#FormationForm')[0].reset();
                        sa.click();
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value){
                        $('.errors_calss').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+value+'<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    }); 
                    document.querySelector(".save-load-btn-ma").classList.add("d-none");
                    document.querySelector(".save-bu-ma").classList.remove("d-none");
                }
            })
            
        })

        //supression d'une formation
        // envoie des informations en ajax

        $(document).on('click','#ApplieUpdate',function(e){
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

        $(document).on('click','#FormationUpdate',function(e){
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
                url:"{{route('update.formation')}}",
                method:'post',
                data:{nom:nom,duree:duree,prix:prix,niveau:niveau,note:note,enligne:enligne,id:id},
                success:function(res){
                    if(res.status == "success"){
                        document.querySelector(".load-btn").classList.add("d-none");
                        document.querySelector(".btn-txt").classList.remove("d-none");
                        $('#FormUpFormation')[0].reset();
                        sa.click();
                        saModal.click();
                        $(' .load-liste').load(location.href+' .load-liste');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value){
                        $('.errors_class').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+value+'<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>');
                    }); 
                    document.querySelector(".load-btn").classList.add("d-none");
                    document.querySelector(".btn-txt").classList.remove("d-none");
                }
            })
        })

    })
</script>
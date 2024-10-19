<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="p-3 card-box mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Enregistrement Exercices</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Enregistrement
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <h3 class="text-primary pb-3">Ajouter une Question</h3>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Choir exercice <small class="text-danger">*</small> </label>
                            <div class="form-group has-warning">
                                <select class="custom-select2 form-control" name="idCour" id="idCour"
                                    style="width: 100%; height: 38px">
                                    @foreach($Cours as $cour)
                                    <optgroup label="{{$cour->libeller}}" data-max-options="2">
                                        @foreach($cour->Exercices as $exercice)
                                        <option value="{{$exercice->id}}">{{$exercice->libeller}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button id="SelectFormCour" class="btn btn-primary">Ajouter une question</button>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30 exrcices">
                <div class="errors_calss"></div>
                <h3 class="text-primary pb-3">Enregistrement exercice</h3>
                <form action="{{route('add.Exercice')}}" method="post" id="ExerciceForm">
                    <div class="form-group">
                        <label>Cour <small class="text-danger">*</small> </label>
                        <div class="form-group has-warning">
                            <select class="custom-select2 form-control" name="cour" id="cour"
                                style="width: 100%; height: 38px">
                                <option value="">Choisir un cour</option>
                                @foreach($Formations as $formation)
                                <optgroup label="{{$formation->nom}}" data-max-options="2">
                                    @foreach($formation->cours as $cour)
                                    <option value="{{$cour->id}}">{{$cour->libeller}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            <div class="errExercices"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Libeller <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="libeller" id="libeller">
                                <div class="errlibeller  has-warning"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Durée <small class="text-danger">*</small></label>
                                <input type="time" class="form-control" name="time" id="time">
                                <div class="errtime  has-warning"></div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label>Description/Consigne <small class="text-danger">*</small></label>
                            <textarea class="form-control note" name="desc" id="desc"></textarea>
                            <div class="errdesc  has-warning"></div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="">
                        <div class="spinner-border text-light save-load-btn-ma d-none"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="save-bu-ma">Enregister</span>
                    </button>
                </form>
            </div>

            <div class="question d-none">
                <div class="pd-20 card-box mb-30">
                    <div class="col-md-6 col-sm-12 text-right mb-3">
                        <button class="btn btn-primary" id="NewExercice">Ajouter un exercice<i class="icon-copy bi bi-arrow-bar-up ml-3 mr-3"></i></button>
                    </div>
                    <form action="{{route('add.Question')}}" class="mb-3" method="post" id="FormQuestion">
                        @csrf
                        <h3 class="text-primary pb-3">Nouvelle Question</h3>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>libeller de la Question</label>
                                    <input type="text" class="form-control" name="question" id="question">
                                    <input type="hidden" class="form-control" value="" name="idEx" id="idEx">
                                    <div class="questionLibeller has-warning"></div>
                                </div>
                                <button class="btn btn-primary">
                                    <div class="spinner-border text-light save-load-question d-none"
                                        style="width: 1rem; height: 1rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span class="btn-load-question">Enregister</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="pd-20 card-box mb-30" id="QuestionListe">

                    <h2 class="mb-3 mt-3 text-primary">Liste des questions</h2>

                    <!-- <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="pb-3">Libeller de la Question</h4>
                            <div class="form-group">
                                <div class="custom-control custom-radio mb-5" id="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <button class="btn btn-primary"><i class="icon-copy fa fa-plus" aria-hidden="true" data-id=""></i></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

    </div>


</div>



<div
    class="modal fade"
    id="success-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Ajouter des des choix
                </h4>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-hidden="true">
                    ×
                </button>
            </div>
            <form action="{{route('add.Choix')}}" method="post" id="ChoixForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Libeller de du choix</label>
                                <input type="text" class="form-control" name="libellerChoix" id="libellerChoix">
                                <input type="hidden" class="form-control" id="idQuestion" name="idQuestion">
                                <div class="libellerChoix has-warning"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>La reponse est</label>
                                <div class="form-group has-warning">
                                    <select class="custom-select2 form-control" name="iscorect"
                                        id="iscorect"
                                        style="width: 100%; height: 38px">
                                        <option value="">Choisir Valeur pour le choix</option>
                                        <option value="1">Vrai</option>
                                        <option value="0">Faux</option>
                                    </select>
                                    <div class="iscorecterr has-warning"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">
                        <div class="spinner-border text-light save-load-choix d-none"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="save-choix">Enregister</span>
                    </button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- welcome modal start -->
<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>
<!-- welcome modal end -->

<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/module/main.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<!-- bootstrap-touchspin js -->
<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>




<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>
<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-100px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Enregistrement Payements</h4>
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
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="error_class_marchant"></div>

            <form method="post" action="{{route('add.payement')}}" id="FormMarchandises">
                @csrf
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Apprenant</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Veiller entrez le nom prenom, formation niveau, anneé scolaire,</label>
                            <select
                                class="custom-select2 form-control select-expediteur"
                                name="FormationPayement"
                                style="width: 100%; height: 38px"
                                id="FormationPayement">*
                                <option value="">Choisir l'Apprenant</option>
                                @foreach($participants as $participant)
                                @foreach($participant->FormationParticipants as $FormationParticipant)
                                <option value="{{$FormationParticipant->id}}">{{$FormationParticipant->Participant->nom}} {{$FormationParticipant->Participant->prenom}}, {{$FormationParticipant->Formation->nom}} {{$FormationParticipant->niv}}, {{$FormationParticipant->anneeScolaire}}</option>
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="ccol-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Montant</label>
                                    <input type="text" class="form-control" name="montant" id="montant" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" name="notes" id="notes" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <button class="btn btn-primary" id="add_marchandises">
                                <div class="spinner-border text-light save-load-btn-ma d-none" style="width: 1rem; height: 1rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span class="save-bu-ma">Enregister</span>
                            </button>
                        </div>
                        <a href="#" class="btn-block d-none" data-toggle="modal" data-target="#qr-active" type="button" id="qr-active"><button class="btn btn-primary">Qr</button></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

</div>
</div>
<!-- Confirmation modal -->
<!-- welcome modal start -->

<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
<script src="{{asset('assets/module/main.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>
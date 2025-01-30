<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Gestion des notes</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Acceuil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Note
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="#"
                            data-toggle="modal"
                            data-target="#bd-insertion"
                            type="button">
                            insertion Rapide</a>
                    </div>
                </div>
            </div>
            <div class="p-3 card-box mb-30">
                @if(session('success'))
                <div class="card-box mb-30">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
                @endif
                @if(session('err'))
                <div class="card-box mb-30">
                    <div class="alert alert-warning">
                        {{session('err')}}
                    </div>
                </div>
                @endif
                <form action="{{route('add.Note')}}" method="post" id="form-charge">
                    @csrf
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Apprenant</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Veiller entrez le <strong>nom prenom</strong> , <strong>formation niveau</strong>, <strong>anneé scolaire</strong>,</label>
                                <select
                                    class="custom-select2 form-control"
                                    name="FormationPayement"
                                    style="width: 100%; height: 38px"
                                    id="FormationPayement" required>*
                                    <option value="">Choisir l'Apprenant</option>
                                    @foreach($participants as $participant)
                                    @foreach($participant->FormationParticipants as $FormationParticipant)
                                    <option value="{{$FormationParticipant->id}}">{{$FormationParticipant->Participant->nom}} {{$FormationParticipant->Participant->prenom}}, {{$FormationParticipant->Formation->nom}} @if(!empty($FormationParticipant->niv)) {{$FormationParticipant->niv}} @endif, {{$FormationParticipant->anneeScolaire}} </option>
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Matieres</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Veiller entrez le libeller de la matieres</label>
                                <select
                                    class="custom-select2 form-control"
                                    name="matiere"
                                    style="width: 100%; height: 38px"
                                    id="matiere" required>*
                                    <option value="">Choisir l'Apprenant</option>
                                    @foreach($Matiere as $matiere)
                                    <option value="{{$matiere->id}}">{{$matiere->libeller}} | Coefficient {{$matiere->coefs}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Evaluation</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label>Veiller Choisir la session d'Evaluation</label>
                            <div class="form-group">
                                <select
                                    class="custom-select2 form-control load-Evaluation"
                                    name="eval"
                                    style="width: 100%; height: 38px"
                                    id="eval" required>*
                                    <option value="">Choisir une Evaluation</option>
                                    @foreach($Evaluation as $evaluation)
                                    <option value="{{$evaluation->id}}" class="load-Evaluation">{{$evaluation->libeller}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>note sur 20</label>
                                <input type="number" class="form-control" name="note" id="note" min="0" max="20" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Appreciation</label>
                                <input type="text" class="form-control" name="appreciation" id="appreciation" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <div class="spinner-border text-light load-btn-ex d-none" style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="btn-txt-ex">Enregister</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- welcome modal start -->


<div class="modal fade bs-example-modal-lg" id="bd-insertion" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Insertion Rapide des notes
                </h4>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form action="{{route('Insertion.note')}}" id="" method="post">
                @csrf
                <div class="errors"></div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Formation</label>
                                <select
                                    class="custom-select2 form-control load-Evaluation"
                                    name="formation"
                                    style="width: 100%; height: 38px"
                                    id="formation" required>*
                                    <option value="">Choisir une Formation</option>
                                    @foreach($Formations as $Formation)
                                    <option value="{{$Formation->id}}" class="load-Evaluation">{{$Formation->nom}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Matieres</label>
                                <select
                                    class="custom-select2 form-control"
                                    name="matiere_select"
                                    style="width: 100%; height: 38px"
                                    id="matiere_select" required>*
                                    <option value="">Choisir la Matiere</option>
                                    @foreach($Matiere as $matiere)
                                    <option value="{{$matiere->id}}">{{$matiere->libeller}} | Coefficient {{$matiere->coefs}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Evaluation</label>
                                <select
                                    class="custom-select2 form-control load-Evaluation"
                                    name="eval_select"
                                    style="width: 100%; height: 38px"
                                    id="eval_select" required>*
                                    <option value="">Choisir une l'evaluation</option>
                                    @foreach($Evaluation as $evaluation)
                                    <option value="{{$evaluation->id}}" class="load-Evaluation">{{$evaluation->libeller}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <select class="custom-select2 form-control" name="anneescolaire"
                                    id="anneescolaire"
                                    style="width: 100%; height: 38px" required>
                                    <option value="">Choisir une année scolaire</option>
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2025-2026">2025-2026</option>
                                    <option value="2026-2027">2026-2027</option>
                                    <option value="2027-2028">2027-2028</option>
                                    <option value="2028-2029">2028-2029</option>
                                    <option value="2029-2030">2029-2030</option>
                                    <option value="2030-2031">2030-2031</option>
                                    <option value="2031-2032">2031-2032</option>
                                    <option value="2032-2033">2032-2033</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="spinner-border text-light load-btn d-none" style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="btn-txt">Enregister</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>

<script src="{{asset('assets/module/main.js')}}"></script>

<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
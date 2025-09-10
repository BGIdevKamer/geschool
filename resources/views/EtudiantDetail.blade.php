<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-20 card-box mb-20">
        <h2 class="text-primary">Details @if(Session::get('type') == "4") Participants @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Eleves @else Etudiants @endif</h2>
        <div class="clearfix">
            <div class="pull-right">
                <div class="pull-right ml-2">
                    <a
                        href="#"
                        class="btn-block"
                        data-toggle="modal"
                        data-target="#new-modal-inscription"
                        type="button">
                        <button class="btn btn-primary">Nouvelle Inscription</button>
                    </a>
                </div>
            </div>
        </div>
        @if(session('success'))
        <div
            class="alert alert-success alert-dismissible fade show mt-3"
            role="alert">
            <strong>Felicitations!</strong> {{session('success')}}
            <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endforeach
        @endif
    </div>
    <div class="card-box mb-30">
        <form action="{{route('update.participant')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="pd-20">
                <div class="d-flex mb-3 w-100" style="justify-content: center;align-items: center;">

                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" class="form-control" name="nom" value="{{$Etudiants->nom}}" required>
                            <input type="hidden" class="form-control" name="id" value="{{$Etudiants->id}}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" class="form-control" name="prenom" value="{{$Etudiants->prenom}}" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$Etudiants->email}}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" class="form-control" name="telephone" value="{{$Etudiants->telephone}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Date naissance</label>
                            <input type="text" class="form-control" name="dateN" value="{{$Etudiants->dateN}}" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label>Sexe</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio1" name="sexe" class="custom-control-input"
                                    value="H" required @if($Etudiants->sexe == 'H') checked @endif />
                                <label class="custom-control-label" for="customRadio1">Homme</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio2" name="sexe" value="F"
                                    class="custom-control-input" required @if($Etudiants->sexe == 'F') checked @endif />
                                <label class="custom-control-label" for="customRadio2">Femme</label>
                            </div>
                            <div class="errsex  has-warning"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" class="form-control" name="age" value="{{$Etudiants->age}}" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Niveau scolaire</label>
                            <input type="text" class="form-control" name="niveau" value="{{$Etudiants->NiveauScolaire}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Photo</label>
                            <div class="custom-file">
                                <input type="file" id="fileInput" name="photo" class="custom-file-input" @if(!empty($Etudiants->photo)) disabled @endif/>
                                <label class="custom-file-label" id="nameFile">Choisr un Fichier</label>
                                <span id="errorMessage" style="color: red;"></span>
                            </div>
                        </div>
                    </div>

                    <style>
                    </style>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>CNI</label>
                            <input type="text" class="form-control" value="{{$Etudiants->cni}}" name="cni">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        @if(!empty($Etudiants->photo))
                        <div class="col-md-6 col-sm-12 d-flex">
                            <img src="{{Storage::url($Etudiants->photo)}}" class="profil-img" alt="">
                            <span class="p-3"><a href="{{route('Delete.Img',['id'=>$Etudiants->id])}}" class="btn text-danger">Supprimer <br> l'image</a></span>
                        </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
    @if(Session::get('type') != "4")
    @foreach($FormationParticipants as $FormationParticipant)
    <div class="row clearfix mb-5 mt-3">
        <div class="col-md-12 col-sm-12">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">{{$FormationParticipant->Formation->nom}}</h5>
                <h3 class="h4 text-blue mb-20">{{$FormationParticipant->anneeScolaire}}</h3>
                <div class="tab">
                    <ul class="nav nav-pills justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-blue" data-toggle="tab" href="#home6" role="tab"
                                aria-selected="true">Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue" data-toggle="tab" href="#profile6" role="tab"
                                aria-selected="false">Payements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue" data-toggle="tab" href="#contact6" role="tab"
                                aria-selected="false">Notes</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="home6" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>@if(Session::get('type') == "4") Statistique @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif</label>
                                        <div class="form-group has-warning">
                                            <select class="custom-select2 form-control" name="formation_{{$FormationParticipant->id}}" id="formation_{{$FormationParticipant->id}}"
                                                style="width: 100%; height: 38px" required>
                                                <option value="">Formations</option>
                                                @foreach ($Formations as $formation)
                                                <option value="{{$formation->id}}" @if($formation->id == $FormationParticipant->formation_id) selected @endif>{{$formation->nom}}</option>
                                                @endforeach
                                            </select>
                                            <div class="errniformation"></div>
                                        </div>
                                    </div>
                                </div>
                                @if(Session::get('type') == "3")
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Niveau</label>
                                        <select class="selectpicker form-control" data-style="btn-outline-primary"
                                            data-size="5" name="niv" id="niv">
                                            <option value="{{$FormationParticipant->niv}}">@if(empty($FormationParticipant->niv)) Choisir un niveau @else Nivau {{$FormationParticipant->niv}} @endif</option>
                                            <option value="1">Niveau I</option>
                                            <option value="2">Niveau II</option>
                                            <option value="3">Niveau III</option>
                                            <option value="4">Niveau IV</option>
                                            <option value="5">Niveau VI</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                        <div class="tab-pane fade" id="profile6" role="tabpanel">
                            <table class="data-table table nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus">#</th>
                                        <th>Nom & Prenom</th>
                                        <th>Montant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($FormationParticipant->Payements as $key => $Payement)
                                    <tr>
                                        <td class="table-plus">
                                            {{$key}}
                                        </td>
                                        <td>{{$FormationParticipant->Participant->nom}} {{$FormationParticipant->Participant->prenom}}</td>
                                        <td><strong>{{$Payement->montant}} Franc cfa</strong></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <!-- <a class="dropdown-item"
                                                        id="modifynote"
                                                        data-toggle="modal"
                                                        data-target="#bd-example-modal-modify-categorie"
                                                        data-id="1"
                                                        href="#"><i class="dw dw-edit2"></i> Edit</a> -->
                                                    <a class="dropdown-item text-danger" href="#"
                                                        class="btn-block"
                                                        id="DeletePayement"
                                                        data-toggle="modal"
                                                        data-target="#delete-payement-modal"
                                                        data-id="{{$Payement->id}}"
                                                        data-participant="{{$Etudiants->id}}"
                                                        type="button"><i class=" dw dw-delete-3"></i>
                                                        Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact6" role="tabpanel">
                            <table class="data-table table nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus">#</th>
                                        <th>Matieres</th>
                                        <th>Note</th>
                                        <th>Sequence</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($FormationParticipant->compositions as $key => $composition)
                                    <tr>
                                        <td class="table-plus">
                                            {{$key}}
                                        </td>
                                        <td>{{$composition->Matiere->libeller}}</td>
                                        <td><strong>{{$composition->note}} Points</strong></td>
                                        <td><strong>{{$composition->Evaluation->libeller}}</strong></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <!-- <a class="dropdown-item"
                                                        id="modifynote"
                                                        data-toggle="modal"
                                                        data-target="#bd-example-modal-modify-categorie"
                                                        data-id="1"
                                                        href="#"><i class="dw dw-edit2"></i> Edit</a> -->
                                                    <a class="dropdown-item text-danger" href="#"
                                                        class="btn-block"
                                                        id="DeleteComposition"
                                                        data-toggle="modal"
                                                        data-target="#delete-modal"
                                                        data-id="{{$composition->id}}"
                                                        data-participant="{{$Etudiants->id}}"
                                                        type="button"><i class=" dw dw-delete-3"></i>
                                                        Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="row clearfix mb-5 mt-3">
        <div class="col-md-12 col-sm-12">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">Exercices</h5>
                <div class="tab">
                    <ul class="nav nav-pills justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-blue" data-toggle="tab" href="#home6" role="tab"
                                aria-selected="true">Exercices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue" data-toggle="tab" href="#profile6" role="tab"
                                aria-selected="false">Evaluations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue" data-toggle="tab" href="#contact6" role="tab"
                                aria-selected="false">Cours</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="home6" role="tabpanel">
                            <table class="data-table table nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus">#</th>
                                        <th>Libellé</th>
                                        <th>Description</th>
                                        <th>Score</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exercicesModule as $key => $Exercices)
                                    <tr>
                                        <td class="table-plus">
                                            {{$key}}
                                        </td>
                                        <td class="">
                                            {{$Exercices->libeller}}
                                        </td>
                                        <td class="">
                                            {{$Exercices->description}}
                                        </td>
                                        <td class="">
                                            {{$Exercices->score}}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <!-- <a class="dropdown-item"
                                                        id="modifynote"
                                                        data-toggle="modal"
                                                        data-target="#bd-example-modal-modify-categorie"
                                                        data-id="1"
                                                        href="#"><i class="dw dw-edit2"></i> Edit</a> -->
                                                    <a class="dropdown-item text-danger" href="#"
                                                        class="btn-block"
                                                        id="DeletePayement"
                                                        data-toggle="modal"
                                                        data-target="#delete-payement-modal"
                                                        type="button"><i class=" dw dw-delete-3"></i>
                                                        Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile6" role="tabpanel">
                            <table class="data-table table nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus">#</th>
                                        <th>Libellé</th>
                                        <th>Description</th>
                                        <th>Score</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exercicesFormation as $key => $Exercices)
                                    <tr>
                                        <td class="table-plus">
                                            {{$key}}
                                        </td>
                                        <td class="">
                                            {{$Exercices->libeller}}
                                        </td>
                                        <td class="">
                                            {{$Exercices->description}}
                                        </td>
                                        <td class="">
                                            {{$Exercices->score}}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <!-- <a class="dropdown-item"
                                                        id="modifynote"
                                                        data-toggle="modal"
                                                        data-target="#bd-example-modal-modify-categorie"
                                                        data-id="1"
                                                        href="#"><i class="dw dw-edit2"></i> Edit</a> -->
                                                    <a class="dropdown-item text-danger" href="#"
                                                        class="btn-block"
                                                        id="DeletePayement"
                                                        data-toggle="modal"
                                                        data-target="#delete-payement-modal"
                                                        type="button"><i class=" dw dw-delete-3"></i>
                                                        Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact6" role="tabpanel">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id laboriosam deserunt rem, nesciunt ipsa laudantium doloremque deleniti facilis dolor culpa perferendis praesentium neque fuga hic optio officiis sapiente et aliquid?
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



    <div class="modal fade bs-example-modal-lg" id="new-modal-inscription" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Nouvelle Inscription
                    </h4>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Nouvelle.Inscription')}}" method="post" id="form-update">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" value="{{$Etudiants->id}}" name="id_participant">
                                    <label>Formation</label>
                                    <div class="form-group has-warning">
                                        <select class="custom-select2 form-control" name="formation_id" id="formation_id"
                                            style="width: 100%; height: 38px" required>
                                            <option value="">@if(Session::get('type') == "4") Statistique @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif</option>
                                            @foreach ($Formations as $formation)
                                            <option value="{{$formation->id}}">{{$formation->nom}}</option>
                                            @endforeach
                                        </select>
                                        <div class="errniformation"></div>
                                    </div>
                                </div>
                            </div>
					        @if(Session::get('type') == "3")
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Niveau</label>
                                    <select class="selectpicker form-control" data-style="btn-outline-primary"
                                        data-size="5" name="niveau" id="niveau">
                                        <option value="">Choisir le niveau</option>
                                        <option value="1">Niveau I</option>
                                        <option value="2">Niveau II</option>
                                        <option value="3">Niveau III</option>
                                        <option value="4">Niveau IV</option>
                                        <option value="5">Niveau VI</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Année scolaire</label>
                                    <div class="form-group has-warning">
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
                                        <div class="erranneescolaire"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="spinner-border text-light load-btn-update d-none" style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="btn-txt-update">Enregister</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div
        class="modal fade"
        id="delete-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content bg-danger text-white">
                <div class="modal-body text-center">
                    <h3 class="text-white mb-15">
                        <i class="fa fa-exclamation-triangle"></i> Supprimer
                    </h3>
                    <div class="errors"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed
                    <form action="{{route('delete.composition')}}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="participant_id" name="participant_id">
                        <button
                            type="submit"
                            class="btn btn-light"
                            id="">
                            <div class="spinner-border text-primary load-btn-Deleteparticipant d-none"
                                style="width: 1rem; height: 1rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="load-txt-Deleteparticipant">Continuer</span>
                        </button>
                    </form>
                    <button
                        type="button"
                        id="data-dismiss"
                        class="btn btn-light d-none"
                        data-dismiss="modal">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="delete-payement-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content bg-danger text-white">
                <div class="modal-body text-center">
                    <h3 class="text-white mb-15">
                        <i class="fa fa-exclamation-triangle"></i> Supprimer
                    </h3>
                    <div class="errors"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed
                    <form action="{{route('Payement.Delete')}}" method="post">
                        @csrf
                        <input type="hidden" id="id_payement" name="id_payement">
                        <input type="hidden" id="participant_id_payement" name="participant_id_payement">
                        <button
                            type="submit"
                            class="btn btn-light"
                            id="">
                            <div class="spinner-border text-primary load-btn-Deleteparticipant d-none"
                                style="width: 1rem; height: 1rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="load-txt-Deleteparticipant">Continuer</span>
                        </button>
                    </form>
                    <button
                        type="button"
                        id="data-dismiss"
                        class="btn btn-light d-none"
                        data-dismiss="modal">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- js -->
    <script src="{{asset ('assets/vendors/scripts/core.js')}}"></script>

    <script src="{{asset('assets/module/main.js')}}"></script>

    <script src="{{asset ('assets/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset ('assets/vendors/scripts/process.js')}}"></script>
    <script src="{{asset ('assets/vendors/scripts/layout-settings.js')}}"></script>

    <script src="{{asset ('assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset ('assets/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
    <!-- <script src="{{asset ('assets/src/plugins/datatables/js/pdfmake.min.js')}}"></script> -->
    <script src="{{asset ('assets/src/plugins/datatables/js/vfs_fonts.js')}}"></script>

    <script src="{{asset ('assets/vendors/scripts/datatable-setting.js')}}"></script>
    <script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

    <!-- switchery js -->
    <script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <!-- bootstrap-stouchspin js -->

    <script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
            height="0"
            width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    </body>

</html>
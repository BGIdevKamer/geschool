<!DOCTYPE html>
<html>
@include('header')
<style>
    .header-table {
        width: 100%;
        text-align: center;
        font-size: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    .wrapper-invoice {
        display: flex;
        justify-content: center;
    }
</style>
<div class="main-container">

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="pd-20 card-box mb-20">
            <h2 class="text-primary">Session de cour</h2>
            <div class="clearfix">
                <div class="pull-right ml-2">
                    <a
                        href="{{route('Impression.Emploie',['id'=>$Emploie->id])}}"
                        class="btn-block"
                        type="button">
                        <button class="btn btn-primary">Imprimer</button>
                    </a>
                </div>
                <div class="pull-right">
                    <a
                        href="{{route('index.Emploie')}}"
                        class="btn-block"
                        type="button">
                        <button class="btn btn-primary">Retour</button>
                    </a>
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
            @if(session('warning'))
            <div
                class="alert alert-warning alert-dismissible fade show mt-3"
                role="alert">
                <strong>Felicitations!</strong> {{session('warning')}}
            </div>
            @endif
        </div>
        <div class="min-height-100px">
            <div class="d-20 card-box mb-30">
                <div class="pd-20 card-box mb-30">
                    <h2 class="text-primary mb-2">{{$Emploie->titre}}</h2>
                    <hr>
                    <form action="{{route('session.Add')}}" method="post" id="form-charge">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Matieres</label>
                                    <input type="hidden" value="{{$id}}" name="emploie" id="emploie">
                                    <select
                                        class="custom-select2 form-control"
                                        name="matiere"
                                        style="width: 100%; height: 38px"
                                        id="matiere">*
                                        <option value="">Choisir la Matiere</option>
                                        @foreach($Matieres as $matiere)
                                        <option value="{{$matiere->id}}">{{$matiere->libeller}} | Coefficient {{$matiere->coefs}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Enseignant</label>
                                    <select
                                        class="custom-select2 form-control"
                                        name="Enseignant"
                                        id="Enseignant"
                                        style="width: 100%; height: 38px"
                                        id="Enseignant">*
                                        <option value="">Choisir l'Enseigant</option>
                                        @foreach($Enseigants as $enseignant)
                                        <option value="{{$enseignant->id}}">{{$enseignant->nom}} {{$enseignant->prenom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Salle</label>
                                    <select
                                        class="custom-select2 form-control"
                                        name="salle"
                                        id="salle"
                                        style="width: 100%; height: 38px"
                                        id="salle">*
                                        <option value="">Choisir la Salles</option>
                                        @foreach($Salles as $salle)
                                        <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Heures de cour</label>
                                        <select class="custom-select2 form-control" name="heures[]" multiple="multiple" style="width: 100%" required>
                                            <optgroup label="Heure de cour">
                                                @foreach($heures as $heure)
                                                <option value="{{$heure->id}}">{{$heure->heure_debut}}h{{$heure->min_debut}}-{{$heure->heure_fin}}h{{$heure->min_fin}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label>Heures/Permanace/cour</label>
                                <select class="custom-select2 form-control" style="width: 100%" name="cpp" id="cpp">
                                    <optgroup label="">
                                        <option value="0">Cour</option>
                                        <option value="1">Pause</option>
                                        <option value="2">Permanence</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label>Jours</label>
                                <select
                                    class="custom-select2 form-control"
                                    name="jour"
                                    style="width: 100%; height: 38px"
                                    id="jour" required>*
                                    <option value="">Choisir le jour</option>
                                    <option value="0">Lundi</option>
                                    <option value="1">Mardi</option>
                                    <option value="2">Mercredi</option>
                                    <option value="3">Jeudi</option>
                                    <option value="4">Vendredi</option>
                                    <option value="5">Samedi</option>
                                </select>
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
            @if($heures->count() != 0)
            <div class="pd-20 card-box mb-30">
                <h2 class="text-primary">Emploie de temps</h2>
                <section class="wrapper-invoice">
                    <!-- switch mode rtl by adding class rtl on invoice class -->
                    <div class="invoice">
                        <br>
                        <table class="header-table" style="width: 100%;">
                            <th>
                            <td>
                                <!-- <h3 style="text-decoration: underline;visibility: hidden;">Lorem ipsum dolor sit amet consectetur adipisicing elit orem ipsum dolor sit </h2> -->
                            </td>
                            </th>
                        </table>
                        <br>

                        <table border="collapse" style="width: 100%;">
                            <thead style="background-color: #eeeeee; font-weight: 500;">
                                <td><span style="">Heures</span></td>
                                <td>Lundi</td>
                                <td>Mardi</td>
                                <td>Mercredi</td>
                                <td>Jeudi</td>
                                <td>Vendre</td>
                                <td>Samedi</td>
                            </thead>
                            @foreach($heures as $heure)
                            <tr>
                                <td style="font-weight: 200;font-size: 13px;">{{$heure->heure_debut}}H{{$heure->min_debut}} - {{$heure->heure_fin}}H{{$heure->min_fin}}</td>
                                @foreach($sessions as $session)
                                @if($session->heure_id === $heure->id)
                                @if($session->cpp == 0)
                                <td style="font-weight: 400;font-size: 12px;padding:0px 4px;"> <strong>{{$session->Matiere->libeller}}</strong> <br>
                                    {{$session->Enseigant->nom}} {{$session->Enseigant->prenom}} - <strong> {{$session->Salle->nom}}</strong> <br>
                                </td>
                                @elseif($session->cpp == 1)
                                <strong><em>
                                        <td style="font-weight: 200; background-color: chocolate;font-size: 10px;color: white;">Pause</td>
                                    </em></strong>
                                @else
                                <strong><em>
                                        <td style="font-weight: 200; background-color: blue;font-size: 10px;color: white;">Permanence</td>
                                    </em></strong>
                                @endif
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </table>
                        <a href="{{route('Impression.Emploie',['id'=>$Emploie->id])}}" class="btn btn-primary mt-3">Imprimer</a>
                    </div>
                </section>
            </div>
            @endif
            <div class="pd-20 card-box mb-30">
                <h2 class="text-primary mb-3">Heures de cours</h2>
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Jour</th>
                            <th>Matieres</th>
                            <th>Enseignant</th>
                            <th>Debut</th>
                            <th>Fin</th>
                            <th>Salle</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @foreach ($ListeSession as $session)
                        @if($session->cpp == 0)
                        <tr>
                            <td>{{$jours[$session->jour]}}</td>
                            <td class="">{{$session->Matiere->libeller}}</td>
                            <td>{{$session->Enseigant->nom}} {{$session->Enseigant->prenom}}</td>
                            <td>{{$session->Heure->heure_debut}}h{{$session->Heure->min_debut}}</td>
                            <td>{{$session->Heure->heure_fin}}h{{$session->Heure->min_fin}}</td>
                            <td>{{$session->Salle->nom}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item text-danger" href="#"
                                            class="btn-block"
                                            id="deleteSession"
                                            data-id="{{$session->id}}"
                                            data-emploie_id="{{$session->emploie_id}}"
                                            data-toggle="modal"
                                            data-target="#alert-modal"
                                            type="button"><i class=" dw dw-delete-3"></i>
                                            Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pd-20 card-box mb-30">
                <h2 class="text-primary mb-3">Pauses et Permanences</h2>
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th class="table-plus datatable-nosort">Jour</th>
                            <th>Debut</th>
                            <th>Fin</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @foreach ($ListeSession as $session)
                        @if($session->cpp != 0 )
                        <tr>
                            <td>@if($session->cpp == 1) Pause @else Permanence @endif</td>
                            <td>{{$jours[$session->jour]}}</td>
                            <td>{{$session->Heure->heure_debut}}h{{$session->Heure->min_debut}}</td>
                            <td>{{$session->Heure->heure_fin}}h{{$session->Heure->min_fin}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item text-danger" href="#"
                                            class="btn-block"
                                            id="deleteSession"
                                            data-id="{{$session->id}}"
                                            data-emploie_id="{{$session->emploie_id}}"
                                            data-toggle="modal"
                                            data-target="#alert-modal"
                                            type="button"><i class=" dw dw-delete-3"></i>
                                            Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div
        class="modal fade"
        id="alert-modal"
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
                    <form action="{{route('delete.Session')}}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="emploie_id" name="emploie">
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
</div>

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


<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
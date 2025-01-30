<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Liste des Etudians</h4>
            <p class="mb-0">
            </p>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Nom/prenom</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>date naissance</th>
                        <th>sexe</th>
                        <th>age</th>
                        <th>Niveau scolaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="load-table">
                    @foreach($participant as $Participants)
                    <tr>
                        <td>{{$Participants->nom}} {{$Participants->prenom}}</td>
                        <td>{{$Participants->telephone}}</td>
                        <td>{{$Participants->email}}</td>
                        <td>{{$Participants->dateN}}</td>
                        <td>{{$Participants->sexe}}</td>
                        <td>{{$Participants->age}}</td>
                        <td>{{$Participants->NiveauScolaire}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> Detaille</a>
                                    <a class="dropdown-item" href="#"
                                        id="updateParticipants"
                                        class="btn-block" data-toggle="modal"
                                        data-id="{{$Participants->id}}"
                                        data-nom="{{$Participants->nom}}"
                                        data-prenom="{{$Participants->prenom}}"
                                        data-telephone="{{$Participants->telephone}}"
                                        data-email="{{$Participants->email}}"
                                        data-sexe="{{$Participants->sexe}}"
                                        data-date="{{$Participants->dateN}}"
                                        data-age="{{$Participants->age}}"
                                        data-cni="{{$Participants->cni}}"
                                        data-niveau="{{$Participants->NiveauScolaire}}"
                                        data-target="#Modal-update" type="button"><i class="icon-copy dw dw-edit-2"></i> Modifier</a>
                                    <a class="dropdown-item text-danger" href="#"
                                        class="btn-block"
                                        id="deleteParticipant"
                                        data-toggle="modal"
                                        data-target="#alert-modal"
                                        data-id="{{$Participants->id}}"
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
    <!-- Simple Datatable End -->

    <!-- modal -->
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
                    <p>
                    <div class="errors"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.
                    <input type="hidden" id="idDelete" name="idDeletes">
                    </p>
                    <button
                        type="button"
                        class="btn btn-light"
                        id="btnDeleteParticipant">
                        <div class="spinner-border text-primary load-btn-Deleteparticipant d-none"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="load-txt-Deleteparticipant">Continuer</span>
                    </button>
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

    <div class="modal fade bs-example-modal-lg" id="Modal-update" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Modifications
                    </h4>
                    <button type="button" class="close" id="closeModals" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="errors_class"></div>
                    <form action="" id="FormaddParticipant">
                        @csrf
                        <div class="errors_participant"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Nom</label>
                                <div class="form-group has-warning">
                                    <input type="text" class="form-control" name="nomEtudiant" id="nomEtudiant">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="sexeId" id="sexeId">
                                    <div class="errname"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Prenom</label>
                                <div class="form-group has-warning">
                                    <input type="text" class="form-control" name="prenomEtudiant" id="prenomEtudiant">
                                    <div class="errprenom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 ">
                                <label>Telephone</label>
                                <div class="form-group has-warning">
                                    <input type="number" class="form-control" name="telephoneEtudiant" id="telephoneEtudiant">
                                    <div class="errtel"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>email</label>
                                <div class="form-group has-warning">
                                    <input type="email" class="form-control" name="emailEtudiant" id="emailEtudiant">
                                    <div class="erremail"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label>Date de naissance</label>
                                <div class="form-group has-warning">
                                    <input class="form-control" placeholder="Choisir une date" type="date" name="datenEtudiant" id="datenEtudiant" />
                                    <div class="errdate"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Choisir le sexe</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input"
                                            value="H" />
                                        <label class="custom-control-label" for="customRadio1">Homme</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="customRadio2" name="customRadio" name="customRadio" value="F"
                                            class="custom-control-input" />
                                        <label class="custom-control-label" for="customRadio2">Femme</label>
                                    </div>
                                    <div class="errsex  has-warning"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Ages</label>
                                <div class="form-group has-warning">
                                    <input type="number" class="form-control" name="ageEtudiant" id="ageEtudiant">
                                    <div class="errage"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>Numero de Cni</label>
                                <div class="form-group has-warning">
                                    <input type="text" class="form-control" id="cniEtudiant" name="cniEtudiant">
                                    <div class="errcni"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Niveau scolaire</label>
                                    <div class="form-group has-warning">
                                        <select class="custom-select2 form-control" name="state" id="niveauEtudiant"
                                            style="width: 100%; height: 38px">
                                            <option value="Bac">Bac</option>
                                            <option value="Bac+1">Bac</option>
                                            <option value="Bac+2">Bac +2</option>
                                            <option value="Bac+3">Bac +3</option>
                                            <option value="Bac+4">Bac +4</option>
                                            <option value="Bac+5">Bac +5</option>
                                            <option value="Autres">Autres</option>
                                        </select>
                                        <div class="errniveau"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fermer
                    </button>
                    <button type="button" class="btn btn-primary" id="ParticipantUpdate">
                        <div class="spinner-border text-light load-btn-addparticipant d-none"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="load-txt-addparticipant">Enregister</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>


<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success">Click me</button>

<!-- welcome modal start -->
<!-- welcome modal end -->
<script>
    const route = "{{route('update.participant')}}";
</script>
<!-- js -->
<script src="{{asset ('assets/vendors/scripts/core.js')}}"></script>
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
<script src="{{asset ('assets/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
<!-- <script src="{{asset ('assets/src/plugins/datatables/js/vfs_fonts.js')}}"></script> -->

<script src="{{asset ('assets/vendors/scripts/datatable-setting.js')}}"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

<script src="{{asset('assets/module/main.js')}}"></script>

<!-- switchery js -->
<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<!-- bootstrap-stouchspin js -->

<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

<script src="{{asset('assets/module/main.js')}}"></script>


<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
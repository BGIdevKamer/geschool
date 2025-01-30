<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-20 card-box mb-20">
        <h2 class="text-primary">Salles</h2>
        <div class="clearfix">
            <div class="pull-right">
                <div class="pull-right ml-2">
                    <a
                        href="#"
                        class="btn-block"
                        data-toggle="modal"
                        data-target="#bd-example-modal-lg"
                        type="button">
                        <button class="btn btn-primary">Ajouter Salles</button>
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
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Liste des matieres</h4>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort"></th>
                        <th>Nom</th>
                        <th>Places</th>
                        <th>Description</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody id="">
                    @foreach($salles as $key => $salle)
                    <tr>
                        <td>{{$key}}</td>
                        <td class="table-plus">{{$salle->nom}}</td>
                        <td>{{$salle->places}} </td>
                        <td>{{$salle->description}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item"
                                        class="btn-block"
                                        id="modfiySalle"
                                        data-toggle="modal"
                                        data-target="#bd-example-modal-Modify"
                                        data-nom="{{$salle->nom}}"
                                        data-places="{{$salle->places}}"
                                        data-description="{{$salle->description}}"
                                        data-id="{{$salle->id}}"
                                        href="#"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item text-danger" href="#"
                                        class="btn-block"
                                        id="deleteSalle"
                                        data-toggle="modal"
                                        data-target="#alert-modal"
                                        data-id="{{$salle->id}}"
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
                    <form action="{{route('delete.Salle')}}" method="post">
                        @csrf
                        <input type="hidden" id="idSalle" name="id">
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


    <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Nouvel Salle
                    </h4>
                    <button type="button" class="close" id="closeSave" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('save.Salles')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" name="nom">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Places</label>
                                    <input type="number" class="form-control" name="place">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary" id="saveEnseignants">
                        <div class="spinner-border text-light load-btn-ex d-none" style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="btn-txt-ex">Enregister</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="bd-example-modal-Modify" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Modifier Salle
                    </h4>
                    <button type="button" class="close" id="closeSave" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update.Salle')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" name="nomSalle" id="nomSalle">
                                </div>
                                <input type="hidden" class="form-control" name="salleId" id="salleId">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Places</label>
                                    <input type="number" class="form-control" name="placeSalle" id="placeSalle">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="descriptionSalle" id="descriptionSalle">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary" id="saveEnseignants">
                        <div class="spinner-border text-light load-btn-ex d-none" style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="btn-txt-ex">Enregister</span>
                    </button>
                </div>
                </form>
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
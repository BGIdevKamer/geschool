<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-20 card-box mb-20">
        <h2 class="text-primary">Matières</h2>
        <div class="clearfix">
            <div class="pull-right">
                <div class="pull-right ml-2">
                    <a
                        href="#"
                        class="btn-block"
                        data-toggle="modal"
                        data-target="#bd-example-modal-lg"
                        type="button">
                        <button class="btn btn-primary">Ajouter Matières</button>
                    </a>
                </div>
                <div class="pull-right">
                    <a
                        href="#"
                        class="btn-block"
                        data-toggle="modal"
                        data-target="#bd-example-modal-Categorie"
                        type="button">
                        <button class="btn btn-dark">Ajouter Categorie</button>
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
                        <th class="table-plus datatable-nosort">numero</th>
                        <th>Libeller</th>
                        <th>Nombre d'heures</th>
                        <th>Coefficients</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody id="">
                    @foreach($matieres as $key => $matiere)
                    <tr>
                        <td>{{$key}}</td>
                        <td class="table-plus">{{$matiere->libeller}}</td>
                        <td>{{$matiere->heures}} heures</td>
                        <td>{{$matiere->coefs}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item"
                                        id="modifyMatieres"
                                        data-toggle="modal"
                                        data-target="#bd-example-modal-modify"
                                        data-libeller="{{$matiere->libeller}}"
                                        data-id="{{$matiere->id}}"
                                        data-heures="{{$matiere->heures}}"
                                        data-coefs="{{$matiere->coefs}}"
                                        data-categorie="{{$matiere->categorie_id}}"
                                        href="#"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item text-danger" href="#"
                                        class="btn-block"
                                        id="deleteParticipant"
                                        data-toggle="modal"
                                        data-target="#alert-modal"
                                        data-id="{{$matiere->id}}"
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

    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Liste des Categories</h4>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">numero</th>
                        <th>Libeller</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody id="">
                    @foreach($categories as $key => $categorie)
                    <tr>
                        <td>{{$key}}</td>
                        <td class="table-plus">{{$categorie->libeller}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item"
                                        id="modifyCategorie"
                                        data-toggle="modal"
                                        data-target="#bd-example-modal-modify-categorie"
                                        data-libeller="{{$categorie->libeller}}"
                                        data-id="{{$categorie->id}}"
                                        href="#"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item text-danger" href="#"
                                        class="btn-block"
                                        id="deleteCategorie"
                                        data-toggle="modal"
                                        data-target="#alert-modalCategorie"
                                        data-id="{{$categorie->id}}"
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


<div class="modal fade bs-example-modal-lg" id="bd-example-modal-modify" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Modifier Matières
                </h4>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('modify.Matieres')}}" method="post" id="form-update">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Libeller <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="uplibeller" id="uplibeller" required>
                                <input type="hidden" class="form-control" name="upId" id="upId" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nombre d'heure</label>
                                <input type="number" class="form-control" name="upheure" id="upheure">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Coefficients/Credits <strong class="text-danger">*</strong></label>
                                <input type="number" class="form-control" name="upcoefs" id="upcoefs" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="upcategorie" id="upcategorie" required>
                                <label>Niveau</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary"
                                    data-size="5" name="selectCategorie" id="selectCategorie">
                                    <option value="">Choisir une categorie</option>
                                    @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->libeller}}</option>
                                    @endforeach
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
                <form action="{{route('delete.Matieres')}}" method="post">
                    @csrf
                    <input type="hidden" id="idDelete" name="id">
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
    id="alert-modalCategorie"
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
                <form action="{{route('delete.Categorie')}}" method="post">
                    @csrf
                    <input type="hidden" id="idDeleteCategorie" name="idCategorie">
                    <button
                        type="submit"
                        class="btn btn-light"
                        id="suppbtn">
                        <div class="spinner-border text-primary load-btn-Delete d-none"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="load-txt-Delete">Continuer</span>
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
                    Nouvel Matières
                </h4>
                <button type="button" class="close" id="closeSave" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add.Matieres')}}" method="post" id="form-charge">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Libeller <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="libeller" id="libeller" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nombre d'heure</label>
                                <input type="number" class="form-control" name="heure" id="heure">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Coefficients/credits <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="coefs" id="coefs" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Niveau</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary"
                                    data-size="5" name="categorie" id="categorie">
                                    <option value="">Choisir une categorie</option>
                                    @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->libeller}}</option>
                                    @endforeach
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

<div class="modal fade bs-example-modal-lg" id="bd-example-modal-Categorie" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Nouvel Categorie
                </h4>
                <button type="button" class="close" id="closeSave" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add.Categorie')}}" method="post" id="">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>categorie</label>
                                <input type="text" class="form-control" name="categorieLibeller" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">
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

<div class="modal fade bs-example-modal-lg" id="bd-example-modal-modify-categorie" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Modifier Categorie
                </h4>
                <button type="button" class="close" id="closeSave" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('modify.Categorie')}}" method="post" id="">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>categorie</label>
                                <input type="text" class="form-control" name="upcategorieLibeller" id="upcategorieLibeller" required>
                                <input type="hidden" class="form-control" name="categorieId" id="categorieId">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">
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



<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>
<script>
    const route = "{{route('delete.Matieres')}}";
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

<script src="{{asset('assets/module/main.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
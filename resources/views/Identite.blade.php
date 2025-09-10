<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-20 card-box mb-20">
        <h2 class="text-primary">Identité</h2>
        <div class="clearfix">
            <div class="pull-right">
                <div class="pull-right ml-2">
                    <a
                        href="#"
                        class="btn-block"
                        data-toggle="modal"
                        data-target="#new-modal-add"
                        type="button">
                        <button class="btn btn-primary">Personnelles</button>
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
        <form action="{{route('update.Identite')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="pd-20">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$Identify->email}}" required>
                            <input type="hidden" class="form-control" name="id" value="{{$Identify->id}}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Raison social</label>
                            <input type="text" class="form-control" name="rs" value="{{$Identify->raisonSocial}}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Ville</label>
                            <input type="text" class="form-control" name="ville" value="{{$Identify->ville}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Adress</label>
                            <input type="text" class="form-control" name="adress" value="{{$Identify->adress}}" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Boite Postal</label>
                            <input type="text" class="form-control" name="bp" value="{{$Identify->Bp}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" class="form-control" name="telephone" value="{{$Identify->telephone}}" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label>Type</label>
                        <select class="form-control" name="type" required>
                            <option value="1" @if($Identify->type == 1) selected @endif>Primaire</option>
                            <option value="2" @if($Identify->type == 2) selected @endif>Secondaire</option>
                            <option value="3" @if($Identify->type == 3) selected @endif>Supperieur</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Logo</label>
                            <div class="custom-file">
                                <input type="file" id="fileInput" name="logo" class="custom-file-input" />
                                <label class="custom-file-label" id="nameFile">Choisr un Fichier</label>
                                <span id="errorMessage" style="color: red;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>

    <div class="card-box pb-10">
        <div class="h5 pd-20 mb-0">Personelle</div>
        <table class="data-table table nowrap">
            <thead>
                <tr>
                    <th class="table-plus">Nom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Date D'admition</th>
                    <th>Role</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Personnelles as $Personnelle)
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img
                                    src="{{Storage::url($Personnelle->logo)}}"
                                    class="border-radius-100 shadow"
                                    width="40"
                                    height="40"
                                    alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">{{$Personnelle->name}}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{$Personnelle->email}}</td>
                    <td>{{$Personnelle->telephone}}</td>
                    <td>08 Oct 2020</td>
                    <td>
                        <span
                            class="badge badge-pill"
                            data-bgcolor="#e7ebf5"
                            data-color="#265ed7">{{$Personnelle->role}}</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a
                                id="updatePersonnel"
                                data-toggle="modal"
                                data-target="#update-Personnel"
                                data-id="{{$Personnelle->id}}"
                                data-name="{{$Personnelle->name}}"
                                data-email="{{$Personnelle->email}}"
                                data-telephone="{{$Personnelle->telephone}}"
                                type="button" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="{{route('Personnel.delete',['id'=>$Personnelle->id])}}" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal fade bs-example-modal-lg" id="new-modal-add" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Personelle
                    </h4>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('store.Personnel')}}" method="post" id="form-update" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nom <strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>telephone</label>
                                    <input type="text" class="form-control" name="telephone" id="telephone" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <div class="custom-file">
                                        <input type="file" id="fileInput" name="photo" class="custom-file-input" />
                                        <label class="custom-file-label" id="nameFile">Choisr un Fichier</label>
                                        <span id="errorMessage" style="color: red;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <select class="form-control" name="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Scolarite">Scolarite</option>
                                        <option value="Secretariat">Secretariat</option>
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

    <div class="modal fade bs-example-modal-lg" id="update-Personnel" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Modifier Personelle
                    </h4>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Personnel.update')}}" method="post" id="form-update" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nom <strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" name="nameUpdate" id="nameUpdate" required>
                                    <input type="hidden" class="form-control" name="idUpdate" id="idUpdate" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="emailUpdate" id="emailUpdate" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>telephone</label>
                                    <input type="text" class="form-control" name="telephoneUpdate" id="telephoneUpdate" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="passwordUpdate" id="passwordUpdate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Roles</label>
                                    <select class="form-control" name="roleUpdate">
                                        <option value="">Garder Le Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Scolarite">Scolarite</option>
                                        <option value="Secretariat">Secretariat</option>
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
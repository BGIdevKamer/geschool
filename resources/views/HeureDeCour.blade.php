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
                            <h2 class="text-primary">Heures de cour</h2>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{route('heure.DeCour')}}">Heure</a>
                                </li>
                            </ol>
                        </nav>
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
            <div class="d-20 card-box mb-30">
                <div class="pd-20 card-box mb-30">
                    <form action="{{route('store.Heure')}}" method="post" id="form-charge">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Heure debut</label>
                                    <input
                                        class="form-control"
                                        placeholder="time"
                                        name="heure_debut"
                                        type="time" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Heure fin</label>
                                    <input
                                        class="form-control"
                                        placeholder="time"
                                        name="heure_fin"
                                        type="time" required />
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
            <div class="pd-20 card-box mb-30">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Nombre</th>
                            <th>Debut</th>
                            <th>Fin</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @foreach ($heures as $key => $heure)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$heure->heure_debut}}:{{$heure->min_debut}}</td>
                            <td>{{$heure->heure_fin}}:{{$heure->min_fin}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item text-danger" href="#"
                                            class="btn-block"
                                            id="delete"
                                            data-id="{{$heure->id}}"
                                            data-toggle="modal"
                                            data-target="#alert-modal"
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
                            <form action="{{route('delete.Heure')}}" method="post">
                                @csrf
                                <input type="hidden" id="id" name="id">
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
    </div>
</div>
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/module/main.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/dashboard3.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
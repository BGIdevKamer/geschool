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
                            <h4>Emploie de temps</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Emploie de temps
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading h4">Attention!</h4>
                    <p>
                        La formation selectionner dispose deja d'un emploie de temps.
                        pour modifier l'emploie cliquer sur <strong>Modifier</strong>
                    </p>
                    <hr />
                    <p class="mb-0">
                        <a href="{{route('session.Cour',['id'=>session('success')])}}" class="btn btn-success">Modifier</a>
                    </p>
                </div>
                @endif
            </div>
            <div class="pd-20 card-box mb-30">
                <form action="{{route('store.Emploie')}}" method="post" id="form-charge">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" class="form-control" name="titre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Formation/Speciliter <small class="text-danger">*</small> </label>
                                    <div class="form-group has-warning">
                                        <select class="custom-select2 form-control" name="formation" id="formation"
                                            style="width: 100%; height: 38px" required>
                                            <option value="">Choisir une formation</option>
                                            @foreach ($Formations as $formation)
                                            <option value="{{$formation->id}}">{{$formation->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>année scolaire</label>
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
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Niveau</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary"
                                    data-size="5" name="niv" id="niv">
                                    <option value="">Choisir le niveau</option>
                                    <option value="1">Niveau I</option>
                                    <option value="2">Niveau II</option>
                                    <option value="3">Niveau III</option>
                                    <option value="4">Niveau IV</option>
                                    <option value="5">Niveau VI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>date de debut et date de fin</label>
                                <input
                                    class="form-control datetimepicker-range"
                                    placeholder="Select Month"
                                    name="dates"
                                    type="text" required />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Note</label>
                                <input
                                    class="form-control"
                                    placeholder="note"
                                    name="note"
                                    type="text" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <div class="spinner-border text-light load-btn-ex d-none" style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="btn-txt-ex">Enregister et configurer</span>
                    </button>
                </form>
            </div>
            <div class="pd-20 card-box mb-30">
                <h2 class="text-primary mb-3">Emploie de Temps</h2>
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Formation</th>
                            <th>Année scolaire</th>
                            <th>Niveau</th>
                            <th>date debut</th>
                            <th>date fin</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @foreach ($Emploies as $Emploie)
                        <tr>
                            <td>{{$Emploie->titre}}</td>
                            <td>{{$Emploie->Formation->nom}}</td>
                            <td>{{$Emploie->anneeScolaire}}</td>
                            <td>{{$Emploie->niveau}}</td>
                            <td>{{$Emploie->date_debut}}</td>
                            <td>{{$Emploie->date_fin}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{route('session.Cour',['id'=>$Emploie->id])}}"><i class="dw dw-eye"></i> Detaille</a>
                                        <a class="dropdown-item" href="#"
                                            id="updateParticipants"
                                            class="btn-block" data-toggle="modal"
                                            data-target="#Modal-update" type="button"><i class="icon-copy dw dw-edit-2"></i> Modifier</a>
                                        <a class="dropdown-item text-danger" href="#"
                                            class="btn-block"
                                            id="deleteParticipant"
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
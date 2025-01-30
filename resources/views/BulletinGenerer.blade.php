<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 class="text-primary">Bulletins</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('Bulletin.index')}}">Generation de bulletin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            liste bulletin Générer
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{route('Trie.Bulletin')}}" method="post" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-12">
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
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>année scolaire <small class="text-danger">*</small> </label>
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
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Evaluation <small class="text-danger">*</small></label>
                        <div class="form-group has-warning">
                            <select class="custom-select2 form-control" name="evaluation" id="evaluation"
                                style="width: 100%; height: 38px" required>
                                <option value="">Choisir une formation </option>
                                @foreach ($Evaluations as $Evaluation)
                                <option value="{{$Evaluation->id}}">{{$Evaluation->libeller}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <input type="submit" value="Rechercher" class="w-100 btn btn-primary">
                </div>
            </div>
        </form>

    </div>
    <div class="card-box pb-10">
        <div class="h5 pd-20 mb-0">Liste des bulletin generé</div>
        <table class="data-table table nowrap">
            <thead>
                <tr>
                    <!-- <th class="table-plus">Name</th> -->
                    <th>Nom/Prenom</th>
                    <th>Formations</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Bulletins as $Bulletin)
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                            </div>
                            <div class="txt">
                                <div class="weight-600">{{$Bulletin->Participant->nom}} {{$Bulletin->Participant->prenom}}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{$Bulletin->Formation->nom}}</td>
                    <!-- <td>
                        <span
                            class="badge badge-pill"
                            data-bgcolor="#e7ebf5"
                            data-color="#265ed7">Typhoid</span>
                    </td> -->
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="{{route('view.Bulletin',['route'=>$Bulletin->id])}}"><i class="dw dw-eye"></i> Ouvrir</a>
                                <a class="dropdown-item" href="{{route('download.Bulletin',['route'=>$Bulletin->id])}}"
                                    class="btn-block"
                                    type="button"><i class="icon-copy fi-page-export"></i> Telecharger</a>
                                <!-- <a class="dropdown-item text-danger" href="#"
                                    class="btn-block"
                                    type="button"><i class=" dw dw-delete-3"></i>
                                    Supprimer</a> -->
                            </div>
                        </div>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- welcome modal start -->

<button class="welcome-modal-btn">
    <i class="fa fa-download"></i> Download
</button>
<!-- welcome modal end -->
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
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
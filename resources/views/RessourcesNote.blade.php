<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Online Note</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Acceuil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Online Note
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">Liste notes</h5>
                        <div class="tab">
                            <ul class="nav nav-pills justify-content-end" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#home6" role="tab"
                                        aria-selected="true">Modules</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#profile6" role="tab"
                                        aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#contact6" role="tab"
                                        aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home6" role="tabpanel">
                                    <table class="data-table table stripe hover nowrap pd-20">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Participants</th>
                                                <th>Libeller exercies</th>
                                                <th>Formation</th>
                                                <th>score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @foreach($modules as $module)
                                            <tr>
                                                <td class="table-plus">{{$module->Participant->nom}} {{$module->Participant->prenom}}</td>
                                                <td>{{$module->Exercice->libeller}}</td>
                                                <td>{{$module->Exercice->Module->Formation->nom}}</td>
                                                <td>{{$module->score}} Point</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile6" role="tabpanel">
                                    <table class="data-table table stripe hover nowrap pd-20">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Participants</th>
                                                <th>Libeller exercies</th>
                                                <th>Formation</th>
                                                <th>score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @foreach($formations as $formation)
                                            <tr>
                                                <td class="table-plus">{{$formation->Participant->nom}} {{$formation->Participant->prenom}}</td>
                                                <td>{{$formation->Exercice->libeller}}</td>
                                                <td>{{$formation->Exercice->Formation->nom}}</td>
                                                <td>{{$formation->score}} Point</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="contact6" role="tabpanel">
                                    <table class="data-table table stripe hover nowrap pd-20">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Participants</th>
                                                <th>Libeller exercies</th>
                                                <th>Formation</th>
                                                <th>score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @foreach($cours as $cour)
                                            <tr>
                                                <td class="table-plus">{{$cour->Participant->nom}} {{$cour->Participant->prenom}}</td>
                                                <td>{{$cour->Exercice->libeller}}</td>
                                                <td>{{$cour->Exercice->Cour->Module->Formation->nom}}</td>
                                                <td>{{$formation->score}} Point</td>
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

        </div>
    </div>
</div>
<!-- welcome modal start -->

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
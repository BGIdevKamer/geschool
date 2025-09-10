<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">@if(Session::get('type') == "4") Liste des participants @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Liste des eleves @else Liste des etudiants @endif</h4>
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
                        <th>Demande</th>
                        <th>date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="load-table">
                    @foreach($Demandes as $Demande)
                    <tr>
                        <td>{{$Demande->Participant->nom}} {{$Demande->Participant->prenom}}</td>
                        <td>{{$Demande->Participant->telephone}}</td>
                        <td>{{$Demande->Participant->email}}</td>
                        <td>{{$Demande->Message}}</td>
                        <td>{{$Demande->created_at}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="{{route('Participant.Detail',['id'=>$Demande->participant_id])}}"><i class="dw dw-eye"></i> Detaille</a>
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
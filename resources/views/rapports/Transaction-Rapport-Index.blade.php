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
                            <h4>Rapport des payements</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Rapport
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @if(session('success'))
                <div
                    class="alert alert-warning alert-dismissible fade show mt-3"
                    role="alert">
                    <strong></strong> {{session('success')}}
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
            <div class="pd-20 card-box mb-30">
                <h3 class="m-3 text-primary">Rapport des Payements</h3>
                <form action="{{route('Transaction.RapportCreate')}}" method="post" id="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Formation/Speciliter <small class="text-danger">*</small> </label>
                                    <div class="form-group has-warning">
                                        <select class="custom-select2 form-control" name="form" id="form"
                                            style="width: 100%; height: 38px">
                                            <option value="">Choisir une formation</option>
                                            @foreach ($Formations as $formation)
                                            <option value="{{$formation->id}}">{{$formation->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date Debut</label>
                                    <input
                                        class="form-control month-picker"
                                        placeholder="Select Month"
                                        name="start_date"
                                        required
                                        type="text" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date Debut</label>
                                    <input
                                        class="form-control month-picker"
                                        name="end_date"
                                        required
                                        placeholder="Select Month"
                                        type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Enregister
                    </button>
                </form>
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
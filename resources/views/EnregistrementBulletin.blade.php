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
                            <h4>Creation de bulletin scolaire</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Bulletin
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
                <form action="{{route('Generate.Bulletin')}}" method="post" id="form-charge">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
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
                        <div class="col-md-6 col-sm-12">
                            <label for="">Années scolaire</label>
                            <div class="form-group has-warning">
                                <select class="custom-select2 form-control" name="anneescolaire"
                                    id="anneescolaire"
                                    style="width: 100%; height: 38px" required>
                                    <option value="">Choisir une année scolaire</option>
                                    @foreach($years as $year)
                                    <option value="{{$year->Years}}" @if($year->active == 1) selected @endif @if(count($years)==0) disabled @endif>{{$year->Years}}</option>
                                    @endforeach
                                </select>
                                @if(count($years) == 0)
                                <p class="text-warnning"> veill Crée et activer les années scolaires <a href="{{route('General.index')}}" class="btn btn-primary"> Continuer </a></p>
                                @endif
                                <div class="erranneescolaire"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Evaluation</label>
                                <div class="form-group has-warning">
                                    <select class="custom-select2 form-control" name="evaluation" id="evaluation"
                                        style="width: 100%; height: 38px" required>
                                        <option value="">Choisir une formation</option>
                                        @foreach ($Evaluations as $Evaluation)
                                        <option value="{{$Evaluation->id}}">{{$Evaluation->libeller}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Evaluation de rappel</label>
                                <div class="form-group has-warning">
                                    <select class="custom-select2 form-control" name="eval_prev" id="eval_prev"
                                        style="width: 100%; height: 38px">
                                        <option value="">Choisir une formation</option>
                                        @foreach ($Evaluations as $Evaluation)
                                        <option value="{{$Evaluation->id}}">{{$Evaluation->libeller}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
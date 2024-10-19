<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        @foreach($Exercice as $exercice)
        <div class="min-height-200px">
            <div class="p-3 card-box mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Enregistrement Exercices</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Configuration
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <h2 class="mb-3 mt-3 text-primary">Liste des questions</h2>
                <hr class="m-5">
                @foreach($exercice->Questions as $question)
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <h5 class="mb-3"><label for="">{{$question->Question}}</label></h5>
                        <div class="form-group">
                            @foreach($question->Choixes as $key => $Choix)
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio{{$key}}" name="customRadio{{$question->id}}" class="custom-control-input"
                                    value="{{$Choix->id}}" />
                                <label class="custom-control-label" for="customRadio{{$key}}">{{$Choix->content}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button class="btn btn-success"><i class="icon-copy bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger"><i class="icon-copy bi bi-clipboard-x"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

</div>

</div>


<!-- welcome modal start -->
<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>
<!-- welcome modal end -->

<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/module/main.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<!-- bootstrap-touchspin js -->
<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>




<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>
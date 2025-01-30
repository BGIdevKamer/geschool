<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            @foreach($formations as $formation)
            @if($formation->Exercices()->exists())
            <h5 class="h4 text-blue mb-10">Libeller de la formation : {{$formation->nom}}</h5>
            <div class="row clearfix">
                @foreach($formation->Exercices as $exercice)
                <div class="row clearfix">
                    <div class="col-sm-12 col-md-4 mb-30">
                        <div class="card card-box">
                            <div class="card-header">Durée {{$exercice->duree}}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$exercice->libeller}}</h5>
                                <p class="card-text">
                                    {{$exercice->description}}
                                </p>
                                <a href="#" class="btn btn-success">Commancer <i class="icon-copy bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>


<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/module/main.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>
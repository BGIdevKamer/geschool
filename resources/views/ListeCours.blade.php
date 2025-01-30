<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            @foreach($formations as $formation)
            @if($formation->Modules()->exists())
            <h5 class="h4 text-blue mb-10">Libeller de la formation : {{$formation->nom}}</h5>
            <div class="row clearfix">
                @foreach($formation->Modules as $module)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">{{$module->libeller}}</h5>
                            <p class="mb-0">{{$module->description}}</p>
                            <a href="{{route('Module.Vue',['id'=>$module->id])}}" class="btn btn-success mt-3">Commancer <i class="icon-copy bi bi-arrow-right"></i></a>
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
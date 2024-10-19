<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            @foreach($formations as $formation)
            <h5 class="h4 text-blue mb-10">Libeller de la formation : {{$formation->nom}}</h5>
            <div class="row clearfix">
                @foreach($formation->cours as $cour)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="{{Storage::url($cour->imgLink)}}" alt="" />
                            <div class="da-overlay">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="{{route('view.cour',['id'=>$cour->id])}}"><i class="icon-copy fa fa-mail-reply-all" aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{route('delete.cour',['id'=>$cour->id])}}"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">{{$cour->libeller}}</h5>
                            <p class="mb-0">{{$cour->desc}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
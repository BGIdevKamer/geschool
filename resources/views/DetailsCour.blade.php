<html>
@include('header')
<link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/plyr/dist/plyr.css')}}" />

<div class="main-container">
    <div class="pd-ltr-20 customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                @foreach($cours as $cour)
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Details de cour</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$cour->Module->nom}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                    </div>
                </div>
                @if(session('success'))
                <div
                    class="alert alert-success alert-dismissible fade show mt-3"
                    role="alert">
                    <strong>Felicitations!</strong> {{session('success')}}
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
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">{{$cour->numero}} - {{$cour->libeller}}</h4>
                        <p class="font-14 ml-0">
                            {{$cour->desc}}
                        </p>
                    </div>
                </div>
                <div class="container">
                    <video id="player"
                        poster="{{Storage::url($cour->imgLink)}}" controls
                        playsinline controls>
                        <source src="{{Storage::url($cour->videoLink)}}" type="video/mp4" />
                    </video>
                </div>
                <div class="container mt-5 mb-5">
                    {!!$cour->Content!!}
                </div>
                @if(count($cour->Pieces) != 0)
                <h2 class="pt-2">Telechargements</h2>
                <p class=" pb-3">Cliquez pour lancer le Telechargements</p>
                <div class="row clearfix">
                    @foreach($cour->Pieces as $Piece)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                        <a href="{{route('download',['file'=>$Piece->id])}}">
                            <div class="da-card" style="cursor: pointer;" id="save" data-pieces="">
                                <div class="da-card-photo">
                                    <img src="{{asset('assets/imgs/'.$Piece->extension.'.PNG')}}" alt="" />
                                    <div class="da-overlay da-slide-bottom">
                                        <div class="da-social">
                                            <ul class="clearfix">
                                                <i class="icon-copy bi bi-save" style="font-size: 30px;"></i>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
                <hr class="mb-3 mt-3">
                <h3 class="text-primary mb-3">Exercices</h3>
                <div class="row clearfix">
                    @foreach($cour->Exercices as $exercice)
                    <div class="col-sm-12 col-md-4 mb-30">
                        <div class="card card-box">
                            <div class="card-header">{{$exercice->libeller}}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$exercice->duree}}</h5>
                                <p class="card-text">
                                    {{$exercice->description}}
                                </p>
                                <a href="{{route('Config.Exercices',['id'=>$exercice->id])}}" class="btn btn-primary">Voir plus</a>
                                <a href="#" class="btn btn-danger">Suprrimer</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
<script src="{{asset('assets/src/plugins/plyr/dist/plyr.js')}}"></script>
<script src="https://cdn.shr.one/1.0.1/shr.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const player = new Plyr('#player');
    });
    plyr.setup({
        tooltips: {
            controls: !0,
        },
    });
</script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
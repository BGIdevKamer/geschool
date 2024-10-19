<!DOCTYPE html>
<html>
@include('participant.header')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-100px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Liste des cours</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Cours
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @foreach($FormationParticipant as $Infos)
        <div class="p-3 card-box mb-3">
            <div class="title mb-3">
                <h4 class="text-primary">{{$Infos->Formation->nom}}</h4>
                <p>{{$Infos->anneeScolaire}}</p>
            </div>
            <div class="row clearfix">
                @if(!empty($Infos->Formation->cours))
                @foreach($Infos->Formation->cours as $cour)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="card card-box">
                        <img class="card-img-top" src="{{Storage::url($cour->imgLink)}}" alt="Card image cap" />
                        <div class="card-body">
                            <h5 class="card-title weight-500">{{$cour->libeller}}</h5>
                            <p class="card-text">
                                {{$cour->desc}}
                            </p>
                            <a href="{{route('particpant.cour',['id'=>$cour->id])}}" class="btn btn-primary">Commancer</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center"><strong>Cette formation n'a aucun cour</strong></p>
                @endif
            </div>

        </div>


        @endforeach

    </div>
</div>
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
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
<!DOCTYPE html>
<html>
@include('participant.header')

<div class="main-container">
    <div class="pd-ltr-20 height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Evaluations de fin de formation</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="">Acceuil</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="blog-wrap">
                <div class="container pd-0">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="blog-list">
                                <ul>
                                    @foreach ($FormationParticipants as $FormationParticipant)
                                    @foreach ($FormationParticipant->Formation->Exercices as $exercice)
                                    <li>
                                        <div class="row no-gutters">
                                            <div class="col-lg-8 col-md-12 col-sm-12">
                                                <div class="blog-caption">
                                                    <h3 class="mb-2 text-success">
                                                        {{ $exercice->libeller }}
                                                    </h3>
                                                    <div class="blog-by">
                                                        <p>{{ $exercice->description }}</p>
                                                        <p><strong>{{ $FormationParticipant->anneeScolaire }}</strong> <strong class="text-primary">{{ $FormationParticipant->Formation->nom }}</strong></p>
                                                        <div class="progress mb-20">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: {{$data[$FormationParticipant->id]}}%"
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                            {{ isset($data[$FormationParticipant->id]) ? $data[$FormationParticipant->id] : 0 }}%
                                                        </div>
                                                        @if($data[$FormationParticipant->id] == 100)
                                                        <div class="pt-10">
                                                            <a href="{{ route('Exercice.View', ['id' => $exercice->id]) }}" class="btn btn-outline-primary">Commencer</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endforeach

                                </ul>
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

<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
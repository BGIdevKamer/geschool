<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Gestion des notes</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Acceuil</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('Bulletin.index')}}">Note</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Insertion rapide des notes
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="{{route('Bulletin.index')}}"
                            data-toggle="modal"
                            data-target="#bd-insertion"
                            type="button">
                            Retour</a>
                    </div>
                </div>
            </div>
            <div class="p-3 card-box mb-30">
                @if(session('success'))
                <div class="card-box mb-30">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
                @endif
                <form action="{{route('Insertion.add')}}" method="post" id="form-charge">
                    @csrf
                    <h2 class="text-primary mb-3">{{$data['formation_libeller']}} | {{$Matiere->libeller}}</h2>
                    <hr>
                    <input type="hidden" name="anneescolaire" value="{{$data['anneescolaire']}}">
                    <input type="hidden" name="Evaluation" value="{{$Evaluation->id}}">
                    <input type="hidden" name="matiere" value="{{$Matiere->id}}">
                    <input type="hidden" name="formation" value="{{$data['formation_id']}}">
                    @foreach($FormationParticipants as $FormationParticipant)
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nom et prenom</label>
                                <input type="text" class="form-control" value="{{$FormationParticipant->Participant->nom}} {{$FormationParticipant->Participant->prenom}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Note</label>
                                <input type="number" class="form-control" value="" name="participant_{{$FormationParticipant->id}}" max="20" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>appreciation</label>
                                <input type="text" class="form-control" value="" name="appreciation_{{$FormationParticipant->id}}" required>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
<!-- welcome modal start -->


<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>

<script src="{{asset('assets/module/main.js')}}"></script>

<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
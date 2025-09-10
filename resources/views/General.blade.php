<!DOCTYPE html>
<html>
@include('header')

<body>
    <div class="main-container">
        <div class="pd-20 card-box mb-20">
            <h2 class="text-primary">Général</h2>
            <div class="clearfix">
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
            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{$error}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endforeach
            @endif
        </div>
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="mb-20 h4">Années scolaires</h4>
                            <div class="list-group">
                                @foreach($years as $year)
                                <a href="#"
                                    id="YearsActive"
                                    data-toggle="modal"
                                    data-target="#confirmation-modal"
                                    data-year="{{$year->Years}}"
                                    class="list-group-item list-group-item-action @if($year->active == 1) active @endif">{{$year->Years}}</a>
                                @endforeach
                                <a
                                    href="#"
                                    class="btn-block"
                                    data-toggle="modal"
                                    data-target="#modal-years"
                                    type="button">
                                    <button class="btn btn-primary w-100 mt-3">Ajouter Années</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="mb-20 h4">Salles</h4>
                            <div class="list-group">
                                <ul class="list-group">
                                    @foreach($Salles as $Salle)
                                    <li class="list-group-item">{{$Salle->nom}} {{$Salle->places}} Places</li>
                                    @endforeach
                                </ul>
                                <a
                                    href="{{route('index.Salles')}}"
                                    class="btn-block"
                                    type="button">
                                    <button class="btn btn-primary w-100 mt-3">Gerer les salles</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="mb-20 h4">Session d'evaluation</h4>
                            <div class="list-group">
                                @foreach($Evaluations as $Evaluation)
                                <a
                                    href="#"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <h5 class="mb-1 h5 color-primary">{{$Evaluation->libeller}}</h5>
                                    <!-- <div class="pb-1">
                                        <small class="weight-600">3 days ago</small>
                                    </div> -->
                                    <p class="mb-1 font-14">
                                        {{$Evaluation->description}}
                                    </p>
                                    <!-- <small>Donec id elit non mi porta.</small> -->
                                </a>
                                @endforeach
                                <a
                                    href="{{route('index.Evaluation')}}"
                                    class="btn-block"
                                    type="button">
                                    <button class="btn btn-primary w-100 mt-3">Gerer Les Evaluations</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" id="modal-years" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Années Scolaire
                        </h4>
                        <button type="button" class="close" id="closeSave" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('General.Years')}}" method="post" id="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nombre a Geénérer</label>
                                        <input type="number" class="form-control" min="1" max="10" name="number">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Année de référence</label>
                                        <input type="text" class="form-control" name="reference">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Fermer
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light load-btn-ex d-none" style="width: 1rem; height: 1rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="btn-txt-ex">Enregister</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="confirmation-modal"
            tabindex="-1"
            role="dialog"
            aria-hidden="true">
            <div
                class="modal-dialog modal-dialog-centered"
                role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <form action="{{route('Active.Years')}}" method="post">
                            @csrf
                            <h4 class="padding-top-30 mb-30 weight-500">
                                Cette année scolaire sera Selectionner par defaut !
                                <input type="hidden" id="activeYears" name="activeYears">
                            </h4>
                            <div
                                class="padding-bottom-30 row"
                                style="max-width: 170px; margin: 0 auto">
                                <div class="col-6">
                                    <button
                                        type="button"
                                        class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                        data-dismiss="modal">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button
                                        type="submit"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- js -->
    <script src="{{asset('assets/vendors/scripts/core.js')}}"></script>

    <script src="{{asset('assets/module/main.js')}}"></script>

    <script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
    <script src="{asset{('assets/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>

    <!-- Google Tag Manager (noscript) -->
    <script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
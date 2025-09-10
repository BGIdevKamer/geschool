<!DOCTYPE html>
<html>
@include('participant.header')

<div class="main-container">
    @if($VerificationForParticipant)
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Vue D'ensemble</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{$totalExercices}}</div>
                            <div class="font-14 text-secondary weight-500">
                                Exercices
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy dw dw-calendar1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{$totalModule}}</div>
                            <div class="font-14 text-secondary weight-500">
                                Module
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="icon-copy ti-heart"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{$moy}}</div>
                            <div class="font-14 text-secondary weight-500">
                                Moyenne Exercices
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i
                                    class="icon-copy fa fa-stethoscope"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"></div>
                            <div class="font-14 text-secondary weight-500">Caisse</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="row pb-10">
            <div class="col-md-12 col-sm-12">
                <div class="card-box height-100-p pd-20">
                    <div
                        class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                        <div class="h5 mb-md-0">Evolution des performances</div>
                        <div class="form-group mb-md-0">
                            <div class="dropdown">
                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown">
                                    {{date('Y-m-j')}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button" id="year">Vue Annuel</button>
                                    <button class="dropdown-item" type="button" id="mont">Vue Mensuel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="activities-chart"></div>
                </div>
            </div>
        </div>

    </div>
    @else
    <div class="pd-20 card-box mb-3">
        <h4 class="text-center text-primary">Vous ne disposer d'aucun contenue pour l'instant</h4>
        <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit esse saepe, possimus deleniti sed labore commodi <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestias rem sit natus magnam earum molestiae culpa numquam exercitationem, fugiat, nihil quasi ab tenetur eligendi eius porro consequatur nulla ad?</p>
    </div>
    @endif
</div>
<!-- welcome modal start -->

<script>
    let data = @json($dataEvaluation);

    // Extraire les années et les montants
    let score = data.map(item => item.score); // Les années
    let exercice = data.map(item => item.exercice_id); // Les montants
</script>

<!-- welcome modal end -->
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/ChartOption4.js')}}"></script>
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
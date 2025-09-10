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
                            <h4>{{$Module->libeller}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="">Acceuil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$Module->libeller}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="blog-wrap">
                <div class="container pd-0">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="blog-list">
                                <ul>
                                    @foreach($cours as $cour)
                                    <li>
                                        <div class="row no-gutters">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="blog-img">
                                                    <img
                                                        src="{{Storage::url($cour->imgLink)}}"
                                                        alt=""
                                                        class="bg_img" />
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-12 col-sm-12">
                                                <div class="blog-caption">
                                                    <h4>
                                                        <a href="#">{{$cour->libeller}}</a>
                                                    </h4>
                                                    <div class="blog-by">
                                                        <p>
                                                            {{$cour->desc}}
                                                        </p>
                                                        <div class="pt-10">
                                                            <a href="{{route('particpant.cour',['id'=>$cour->id])}}" class="btn btn-outline-primary">Voir plus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="blog-pagination">
                                <div class="btn-toolbar justify-content-center mb-15">
                                    <div class="btn-group">
                                        <!-- Lien vers la page précédente -->
                                        @if ($cours->onFirstPage())
                                        <span class="btn btn-outline-primary prev disabled">
                                            <i class="fa fa-angle-double-left"></i>
                                        </span>
                                        @else
                                        <a href="{{ $cours->previousPageUrl() }}" class="btn btn-outline-primary prev">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                        @endif

                                        <!-- Lien vers les pages -->
                                        @foreach ($cours->links()->elements[0] as $page => $url)
                                        @if ($page == $cours->currentPage())
                                        <span class="btn btn-primary current">{{ $page }}</span>
                                        @else
                                        <a href="{{ $url }}" class="btn btn-outline-primary">{{ $page }}</a>
                                        @endif
                                        @endforeach

                                        <!-- Lien vers la page suivante -->
                                        @if ($cours->hasMorePages())
                                        <a href="{{ $cours->nextPageUrl() }}" class="btn btn-outline-primary next">
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                        @else
                                        <span class="btn btn-outline-primary next disabled">
                                            <i class="fa fa-angle-double-right"></i>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-box mb-30">
                                <h5 class="pd-20 h5 mb-0">Modules</h5>
                                <div class="list-group">
                                    @foreach($Modules as $module)
                                    <a
                                        href="{{route('Module.Participant',['id'=>$module->id])}}"
                                        class="list-group-item d-flex align-items-center justify-content-between">{{$module->libeller}}
                                        <span class="badge badge-primary badge-pill">{{$module->cours->count()}}</span></a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-box mb-30">
                                <h5 class="pd-20 h5 mb-0">Exercice module</h5>
                                <div class="latest-post">
                                    <ul>
                                        @foreach($Exercices as $exercice)
                                        <li>
                                            <h4>
                                                <a href="{{route('Exercice.View',['id'=>$exercice->id])}}">{{$exercice->libeller}}</a>
                                            </h4>
                                            <span>{{$exercice->Module->libeller}}</span>
                                        </li>
                                        @endforeach
                                </div>
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
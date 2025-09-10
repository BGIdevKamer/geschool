<!DOCTYPE html>
<html>
@include('header')
<link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/dropzone/src/mydropzone.css')}}" />

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Ajouter un Cours </h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Acceuil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    cours
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{route('Liste.cours')}}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>
                </div>
                @endforeach
                @endif
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

            <div class="html-editor pd-20 card-box mb-30">
                <div class="errors-messages"></div>
                <form action="{{route('ModifyCour.cour')}}" id="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12 ">
                            <label>Titre du cours</label>
                            <div class="form-group has-warning">
                                <input type="text" class="form-control" name="libeller" id="libeller" value="{{$cour->libeller}}">
                                <input type="hidden" class="form-control" name="id" id="id" value="{{$cour->id}}">
                                <div class="err-libeller"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Numéro du cours</label>
                            <div class="form-group has-warning">
                                <input type="number" min="1" max="100" class="form-control" name="num" id="num" value="{{$cour->numero}}">
                                <div class="err-num"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6 col-sm-12">
                            Miniature
                        </div>
                        @if(!empty($cour->imgLink))
                        <div class="col-md-6 col-sm-12 text-right">
                            <a href="{{route('delete.Image',['id'=>$cour->id])}}" class="text-danger">Supprimer l'image</a>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="custom-file  has-warning">
                                <input type="file" class="custom-file-input" name="miniature" id="miniature" @if(!empty($cour->imgLink)) disabled @endif />
                                <label class="custom-file-label">Choisir une image</label>
                                <div class="err-miniature"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6 col-sm-12">
                            Video
                        </div>
                        @if(!empty($cour->videoLink))
                        <div class="col-md-6 col-sm-12 text-right">
                            <a href="{{route('delete.video',['id'=>$cour->id])}}" class="text-danger">Supprimer la video</a>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="custom-file  has-warning">
                                <input type="file" class="custom-file-input" name="video" id="video" @if(!empty($cour->videoLink)) disabled @endif accept="video/*" />
                                <label class="custom-file-label">Choisir une image</label>
                                <div class="err-miniature"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <label>Video youtube</label>
                            <div class="form-group has-warning">
                                <input type="text" class="form-control" name="deofile" id="deofile">
                                <div class="err-deofile"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Module</label>
                                <div class="form-group has-warning">
                                    <select class="custom-select2 form-control" name="state" id="module"
                                        style="width: 100%; height: 38px">
                                        <option value="">Choisir un Module</option>
                                        @foreach ($formations as $formation)
                                        @if($formation->Modules()->exists())
                                        <optgroup label="{{$formation->nom}}">
                                            @foreach($formation->Modules as $module)
                                            <option value="{{$module->id}}" @if($cour->module_id == $module->id) selected @endif>{{$module->libeller}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif
                                        @endforeach
                                    </select>
                                    <div class="err-formation"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Description courte</label>
                            <div class="form-group has-warning">
                                <input type="text" class="form-control" name="desc" id="desc" value="{{$cour->desc}}">
                                <div class="err-desc"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="h4 text-blue">
                        Contenu Textuel
                    </h4>
                    <textarea class="textarea_editor form-control border-radius-0" name="content" id="content"
                        placeholder="Enter text ..."></textarea>
                    <div class="err-content has-warning"></div>
                    <div class="pt-3">
                        <button class="btn btn-primary" id="addCour">
                            <div class="spinner-border text-light load-btn-cour d-none"
                                style="width: 1rem; height: 1rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="load-txt-cour">Enregister</span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Success modal -->
<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success">Click me</button>

<div
    class="modal fade bs-example-modal-lg"
    id="bd-example-modal-lg"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Ajouter des fichier au cour
                </h4>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="myContainer">
                    <div class="myhearder-section">
                        <h1 class="text-primary">Upload files</h1>
                        <p>Upload file you wabt to share with your team menberchip.</p>
                        <p>Pdf, img, xml, csv.</p>
                    </div>
                    <div class="myDrop-section">
                        <div class="myCol">
                            <div class="myCloud-icon">
                                <img src="{{asset('assets/vendors/images/cloud.PNG')}}" alt="">
                            </div>
                            <span>Drag end drop files here</span>
                            <span>Or</span>
                            <button class="myFile-selector">Browzer files</button>
                            <form action="{{route('add.pieces')}}" id="myFormFiles" method="POST">
                                @csrf
                                <input type="file" class="myFile-selector-input" name="pieces[]" multiple>
                                <input type="hidden" name="IdCour" id="IdCour" value="">
                                <input type="submit" id="sendPieces">
                            </form>
                        </div>
                        <div class="myCol">
                            <div class="myDrop-here">Drop here</div>
                        </div>
                    </div>
                    <div class="myListe-section">
                        <div class="myListe-title">Upload files</div>
                        <div class="myListe">
                            <!-- <li class="myIn-prog">
                                    <div class="myCol">
                                        <img src="{{asset('assets/vendors/images/csv.PNG')}}" alt="">
                                    </div>
                                    <div class="myCol">
                                        <div class="myFile-name">
                                            <div class="myName">File name</div>
                                            <span>50%</span>
                                        </div>
                                        <div class="myFile-progress">
                                            <span></span>
                                        </div>
                                        <div class="myFile-size">2.2MB</div>
                                    </div>
                                    <div class="myCol">
                                        <i class="icon-copy fa fa-close" aria-hidden="true"></i>
                                        <i class="icon-copy fa fa-check" aria-hidden="true"></i>
                                    </div>
                                </li> -->
                        </div>
                    </div>
                </div>
                <!-- dropzone  end -->
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Confirmation modal -->
    <!-- welcome modal start -->
    <a
        href="#"
        class="btn-block d-none"
        id="sa-start"
        data-toggle="modal"
        data-target="#bd-example-modal-lg"
        type="button">
    </a>
    <!-- welcome modal end -->

    <!-- js -->
    <script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('assets/src/plugins/dropzone/src/mydropzone.js')}}"></script>
    <script src="{{asset('assets/module/main.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>



    <script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
    <script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    </body>


</html>
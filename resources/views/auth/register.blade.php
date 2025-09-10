<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Gescholl</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/vendors/images/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/vendors/images/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/vendors/images/favicon-16x16.png')}}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/core.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/icon-font.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/jquery-steps/jquery.steps.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/style.css')}}" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <div class="pd-ltr-20 xs-pd-20-10 m-3">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Formulaire D'inscription</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Incription</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Connexion
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                            <a
                                class="btn btn-primary dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown">
                                January 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4 text-uppercase">cree et Configurer votre compte</h4>
                    <p class="mb-30">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div id="err">
                </div>
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>
                </div>
                @endforeach
                @endif
                <div class="wizard-content">
                    <form method="post" action="/register" enctype="multipart/form-data" class="tab-wizard2 wizard-circle wizard" id="RegisterUser">
                        @csrf
                        <h5>Admin Info</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom et prenom : </label>
                                        <input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" value="{{old('name')}}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address Email :</label>
                                        <input type="email" value="{{old('email')}}" class="form-control @error('email') form-control-danger @enderror" id="email" name="email" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number :</label>
                                        <input type="number" value="{{old('telephone')}}" class="form-control @error('telephone') form-control-danger @enderror" id="telephone" name="telephone" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mot de passe :</label>
                                        <input type="password" class="form-control @error('password') form-control-danger @enderror" id="password" name="password" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confimer le mot de passe :</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Image de profil</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="photo" />
                                            <label class="custom-file-label">Choisir une Image de profil</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Information d'etablissement</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email de l'etablissement :</label>
                                        <input type="email" value="{{old('emailE')}}" class="form-control @error('emailE') form-control-danger @enderror" name="emailE" id="emailE" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Raison social :</label>
                                        <input type="text" value="{{old('Rs')}}" class="form-control @error('Rs') form-control-danger @enderror" name="Rs" id="Rs" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ville :</label>
                                        <input type="text" value="{{old('ville')}}" class="form-control @error('ville') form-control-danger @enderror" name="ville" id="ville" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adress :</label>
                                        <input type="text" value="{{old('adress')}}" class="form-control @error('adress') form-control-danger @enderror" name="adress" id="adress" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Boite postal :</label>
                                        <input type="text" value="{{old('Bp')}}" class="form-control @error('Bp') form-control-danger @enderror" name="Bp" id="Bp" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telephone :</label>
                                        <input type="text" value="{{old('phone')}}" class="form-control  @error('phone') form-control-danger @enderror" name="phone" id="phone" required />
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 4 -->
                        <h5>Remark</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="type" required>
                                            <option value="1">Primaire</option>
                                            <option value="2">Secondaire</option>
                                            <option value="3">Supperieur</option>
                                            <option value="4">Online School</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo" required />
                                            <label class="custom-file-label">Choisir un logo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti aperiam reiciendis nisi harum eveniet, quisquam aliquid natus voluptate magnam vel, molestiae quidem! Impedit, provident quidem voluptatem accusamus molestiae laudantium magnam!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
            <!-- success Popup html Start -->
            <div
                class="modal fade"
                id="success-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20">Form Submitted!</h3>
                            <div class="mb-30 text-center">
                                <img src="vendors/images/success.png" />
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                            do eiusmod
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-dismiss="modal">
                                Done
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- success Popup html End -->
        </div>
    </div>
    <!-- welcome modal start -->
    <!-- welcome modal end -->
    <!-- js -->
    <script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{asset('assets/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/steps-setting.js')}}"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
            height="0"
            width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
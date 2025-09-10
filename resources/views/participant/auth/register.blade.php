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

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <!-- <img src="{{ asset('assets/identifies/' . $Identify->logo) }}" alt="Logo" width="200px" class="py-3" /> -->
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <h3 class="h3 text-primary">
                        <em>
                            << Votre compétence est notre satisfaction.>>
                        </em>
                    </h3>
                    <img src="{{asset('assets/src/images/regis.png')}}" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="register-box bg-white box-shadow border-radius-10">
                        <div class="wizard-content">
                            <form action="{{route('register.participant')}}" method="post" id="RegisterParticipant" class="tab-wizard wizard-circle wizard">
                                @csrf
                                <h5>User infromation</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email Address<strong class="text-danger">*</strong> </label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" required />
                                                <input type="hidden" value="{{$Identify->randomUser}}" name="randomUser">
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("email")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Telephone <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" value="{{old('telephone')}}" id="telephone" name="telephone" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("telephone")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password" id="password" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("password")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Confirm Password <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required />
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 2 -->
                                <h5>Personal Information</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nom <strong class="text-danger"> * </strong> </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{old('nom')}}" id="nom" name="nom" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("nom")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Prenom <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{old('prenom')}}" id="prenom" name="prenom" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("prenom")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label">Genre <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <div class="custom-control custom-radio custom-control-inline pb-0">
                                                    <input type="radio" id="male" name="gender"
                                                        class="custom-control-input" value="F" />
                                                    <label class="custom-control-label" for="male">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline pb-0">
                                                    <input type="radio" id="female" name="gender" value="M"
                                                        class="custom-control-input" />
                                                    <label class="custom-control-label" for="female">Female</label>
                                                </div>
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("gender")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Date de naissance <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" value="{{old('naissance')}}" id="naissance" name="naissance" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("naissance")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Ages <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{old('age')}}" name="age" id="age" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("age")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 3 -->
                                <!-- <h5>Payment Method & Info</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Credit Card Type</label>
                                            <div class="col-sm-8">
                                                <select class="form-control selectpicker" title="Select Card Type">
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label">Credit Card Number</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">CVC</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Expiration Date</label>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-control selectpicker" title="Month"
                                                            data-size="5">
                                                            <option value="01">January</option>
                                                            <option value="02">February</option>
                                                            <option value="03">March</option>
                                                            <option value="04">April</option>
                                                            <option value="05">May</option>
                                                            <option value="06">June</option>
                                                            <option value="07">July</option>
                                                            <option value="08">August</option>
                                                            <option value="09">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-control selectpicker" title="Year"
                                                            data-size="5">
                                                            <option>2020</option>
                                                            <option>2019</option>
                                                            <option>2018</option>
                                                            <option>2017</option>
                                                            <option>2016</option>
                                                            <option>2015</option>
                                                            <option>2014</option>
                                                            <option>2013</option>
                                                            <option>2012</option>
                                                            <option>2011</option>
                                                            <option>2010</option>
                                                            <option>2009</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section> -->
                                <!-- Step 4 -->
                                <h5>Demande D'admission</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Formation <strong class="text-danger"> * </strong></label>
                                            <div class="col-sm-8">
                                                <select class="form-control selectpicker" name="formation" id="formation" title="Choisir une Formation">
                                                    @foreach ($formations as $formation)
                                                    <option value="{{$formation->id}}">{{$formation->nom}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-control-feedback text-danger">
                                                    @error("formation")
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Pays d'origine <strong class="text-danger"> * </strong> </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{old('Pays')}}" id="Pays" name="Pays" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("Pays")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Secteur d'activité <strong class="text-danger"> * </strong> </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{old('activite')}}" id="activite" name="activite" required />
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("activite")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label">Courriel</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control note" name="courriel" id="courriel" placeholder="Rediger votre message d'admission" required></textarea>
                                            </div>
                                            <div class="form-control-feedback text-danger">
                                                @error("courriel")
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html Start -->
    <!-- <button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success">Click me</button> -->
    <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal"
        data-backdrop="static">
        Launch modal
    </button>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Formulaire Envoyer</h3>
                    <div class="mb-30 text-center">
                        <img src="{{asset('assets/vendors/images/success.png')}}" />
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                    eiusmod
                    <div class="err"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <!-- <a href="login.html" class="btn btn-primary">Done</a> -->
                    <button class="btn btn-primary" id="">
                        <div class="spinner-border text-light load-btn"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <a href="" class="load-txt d-none">Terminer</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->

    <script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{asset('assets/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/vendors/scripts/steps-setting.js')}}"></script>
    <!-- <script src="{{asset('assets/module/main.js')}}"></script> -->


    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
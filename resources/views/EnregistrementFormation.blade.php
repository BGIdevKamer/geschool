<!DOCTYPE html>
<html>
        @include('header')
        
		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
                <!-- <div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Enregistrement Etudians</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="{{route('dashboard')}}">Accueil</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Enregistrement
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div> -->
                <div class="p-3 card-box mb-30">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Enregistrement Formation</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="{{route('dashboard')}}">Accueil</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Enregistrement
									</li>
								</ol>
							</nav>
						</div>
					</div>        
                </div>

                <div class="pd-20 card-box mb-30">
				<div class="errors_calss"></div>
                <form action="" id="FormationForm">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Nom de la formations</label>
                            <input type="text" class="form-control name" name="nom" id="nom">
                        </div>
                    </div>
	              </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Durée de la formation</label>
								<input class="duree" id="duree" type="text" value="" name="duree" />
							</div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
								<label>Prix de la formation</label>
								<input class="prix" id="prix" type="text" value="" name="prix" />
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Niveau scolaire require</label>
                                <input  type="text" class="form-control prerequit" name="prerequit" id="prerequit">
                            </div>
                        </div>
                    </div>
                    <div class="">
                    <div class="form-group">
						<label>Note</label>
							<textarea class="form-control note" name="note" id="note"></textarea>
						</div>
                    </div>
                    <button class="btn btn-primary" id="Envoyer">
                        <div class="spinner-border text-light save-load-btn-ma d-none" style="width: 1rem; height: 1rem;" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                        <span class="save-bu-ma">Enregister</span>
                    </button>
                </form>
                </div>
			</div>
		</div>


		<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success">Click me</button>

		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe
				class="w-100 border-0"
				src="https://embed.lottiefiles.com/animation/31548"
			></iframe>
			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					Open source
					<span role="img" aria-label="gratitude">❤️</span>
				</h3>
				<div class="pb-2">
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-star"
						data-size="large"
						data-show-count="true"
						aria-label="Star dropways/deskapp dashboard on GitHub"
						>Star</a
					>
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp/fork"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-repo-forked"
						data-size="large"
						data-show-count="true"
						aria-label="Fork dropways/deskapp dashboard on GitHub"
						>Fork</a
					>
				</div>
			</div>
			<div class="text-center mb-1">
				<div>
					<a
						href="https://github.com/dropways/deskapp"
						target="_blank"
						class="btn btn-light btn-block btn-sm"
					>
						<span class="text-danger weight-600">STAR US</span>
						<span class="weight-600">ON GITHUB</span>
						<i class="fa fa-github"></i>
					</a>
				</div>
				<script
					async
					defer="defer"
					src="https://buttons.github.io/buttons.js"
				></script>
			</div>
			<a
				href="https://github.com/dropways/deskapp"
				target="_blank"
				class="btn btn-success btn-sm mb-0 mb-md-3 w-100"
			>
				DOWNLOAD
				<i class="fa fa-download"></i>
			</a>
			<p class="font-14 text-center mb-1 d-none d-md-block">
				Available in the following technologies:
			</p>
			<div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
				<i class="fa fa-html5"></i>
			</div>
		</div>
		<button class="welcome-modal-btn">
			<i class="fa fa-download"></i> Download
		</button>
		<!-- welcome modal end -->
		<!-- js -->
		<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
		<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
		<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
		<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
		<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
        <script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

		<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
		<!-- bootstrap-tagsinput js -->
		<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
		<!-- bootstrap-touchspin js -->
		<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
        <script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

		<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
		<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
	@include('main')
</html>

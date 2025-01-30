€
<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
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
				<form action="{{route('add.formation')}}" id="FormationForm" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-12 col-sm-12 mb-3">
							<label>Miniature de la formations</label>
							<div class="custom-file has-warning">
								<input type="file" class="custom-file-input" name="miniature" id="miniature" />
								<label class="custom-file-label">Choisir une image</label>
								<div class="err-miniature"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Nom de la formations</label>
								<input type="text" class="form-control name" name="nom" id="nom" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Durée de la formation</label>
								<input class="duree" id="duree" type="text" value="" name="duree" required />
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Prix de la formation</label>
								<input class="prix" id="prix" type="text" value="" name="prix" required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<label for="">La formation est en ligne ?</label>
							<div class="form-group">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input"
										value="1" required />
									<label class="custom-control-label" for="customRadio1">Oui</label>
								</div>
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="customRadio2" name="customRadio" name="customRadio" value="0"
										class="custom-control-input" required />
									<label class="custom-control-label" for="customRadio2">Nom</label>
								</div>
								<div class="errsex  has-warning"></div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Niveau scolaire require</label>
								<input type="text" class="form-control prerequit" name="prerequit" id="prerequit">
							</div>
						</div>
					</div>
					<div class="">
						<div class="form-group">
							<label>Note</label>
							<textarea class="form-control note" name="note" id="note"></textarea>
						</div>
					</div>
					<div class="err"></div>
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>Inscription</label>
								<input type="text" class="form-control" name="tranche_1" id="tranche_1" required>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>1er tranche</label>
								<input type="text" class="form-control" name="tranche_2" id="tranche_2" required>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>2em tranche</label>
								<input type="text" class="form-control" name="tranche_3" id="tranche_3">
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>3em tranche</label>
								<input type="text" class="form-control" name="tranche_4" id="tranche_4">
							</div>
						</div>
					</div>
					<button class="btn btn-primary" id="Envoyer">
						<div class="spinner-border text-light save-load-btn-ma d-none"
							style="width: 1rem; height: 1rem;" role="status">
							<span class="sr-only">Loading...</span>
						</div>
						<span class="save-bu-ma">Enregister</span>
					</button>
				</form>
			</div>
		</div>
	</div>

	<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>

	<!-- welcome modal start -->
	<!-- welcome modal end -->
	<script>
		const route = "{{route('add.formation')}}";
	</script>
	<!-- js -->
	<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('assets/module/main.js')}}"></script>
	<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
	<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
	<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

	<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
	<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

	<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
	<!-- bootstrap-touchspin js -->
	<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
	<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>




	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
			style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	</body>


</html>
<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-100px">
			<div class="page-header">
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
		</div>

		<div class="p-3 card-box mb-30">
			<form action="" id="FormaddParticipant">
				<div class="errors_participant"></div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label for="">Nom</label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" name="nomEtudiant" id="nomEtudiant">
							<div class="errname"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Prenom</label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" name="prenomEtudiant" id="prenomEtudiant">
							<div class="errprenom"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 ">
						<label>Telephone</label>
						<div class="form-group has-warning">
							<input type="number" class="form-control" name="telephoneEtudiant" id="telephoneEtudiant">
							<div class="errtel"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<label>email</label>
						<div class="form-group has-warning">
							<input type="email" class="form-control" name="emailEtudiant" id="emailEtudiant">
							<div class="erremail"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<label>Date de naissance</label>
						<div class="form-group has-warning">
							<input class="form-control" placeholder="Choisir une date" type="date" name="datenEtudiant" id="datenEtudiant" />
							<div class="errdate"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label for="">Choisir le sexe</label>
						<div class="form-group">
							<div class="custom-control custom-radio mb-5">
								<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input"
									value="H" />
								<label class="custom-control-label" for="customRadio1">Homme</label>
							</div>
							<div class="custom-control custom-radio mb-5">
								<input type="radio" id="customRadio2" name="customRadio" name="customRadio" value="F"
									class="custom-control-input" />
								<label class="custom-control-label" for="customRadio2">Femme</label>
							</div>
							<div class="errsex  has-warning"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Ages</label>
						<div class="form-group has-warning">
							<input type="number" class="form-control" name="ageEtudiant" id="ageEtudiant">
							<div class="errage"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label>Numero de Cni</label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" id="cniEtudiant" name="cniEtudiant">
							<div class="errcni"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Niveau scolaire</label>
							<div class="form-group has-warning">
								<select class="custom-select2 form-control" name="state" id="niveauEtudiant"
									style="width: 100%; height: 38px">
									<option value="Bac">Bac</option>
									<option value="Bac+1">Bac +1</option>
									<option value="Bac+2">Bac +2</option>
									<option value="Bac+3">Bac +3</option>
									<option value="Bac+4">Bac +4</option>
									<option value="Bac+5">Bac +5</option>
									<option value="Autres">Autres</option>
								</select>
								<div class="errniveau"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label>Formation/Speciliter</label>
							<div class="form-group has-warning">
								<select class="custom-select2 form-control" name="state" id="formation"
									style="width: 100%; height: 38px">
									<option value="">Choisir une formation</option>
									@foreach ($Formations as $formation)
									<option value="{{$formation->id}}">{{$formation->nom}}</option>
									@endforeach
								</select>
								<div class="errniformation"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Année scolaire</label>
							<div class="form-group has-warning">
								<select class="custom-select2 form-control" name="state"
									id="anneescolaire"
									style="width: 100%; height: 38px">
									<option value="">Choisir une année scolaire</option>
									<option value="2024-2025">2024-2025</option>
									<option value="2025-2026">2025-2026</option>
									<option value="2026-2027">2026-2027</option>
									<option value="2027-2028">2027-2028</option>
									<option value="2028-2029">2028-2029</option>
									<option value="2029-2030">2029-2030</option>
									<option value="2030-2031">2030-2031</option>
									<option value="2031-2032">2031-2032</option>
									<option value="2032-2033">2032-2033</option>
								</select>
								<div class="erranneescolaire"></div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<h3 class="text-primary p-3">Premier payements</h3>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<label>Montant</label>
						<div class="form-group has-warning">
							<input type="number" class="form-control" id="montant">
							<div class="errmontant"></div>
						</div>
					</div>
				</div>
				<button class="btn btn-primary" id="addParticipantbtn">
					<div class="spinner-border text-light load-btn-addparticipant d-none"
						style="width: 1rem; height: 1rem;" role="status">
						<span class="sr-only">Loading...</span>
					</div>
					<span class="load-txt-addparticipant">Enregister</span>
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
	<iframe class="w-100 border-0" src="https://embed.lottiefiles.com/animation/31548"></iframe>
	<div class="text-center">
		<h3 class="h5 weight-500 text-center mb-2">
			Open source
			<span role="img" aria-label="gratitude">❤️</span>
		</h3>
		<div class="pb-2">
			<a class="github-button" href="https://github.com/dropways/deskapp"
				data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star"
				data-size="large" data-show-count="true" aria-label="Star dropways/deskapp dashboard on GitHub">Star</a>
			<a class="github-button" href="https://github.com/dropways/deskapp/fork"
				data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-repo-forked"
				data-size="large" data-show-count="true" aria-label="Fork dropways/deskapp dashboard on GitHub">Fork</a>
		</div>
	</div>
	<div class="text-center mb-1">
		<div>
			<a href="https://github.com/dropways/deskapp" target="_blank" class="btn btn-light btn-block btn-sm">
				<span class="text-danger weight-600">STAR US</span>
				<span class="weight-600">ON GITHUB</span>
				<i class="fa fa-github"></i>
			</a>
		</div>
		<script async defer="defer" src="https://buttons.github.io/buttons.js"></script>
	</div>
	<a href="https://github.com/dropways/deskapp" target="_blank" class="btn btn-success btn-sm mb-0 mb-md-3 w-100">
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
<script src="{{asset('assets/module/main.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>


<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
		style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>
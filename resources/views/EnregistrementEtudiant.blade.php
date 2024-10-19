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
						<label for="">Nom <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" name="nomEtudiant" id="nomEtudiant">
							<div class="errname"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Prenom <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" name="prenomEtudiant" id="prenomEtudiant">
							<div class="errprenom"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 ">
						<label>Telephone <small class="text-danger">*</small> </label>
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
						<label>Date de naissance <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input class="form-control" placeholder="Choisir une date" type="date" name="datenEtudiant" id="datenEtudiant" />
							<div class="errdate"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label for="">Choisir le sexe <small class="text-danger">*</small></label>
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
						<label>Ages <small class="text-danger">*</small> </label>
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
							<div class="form-group has-warning ">
								<select class="custom-select2 form-control" name="state" id="niveauEtudiant"
									style="width: 100%; height: 38px">
									<option value="">Selectionner</option>
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
							<label>Formation/Speciliter <small class="text-danger">*</small> </label>
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
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Niveau</label>
							<select class="selectpicker form-control" data-style="btn-outline-primary"
								data-size="5" name="niv" id="niv">
								<option value="">Choisir le niveau</option>
								<option value="1">Niveau I</option>
								<option value="2">Niveau II</option>
								<option value="3">Niveau III</option>
								<option value="4">Niveau IV</option>
								<option value="5">Niveau VI</option>
							</select>
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

<!-- Success modal -->
<a
	href="#"
	class="btn-block"
	data-toggle="modal"
	data-target="#success-modal"
	type="button"
	class="d-none"
	id="modal-success">
</a>

<div
	class="modal fade"
	id="success-modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div
		class="modal-dialog modal-dialog-centered"
		role="document">
		<div class="modal-content">
			<div class="modal-body text-center font-18">
				<h3 class="mb-20">Succes</h3>
				<div class="mb-30 text-center">
					<img src="{{asset('assets/vendors/images/success.png')}}" />
				</div>
				Lorem ipsum dolor sit amet, consectetur adipisicing
				elit, sed do eiusmod
			</div>
			<div class="modal-footer justify-content-center">
				<button
					type="button"
					class="btn btn-primary">
					Payements
				</button>
				<button
					type="button"
					class="btn btn-secondary"
					data-dismiss="modal">
					Fermer
				</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!-- Confirmation modal -->
<!-- welcome modal start -->

<!-- welcome modal end -->
<script>
	const route = "{{route('add.participant')}}";
</script>
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
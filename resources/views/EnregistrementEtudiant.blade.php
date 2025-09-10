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
							<h4>Enregistrement @if(Session::get('type') == "1" OR Session::get('type') == "2") Elèves @else Etudiants @endif</h4>
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
			@if($errors->any())
			@foreach($errors->all() as $error)
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				{{$error}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="sa-err-close"><span aria-hidden="true">&times;</span></button>
			</div>
			@endforeach
			@endif
		</div>

		<div class="p-3 card-box mb-30">
			<form action="{{route('add.participant')}}" method="post" id="form-charge">
				@csrf
				<div class="errors_participant"></div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label for="">Nom <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" name="nom" id="nomEtudiant" required>
							<div class="errname"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Prenom <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" name="prenom" id="prenomEtudiant" required>
							<div class="errprenom"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 ">
						<label>Telephone <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input type="number" class="form-control" name="telephone" id="telephoneEtudiant" required>
							<div class="errtel"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Email</label>
						<div class="form-group has-warning">
							<input type="email" class="form-control" name="email" id="emailEtudiant" required>
							<div class="erremail"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<label>Date de naissance <small class="text-danger">*</small> </label>
						<div class="form-group has-warning">
							<input class="form-control" placeholder="Choisir une date" type="date" name="dateN" id="datenEtudiant" required />
							<div class="errdate"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label for="">Choisir le sexe <small class="text-danger">*</small></label>
						<div class="form-group">
							<div class="custom-control custom-radio mb-5">
								<input type="radio" id="customRadio1" name="sexe" class="custom-control-input"
									value="H" required />
								<label class="custom-control-label" for="customRadio1">Homme</label>
							</div>
							<div class="custom-control custom-radio mb-5">
								<input type="radio" id="customRadio2" name="sexe" value="F"
									class="custom-control-input" required />
								<label class="custom-control-label" for="customRadio2">Femme</label>
							</div>
							<div class="errsex  has-warning"></div>
						</div>
					</div>
					@if(Session::get('type') == "4")
					<div class="col-md-6 col-sm-12">
						<label>Age</label>
						<div class="form-group has-warning ">
							<select class="custom-select2 form-control" name="age" id="ageEtudiant"
								style="width: 100%; height: 38px" required>
								<option value="">Sélectionner</option>
								<option value="18-23">18-23</option>
								<option value="24-29">24-29</option>
								<option value="30-35">30-35</option>
								<option value="35-40">35-40</option>
								<option value="40+">40+</option>
							</select>
							<div class="errniveau"></div>
						</div>
					</div>
					@else
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Age</label>
							<div class="form-group has-warning">
								<input type="text" class="form-control" name="age" id="ageEtudiant" required>
								<div class="errcni"></div>
							</div>
						</div>
					</div>
					@endif
				</div>

				<div class="row">
					<!-- <div class="col-md-6 col-sm-12">
						<label>Numero de Cni</label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" id="cniEtudiant" name="cni">
							<div class="errcni"></div>
						</div>
					</div> -->
					@if(Session::get('type') != "1" AND Session::get('type') != "2")
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Diplôme le plus élevé</label>
							<div class="form-group has-warning ">
								<select class="custom-select2 form-control" name="niveau" id="niveauEtudiant"
									style="width: 100%; height: 38px">
									<option value="">Selectionner</option>
									<option value="Bac">Licence / Bachelor's degree</option>
									<option value="Bac">Master / Master's degree</option>
									<option value="Bac">Doctorat / PhD </option>
									<option value="Bac">Autres</option>
								</select>
								<div class="errniveau"></div>
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label>@if(Session::get('type') == "4") Approches de la formation @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif<small class="text-danger">*</small> </label>
							<div class="form-group has-warning">
								<select class="custom-select2 form-control" name="formation" id="formation"
									style="width: 100%; height: 38px" required>
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
								<select class="custom-select2 form-control" name="anneescolaire"
									id="anneescolaire"
									style="width: 100%; height: 38px" required>
									<option value="">Choisir une année scolaire</option>
									@foreach($years as $year)
									<option value="{{$year->Years}}" @if($year->active == 1) selected @endif @if(count($years)==0) disabled @endif>{{$year->Years}}</option>
									@endforeach
								</select>
								@if(count($years) == 0)
								<p class="text-warnning mt-3"> Veiller Crée et activer les années scolaires <a href="{{route('General.index')}}" class="btn btn-primary"> Continuer </a></p>
								@endif
								<div class="erranneescolaire"></div>
							</div>
						</div>
					</div>
					@if(Session::get('type') == "3")
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
					@endif
				</div>
				@if(Session::get('type') == "4")
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label>Secteur d'activité</label>
						<div class="form-group has-warning">
							<input type="text" class="form-control" id="activite" name="activite">
							<div class="errcni"></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Pays d'origine</label>
							<div class="form-group has-warning">
								<input type="text" class="form-control" id="Pays" name="Pays">
								<div class="errcni"></div>
							</div>
						</div>
					</div>
				</div>
				@endif
				<button type="submit" class="btn btn-primary">
					<div class="spinner-border text-light load-btn-ex d-none" style="width: 1rem; height: 1rem;" role="status">
						<span class="sr-only">Loading...</span>
					</div>
					<span class="btn-txt-ex">Enregister</span>
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
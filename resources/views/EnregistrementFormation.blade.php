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
							<!-- <h4>Enregistrement @if(Session::get('type') == "4") de l'approche de formation @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif</h4> -->
							<h4>Enregistrement @if(Session::get('type') == "4") de la formation @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif</h4>
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
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="errors_calss"></div>
				<form action="{{route('add.formation')}}" id="" method="post" enctype="multipart/form-data">
					@csrf

					<div class="row">
						<div class="col-md-12 col-sm-12 mb-3">
							<label>Image</label>
							<div class="custom-file has-warning">
								<input type="file" class="custom-file-input" name="miniature" id="fileInput" />
								<label class="custom-file-label" id="nameFile">Choisir une image</label>
								<span id="errorMessage" style="color: red;"></span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label> @if(Session::get('type') == "4") Approches de la formation @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif </label>
								<input type="text" class="form-control name" name="nom" id="nom" required>
							</div>
						</div>
					</div>

					<div class="row">
						@if(Session::get('type') == "3")
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Durée</label>
								<input class="duree" id="duree" type="text" value="" name="duree" />
							</div>
						</div>
						@endif
						<div class="col-md-6 col-sm-12  @if(Session::get('type')=="4") d-none @endif required">
							<div class="form-group">
								<label>@if(Session::get('type') == "4")  @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Scolarité @else Prix de la formation @endif</label>
								<input class="prix" id="prix" type="text" name="prix" @if(Session::get('type')=="4" ) value="0" @endif required />
							</div>
						</div>
					</div>

					<div class="row d-none">
						<div class="col-md-6 col-sm-12">
							<label for="">La formation est en ligne ?</label>
							<div class="form-group">
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input"
										value="1" required @if(Session::get('type')=="4" ) checked @endif />
									<label class="custom-control-label" for="customRadio1">Oui</label>
								</div>
								<div class="custom-control custom-radio mb-5">
									<input type="radio" id="customRadio2" name="customRadio" name="customRadio" value="0"
										class="custom-control-input"  @if(Session::get('type')!="4") checked @endif required required />
									<label class="custom-control-label" for="customRadio2">Non</label>
								</div>
								<div class="errsex  has-warning"></div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Niveau de compréhension</label>
								<input type="text" class="form-control prerequit" name="prerequit" id="prerequit">
							</div>
						</div>
					</div>

					<div class="">
						<div class="form-group">
							<label>@if(Session::get('type') == "4") Présentation de l'approche de la formation @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Description @else Description de la formation @endif</label>
							<textarea class="form-control note" name="note" id="note"></textarea>
						</div>
					</div>
					<div class="err"></div>
					<div class="row  @if(Session::get('type')=="4" ) d-none @endif required">
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>Inscription</label>
								<input type="text" class="form-control" name="tranche_1" id="tranche_1" @if(Session::get('type')=="4" ) value="0" @endif required>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>1er tranche</label>
								<input type="text" class="form-control" name="tranche_2" id="tranche_2" @if(Session::get('type')=="4" ) value="0" @endif required>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>2em tranche</label>
								<input type="text" class="form-control" name="tranche_3" @if(Session::get('type')=="4" ) value="0" @endif id="tranche_3">
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label>3em tranche</label>
								<input type="text" class="form-control" name="tranche_4" @if(Session::get('type')=="4" ) value="0" @endif id="tranche_4">
							</div>
						</div>
					</div>
					<input type="submit" class="btn btn-primary" value="Envoyer">
				</form>
			</div>
		</div>
	</div>

	<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>

	<!-- welcome modal start -->
	<!-- welcome modal end -->


	<!-- js -->
	<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('assets/module/fileConfig.js')}}"></script>
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
<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="title">
							<h4>Profile</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="index.html">Accueil</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									Profile
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
					<div class="pd-20 card-box height-100-p">
						<div class="profile-photo">
							<img
								src="{{Storage::url(Auth::user()->logo)}}"
								alt=""
								class="avatar-photo" />
							<div
								class="modal fade"
								id="modal"
								tabindex="-1"
								role="dialog"
								aria-labelledby="modalLabel"
								aria-hidden="true">
							</div>
						</div>
						<h5 class="text-center h5 mb-0">{{Auth::user()->name}}</h5>
						<p class="text-center text-muted font-14">
							{{Auth::user()->random}}
						</p>
						<div class="profile-info">
							<h5 class="mb-20 h5 text-blue">Informations</h5>
							<ul>
								<li>
									<span>Email Address:</span>
									{{Auth::user()->email}}
								</li>
								<li>
									<span>Telephone:</span>
									{{Auth::user()->telephone}}
								</li>
								<li>
									<span>Ville:</span>
									{{Auth::user()->ville}}
								</li>
								<li>
									<span>Address:</span>
									{{Auth::user()->adress}}
								</li>
								<li>
									<span>Raison social:</span>
									{{Auth::user()->raisonSocial}}
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
					<div class="card-box height-100-p overflow-hidden">
						<div class="profile-tab height-100-p">
							<div class="tab height-100-p">
								<ul class="nav nav-tabs customtab" role="tablist">
									<li class="nav-item">
										<a
											class="nav-link active"
											data-toggle="tab"
											href="#timeline"
											role="tab">Modifier</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- Timeline Tab start -->
									<div class="profile-setting">
										<form action="{{ route('update.info') }}" method="POST" enctype="multipart/form-data">
											@csrf
											<ul class="profile-edit-list row">
												<li class="weight-500 col-md-6">
													<h4 class="text-blue h5 mb-20">
														Modification des informations
													</h4>
													<div class="form-group">
														<label>Nom d'ulisateur</label>
														<input
															class="form-control form-control-lg @error('name') form-control-danger @enderror"
															type="text"
															value="{{Auth::user()->name}} @if(empty(Auth::user()->name)){{old('name')}} @endif"
															name="name"
															id="name" />
													</div>
													<div class="form-control-feedback text-danger">
														@error("name")
														{{ $message }}
														@enderror
													</div>
													<div class="form-group">
														<label>Raison social</label>
														<input
															class="form-control form-control-lg @error('rs') form-control-danger @enderror"
															type="text"
															value="{{Auth::user()->raisonSocial}} @if(empty(Auth::user()->raisonSocial)){{old('rs')}} @endif"
															name="rs"
															id="rs" />
													</div>
													<div class="form-control-feedback text-danger">
														@error("rs")
														{{ $message }}
														@enderror
													</div>
													<div class="form-group">
														<label>Email</label>
														<input
															class="form-control form-control-lg @error('email') form-control-danger @enderror"
															type="email"
															value="{{Auth::user()->email}} @if(empty(Auth::user()->email)){{old('email')}} @endif "
															name="email"
															id="email" />
													</div>
													<div class="form-control-feedback text-danger">
														@error("email")
														{{ $message }}
														@enderror
													</div>
													<div class="form-group">
														<label>Ville</label>
														<input
															class="form-control form-control-lg @error('ville') form-control-danger @enderror"
															type="text"
															value="{{Auth::user()->ville}} @if(empty(Auth::user()->ville)){{old('ville')}} @endif "
															name="ville"
															id="ville" />
													</div>
													<div class="form-control-feedback text-danger">
														@error("ville")
														{{ $message }}
														@enderror
													</div>
												</li>
												<li class="weight-500 col-md-6">
													<h4 class="text-blue h5 mb-20">
														utilisateur
													</h4>
													<div class="form-group">
														<label>Numero de telephone</label>
														<input
															class="form-control form-control-lg @error('numero') form-control-danger @enderror"
															type="text"
															value="{{Auth::user()->telephone}} @if(empty(Auth::user()->telephone)){{old('numero')}} @endif"
															name="numero"
															id="numero" />
													</div>
													<div class="form-control-feedback text-danger">
														@error("numero")
														{{ $message }}
														@enderror
													</div>
													<div class="form-group">
														<label>Adress</label>
														<input
															class="form-control form-control-lg @error('adress') form-control-danger @enderror"
															type="text"
															value="{{Auth::user()->adress}} @if(empty(Auth::user()->adress)){{old('adress')}} @endif"
															name="adress" />
													</div>
													<div class="form-control-feedback text-danger">
														@error("numero")
														{{ $message }}
														@enderror
													</div>
													<div class="form-group">
														<label>Logo</label>
														<div class="custom-file">
															<input type="file" class="custom-file-input" name="logo" />
															<label class="custom-file-label">Choose file</label>
														</div>
													</div>
													<div class="form-control-feedback text-danger">
														@error("logo")
														{{ $message }}
														@enderror
													</div>
													<div class="form-group mb-0">
														<input
															type="submit"
															class="btn btn-primary"
															value="Enregistrer les modifications" />
													</div>
												</li>
											</ul>
										</form>
									</div>
								</div>
								<!-- Timeline Tab End -->
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
<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
		src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
		height="0"
		width="0"
		style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
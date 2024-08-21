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
										class="avatar-photo"
									/>
									<div
										class="modal fade"
										id="modal"
										tabindex="-1"
										role="dialog"
										aria-labelledby="modalLabel"
										aria-hidden="true"
									>
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
													role="tab"
													>Modifier</a
												>
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
                                                                        value="{{Auth::user()->name}}"
                                                                        name="name"
                                                                        id="name"
																	/>
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
                                                                        value="{{Auth::user()->raisonSocial}}"
                                                                        name="rs"
                                                                        id="rs"
																	/>
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
                                                                        value="{{Auth::user()->email}}"
                                                                        name="email"
                                                                        id="email"
																	/>
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
                                                                        value="{{Auth::user()->ville}}"
                                                                        name="ville"
                                                                        id="ville"
																	/>
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
																		value="{{Auth::user()->telephone}}"
                                                                        name="numero"
                                                                        id="numero"
																	/>
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
																		value="{{Auth::user()->adress}}"
                                                                        name="adress"
																	/>
																</div>
                                                                <div class="form-control-feedback text-danger">
                                                                @error("numero")
                                                                {{ $message }}
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
																	<label>Logo</label>
																	<div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="logo"/>
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
																		value="Enregistrer les modifications"
																	/>
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
		<!-- Google Tag Manager (noscript) -->
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
</html>

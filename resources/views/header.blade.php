<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{Auth::user()->name}} : Gestion de centre</title>

	<!-- Site favicon -->
	<link
		rel="apple-touch-icon"
		sizes="180x180"
		href="{{asset('assets/vendors/images/apple-touch-icon.png')}}" />
	<link
		rel="icon"
		type="image/png"
		sizes="32x32"
		href="{{asset('assets/vendors/images/favicon-32x32.png')}}" />
	<link
		rel="icon"
		type="image/png"
		sizes="16x16"
		href="{{asset('assets/vendors/images/favicon-16x16.png')}}" />

	<!-- Mobile Specific Metas -->
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/core.css')}}" />
	<link
		rel="stylesheet"
		type="text/css"
		href="{{asset('assets/vendors/styles/icon-font.min.css')}}" />
	<link
		rel="stylesheet"
		type="text/css"
		href="{{asset('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}" />
	<link
		rel="stylesheet"
		type="text/css"
		href="{{asset('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/style.css')}}" />

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script
		async
		src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
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


	<div class="header">
		<div class="header-left">
			<div class="menu-icon bi bi-list"></div>
			<div
				class="search-toggle-icon bi bi-search"
				data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input
							type="text"
							class="form-control search-input"
							placeholder="Search Here" />
						<div class="dropdown">
							<a
								class="dropdown-toggle no-arrow"
								href="#"
								role="button"
								data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input
											class="form-control form-control-sm form-control-line"
											type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input
											class="form-control form-control-sm form-control-line"
											type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input
											class="form-control form-control-sm form-control-line"
											type="text" />
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a
						class="dropdown-toggle no-arrow"
						href="javascript:;"
						data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-notification">
				<div class="dropdown">
					<a
						class="dropdown-toggle no-arrow"
						href="#"
						role="button"
						data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a
						class="dropdown-toggle"
						href="#"
						role="button"
						data-toggle="dropdown">
						<span class="user-icon">
							<img src="{{Storage::url(Auth::user()->logo)}}" />
						</span>
						<span class="user-name">{{Auth::user()->name}}</span>
					</a>
					<div
						class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="/profil"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<form action="{{ route('logout') }}" method="POST">
							@csrf
							<a class="dropdown-item" href="route('logout')"
								onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="dw dw-logout"></i> Log Out</a>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a
						href="javascript:void(0);"
						class="btn btn-outline-primary header-white active">White</a>
					<a
						href="javascript:void(0);"
						class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a
						href="javascript:void(0);"
						class="btn btn-outline-primary sidebar-light">White</a>
					<a
						href="javascript:void(0);"
						class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebaricon-1"
							name="menu-dropdown-icon"
							class="custom-control-input"
							value="icon-style-1"
							checked="" />
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebaricon-2"
							name="menu-dropdown-icon"
							class="custom-control-input"
							value="icon-style-2" />
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebaricon-3"
							name="menu-dropdown-icon"
							class="custom-control-input"
							value="icon-style-3" />
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebariconlist-1"
							name="menu-list-icon"
							class="custom-control-input"
							value="icon-list-style-1"
							checked="" />
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebariconlist-2"
							name="menu-list-icon"
							class="custom-control-input"
							value="icon-list-style-2" />
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebariconlist-3"
							name="menu-list-icon"
							class="custom-control-input"
							value="icon-list-style-3" />
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebariconlist-4"
							name="menu-list-icon"
							class="custom-control-input"
							value="icon-list-style-4"
							checked="" />
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebariconlist-5"
							name="menu-list-icon"
							class="custom-control-input"
							value="icon-list-style-5" />
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input
							type="radio"
							id="sidebariconlist-6"
							name="menu-list-icon"
							class="custom-control-input"
							value="icon-list-style-6" />
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">
						Reset Settings
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="" alt="" class="dark-logo" />
				<img
					src="vendors/images/deskapp-logo-white.svg"
					alt=""
					class="light-logo" />
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					@if(Session::get('type') == "4")
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">Ressources</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="{{route('cour.index')}}">Cours</a>
							</li>
							<li><a href="{{route('Exercice')}}">Exercices</a></li>
							<li><a href="{{route('Module.index')}}">Module</a></li>
							<li><a href="{{route('Evaluations.Exercices')}}">Evaluation</a></li>
							<li><a href="{{route('note.Resources')}}">Notes</a></li>
						</ul>
					</li> -->
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">Participants</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="{{route('Enregistrement.Etudiant')}}">Enregistrements</a>
							</li>
							<li><a href="{{route('liste.particiapants')}}">Liste</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<!-- <span class="micon bi bi-textarea-resize"></span><span class="mtext">Statistique</span> -->
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">Formation</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="{{route('Enregistrement.Formation')}}">Enregistrement</a>
							</li>
							<!-- <li><a href="{{route('liste.Formation')}}">Approches de Formation</a></li> -->
							<li><a href="{{route('liste.Formation')}}">Liste</a></li>
						</ul>
					</li>
					<li>
						<a href="{{route('Module.index')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Modules</span>
						</a>
					</li>
					<li>
						<a href="{{route('cour.index')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Cours</span>
						</a>
					</li>
					<li>
						<a href="{{route('Exercice')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Exercices</span>
						</a>
					</li>
					<li>
						<a href="{{route('Evaluations.Exercices')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Evaluation final</span>
						</a>
					</li>
					<li>
						<a href="{{route('Demande.Admission')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Admision</span>
						</a>
					</li>
					@else
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-house"></span><span class="mtext">Accueil</span>
						</a>
						<ul class="submenu">
							<li><a href="{{route('dashboard')}}">Tableau de bord</a></li>
						</ul>
					</li>
					@if(Auth::user()->role == 'Scolarite' OR Auth::user()->role == 'Admin')
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">@if(Session::get('type') == "1" OR Session::get('type') == "2") Elèves @else Etudiants @endif</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="{{route('Enregistrement.Etudiant')}}">Enregistrements</a>
							</li>
							<li><a href="{{route('liste.particiapants')}}">Liste</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">@if(Session::get('type') == "4") De l'approche de formation @elseif(Session::get('type') == "1" OR Session::get('type') == "2") Classe @else Formation @endif</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="{{route('Enregistrement.Formation')}}">Enregistrement</a>
							</li>
							<li><a href="{{route('liste.Formation')}}">Liste</a></li>
						</ul>
					</li>
					@endif
					@if(Auth::user()->role == 'Secretariat' OR Auth::user()->role == 'Admin')
					<li>
						<a href="{{route('Payement.index')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-archive"></span><span class="mtext">Nouveau Payements</span>
						</a>
					</li>
					@endif
					@if(Auth::user()->role == 'Scolarite' OR Auth::user()->role == 'Admin')
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-table"></span><span class="mtext">Evaluations</span>
						</a>
						<ul class="submenu">
							<li><a href="{{route('index.composition')}}">Enregistrements</a></li>
							<li><a href="{{route('index.Evaluation')}}">Sessions</a></li>
							<li><a href="{{route('Bulletin.index')}}">Bulletin de note</a></li>
							<li><a href="{{route('Bulletin.Liste')}}">Bulletin generer</a></li>
						</ul>
					</li>
					@endif
					<li>
						<a href="{{route('matieres.index')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Matieres</span>
						</a>
					</li>
					<li>
						<a href="{{route('index.Enseigant')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Enseignants</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">Emploie de temps</span>
						</a>
						<ul class="submenu">
							<li>
								<a href="{{route('index.Emploie')}}">Enregistrement</a>
							</li>
							<li><a href="{{route('index.Salles')}}">Salles</a></li>
							<li><a href="{{route('heure.DeCour')}}">Heures de cour</a></li>
							<li><a href="">Hauraires d'enseigants</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-textarea-resize"></span><span class="mtext">Rappors</span>
						</a>
						<ul class="submenu">
							<li><a href="{{route('Payement.RapportIndex')}}">Payement</a></li>
							<li><a href="{{route('Etudient.RapportIndex')}}">@if(Session::get('type') == "1" OR Session::get('type') == "2") Elèves @else Etudiants @endif</a></li>
							<li><a href="{{route('Etudient.RapportIndex')}}">Enseigants</a></li>
						</ul>
					</li>

					@if(Auth::user()->role == 'Admin')
					<li>
						<a href="{{route('General.index')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Général</span>
						</a>
					</li>
					<li>
						<a href="{{route('index.Identite')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Identité</span>
						</a>
					</li>
					@endif
					@endif
					<!-- <li>
						<a href="{{route('courriel.liste')}}" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Courriel</span>
						</a>
					</li>
					<li>
						<a href="calendar.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Session de formation</span>
						</a>
					</li> -->
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>
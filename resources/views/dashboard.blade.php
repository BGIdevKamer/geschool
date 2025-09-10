<!DOCTYPE html>
<html>
@include('header')
<div class="pre-loader">
	<div class="pre-loader-box">
		<div class="loader-logo">
			<img src="{{Storage::url(Auth::user()->logo)}}" alt="" width="200px" />
		</div>
		<div class="loader-progress" id="progress_div">
			<div class="bar" id="bar1"></div>
		</div>
		<div class="percent" id="percent1">0%</div>
		<div class="loading-text">Loading...</div>
	</div>
</div>
<div class="main-container">
	<div class="xs-pd-20-10 pd-ltr-20">
		<div class="title pb-20">
			<h2 class="h3 mb-0">Vue D'ensemble De L'ecole</h2>
		</div>

		<div class="row pb-10">
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark">{{$formations}}</div>
							<div class="font-14 text-secondary weight-500">
								Classes
							</div>
						</div>
						<div class="widget-icon">
							<div class="icon" data-color="#00eccf">
								<i class="dw dw-mortarboard" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark">{{$Enseigants}}</div>
							<div class="font-14 text-secondary weight-500">
								Total Enseigants
							</div>
						</div>
						<div class="widget-icon">
							<div class="icon" data-color="#ff5b5b">
								<i class="dw dw-user-3" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark">{{$Participants}}+</div>
							<div class="font-14 text-secondary weight-500">
								Total Apprenants
							</div>
						</div>
						<div class="widget-icon">
							<div class="icon">
								<i class="dw dw-user" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark">{{$payements}} F</div>
							<div class="font-14 text-secondary weight-500">Caisse</div>
						</div>
						<div class="widget-icon">
							<div class="icon" data-color="#09cc06">
								<i class="dw dw-money" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row pb-10">
			<div class="col-md-8 mb-20">
				<div class="card-box height-100-p pd-20">
					<div
						class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
						<div class="h5 mb-md-0">Finance Activities</div>
						<div class="form-group mb-md-0">
							<div class="dropdown">
								<a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
									data-toggle="dropdown">
									{{date('Y-m-j')}}
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<button class="dropdown-item" type="button" id="year">Vue Annuel</button>
									<button class="dropdown-item" type="button" id="mont">Vue Mensuel</button>
								</div>
							</div>
						</div>
					</div>
					<div id="activities-chart"></div>
				</div>
			</div>
			<div class="col-md-4 mb-20">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between">
						<div class="h5 mb-0">Fille/Garçcon</div>
						<div class="dropdown">
							<a
								class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
								data-color="#1b3133"
								href="#"
								role="button"
								data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div
								class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
								<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
								<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
							</div>
						</div>
					</div>

					<div id="diseases-chart"></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6 mb-20">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between pb-10">
						<div class="h5 mb-0">Personnel</div>
					</div>
					<div class="user-list">
						<ul>
							@foreach($Personnelles as $Personnelle)
							<li class="d-flex align-items-center justify-content-between">
								<div class="name-avatar d-flex align-items-center pr-2">
									<div class="avatar mr-2 flex-shrink-0">
										<img
											src="{{Storage::url($Personnelle->logo)}}"
											class="border-radius-100 box-shadow"
											width="50"
											height="50"
											alt="" />
									</div>
									<div class="txt">
										<div class="font-14 weight-600">{{$Personnelle->name}}</div>
										<div class="font-12 weight-500" data-color="#b2b1b6">
											{{$Personnelle->email}}
										</div>
									</div>
								</div>
								<div class="cta flex-shrink-0">
									<a type="button" class="btn btn-sm btn-outline-primary">{{$Personnelle->role}}</a>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-20">
				<!-- <div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between">
						<div class="h5 mb-0">Diseases Report</div>
						<div class="dropdown">
							<a
								class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
								data-color="#1b3133"
								href="#"
								role="button"
								data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div
								class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
								<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
								<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
							</div>
						</div>
					</div>

					<div id="diseases-chart"></div>
				</div> -->
			</div>
			
		</div>
		<div class="title pb-20 pt-20">
			<h2 class="h3 mb-0">Quick Start</h2>
		</div>

		<div class="row">
			<div class="col-md-4 mb-20">
				<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
					<div class="img pb-30">
						<img src="vendors/images/medicine-bro.svg" alt="" />
					</div>
					<div class="content">
						<h3 class="h4">Services</h3>
						<p class="max-width-200">
							We provide superior health care in a compassionate maner
						</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 mb-20">
				<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
					<div class="img pb-30">
						<img src="vendors/images/remedy-amico.svg" alt="" />
					</div>
					<div class="content">
						<h3 class="h4">Medications</h3>
						<p class="max-width-200">
							Look for prescription and over-the-counter drug information.
						</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 mb-20">
				<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
					<div class="img pb-30">
						<img src="vendors/images/paper-map-cuate.svg" alt="" />
					</div>
					<div class="content">
						<h3 class="h4">Locations</h3>
						<p class="max-width-200">
							Convenient locations when and where you need them.
						</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- welcome modal start -->

<script>
	let data = @json($yearlyTotals);

	// Extraire les années et les montants
	let years = data.map(item => item.year); // Les années
	let amounts = data.map(item => item.total); // Les montants

	let getDataMont = @json($monthlyTotals);
	let getPercentage = @json($percentage); // Les données envoyées par PHP

	let percentageTable = getPercentage.map(item => item.percentage.toFixed(2)); // Arrondir les pourcentages à 2 décimales

	console.log(percentageTable);
</script>
<!-- welcome modal end -->
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/chartOption.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/dashboard3.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/chartOption3.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
		src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
		height="0"
		width="0"
		style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
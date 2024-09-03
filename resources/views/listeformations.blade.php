<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
	@if(session('success'))
	<div class="card-box mb-30">
		<div class="alert alert-success">
			{{session('success')}}
		</div>
	</div>
	@endif
	<!-- Simple Datatable start -->
	<div class="card-box mb-30">
		<div class="pd-20">
			<h4 class="text-blue h4">Liste des formations</h4>
			<p class="mb-0">
			</p>
		</div>
		<div class="pb-20">
			<table class="data-table table stripe hover nowrap load-liste">
				<thead>
					<tr>
						<th class="table-plus datatable-nosort">Libeller</th>
						<th>Durée</th>
						<th>Note</th>
						<th>prix</th>
						<th>En ligne</th>
						<th>Niveau requis</th>
						<th>Statut</th>
						<th class="datatable-nosort">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($formations as $Formation)
					<tr>
						<td class="table-plus">{{$Formation->nom}}</td>
						<td>{{$Formation->durée}}</td>
						<td>{{$Formation->note}}</td>
						<td>{{$Formation->prix}} Franc cfa</td>
						<td>@if($Formation->EnLigne == 0) Non @else Oui @endif</td>
						<td>{{$Formation->Niveau_requie}}</td>
						<td class="@if($Formation->statue == 0) text-danger @endif">@if($Formation->statue == 1) Actif
							@else Desactiver @endif</td>
						<td>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
									role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									<a class="dropdown-item @if($Formation->statue == 1) text-danger @else text-success @endif"
										href="{{route('Delete.Formation',['id'=>$Formation->id,'statut'=>$Formation->statue])}}"><i
											class="iicon-copy dw dw-shrink"></i>@if($Formation->statue == 1) Désactiver
										@else Activer @endif</a>
									<a class="dropdown-item " href="" href="#" class="btn-block" data-toggle="modal" id="ApplieUpdate"
										data-id="{{$Formation->id}}"
										data-nom="{{$Formation->nom}}"
										data-duree="{{$Formation->durée}}"
										data-note="{{$Formation->note}}"
										data-prix="{{$Formation->prix}}"
										data-Enligne="{{$Formation->EnLigne}}"
										data-niveau="{{$Formation->Niveau_requie}}"
										data-target="#bd-example-modal-lg" type="button"><i
											class="icon-copy dw dw-edit-2"></i>Modifier</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- Simple Datatable End -->

	<!-- modal -->

	<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
		aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">
						Modifications
					</h4>
					<button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">
						×
					</button>
				</div>
				<div class="modal-body">
					<div class="errors_class"></div>
					<form action="" id="FormUpFormation">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Nom de la formation <span class="text-danger">*</span> </label>
									<input type="text" class="form-control" name="nom" id="nom">
									<input type="text" class="form-control d-none" name="id" id="id">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Durée de la formation <span class="text-danger">*</span> </label>
									<input type="text" class="form-control" name="duree" id="duree">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Note</label>
									<input type="text" class="form-control" name="note" id="note">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Prix de la formation <span class="text-danger">*</span></label>
									<input class="prix" id="prix" type="text" value="" name="prix" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Niveau requie <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="niveau" name="niveau">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<div class="form-group">
										<label>En ligne ?</label>
										<select
											class="custom-select2 form-control"
											name="state"
											id="enligne"
											style="width: 100%; height: 38px">
											<option value="2">Conserver valeur initial</option>
											<option value="0">Non</option>
											<option value="1">Oui</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Fermer
					</button>
					<button type="button" class="btn btn-primary" id="FormationUpdate">
						<div class="spinner-border text-light load-btn d-none" style="width: 1rem; height: 1rem;" role="status">
							<span class="sr-only">Loading...</span>
						</div>
						<span class="btn-txt">Enregister</span>
					</button>
				</div>
			</div>
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
<script src="{{asset ('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset ('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset ('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset ('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
<script src="{{asset ('assets/src/plugins/datatables/js/vfs_fonts.js')}}"></script>

<script src="{{asset ('assets/vendors/scripts/datatable-setting.js')}}"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

<!-- switchery js -->
<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<!-- bootstrap-stouchspin js -->

<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

<script src="{{asset('assets/module/main.js')}}"></script>


<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
		style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
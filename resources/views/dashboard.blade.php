<!DOCTYPE html>
<html>
@include('header')

<div class="main-container">
	<div class="row">
		@foreach($formations as $formation)
		@if(!empty($formation->img))
		<div class="col-md-4 mb-20">
			<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
				<div class="img pb-30">
					<img src="{{Storage::url($formation->img)}}" alt="" />
				</div>
				<div class="content">
					<h3 class="h4">{{$formation->nom}}</h3>
					<p class="max-width-200">
						{{$formation->note}}
					</p>
					<button class="btn btn-success">Detaille</button>
				</div>
			</a>
		</div>
		@endif
		@endforeach
	</div>
</div>
<!-- welcome modal start -->

<button class="welcome-modal-btn">
	<i class="fa fa-download"></i> Download
</button>
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
<script src="{{asset('assets/vendors/scripts/dashboard3.js')}}"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
		src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
		height="0"
		width="0"
		style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
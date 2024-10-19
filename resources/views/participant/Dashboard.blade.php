<!DOCTYPE html>
<html>
@include('participant.header')

<div class="main-container">
    @if($countFormation == 0)
    <div class="pd-20 card-box mb-3">
        <h4 class="text-center text-primary">Vous ne disposer d'aucun contenue pour l'instant</h4>
        <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit esse saepe, possimus deleniti sed labore commodi <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestias rem sit natus magnam earum molestiae culpa numquam exercitationem, fugiat, nihil quasi ab tenetur eligendi eius porro consequatur nulla ad?</p>*
    </div>
    @endif
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
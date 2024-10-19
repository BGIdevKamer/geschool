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
                            <h4>Tabs</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    UI Tabs
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">Nav Pills Tabs Right</h5>
                        <div class="tab">
                            <ul class="nav nav-pills justify-content-end" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#home6" role="tab"
                                        aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#profile6" role="tab"
                                        aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#contact6" role="tab"
                                        aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home6" role="tabpanel">
                                    <table class="data-table table nowrap">
                                        <thead>
                                            <tr>
                                                <th class="table-plus">Name</th>
                                                <th>Gender</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-plus">
                                                    <div class="name-avatar d-flex align-items-center">
                                                        <div class="avatar mr-2 flex-shrink-0">
                                                            <img
                                                                src="{{asset('assets/vendors/images/photo4.jpg')}}"
                                                                class="border-radius-100 shadow"
                                                                width="40"
                                                                height="40"
                                                                alt="" />
                                                        </div>
                                                        <div class="txt">
                                                            <div>Jennifer O. Oster</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Female</td>
                                                <td><strong>Lorem ipsum dolor sit Lorem ipsum dolor sit amet consectetur adipisicing elit.</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile6" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                        non proident, sunt in culpa qui officia deserunt mollit
                                        anim id est laborum.
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact6" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                        non proident, sunt in culpa qui officia deserunt mollit
                                        anim id est laborum.
                                    </div>
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
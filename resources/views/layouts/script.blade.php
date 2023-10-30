<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/plugin/notify/js/notify.js"></script>
@if($admin)
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/sticky.js"></script>
<script src="/plugin/p-scroll/perfect-scrollbar.js"></script>
<script src="/plugin/p-scroll/pscroll.js"></script>
<script src="/assets/js/sidebar.js"></script>
<script src="/assets/js/sidemenu.js"></script>
<script src="/assets/js/landing.js"></script>
{{-- <script src="/assets/js/tooltip&popover.js"></script> --}}
@else
<script src="/assets/js/jquery-ui.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/swiper-bundle.min.js"></script>
<script src="/assets/js/slick.js"></script>
<script src="/assets/js/jquery.nice-select.js"></script>
<script src="/assets/js/odometer.min.js"></script>
<script src="/assets/js/viewport.jquery.js"></script>
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/assets/js/main.js"></script>
@endif
@stack('scripts')
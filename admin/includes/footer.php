</div>


<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-center text-center px-4 py-3 border-top small">
    <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="javascript:void(0);">Discount Dhamaka</a>.</p>
</footer>


</div>
</div>


<!-- core:js -->
<script src="assets/vendors/core/core.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="assets/js/dashboard-light.js"></script>
<!-- End custom js for this page -->

<script src="assets/js/jquery.magnific-popup.min.js"></script>

<script src="../assets/sweetalert2/sweetalert2.min.js"></script>

<script>
    function srbSweetAlret(msg, swicon) {
        msg = msg;
        swicon = swicon;
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: swicon,
            title: msg
        })
    }
</script>

<script>
    function logout() {

$.ajax({
    url: "ajax/logout.php",
    type: "POST",
    async: false,
    success: function(data) {
        location.href = "login.php";
    }

});

}
</script>
</body>

</html>
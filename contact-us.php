<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/contact-us.css">
<!-- header end here -->

<section class="ec-page-content section-space-p contactpg">
    <div class="container">
        <div class="row">
            <div class="ec-common-wrapper">
                <div class="row">

                    <div class="col-md-7">
                        <div class="ec-contact-leftside">
                            <div class="ec-contact-container">
                                <div class="ec-contact-form">
                                    <form action="javascript:void(0);" id="contatForm" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="ec-contact-wrap">
                                                    <label>Name*</label>
                                                    <input type="text" name="CntcName" placeholder="Enter your name" required />
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="ec-contact-wrap">
                                                    <label>Email*</label>
                                                    <input type="email" name="CntcEmail" placeholder="Enter email address" required />
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="ec-contact-wrap">
                                                    <label>Phone Number*</label>
                                                    <input type="text" name="CntcPhn"   maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="Enter mobile number" required />
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="ec-contact-wrap">
                                                    <label>Query*</label>
                                                    <textarea name="CntcQuery" required placeholder="Please leave your comments here.."></textarea>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="ec-contact-wrap ec-contact-btn">
                                                    <button class="btn btn-primary" type="submit">Send Query</button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="ec-contact-rightside">
                            <div class="ec_contact_info">
                                <h1 class="ec_contact_info_head">Contact us</h1>
                                <ul class="align-items-center">

                                    <li class="ec-contact-item">
                                        <span><i class="ecicon eci-envelope" aria-hidden="true"></i><span>Email :</span></span>
                                        <span class="myfntcnt"><a href="mailto:support@discountdhamaka.com">support@discountdhamaka.com</a></span>
                                    </li>
                                    <li class="ec-contact-item">
                                        <span><i class="ecicon eci-home" aria-hidden="true"></i><span>Address :</span></span>
                                        <span class="myfntcnt"> <b>Extrabucks Technologies Pvt Ltd.</b> <br> Ashok Vihar,Phase-2 <br> Delhi-110052</span>
                                    </li>
                                    
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer start here -->
<?php include('includes/footer.php'); ?>
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
    $(document).on('submit', '#contatForm', function() {
        $.ajax({

            type: "POST",
            url: "ajax/contact.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
         
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                                location.reload();
                            }, 1000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }

        });
    });
</script>
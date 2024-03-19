<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/add-cat.css">

<style>
    .card-body {
        padding: 10px;
        padding-bottom: 0;
    }

    .card-body img {
        height: 180px;
        width: 100%;
        object-fit: cover;
    }

    .main-wrapper .page-wrapper .page-content {
        flex-grow: 1;
        padding: 25px;
        margin-top: 60px;
        background: #fff;
    }

    .emp-det {
        padding: 0 10px;
    }

    .emp-det li {
        display: flex;
        width: 100%;
        padding: 8px 5px;
        border-bottom: 1px solid #fcfcfc;
        justify-content: space-between;
    }

    .emp-det li:nth-last-child(1) {
        border: none;
        padding-bottom: 0;
    }

    .emp-det li:nth-child(even) {
        background-color: #fcfcfc;
    }

    .emp-det li .bs {
        font-weight: 500;
        font-size: 10px;
        text-transform: uppercase;
    }

    .sts_false {
        color: indianred;
        background: #ffefef;
    }

    .sts_true {
        color: #008000d1;
        background: #e2f4e2;
    }

    .btn.btn-xs {
        padding: 5px 7px;
        font-size: 11px;
    }

    .btn.btn-xs i {
        font-size: 11px;
    }

    .card-footer {
        padding: 0;
        font-size: 12px;
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">

            <?php
            $i = 0;
            $getEmpQ = mysqli_query($con, "SELECT ee.*, er.title AS role_title FROM ec_employee ee, ec_roles_type er WHERE ee.role_id = er.id AND ee.id!=1  ORDER BY id DESC");
            $getEmpCOunt = mysqli_num_rows($getEmpQ);
            if ($getEmpCOunt > 0) {
                while ($getEmp = mysqli_fetch_array($getEmpQ)) {
            ?>
                    <div class="col-md-4 grid-margin">
                        <div class="card rounded">

                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="img-xs rounded-circle" src="assets/images/faces/face1.png" alt="">
                                        <div class="ms-2">
                                            <p><?= $getEmp['first_name'] . ' ' . $getEmp['last_name'] ?></p>
                                            <span class="tx-11 text-uppercase text-bold <?= ($getEmp['status'] == 1) ? 'sts_true' : 'sts_false'; ?> "><?= ($getEmp['status'] == 1) ? 'Active' : 'Inactive'; ?></span></p>
                                        </div>
                                    </div>
                                    <div>
                                        <?php
                                        if ($getEmp['email_verified'] == 1) {


                                        ?>
                                            <a type="button" data-id="<?= $getEmp['id'] ?>" class="btn btn-xs btn-danger EmpDltBtn">
                                                <i class="fa fa-md fa-trash"></i>
                                            </a>
                                            <a type="button" id="empsts" data-id="<?= $getEmp['id'] ?>" data-status="<?= ($getEmp['status'] == 1) ? '0' : '1'; ?>" class="btn btn-xs <?= ($getEmp['status'] == 1) ? 'btn-danger' : 'btn-success'; ?> ">
                                                <?= ($getEmp['status'] == 1) ? '<i class="fa fa-md fa-pause"></i>' : '<i class="fa fa-md fa-play"></i>'; ?>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a type="button" data-id="<?= $getEmp['id'] ?>" class="btn btn-xs btn-danger EmpDltBtn">
                                                <i class="fa fa-md fa-trash"></i>
                                            </a>
                                            <a type="button" data-id="<?= $getEmp['id'] ?>" data-email="<?= $getEmp['email'] ?>" class="btn btn-xs btn-primary " id="VerEmpBtn">
                                                Verify Employee
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <ul class="emp-det">
                                    <li>
                                        <div class="bs">Email </div>
                                        <div><?= $getEmp['email']; ?></div>
                                    </li>
                                    <li>
                                        <div class="bs">Mobile </div>
                                        <div><?= $getEmp['primary_phone_no']; ?></div>

                                    </li>
                                    <li>
                                        <div class="bs">Role </div>
                                        <div><?= $getEmp['role_title']; ?></div>

                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <p class="my-2 px-2">
                                    <?= $getEmp['job_description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="text-center">
                    <img src="assets/images/nofound.jpg" width="300px" alt="">
                    <p>Oops ! Employees not added by admin yet...</p>
                </div>
            <?php
            }
            ?>


        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade " id="verifyOtpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                <form class="forms-sample" id="VerEmpForm" action="javascript:;" method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="mb-3 text-center">
                                <label class="form-label">Enter Verification Code</label>
                                <input type="text" minlength="4" maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-control" name="EmpOtp" required placeholder="Enter Verification Code">
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="VerifyEmployee">
                                <input type="hidden" id="emailEmp" name="emailEmp">
                                <button type="submit" class="btn btn-primary me-2 w-50" id="VerifyEmpBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<script>
    $(document).on("click", ".EmpDltBtn", function() {
        var empID = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // console.log(result);

                $.ajax({
                    url: "ajax/employees.php",
                    type: "POST",
                    async: false,
                    data: {
                        empID: empID,
                        type: 'EmpDlt'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            window.setTimeout(function() {
                                location.reload();
                            }, 500);
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                        }
                    }
                });
            }
        });

    });

    $(document).on("click", "#VerEmpBtn", function() {
        // 
        var emailEmp = $(this).attr('data-email');
        $("#emailEmp").val(emailEmp);
        $.ajax({
            url: "ajax/employees.php",
            type: "POST",
            async: false,
            data: {
                emailEmp: emailEmp,
                type: 'EmpVeriOtpSend'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#verifyOtpModal").modal('show');
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });
    });

    $(document).on("click", "#empsts", function() {
        emplid = $(this).attr('data-id');
        EMpstatus = $(this).attr('data-status');
        $.ajax({
            url: "ajax/employees.php",
            type: "POST",
            async: false,
            data: {
                emplid: emplid,
                EMpstatus:EMpstatus,
                type: 'EmpSts'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });
    });

    $(document).on("submit", "#VerEmpForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/employees.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#VerifyEmpBtn").attr("disabled", "disabled");
                $("#VerifyEmpBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 1) {
                    $("#VerifyEmpBtn").removeAttr("disabled", "disabled");
                    $("#VerifyEmpBtn").html("Submit");
                    swicon = "success";
                    msg = 'Employee Verify Successfully';
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        window.location.href = "employee-list.php";
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#VerifyEmpBtn").removeAttr("disabled", "disabled");
                    $("#VerifyEmpBtn").html("Submit");
                }
            },
        });
    });
</script>
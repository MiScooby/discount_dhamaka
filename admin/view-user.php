<?php include('includes/header.php');
 
if (!authChecker('admin', ['view_user', 'edit_user'])) { noAccessPage(); }

if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
    $GetUserQ = mysqli_query($con, "SELECT * FROM `user` WHERE `id`='$id'");
    $GetUser = mysqli_fetch_array($GetUserQ);
}
?>
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">

<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 38px;
        border: 1px solid #e9ecef !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 23px;
    }

    .pass1 {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 25px;
        top: 12px;
        color: #000865;
        font-weight: 500;
        cursor: pointer;
    }

    .userinfodiv {
        background: #fcfcfcc4;
        padding: 20px 20px 8px;
        border-radius: 20px;
        border: 1px solid #f6f6f6cc;
    }

    .divbtn {
        padding-top: 10px;
    }

    .dropify-wrapper {
        height: 100px;
    }

    .dropify-wrapper .dropify-message span.file-icon {
        font-size: 20px;
    }

    .userinfodiv .forms-sample .form-label {
        font-weight: 500;
        color: #030414bd;
    }

    .row.mb-3 {
        display: flex;
        align-items: center;
    }

    .useravatar img {
        width: 90px;
    }
</style>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6  ">
                        <h6 class="card-title">Edit / View User Details</h6>
                    </div>
                    <div class="col-md-6 mb-2 grid-margin stretch-card justify-content-end">
                        <?php
                        if ($GetUser['email_id'] != null) {
                        ?>

                            <a href="mailto:<?= $GetUser['email_id']; ?>" class="btn btn-success me-2">Send Email to user</a>


                        <?php
                        }
                        ?>


                    </div>
                </div>
                <div class="userinfodiv">
                    <div class="row">
                        <div class="col-md-12">

                            <form class="forms-sample">
                                <input type="hidden" id="UserId" value="<?= $GetUser['id']; ?>">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">User Name:</label>
                                        <input class="form-control mb-4 mb-md-0" id="UserName" type="text" value="<?= $GetUser['user_name']; ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">First Name:</label>
                                        <input class="form-control mb-4 mb-md-0" id="FirstName" type="text" value="<?= $GetUser['first_name']; ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Last Name:</label>
                                        <input class="form-control" id="LastName" type="text" value="<?= $GetUser['last_name']; ?>" />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Email Address:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php
                                        if ($GetUser['email_id'] == null) {
                                        ?>

                                            <p>Email is Not Entered by User</p>


                                        <?php
                                        } else {
                                        ?>
                                            <input class="form-control mb-4 mb-md-0" id="EmailAdd" type="email" value="<?= $GetUser['email_id']; ?>" disabled />
                                        <?php

                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Mobile Number:</label>
                                    </div>

                                    <?php
                                    if (($GetUser['c_code'] == null) && ($GetUser['mobile_num'] == null)) {
                                    ?>

                                        <div class="col-md-9">
                                            <p>Mobile is Not Entered by User</p>

                                        </div>

                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-3">
                                            <select class="js-example-basic-single form-control" id="c_code" disabled>
                                                <option value="<?= $GetUser['c_code']; ?>" selected><?= $GetUser['c_code']; ?></option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" disabled id="mobilNUm" value="<?= $GetUser['mobile_num']; ?>" />
                                        </div>
                                    <?php

                                    }
                                    ?>


                                </div>


                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">User Current Status:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="js-example-basic-single form-control" data-id="<?= $GetUser['id'] ?>" id="userStatus">
                                            <option data-id="" value="Active" <?php if ($GetUser['status'] == "Active") {
                                                                                    echo "selected";
                                                                                } ?>>Active</option>
                                            <option data-id="" value="Inactive" <?php if ($GetUser['status'] !== "Active") {
                                                                                    echo "selected";
                                                                                } ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">User Avatar:</label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="useravatar">
                                            <img src="assets/images/faces/face1.png" alt="user-img">

                                        </div>
                                    </div>
                                </div>


                                <?php
                                        if (authChecker('admin', ['edit_user'])) {
                                        ?>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="divbtn">
                                            <button type="button" id="saveUserbtn" class="btn btn-primary me-2">Save User Details</button>
                                            <button type="button" id="DltBtn" class="btn btn-danger me-2">Delete User</button>
                                        </div>

                                    </div>
                                </div>

<?php
                                        }
?>

                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>

<script>
    $(function() {
        'use strict'

        $(".js-example-basic-single").select2();

        $('#userImage').dropify();


        $(document).on("click", ".toggle-password", function() {
            if ($(".pass1").find("input").attr("type") == "password") {
                $(".pass1").find("input").attr("type", "text");
                $(this).addClass("fa-eye");
                $(this).removeClass("fa-eye-slash");
            } else {
                $(".pass1").find("input").attr("type", "password");
                $(this).removeClass("fa-eye");
                $(this).addClass("fa-eye-slash");
            }
        });
        $(document).on("change", "#user_sts", function() {
            var userId = $(this).attr('data-id');
            var user_sts = $("#user_sts").val();

            $.ajax({
                url: "ajax/customers.php",
                type: "POST",
                async: false,
                data: {
                    userId: userId,
                    user_sts: user_sts,
                    type: 'statusChnage'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        alert(data.message);
                        location.reload();

                    } else {
                        alert(data.message);
                    }
                }
            });
        });
        $(document).on("click", "#DltBtn", function() {
            var userIdnum = $("#UserId").val();
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
                    console.log(result);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $.ajax({
                        url: "ajax/customers.php",
                        type: "POST",
                        async: false,
                        data: {
                            userIdnum: userIdnum,
                            type: 'DltUser'
                        },
                        success: function(data) {
                            data = JSON.parse(data);
                            if (data.status) {
                                location.href = "users.php";
                            } else {
                                alert(data.message);
                            }
                        }
                    });
                }
            });

        });
        $(document).on("click", "#saveUserbtn", function() {
            var UserId = $("#UserId").val();
            var UserName = $("#UserName").val();
            var FirstName = $("#FirstName").val();
            var LastName = $("#LastName").val();
            var userStatus = $("#userStatus").val();
            $.ajax({
                url: "ajax/customers.php",
                type: "POST",
                async: false,
                data: {
                    UserId: UserId,
                    UserName: UserName,
                    FirstName: FirstName,
                    LastName: LastName,
                    userStatus: userStatus,
                    type: 'UpdateUserDet'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        location.href = "users.php";
                    } else {
                        alert(data.message);
                    }
                }
            });
        });

    });
</script>
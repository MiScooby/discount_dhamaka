<?php session_start();
include('ajax/config.php');
if (!isset($_SESSION['usertoken'])) {
    header("location:login.php");
}
$InUser1 = $_SESSION['usertoken'];
$AdminUserData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `ec_employee` WHERE `email`='$InUser1' "));
$AdminUserName = $AdminUserData['first_name'] . ' ' . $AdminUserData['last_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title>DiscountDhamka - Admin</title>
    <!-- Fonts -->
    <link href="assets/images/favicon.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/flatpickr/flatpickr.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo1/style.min.css">
    <!-- End layout styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/demo1/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">
</head>

<body>
    <div class="main-wrapper">


        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="index.php" class="sidebar-brand">
                    <img src="assets/images/logo-8.png" width="150px" alt="">
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    if (authChecker('admin', ['add_category', 'view_category', 'edit_category'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">
                                <i class="link-icon" data-feather="list"></i>
                                <span class="link-title">Category</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="category">
                                <ul class="nav sub-menu">
                                    <?php
                                    if (authChecker('admin', ['add_category'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="add-category.php" class="nav-link">Add Category</a>
                                        </li>
                                    <?php }
                                    ?>
                                    <?php
                                    if (authChecker('admin', ['view_category', 'edit_category'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="view-category.php" class="nav-link">View Category</a>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>



                    <?php
                    if (authChecker('admin', ['add_locality', 'view_locality', 'edit_locality'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#Locality" role="button" aria-expanded="false" aria-controls="Locality">
                                <i class="link-icon" data-feather="map-pin"></i>
                                <span class="link-title">Locality</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="Locality">
                                <ul class="nav sub-menu">
                                    <?php
                                    if (authChecker('admin', ['add_locality'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="add-locality.php" class="nav-link">Add Locality</a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (authChecker('admin', ['view_locality', 'edit_locality'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="view-locality.php" class="nav-link">View Locality</a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if (authChecker('admin', ['add_user', 'view_user', 'edit_user', 'add_vendor', 'view_vendor', 'edit_vendor'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">Users</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="nav sub-menu">
                                    <?php
                                    if (authChecker('admin', ['add_user', 'view_user', 'edit_user'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="users.php" class="nav-link">View Customers</a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if (authChecker('admin', ['add_vendor', 'view_vendor', 'edit_vendor'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="vendors.php" class="nav-link">View Vendors</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if (authChecker('admin', ['view_deal', 'edit_offer'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#offers" role="button" aria-expanded="false" aria-controls="users">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Offers</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="offers">
                                <ul class="nav sub-menu">
                                    <!-- <li class="nav-item">
                                    <a href="add-offer.php" class="nav-link">Add Offer</a>
                                </li> -->
                                    <li class="nav-item">
                                        <a href="view-offers.php" class="nav-link">View Offers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if (authChecker('admin', ['membership_subscription', 'falsh_deal_subscription'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#membership" role="button" aria-expanded="false" aria-controls="users">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Membership</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="membership">
                                <ul class="nav sub-menu">
                                    <?php
                                    if (authChecker('admin', ['membership_subscription'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="membership.php" class="nav-link">Membership</a>
                                        </li>
                                    <?php
                                    } ?>
                                    <?php
                                    if (authChecker('admin', ['falsh_deal_subscription'])) {
                                    ?>
                                        <li class="nav-item">
                                            <a href="flash-deal.php" class="nav-link">Flash Deal Membership</a>
                                        </li>
                                    <?php
                                    } ?>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>



                    <?php
                    if (authChecker('admin', ['view_earning'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#earnings" role="button" aria-expanded="false" aria-controls="users">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Earnings</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="earnings">
                                <ul class="nav sub-menu">
                                    <li class="nav-item">
                                        <a href="earnings.php" class="nav-link">Earnings</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if (authChecker('admin', ['view_grabbed_deals'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="grabbed-deals.php">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Grabbed Deals</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if (authChecker('admin', ['view_comment'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="comments.php">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Deal Comments/Reviews</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if (authChecker('admin', ['add_coupon_code', 'view_coupon_code', 'edit_coupon_code'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="coupon.php">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Promo Code</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if (authChecker('admin', ['view_contact_query'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-query.php">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Contact Us Query</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if (authChecker('admin', ['access_control'])) {
                    ?>
                        <li class="nav-item nav-category">SECURITY & ACCESS CONTROL</li>
                        <li class="nav-item">
                            <a class="nav-link" href="roles.php">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Roles / Privileges</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#employee" role="button" aria-expanded="false" aria-controls="employee">
                                <i class="link-icon" data-feather="tag"></i>
                                <span class="link-title">Employees</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="employee">
                                <ul class="nav sub-menu">
                                    <li class="nav-item">
                                        <a href="add-employee.php" class="nav-link">Create Employee</a>

                                    </li>
                                    <li class="nav-item">
                                        <a href="employee-list.php" class="nav-link">Employee List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </nav>


        <div class="page-wrapper">


            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">

                    <ul class="navbar-nav">


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="wd-30 ht-30 rounded-circle" src="assets/images/faces/face1.png" alt="profile">
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-3">
                                        <img class="wd-80 ht-80 rounded-circle" src="assets/images/faces/face1.png" alt="">
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder"><?= $AdminUserName ?></p>
                                        <p class="tx-11 fw-normal"><?= $InUser1 ?></p>

                                    </div>
                                </div>
                                <ul class="list-unstyled p-1">


                                    <li class="dropdown-item py-2">
                                        <a href="javascript:;" class="text-body ms-0" onclick="logout()">
                                            <i class="me-2 icon-md" data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-content">
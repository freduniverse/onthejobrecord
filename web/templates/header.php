<?php
session_start();
include_once("../config/database.php");
include_once("../config/Models.php");

$role = "";
if (isset($_SESSION["admin_session"])) {
  $username = $_SESSION["admin_session"]["username"];
  $account = account()->get("username='$username'");
  $role = $account->role;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>On The Job Record Management Information System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="templates/assets/img/favicon.png" rel="icon">
    <link href="templates/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="templates/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="templates/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="templates/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="templates/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="templates/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="templates/assets/css/style.css" rel="stylesheet">

</head>

<style>
.social-links a {
    color: white !important;
}
</style>

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-end">
            <div class="social-links d-none d-md-flex align-items-center">
                <?php if (isset($_SESSION["admin_session"])): ?>
                <a href=""><?=$_SESSION["admin_session"]["firstName"];?> <?=$_SESSION["admin_session"]["lastName"];?>
                    (<?=$_SESSION["admin_session"]["role"];?>)</a><a href="processAuth.php?action=user-logout">Log
                    out</a>
                <?php else: ?>
                <a href="login.php">Log in</a><a href="register.php">Student Registration</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="./">On The Job Record<span>.</span></a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="./">Home</a></li>

                    <?php if ($role=="Coordinator"): ?>

                    <li><a class="nav-link scrollto" href="#announcements">Announcements</a></li>

                    <li><a class="nav-link scrollto" href="accounts.php?role=Head">OJT Heads</a></li>

                    <li><a class="nav-link scrollto" href="accounts.php?role=Student">Enrolled Students</a></li>

                    <li><a class="nav-link scrollto" href="students.php?page=dtr">Student's DTR</a></li>

                    <li><a class="nav-link scrollto" href="students.php?page=coe">Student's COE</a></li>

                    <?php endif; ?>

                    <?php if ($role=="Student"): ?>

                    <li><a class="nav-link scrollto" href="dtr.php">DTR</a></li>

                    <li><a class="nav-link scrollto" href="#studentCoe">COE</a></li>

                    <li><a class="nav-link scrollto" href="#studentAnnouncement">Announcementts</a></li>

                    <?php endif; ?>

                    <?php if ($role=="Head"): ?>

                    <li><a class="nav-link scrollto" href="students.php">Assigned Students</a></li>

                    <li><a class="nav-link scrollto" href="students.php?page=dtr">Student's DTR</a></li>

                    <li><a class="nav-link scrollto" href="students.php?page=coe">Student's COE</a></li>

                    <li><a class="nav-link scrollto" href="#headAnnouncement">Announcementts</a></li>

                    <?php endif; ?>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->



    <main id="main" class="container" style="min-height:500px;">
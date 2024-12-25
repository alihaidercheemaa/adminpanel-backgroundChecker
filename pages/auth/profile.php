<?php
$title = 'Profile';
include('../includes/header.php');
?>

<body id="app-top">
    <div class="app-wrapper">
        <?php include('../includes/sidebar.php') ?>
        <div class="app-main">
            <?php include('../includes/topbar.php') ?>
            <div class="app-content">
                <div class="app-content--inner">
                    <div class="pb-4 text-center text-xl-left">
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <div>
                                    <ol class="d-inline-block breadcrumb text-uppercase font-size-xs p-0">
                                        <li class="d-inline-block breadcrumb-item"><a href="/">Dashboard</a></li>
                                        <li class="d-inline-block breadcrumb-item active"><?= $title ?></li>
                                    </ol>
                                    <h5 class="display-3 mt-1 mb-2 font-weight-bold"><?= $title ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-box mb-3">
                        <div class="card-header">
                            <div class="card-header--title">
                                <small><?= $title ?></small>
                            </div>
                        </div>
                        <section>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="d-flex mb-3">
                                                <span class="flex-grow-1 font-weight-bold text-uppercase">
                                                    <small class="font-weight-bold">Name: </small>
                                                </span>
                                                <p class="mb-0"><small><?= $_SESSION["full_name"] ?></small></p>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <span class="flex-grow-1 font-weight-bold text-uppercase">
                                                    <small class="font-weight-bold">Email: </small>
                                                </span>
                                                <p class="mb-0"><small><?= $_SESSION["email"] ?></small></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="d-flex mb-3">
                                                <span class="flex-grow-1 font-weight-bold text-uppercase">
                                                    <small class="font-weight-bold">Role: </small>
                                                </span>
                                                <p class="mb-0 text-uppercase"><small><?= $_SESSION["role"] ?></small></p>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <span class="flex-grow-1 font-weight-bold text-uppercase">
                                                    <small class="font-weight-bold">Phone no: </small>
                                                </span>
                                                <p class="mb-0"><small><?= $_SESSION["phone_no"] ?></small></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php include('../includes/footer.php'); ?>
                <script src="<?= BASE_URL ?>/assets/js/app/change_password.js?v=<?= time() ?>"></script>
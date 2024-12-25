<?php
$title = 'Change Password';
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
                                <form class="changePasswordForm" method="POST" novalidate>
                                    <div class="form-row pb-3">
                                        <div class="col-lg-6">
                                            <label for="old_password">Old Password</label>
                                            <div class="form-group eye-toggle">
                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" required autocomplete="off">
                                                <span class="input-group-text p-1 bg-white eye-check"> <i class="bi bi-eye-slash" onclick="togglePassword(this)"></i></span>
                                            </div>
                                            <label for="new_password">New Password</label>
                                            <div class="form-group eye-toggle">
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required autocomplete="off">
                                                <span class="input-group-text p-1 bg-white eye-check"> <i class="bi bi-eye-slash" onclick="togglePassword(this)"></i></span>
                                            </div>
                                            <label for="confirm_password">Confirm Password</label>
                                            <div class="form-group eye-toggle">
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required autocomplete="off">
                                                <span class="input-group-text p-1 bg-white eye-check"> <i class="bi bi-eye-slash" onclick="togglePassword(this)"></i></span>
                                            </div>
                                            <div>
                                                <a href="javascript: void(0);" type="button" class="btn btn-bgchecker" onclick="changePassword()">Update</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <?php include('../includes/footer.php'); ?>
                <script src="<?= BASE_URL ?>/assets/js/app/change_password.js?v=<?= time() ?>"></script>
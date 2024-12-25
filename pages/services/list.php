<?php
    $title = 'Services';
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
                                <div class="col-xl-6 d-flex align-items-center justify-content-start mt-xl-0 justify-content-xl-end">
                                    <div class="mx-auto mx-xl-0 mt-3 btn-wrapper">
                                        <a href="/addServices" class="btn btn-secondary-orio">Add Service</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-box mb-3">
                            <div class="card-header">
                                <div class="card-header--title">
                                    <small><?= $title ?> List</small>
                                </div>
                                <div class="card-header--actions">
                                    <div class="mx-auto mx-xl-0">
                                        <div class="d-inline-block btn-group btn btn-primary coursor-pointer">
                                            <div id="datepicker">
                                                <i class="fa fa-calendar"></i>
                                                <span class="date_title"></span>
                                                <span class="date_range"></span>
                                                <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="servicesList" class="nowrap table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">SNO</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Image</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Title</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Status</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Action</b>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <?php include('../includes/footer.php'); ?>
                    <script src="<?= BASE_URL ?>/assets/js/app/services.js?v=<?= time() ?>"></script>
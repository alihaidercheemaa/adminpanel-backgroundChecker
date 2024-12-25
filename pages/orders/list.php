<?php
    $title = 'Orders';
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
                                        <a href="/addOrder" class="btn btn-secondary-orio">Add Order</a>
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
                            <table id="orderList" class="display nowrap table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Order No</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Order Date</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Customer Name</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Customer Contact</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Quantity</b>
                                        </th>
                                        <th class="no-sort">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Subtotal</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Shipping Charges</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Discount</b>
                                        </th>
                                        <th class="no-sort">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Total Amount</b>
                                        </th>
                                        <th class="no-sort">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Profit</b>
                                        </th>
                                        <th class="no-sort">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Payment Status</b>
                                        </th>
                                        <th class="no-sort">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <?php include('../includes/footer.php'); ?>
                    <script src="<?= BASE_URL ?>/assets/js/app/orders.js?v=<?= time() ?>"></script>
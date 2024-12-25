<?php
    $title = 'Create Order';
    include('../includes/header.php');
    $url = API_URL . "products/list";
    $productList = (curlFunction($url, '{}', '', '', 'GET', '1'))->payload;
    ?>

    <body id="app-top" style="overflow-x: hidden;">
        <div class="app-wrapper">
            <?php include('../includes/sidebar.php') ?>
            <div class="app-main">
                <?php include('../includes/topbar.php') ?>
                <div class="app-content">
                    <div class="app-content--inner">
                        <div class="pb-4 text-center text-xl-left">
                            <div class="row align-items-center">
                                <div class="col-xl-8">
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
                            <div class="card-body">
                                <form class="orderForm" id="orderForm" method="post" novalidate>
                                    <div class="form-row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="row col-md-6 col-sm-12 form-group">
                                                <label>Customer Name <span class="text-danger">*</span></label>
                                                <input type="text" name="customer_name" id="customer_name" class="form-control form-control-lg" required placeholder="Customer Name">
                                            </div>
                                            <div class="row col-md-6 col-sm-12 form-group">
                                                <label>Customer Contact <span class="text-danger">*</span></label>
                                                <input type="text" name="customer_contact" id="customer_contact" class="form-control form-control-lg" placeholder="(e.g. 03*********)" required maxlength="11" data-parsley-pattern="^03\d{9}$"">
                                                </div>
                                                <div class=" row col-md-6 col-sm-12 form-group">
                                                <label>Order Date <span class="text-danger">*</span></label>
                                                <input class="form-control form-control-lg" id="order_date" data-toggle="datepicker" placeholder="Select date" type="text" autocomplete="off" required>
                                            </div>
                                            <label class="">Add Products <span class="text-danger">*</span></label>
                                            <div id="append_products">
                                            </div>
                                            <div class="row col-md-6 col-sm-12 form-group">
                                                <label>Shipping Charges <span class="text-danger">*</span></label>
                                                <input type="text" name="shipping_charges" id="shipping_charges" class="form-control form-control-lg digits" required placeholder="Shipping Charges" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageOrders" onclick="manageOrders('create');">Save</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php include('../includes/footer.php'); ?>
                    <div class="row col-md-6 col-sm-12 form-group d-none">
                        <label>Select Product <span class="text-danger">*</span></label>
                        <select id="productList" class="form-control form-control-lg" size="1" data-toggle="custom-select2" placeholder="Select Product" data-allow-clear="1" required>
                            <option value="">Select Product</option>
                            <?php foreach ($productList as $item) : ?>
                                <?php if ($item->status == '1') : ?>
                                    <option value="<?= $item->id ?>" product_amount="<?= $item->price ?>" product_quantity="<?= $item->quantity ?>"><?= ucwords($item->name) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/app/orders.js?v=<?= time() ?>"></script>
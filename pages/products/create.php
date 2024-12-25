<?php
$title = 'Create Product';
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
                            <form class="productForm" id="productForm" method="post" novalidate>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control form-control-lg" required placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity <span class="text-danger">*</span></label>
                                            <input type="text" name="quantity" id="quantity" class="form-control form-control-lg digits" required placeholder="Quantity">
                                        </div>
                                        <div class="form-group">
                                            <label>Price <span class="text-danger">*</span></label>
                                            <input type="text" name="price" id="price" class="form-control form-control-lg" required placeholder="Price">
                                        </div>
                                        <div class="form-group">
                                            <label>Cost Price <span class="text-danger">*</span></label>
                                            <input type="text" name="cost_price" id="cost_price" class="form-control form-control-lg digits" required placeholder="Cost Price">
                                        </div>
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control form-control-lg" placeholder="Select Status" size="1" data-toggle="custom-select2" data-allow-clear="1" required>
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">In Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageProducts" onclick="manageProducts('create');">Save</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include('../includes/footer.php'); ?>
                <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/app/products.js?v=<?= time() ?>"></script>
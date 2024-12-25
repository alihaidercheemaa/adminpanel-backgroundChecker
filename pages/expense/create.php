<?php
$title = 'Create Expense';
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
                            <form class="expenseForm" id="expenseForm" method="post" novalidate>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control form-control-lg" required placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <input type="text" name="description" id="description" class="form-control form-control-lg" required placeholder="Description">
                                        </div>
                                        <div class="form-group">
                                            <label>Purchase Date <span class="text-danger">*</span></label>
                                            <input class="form-control form-control-lg" id="purchase_date" data-toggle="datepicker" placeholder="Select date" type="text" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="amount" id="amount" class="form-control form-control-lg digits" required placeholder="Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageExpense" onclick="manageExpense('create');">Save</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include('../includes/footer.php'); ?>
                <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/app/expense.js?v=<?= time() ?>"></script>
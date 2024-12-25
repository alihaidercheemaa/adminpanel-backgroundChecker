<?php 
    require($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php'); 
    require($_SERVER['DOCUMENT_ROOT'] . '/config/guard.php');
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= (isset($title) && !empty($title)) ? $title . ' | Background Checker' : 'Background Checker'; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon/favicon.png">
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/bamburgh.min.css?v=<?= time() ?>">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/daterangepicker.css" />
        <!--==================================DataTable==================================-->
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/buttons.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/responsive.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/scroller.bootstrap4.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css?v=<?= time() ?>" />
        <!--==================================DataTable==================================-->
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= time() ?>" />
    </head>
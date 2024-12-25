<?php
    error_reporting(0);
    session_start();
    $isValid = $_SESSION['isValid'];
    if ($isValid) {
        header("Location: /dashboard");
        exit;
    }
    ?>
    <!Doctype html>
    <html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login - Background Checker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <link rel="shortcut icon" href="assets/images/favicon/favicon.png">
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" type="text/css" href="assets/css/bamburgh.min.css?v=<?= time(); ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css?v=<?= time(); ?>" />
        <link rel="stylesheet" type="text/css" href="assets/css/style.css?v=<?= time(); ?>">
    </head>

    <body id="app-top" style="margin: 0; height: 100vh; background: linear-gradient(to bottom right, #0074fc 50%, #ffffff 50%);">
        <div>
            <div class="app-main">
                <div class="app-content p-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="flex-grow-1 w-100">
                            <div class="bg-composed-wrapper--content container">
                                <div class="row">
                                    <div class="col-lg-6 align-items-center justify-content-center mx-auto vh-100 bg-white py-5 px-0 mt-5" style="border-radius: 5px;">
                                        <div class="sign-in-sec py-5">
                                            <div class="text-white">
                                                <div class="logo-wrapper">
                                                    <a class="brand-logo text-center d-block">
                                                        <img src="assets/images/logo/your-logo.webp" width="170px" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="heading-wrapper text-black text-center mb-4">
                                                    <h2 class="mb-2 Heebo-Bold">
                                                        Login to your account
                                                    </h2>
                                                    <p class="font-size-sm mb-0 font-weight-bold Heebo-Regular">
                                                        Access Your World with a Simple Login
                                                    </p>
                                                </div>
                                                <div>
                                                    <form class="loginForm row" action="#" method="post" novalidate>
                                                        <div class="col-md-7 mx-auto">
                                                            <div class="form-group">
                                                                <input type="email" id="email" name="email" placeholder="Email" class="form-control form-control-lg custom-input" maxlength="50" required autocomplete>
                                                            </div>
                                                            <div class="form-group eye-toggle">
                                                                <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg" maxlength="50" required autocomplete="new-password">
                                                                <span class="input-group-text p-1 bg-white eye-check-two"> <i class="bi bi-eye-slash" onclick="togglePassword(this)"></i></span>
                                                                <div class="font-weight-bold text-danger d-none" id="invalidError"></div>
                                                            </div>
                                                            <button type="button" class="btn btn-bgchecker w-100 Heebo-Regular text-white" id="loginBtn" onclick="login()">Sign in</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js?v=<?= time() ?>"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.min.js?v=<?= time() ?>"></script>
        <script src="assets/js/bamburgh.min.js?v=<?= time() ?>"></script>
        <script src="/assets/vendor/notify/js/notify.min.js"></script>
        <script src="/assets/js/app/customize.js?v=<?= time() ?>"></script>
        <script src="/assets/js/app/login.js?v=<?= time(); ?>"></script>
    </body>

    </html>
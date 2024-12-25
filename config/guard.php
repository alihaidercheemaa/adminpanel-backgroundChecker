<?php
    $isValid = $_SESSION['isValid'];
    if (!$isValid) {
        header("Location: /login");
        exit;
    }
?>
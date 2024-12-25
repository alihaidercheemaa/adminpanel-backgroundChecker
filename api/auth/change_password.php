<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT `password` FROM `users` WHERE `id` = '$user_id' AND `status` = '1' AND `is_deleted` = '0'";
        $dbobjx->query($query);
        $result = $dbobjx->single();
        if (isset($result) && $result == true) {
            if ($confirm_password == $new_password) {
                if ($result->password == $old_password) {
                    $query = "UPDATE `users` SET `password` = '$confirm_password', `updated_date` = NOW() WHERE `id` = '$user_id' AND `status` = '1' AND `is_deleted` = '0'";
                    $dbobjx->query($query);
                    $result = $dbobjx->execute($query);
                    if ($result) {
                        echo response("1", "Password changed successfully", []);
                        exit();
                    } else {
                        echo response("0", "BAD REQUEST!", []);
                        exit();
                    }
                } else {
                    echo response("0", "Old password does not match", []);
                    exit();
                }
            } else {
                echo response("0", "New Password and Confirm Password does not Matched", []);
                exit();
            }
        } else {
            echo response("0", "USER NOT FOUND!", []);
            exit();
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
        exit();
    }
#code ends
#mtech
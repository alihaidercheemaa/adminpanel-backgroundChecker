<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT u.`id`, u.`first_name`, u.`last_name`, u.`phone_no`, u.`password`, u.`service_type`, u.`plan`, u.`plan_type`, u.`email`, u.`role`, u.`status` 
                    FROM `users` u 
                    WHERE u.`email` = '$email' AND u.`status` IN ('1','0') AND u.`is_deleted` = '0'";
        $dbobjx->query($query);
        $return = $dbobjx->single();
        if ($return == true) {
            if ($password === $return->password) {
                if ($return->status) {
                    echo response(1, "Welcome! Login Successfully", $return);
                } else {
                    echo response(0, "ACCOUNT DEACTIVATED!", []);
                }
            } else {
                echo response(0, "INVALID PASSWORD!", []);
            }
        } else {
            echo response(0, "INVALID EMAIL!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code end
#mtech
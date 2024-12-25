<?php
    try {
        include("../main.php");
        validateApiRequest("GET");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT `id`, `name`, `description`, `amount`, `purchase_date` FROM `expense` WHERE `id` = '$id' AND `status` = '1' AND `is_deleted` = '0'";
        $dbobjx->query($query);
        $return = $dbobjx->single();
        if (isset($return) && $return == true) {
            echo response(1, "SUCCESSFULLY OPERATED", $return);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
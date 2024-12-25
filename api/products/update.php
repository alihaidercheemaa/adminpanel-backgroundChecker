<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "UPDATE `products` SET `name`='$name',`quantity`='$quantity',`price`='$price',`cost_price`='$cost_price',`status`='$status',`updated_date`= NOW() WHERE `id` = '$id' AND `is_deleted` = '0'";
        $dbobjx->query($query);
        $return = $dbobjx->execute();
        if ($return) {
            echo response(1, "Product #{$id} updated Successfully", []);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
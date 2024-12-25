<?php
    try {
        include("../main.php");
        validateApiRequest("GET");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT o.`id`, o.`order_date`, o.`customer_name`, o.`customer_number`, o.`quantity`, o.`shipping_charges`, o.`subtotal`, o.`total_amount`, o.`discount` 
        FROM `orders` o WHERE o.`id` = '$id' AND o.`status` = '1' AND o.`is_deleted` = '0'";
        $dbobjx->query($query);
        $orderResult = $dbobjx->single();
        if (isset($orderResult) && $orderResult == true) {
        $query = "SELECT od.`product_id`, od.`quantity`, od.`discount` FROM `order_detail` od WHERE od.`order_id` = '$id' AND od.`status` = '1' AND od.`is_deleted` = '0'";
        $dbobjx->query($query);
        $orderdetailResult = $dbobjx->resultset();
        $payload = [
            "order" => $orderResult,
            "detail" => $orderdetailResult,
        ];
            echo response(1, "SUCCESSFULLY OPERATED", $payload);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
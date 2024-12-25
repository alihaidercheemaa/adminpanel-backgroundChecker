<?php
    try {
        include("../main.php");
        validateApiRequest("GET");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT o.`id`, o.`discount`, o.`quantity`, o.`customer_name`, o.`customer_number`, o.`shipping_charges`, o.`subtotal`, o.`total_amount`, o.`order_date`, o.`payment_status`, COALESCE(SUM((od.`amount`) - (p.`cost_price` * od.`quantity`)), 0) AS `profit` 
                    FROM `orders` o 
                        LEFT JOIN `order_detail` od ON od.`order_id` = o.`id` AND od.`status` = '1' AND od.`is_deleted` = '0'
                        LEFT JOIN `products` p ON  p.`id` = od.`product_id` AND p.`status` = '1' AND p.`is_deleted` = '0'
                    WHERE o.`created_date` BETWEEN '$start_date' AND '$end_date' AND o.`status` = '1' AND o.`is_deleted` = '0'
                    GROUP BY o.`id`";
        $dbobjx->query($query);
        $return = $dbobjx->resultset();
        if (count($return) > 0 && !empty($return)) {
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
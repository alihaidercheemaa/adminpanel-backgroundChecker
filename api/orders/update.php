<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "UPDATE `orders` SET `order_date` = '$order_date', `customer_name` = '$customer_name', `customer_number` = '$customer_contact', `shipping_charges` = '$shipping_charges', `quantity` = '$quantity', `discount` = '$total_discount', `subtotal` = '$subtotal', `total_amount` = '$total_amount',`updated_date`= NOW() WHERE `id` = '$id' AND `status` = '1' AND `is_deleted` = '0'";
        $dbobjx->query($query);
        $return = $dbobjx->execute();
        if ($return) {
            foreach ($details as $value) {
                $actual_product = $value->actual_product;
                $product_id = $value->product_id;
                $product_quantity = $value->product_quantity;
                $product_amount = $value->product_amount;
                $product_discount = $value->product_discount;
                $query = "UPDATE `order_detail` SET `quantity`='$product_quantity', `amount`='$product_amount', `discount`='$product_discount', `status`='1', `updated_date`=CURRENT_DATE() WHERE `order_id`='$id' AND `product_id` ='$actual_product' AND `is_deleted` = '0'";
                $dbobjx->query($query);
                $dbobjx->execute($query);
            }
            $string = implode(',',array_column($details, 'actual_product'));
            $query = "UPDATE `order_detail` SET `status`='0', `is_deleted`='1', `updated_date`=CURRENT_DATE() WHERE `product_id` NOT IN ($string) AND `order_id`='$id'";
            $dbobjx->query($query);
            $dbobjx->execute($query);
            echo response(1, "Order #{$id} updated Successfully", []);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
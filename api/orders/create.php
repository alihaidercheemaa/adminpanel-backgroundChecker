<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "INSERT INTO `orders` (`customer_name`, `customer_number`, `order_date`, `quantity`, `shipping_charges`, `subtotal`, `total_amount`, `discount`, `status`, `is_deleted`, `created_date`) VALUES ('$customer_name', '$customer_contact', '$order_date', '$quantity', '$shipping_charges', '$subtotal', '$total_amount', '$total_discount', '1', '0', NOW())";
        $dbobjx->query($query);
        if ($dbobjx->execute()) {
            $order_id = $dbobjx->lastInsertId();
            foreach ($details as $value) {
                $product_id = $value->product_id;
                $product_quantity = $value->product_quantity;
                $queryinventory = "UPDATE `products` SET `quantity` = quantity - $product_quantity, `updated_date` = NOW() WHERE `id` = '$product_id' AND `is_deleted` = '0'";
                $dbobjx->query($queryinventory);
                $dbobjx->execute();
            }

            $query = "INSERT INTO `order_detail` (`order_id`, `product_id`, `amount`, `quantity`, `discount`, `created_date`) VALUES ";
            $valuebridge = [];
            foreach ($details as $value) {
                $product_id = $value->product_id;
                $product_quantity = $value->product_quantity;
                $product_discount = $value->product_discount;
                $product_amount = $value->product_amount;
                $valuebridge[] = "($order_id, '$product_id', '$product_amount', '$product_quantity', '$product_discount', NOW())";
            }
            $query .= implode(',', $valuebridge);
            $dbobjx->query($query);
            $dbobjx->execute($query);
            echo response(1, "Order created Successfully", []);
        } else {
            echo response(0, "Error!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
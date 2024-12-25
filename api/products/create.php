<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "INSERT INTO `products` (`name`, `quantity`, `price`, `cost_price`, `status`, `is_deleted`, `created_date`) VALUES ('$name', '$quantity', '$price', '$cost_price', '$status', '0', NOW())";
        $dbobjx->query($query);
        $return = $dbobjx->execute();
        if ($return) {
            echo response(1, "Product created Successfully", []);
        } else {
            echo response(0, "Error!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
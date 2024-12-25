<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "UPDATE `expense` SET `name`='$name',`description`='$description',`purchase_date`='$purchase_date',`amount`='$amount',`updated_date`= NOW() WHERE `id` = '$id' AND `status` = '1' AND `is_deleted` = '0'";
        $dbobjx->query($query);
        $return = $dbobjx->execute();
        if ($return) {
            echo response(1, "Expense #{$id} updated Successfully", []);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
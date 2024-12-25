<?php
    try {
        include("../main.php");
        validateApiRequest("PUT");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "UPDATE `$table` SET `$column`='$value', `updated_date` = NOW() WHERE `$reference` = '$id'";
        $dbobjx->query($query);
        $return = $dbobjx->execute();
        if ($return) {
            echo response(1, "Updated Successfully", $return);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
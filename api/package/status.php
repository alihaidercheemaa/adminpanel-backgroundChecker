<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
            extract((array) $request);  
            $query = "UPDATE `packages` SET `status`='$status',`updated_at`=NOW() WHERE `id` = '$id'";
            $dbobjx->query($query);
            if ($dbobjx->execute($query)) {
                echo response("1", "SUCCESSFULLY STATUS CHANGED", []);
            } else {
                echo response("0", "Something went wrong!", []);
            }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response("0", "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code end
#mtech
<?php
    try {
        include("../main.php");
        validateApiRequest("DELETE");
        $request = json_decode(file_get_contents('php://input'));
            extract((array) $request);  
            $query = "UPDATE `appointments` SET `status`='0', `is_deleted`='1',`updated_at`=NOW() WHERE `id` = '$id'";
            $dbobjx->query($query);
            if ($dbobjx->execute($query)) {
                echo response("1", "SUCCESSFULLY DELETED", []);
            } else {
                echo response("0", "Something went wrong!", []);
            }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response("0", "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code end
#mtech
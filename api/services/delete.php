<?php
    try {
        include("../main.php");
        validateApiRequest("DELETE");
        $request = json_decode(file_get_contents('php://input'));
            extract((array) $request);  
            $query = "UPDATE `services` SET `status`='0', `is_deleted`='1',`updated_date`=NOW() WHERE `id` = '$id'"; 
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
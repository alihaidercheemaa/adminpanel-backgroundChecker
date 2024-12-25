<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT COUNT(`id`) AS `row_count` FROM `industries` WHERE `slug` = '$slug' AND `id` != '$id'"; 
        $dbobjx->query($query);
        if(($dbobjx->single($query))->row_count > 0){
            echo response("0", "Duplicate industry title found, Please try something else.", []);
            exit();
        }
        $query = "UPDATE `industries` SET `title`='$title',`slug`='$slug',`description`='$description',`image`='$image',`updated_date`=NOW() WHERE `id` = '$id'"; 
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            echo response("1", "SUCCESSFULLY UPDATED", []);
        } else {
            echo response("0", "Something went wrong!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
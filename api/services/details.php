<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        if (!isset($request->id) || empty($request->id)) {
            echo response("0", "BAD REQUEST! INVALID ID!", []);
            exit();
        }
        $query = "SELECT `id`, `title`, `slug`, `description`, `image`,  DATE_FORMAT(created_date, '%M %d, %Y') AS `created_date` FROM `services` WHERE `id` = '$request->id' AND `is_deleted`='0' ORDER BY `id` DESC LIMIT 1";
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            $return = $dbobjx->single($query);
            $return->title = str_replace("~", "'", $return->title);
            $return->description = str_replace("~", "'", $return->description); 
            echo response("1", "SUCCESSFULLY OPERATED", $return);
        } else {
            echo response("0", "Something went wrong!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
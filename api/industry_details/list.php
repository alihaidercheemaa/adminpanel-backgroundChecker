<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        if (empty($slug) && empty($industries_id)) {
            echo response("0", "BAD REQUEST! INVALID PARAMS!", []);
            exit();
        }
        $where = '';
        if(isset($slug) && !empty($slug)){
            $where .= "AND `industries`.`slug` = '$slug'";
        }
        if(isset($industries_id) && !empty($industries_id)){
            $where .= "AND `industries_details`.`industry_id` = '$industries_id'";
        }
        $sql = "SELECT `industries_details`.`id`, `industries_details`.`industry_id`, `industries`.`title` AS `service_title`, `industries_details`.`title`, `industries_details`.`image`, `industries_details`.`description`, `industries_details`.`status` 
                    FROM `industries_details` 
                    INNER JOIN `industries` ON `industries`.`id` = `industries_details`.`industry_id` AND `industries`.`is_deleted`='0'
                    WHERE `industries_details`.`is_deleted`='0' $where";
        $dbobjx->query($sql);
        $return = $dbobjx->resultset();
        if (count($return) > 0 && !empty($return)) {
            echo response("1", "SUCCESSFULLY OPERATED", $return);
        } else {
            echo response("0", "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
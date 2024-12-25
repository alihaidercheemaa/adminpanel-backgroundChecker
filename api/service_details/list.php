<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        if (empty($slug) && empty($service_id)) {
            echo response("0", "BAD REQUEST! INVALID PARAMS!", []);
            exit();
        }
        $where = '';
        if(isset($slug) && !empty($slug)){
            $where .= "AND `services`.`slug` = '$slug'";
        }
        if(isset($service_id) && !empty($service_id)){
            $where .= "AND `service_details`.`service_id` = '$service_id'";
        }
        $sql = "SELECT `service_details`.`id`, `service_details`.`service_id`, `services`.`title` AS `service_title`, `service_details`.`title`, `service_details`.`image`, `service_details`.`description`, `service_details`.`status` 
                    FROM `service_details` 
                    INNER JOIN `services` ON `services`.`id` = `service_details`.`service_id` AND `services`.`is_deleted`='0'
                    WHERE `service_details`.`is_deleted`='0' $where";
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
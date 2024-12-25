<?php
    try {
        include("../main.php");
        validateApiRequest("GET");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $where = (isset($start_date,$end_date) && !empty($start_date) && !empty($end_date) ? "AND `created_date` BETWEEN '$start_date' AND '$end_date'" : "");
            $sql = "SELECT `id`, `slug`, `title`, `short_description`, `blog_image`,  DATE_FORMAT(blog_date, '%M %d, %Y') AS `blog_date`, `status` FROM `blogs` WHERE `is_deleted`='0' $where";
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
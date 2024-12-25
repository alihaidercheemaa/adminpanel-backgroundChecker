<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        if (!isset($request->slug) || empty($request->slug)) {
            echo response("0", "BAD REQUEST! INVALID SLUG!", []);
            exit();
        }
        $slug = trim(strtolower($request->slug));
        $query = "SELECT `id`, `slug`, `title`, `author`, `short_description`, `detailed_description`, `blog_image`,  DATE_FORMAT(blog_date, '%M %d, %Y') AS `blog_date` FROM `blogs` WHERE `slug` = '$slug' AND `is_deleted`='0' ORDER BY `id` DESC LIMIT 1";
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            $return = $dbobjx->single($query);
            $return->title = str_replace("~", "'", $return->title);
            $return->author = str_replace("~", "'", $return->author);
            $return->short_description = str_replace("~", "'", $return->short_description);
            $return->detailed_description = str_replace("~", "'", $return->detailed_description);
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
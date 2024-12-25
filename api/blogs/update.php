<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $slug = trim(strtolower($slug));
        $query = "SELECT COUNT(`id`) AS `row_count` FROM `blogs` WHERE `slug` = '$slug' AND `id` != '$id'";
        $dbobjx->query($query);
        if(($dbobjx->single($query))->row_count > 0){
            echo response("0", "Duplicate slug found, Please try something else.", []);
            exit();
        }
        $query = "UPDATE `blogs` SET `title`='$title',`slug`='$slug',`author`='$author',`short_description`='$short_description',`detailed_description`='$detailed_description',`blog_image`='$blog_image',`blog_date`='$blog_date',`updated_date`=NOW() WHERE `id` = '$id'"; 
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
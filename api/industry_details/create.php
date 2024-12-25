<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        $title = $request->title;
        $industry_id = $request->industries_id;
        $description = $request->description;
        $image = $request->image;
        $query = "SELECT COUNT(`id`) AS `row_count` FROM `industries_details` WHERE `title` = '$title'";
        $dbobjx->query($query);
        if (($dbobjx->single($query))->row_count > 0) {
            echo response("0", "Duplicate industry title found, Please try something else.", []);
            exit();
        }
        $query = "INSERT INTO `industries_details` (`industry_id`, `title`, `image`, `description`, `created_date`) VALUES ('$industry_id', '$title', '$image', '$description', NOW())";
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            echo response("1", "SUCCESSFULLY CREATED", []);
        } else {
            echo response("0", "Something went wrong!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
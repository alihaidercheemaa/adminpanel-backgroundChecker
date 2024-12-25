<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
            $title = $request->title;
            $description = $request->description;
            $image = $request->image;
            $slug = $request->slug;
            $query = "SELECT COUNT(`id`) AS `row_count` FROM `industries` WHERE `slug` = '$slug'"; 
            $dbobjx->query($query);
            if(($dbobjx->single($query))->row_count > 0){
                echo response("0", "Duplicate industry title found, Please try something else.", []);
                exit();
            }
            $query = "INSERT INTO `industries` (`title`, `slug`, `image`, `description`, `created_date`) VALUES ('$title' , '$slug', '$image', '$description', NOW())";
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
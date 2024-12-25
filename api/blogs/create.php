<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
            $slug = trim(strtolower($request->slug));
            $title = $request->title;
            $author = $request->author;
            $short_description = $request->short_description;
            $detailed_description = $request->detailed_description;
            $blog_image = $request->blog_image;
            $blog_date = $request->blog_date;
            $query = "SELECT COUNT(`id`) AS `row_count` FROM `blogs` WHERE `slug` = '$slug'";
            $dbobjx->query($query);
            if(($dbobjx->single($query))->row_count > 0){
                echo response("0", "Duplicate slug found, Please try something else.", []);
                exit();
            }
            $query = "INSERT INTO `blogs` (`title`, `slug`, `author`, `short_description`, `detailed_description`, `blog_image`, `blog_date`, `created_date`) VALUES ('$title', '$slug', '$author', '$short_description', '$detailed_description', '$blog_image', '$blog_date', NOW())";
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
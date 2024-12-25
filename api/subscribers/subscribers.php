<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "INSERT INTO `subscribers`(`email`, `created_at`) VALUES ('$email', NOW())";
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            $dbobjx->close();
            //=================================Client Email=================================
            $payload = 
                [
                "notification" => "email",
                "email" => $email,
                "subject" => "Thank You for Subscribing!",
                "message" => "Thank you for subscribing to our newsletter!"
                ];
            systemNotification($payload);
            //=================================Client Email=================================
            //=================================Admin Email=================================
            $payload = 
                [
                "notification" => "email",
                "email" => "xuhldmin@inmedsolution.com",
                "subject" => "New Subscriber!",
                "message" => "A new customer has subscribed with the email: " . $email
                ];
            systemNotification($payload);
            //=================================Admin Email=================================
            echo response(1, "SUCCESSFULLY SUBMITTED", []);
            exit;
        } else {
            echo response(0, "Something went wrong!", []);
        }
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
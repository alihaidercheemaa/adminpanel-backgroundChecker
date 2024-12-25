<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT `email` FROM `subscribers` WHERE `status` = '1' AND is_deleted = '0'";
        $dbobjx->query($query);
        $result = $dbobjx->resultset($query);
        if (count($result) > 0 && !empty($result)) {
            $dbobjx->close();
            //=================================Client Email=================================
            foreach ($result as $key => $item) {
                $payload = 
                    [
                    "notification" => "email",
                    "email" => $email,
                    "subject" => "Thank You for Subscribing!",
                    "message" => $message
                    ];
                systemNotification($payload);
            }
            //=================================Client Email=================================
            echo response(1, "SUCCESSFULLY EMAIL SEND TO SUBSCRIBERS", []);
            exit;
        } else {
            echo response(0, "NO DATA!", []);
        }
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
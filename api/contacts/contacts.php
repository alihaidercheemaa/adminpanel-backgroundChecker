<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $name = str_replace("'", "`", trim($first_name)) . ' ' . str_replace("'", "`", trim($last_name));
        $message = str_replace("'", "`", $message);
        $query = "INSERT INTO `contacts`(`name`, `phone`, `email`, `message`, `created_at`) VALUES ('$name', '$phone', '$email', '$message', NOW())";
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            $dbobjx->close();
            //=================================Client Email=================================
            $payload = 
                [
                "notification" => "email",
                "email" => $email,
                "subject" => "Thank You for Contacting Us!",
                "message" => "Dear " . $name . ",<br>".
                        "Thank you for getting in touch with us. We have received your message and will get back to you soon.<br><br>".
                        "Best regards,<br> Narayani"
                ];
            systemNotification($payload);
            //=================================Client Email=================================
            //=================================Admin Email=================================
            $payload = [
                "notification" => "email",
                "email" => "xuhldmin@inmedsolution.com",
                "subject" => "New Contact Form Submission",
                "message" => "You have received a new message from the contact form.<br>"
                            . "Details:<br><br>"
                            . "Name: " . $name . "<br>"
                            . "Email: " . $email . "<br>"
                            . "Phone: " . $phone . "<br>"
                            . "Message: " . $message
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
<?php
    try {
        include("../main.php");
        validateApiRequest("POST");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $name = str_replace("'", "`", trim($request->name));
        $date = date('Y-m-d', strtotime($request->date));
        $message = str_replace("'", "`", $request->message);
        $query = "INSERT INTO `appointments`(`name`, `phone_no`, `email`, `date`, `time`, `message`, `created_at`) VALUES ('$name', '$phone_no', '$email', '$date', '$time', '$message', NOW())";
        $dbobjx->query($query);
        if ($dbobjx->execute($query)) {
            $dbobjx->close();
            //=================================Client Email=================================
            $payload = 
                [
                "notification" => "email",
                "email" => $email,
                "subject" => "Appointment Confirmation!",
                "message" => "Dear Customer,\n\nThank you for booking your appointment with us!<br><br>".
                        "Appointment Details:<br>
                        Date: " . date('M D, Y', strtotime($date)) . "<br>
                        Time: " . $time . "<br><br>".
                        "We look forward to seeing you!"
                ];
            systemNotification($payload);
            //=================================Client Email=================================
            //=================================Admin Email=================================
          $payload = [
                "notification" => "email",
                "email" => "xuhldmin@inmedsolution.com",
                "subject" => "New Appointment Booking",
                "message" => "A new appointment has been booked:<br><br>" 
                            . "Email: " . $email . "<br>"
                            . "Phone: " . $phone_no . "<br>"
                            . "Date: " . date('M D, Y', strtotime($date)) . "<br>"
                            . "Time: " . $time . "<br>"
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
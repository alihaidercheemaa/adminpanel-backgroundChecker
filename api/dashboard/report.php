<?php
    try {
        include("../main.php");
        validateApiRequest("GET");
        $request = json_decode(file_get_contents('php://input'));
        extract((array) $request);
        $query = "SELECT COALESCE(FORMAT(COUNT(a.`id`),0),0) AS `total_appointments`
                    FROM `appointments` a 
                    WHERE a.`created_at` BETWEEN '$start_date' AND '$end_date' AND a.`status` = '1' AND a.`is_deleted` = '0'";
        $dbobjx->query($query);
        $appointmentsResult = $dbobjx->single();
        $query = "SELECT COALESCE(FORMAT(COUNT(c.`id`),0),0) AS `total_contacts`
                    FROM `contacts` c
                    WHERE c.`created_at` BETWEEN '$start_date' AND '$end_date' AND c.`status` = '1' AND c.`is_deleted` = '0'";
        $dbobjx->query($query);
        $contactResult = $dbobjx->single();
        $query = "SELECT COALESCE(FORMAT(COUNT(s.`id`),0),0) AS `total_subscribers`
                    FROM `subscribers` s 
                    WHERE s.`created_at` BETWEEN '$start_date' AND '$end_date' AND s.`status` = '1' AND s.`is_deleted` = '0'";
        $dbobjx->query($query);
        $subscribersResult = $dbobjx->single();
        $query = "SELECT COALESCE(FORMAT(COUNT(b.`id`),0),0) AS `total_blogs`
                    FROM `blogs` b 
                    WHERE b.`created_at` BETWEEN '$start_date' AND '$end_date' AND b.`status` = '1' AND b.`is_deleted` = '0'";
        $dbobjx->query($query);
        $blogsResult = $dbobjx->single();

        $query = "SELECT COALESCE(FORMAT(COUNT(p.`id`),0),0) AS `total_packages`
                    FROM `packages` p 
                    WHERE p.`created_at` BETWEEN '$start_date' AND '$end_date' AND p.`status` = '1' AND p.`is_deleted` = '0'";
        $dbobjx->query($query);
        $packagesResult = $dbobjx->single();

        $query = "SELECT COALESCE(FORMAT(COUNT(c.`id`),0),0) AS `total_credibility`
                    FROM `credibility` c 
                    WHERE c.`created_at` BETWEEN '$start_date' AND '$end_date' AND c.`status` = '1' AND c.`is_deleted` = '0'";
        $dbobjx->query($query);
        $credibilityResult = $dbobjx->single();

        if (isset($appointmentsResult)) {
            $payload = [
                "appoinntments" => $appointmentsResult,
                "contacts" => $contactResult,
                "subscribers" => $subscribersResult,
                "blogs" => $blogsResult,
                "packages" => $packagesResult,
                "credibility" => $credibilityResult
            ];
            echo response(1, "SUCCESSFULLY OPERATED", $payload);
        } else {
            echo response(0, "NO DATA!", []);
        }
        $dbobjx->close();
    } catch (Exception $error) {
        echo response(0, "API ERROR!, UNPROCESSABLE ENTITY", $error->getMessage());
    }
#code ends
#mtech
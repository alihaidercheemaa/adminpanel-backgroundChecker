<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'login':
            ($email == "" || $password == "") ? exit(json_encode(['status' => 0, 'message' => 'Please fill all the fields', 'payload' => []])) : '';
            $url = API_URL . "auth/login";
            $request = ["email" => $email, "password" => $password];
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            if ($response->status) {
                $payload = $response->payload;
                extract((array)$payload);
                $_SESSION['isValid']            = true;
                $_SESSION['id']                 = $id;
                $_SESSION['full_name']          = $first_name . ' ' . $last_name;
                $_SESSION['email']              = $email;
                $_SESSION['phone_no']           = $phone_no;
                $_SESSION['role']               = $role;
            }
            $return = ['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload];
            echo json_encode($return);
            break;
        case 'change_password':
            ($old_password == "" || $new_password == "" || $confirm_password == "") ? exit(json_encode(['status' => 0, 'message' => 'Please fill all the fields', 'payload' => []])) : '';
            $request = [
                "user_id" => $_SESSION['id'],
                "old_password" => $old_password,
                "new_password" => $new_password,
                "confirm_password" => $confirm_password
            ];
            $url = API_URL . "auth/change_password";
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            if ($response->status == 1) {
                $return = ['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload];
                session_destroy();
            } else {
                $return = ['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload];
            }
            echo json_encode($return);
            break;
        default:
            header("Location:" . $_SERVER['HTTP_REFERER']);
            break;
    }
// #code ends
// #mtech
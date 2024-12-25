<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'dashboardReport':
            $url = API_URL . "dashboard/report";
            $request = ["start_date" => trim($start_date) . ' 00:00:01', "end_date" => trim($end_date) . ' 23:59:59'];
            $result = curlFunction($url, $request, '', '', 'GET', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        default:
            header("Location:" . $_SERVER['HTTP_REFERER']);
        break;
    }
<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        // case 'manageProducts':
        //     $request = ["name" => $name, "quantity" => $quantity, "price" => $price, "cost_price" => $cost_price, "status" => $status];
        //     if ($module == "update") {
        //         $request["id"] = $id;
        //     }
        //     $url = API_URL . "products/{$module}";
        //     $result = curlFunction($url, $request, '', '', 'POST', '1');
        //     echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
        //     exit();
        //     break;
        case 'appointmentList':
            $request = [];
            $url = API_URL . "appointments/list";
            $result = curlFunction($url, $request, '', '', 'GET', '1');
            $data = [];
            $i = 1;
            $resultsCount = 0;
            $htm = '';
            if ($result->status == 1 && count($result->payload) > 0) {
                foreach ($result->payload as $row) {
                    extract((array)$row);
                    $data[] = [
                        'SNO' => $i,
                        'NAME' => ucwords($name),
                        'PHONE' => $phone_no,
                        'EMAIL' => $email,
                        'MESSAGE' => ucfirst($message),
                        'DATE' => date('M D, Y', strtotime($date)),
                        'TIME' => $time,
                        'ACTIONS' => '<div class="action-perform-btns d-flex justify-content-center">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" onclick="deleteRecord(' . $id . ')" id="row_' . $id . '"><img src="assets/images/svg/delete.svg" width="15px"></a></div>'
                    ];
                    $i++;
                    $resultsCount++;
                }
            }
            $return = [
                'iTotalRecords' => $resultsCount,
                'aaData' => $data,
            ];
            echo compressJson($return);
            break;
        case 'deleteRecord':
            $url = API_URL . "appointments/delete";
            $request = ["id" => (int) $id];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
            default:
                header("Location:" . $_SERVER['HTTP_REFERER']);
            break;
    }

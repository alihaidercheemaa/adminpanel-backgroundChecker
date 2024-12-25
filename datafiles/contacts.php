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
        case 'contactList':
            $request = [];
            $url = API_URL . "contacts/list";
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
                        'Email' => $email,
                        'PHONE' => $phone,
                        'MESSAGE' => ucfirst($message)
                        // 'STATUS' => '<div class="text-center"><span class="badge badge-' . $badge . '">' . $text . '</span></div>',
                        // 'ACTIONS' => '<div class="action-perform-btns d-flex justify-content-center">
                        //         <a href="editProducts?id=' . $id . '" id="edit_products" data-toggle="tooltip" data-original-title="Edit"><img src="assets/images/svg/edit.svg" width="15px"></a>
                        //         <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" onclick="deleteRecord(' . $id . ')" id="row_' . $id . '"><img src="assets/images/svg/delete.svg" width="15px"></a></div>'
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
        // case 'deleteRecord':
        //     $url = API_URL . "common/delete";
        //     $request = ["id" => (int) $id, "table" => "products", "column" => "is_deleted", "reference" => "id", "value" => "1"];
        //     $result = curlFunction($url, $request, '', '', 'DELETE', '1');
        //     echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
        //     break;
        //     default:
        //         header("Location:" . $_SERVER['HTTP_REFERER']);
        //     break;
    }

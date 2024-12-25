<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'manageExpense':
            $request = ["name" => $name, "description" => $description, "amount" => $amount, "purchase_date" => date('Y-m-d', strtotime($purchase_date)), "sale_price" => $sale_price];
            if ($module == "update") {
                $request["id"] = $id;
            }
            $url = API_URL . "expense/{$module}";
            $result = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            exit();
            break;
        case 'expenseList':
            $request = ["start_date" => trim($start_date) . ' 00:00:01', "end_date" => trim($end_date) . ' 23:59:59'];
            $url = API_URL . "expense/list";
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
                        'PURCHASEDATE' => date('Y-m-d', strtotime($purchase_date)),
                        'DESCRIPTION' => '<div class="max-w-180 truncate coursor-pointer" data-toggle="tooltip" data-original-title="'. ucfirst($description) .'">' . ucfirst($description) . '</div>',
                        'AMOUNT' => $amount,
                        'ACTIONS' => '<div class="action-perform-btns d-flex justify-content-center">
                                    <a href="editExpense?id=' . $id . '" id="edit_expense" data-toggle="tooltip" data-original-title="Edit"><img src="assets/images/svg/edit.svg" width="15px"></a>
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
            $url = API_URL . "common/delete";
            $request = ["id" => (int) $id, "table" => "expense", "column" => "is_deleted", "reference" => "id", "value" => "1"];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
            default:
                header("Location:" . $_SERVER['HTTP_REFERER']);
            break;
    }

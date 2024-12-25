<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'manageServices':
            $request = [
                "title" => str_replace("'", "~", $title),
                "slug" => $slug,
                "description" => str_replace("'", "~", $description),
                "image" => $image
            ];
            if ($module == 'update') {
                $request["id"] = (int)$id;
            }
            $url = API_URL . "services/{$module}";
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload]);
            exit();
            break;
        case 'servicesList':
            $url = API_URL . "services/list";
            $request = ["start_date" => trim($start_date) . ' 00:00:01', "end_date" => trim($end_date) . ' 23:59:59'];
            $response = curlFunction($url, $request, '', '', 'GET', '1');
            $data = [];
            $i = 1;
            $resultsCount = 0;
            if ($response->status == 1 && count($response->payload) > 0) {
                foreach ($response->payload as $item) {
                    extract((array)$item);
                    $checked = ($status == '1') ? 'checked' : '';
                    $action = ($status == '1') 
                    ?'
                    <a href="/serviceDetails?id=' . $id . '" id="row_' . $id . '" data-toggle="tooltip" data-original-title="Details"><img src="' . BASE_URL . '/assets/images/svg/view.svg" width="20" alt="Add Dtails"></a>
                    <a href="/updateServices?id=' . $id . '" id="row_' . $id . '" data-toggle="tooltip" data-original-title="Edit"><img src="' . BASE_URL . '/assets/images/svg/edit.svg" width="15" alt="Edit"></a>'
                     : '';
                    ;
                    $data[] = [
                        'sno' => $i,
                        'image' => $image && $image !== "none" ? '<img src="' . BASE_URL . '/assets/uploads/' . $image . '" width="50" alt="' . $image . '" class="img-fluid img-thumbnail">' : '---',
                        'title' => '<div class="max-w-120 truncate">'.ucwords(str_replace("~", "'", $title)).'</div>',
                        'status' => '<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" onclick="updateStatus(' . $id . ')" id="status_' . $id . '" ' . $checked . '>
                            <label class="custom-control-label" for="status_' . $id . '"></label>
                        </div>',
                        'actions' => '<div class="action-perform-btns d-flex justify-content-center">
                                        '.
                                        $action
                                        .'
                                        <a href="javascript:void(0);"  id="row_' . $id . '" data-toggle="tooltip" data-original-title="Delete" oncLick="deleteRecord(' . $id . ')"><img src="' . BASE_URL . '/assets/images/svg/delete.svg" width="15" alt="Delete"></a>
                                    </div>'
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
            $url = API_URL . "services/delete"; 
            $request = ["id" => (int) $id];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        case 'updateStatus':
            $url = API_URL . "services/status";
            $request = ["id" => (int) $id, "status" => $status];
            $result = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        default:
            header("Location:" . $_SERVER['HTTP_REFERER']);
            break;
    }
#code end
#mtech
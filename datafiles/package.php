<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'managePackages':
            $request = [
                "image" => $image,
            ];
            $url = API_URL . "package/create";
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload]);
            exit();
            break;
        case 'packageList':
            $url = API_URL . "package/list";
            $response = curlFunction($url, $request, '', '', 'GET', '1');
            $data = [];
            $i = 1;
            $resultsCount = 0;
            if ($response->status == 1 && count($response->payload) > 0) {
                foreach ($response->payload as $item) {
                    extract((array)$item);
                    $checked = ($status == '1') ? 'checked' : '';
                    $data[] = [
                        'sno' => $i,
                        'image' => $image && $image !== "none" ? '<img src="/assets/uploads/' . $image . '" width="50" alt="' . $image . '" class="img-fluid img-thumbnail">' : '---',
                        'status' => '<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" onclick="updateStatus(' . $id . ')" id="status_' . $id . '" ' . $checked . '>
                            <label class="custom-control-label" for="status_' . $id . '"></label>
                        </div>',
                        'actions' => '<div class="action-perform-btns d-flex justify-content-center">
                                        <a href="javascript:void(0);"  id="row_' . $id . '" data-toggle="tooltip" data-original-title="Delete" oncLick="deleteRecord(' . $id . ')"><svg viewBox="0 0 24 24" width="75" height="75" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
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
            $url = API_URL . "package/delete";
            $request = ["id" => (int) $id];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        case 'updateStatus':
            $url = API_URL . "package/status";
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
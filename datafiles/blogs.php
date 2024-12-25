<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'manageBlogs':
            $request = [
                "title" => str_replace("'", "~", $title),
                "slug" => $slug,
                "author" => str_replace("'", "~", $author),
                "short_description" => str_replace("'", "~", $short_description),
                "detailed_description" => str_replace("'", "~", $detailed_description),
                "blog_image" => $blog_image,
                "blog_date" => date('Y-m-d', strtotime($blog_date))
            ];
            if ($module == 'update') {
                $request["id"] = (int)$id;
            }
            $url = API_URL . "blogs/{$module}";
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload]);
            exit();
            break;
        case 'blogsList':
            $url = API_URL . "blogs/list";
            $request = ["start_date" => trim($start_date) . ' 00:00:01', "end_date" => trim($end_date) . ' 23:59:59'];
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
                        'image' => $blog_image && $blog_image !== "none" ? '<img src="' . BASE_URL . '/assets/uploads/' . $blog_image . '" width="50" alt="' . $blog_image . '" class="img-fluid img-thumbnail">' : '---',
                        'title' => '<div class="max-w-120 truncate">'.ucwords(str_replace("~", "'", $title)).'</div>',
                        'author' => ucwords(str_replace("~", "'", $author)),
                        'date' => $blog_date,
                        'status' => '<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" onclick="updateStatus(' . $id . ')" id="status_' . $id . '" ' . $checked . '>
                            <label class="custom-control-label" for="status_' . $id . '"></label>
                        </div>',
                        'actions' => '<div class="action-perform-btns d-flex justify-content-center">
                                        <a href="'. BASE_URL .'/blogDetails?slug=' . $slug . '" id="row_' . $id . '" data-toggle="tooltip" data-original-title="View Blog"><img src="' . BASE_URL . '/assets/images/svg/view.svg" width="20" alt="View"></a>
                                        <a href="/updateBlogs?slug=' . urlencode($slug) . '" id="row_' . $id . '" data-toggle="tooltip" data-original-title="Edit"><img src="' . BASE_URL . '/assets/images/svg/edit.svg" width="15" alt="Edit"></a>
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
            $url = API_URL . "blogs/delete";
            $request = ["id" => (int) $id];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        case 'updateStatus':
            $url = API_URL . "blogs/status";
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
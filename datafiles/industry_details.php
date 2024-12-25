<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'manageIndustryDetails':
            $request = [
                "industries_id" => (int)$industries_id,
                "title" => str_replace("'", "~", $title),
                "description" => str_replace("'", "~", $description),
                "image" => $image
            ];
            if ($module == 'update') {
                $request["id"] = (int)$id;
            }
            $url = API_URL . "industry_details/{$module}";
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $response->status, 'message' => $response->message, 'payload' => $response->payload]);
            exit();
            break;
        case 'industryDetailsList':
            $url = API_URL . "industry_details/list";
            $request = ["industries_id" => (int)$id];
            $response = curlFunction($url, $request, '', '', 'POST', '1');
            $data = [];
            $i = 1;
            $resultsCount = 0;
            if ($response->status == 1 && count($response->payload) > 0) {
                foreach ($response->payload as $item) {
                    extract((array)$item);
                    $checked = ($status == '1') ? 'checked' : '';
                    $data[] = [
                        'sno' => $i,
                        'image' => $image && $image !== "none" ? '<img src="' . BASE_URL . '/assets/uploads/' . $image . '" width="50" alt="' . $image . '" class="img-fluid img-thumbnail">' : '---',
                        'title' => '<div class="max-w-120 truncate">'.ucwords(str_replace("~", "'", $title)).'</div>',
                        'actions' => '<div class="action-perform-btns d-flex justify-content-center">
                                        <a href="javascript:void(0);" id="row_' . $id . '" data-toggle="tooltip" data-original-title="Edit" onclick="updateIndustryDetails(' . $id . ')"><img src="' . BASE_URL . '/assets/images/svg/edit.svg" width="15" alt="Edit"></a>
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
            $url = API_URL . "industry_details/delete"; 
            $request = ["id" => (int) $id];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        case 'updateIndustryDetails':
            $url = API_URL . "industry_details/details";
            $request = ["id" => (int) $id]; 
            $result = curlFunction($url, $request, '', '', 'POST', '1');
            $details = $result->payload;
            $html = '';
            $html .= '
                    <form class="industries_form" id="edit-industry-form" method="post" novalidate> 
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="modal-lable form-label">Industry Image</label>
                                    </div>
                                    <div class="dropzone dropzone-single dz-clickable dz-max-files-reached" data-toggle="dropzone-image-2" data-dropzone-url="/assets/uploads/upload" data-max-filesizee="800x503">
                                        <div class="fallback">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="dropzoneBasicUpload">
                                                <label class="custom-file-label" for="dropzoneBasicUpload"><i class="fad fa-image"></i></label>
                                            </div>
                                        </div>
                                        <div class="dz-preview dz-preview-single">
                                            <div class="dz-preview-cover"> <img class="dz-preview-img" src="/assets/uploads/'.$details->image.'" alt="..." data-dz-thumbnail id="appendImage"> </div>
                                        </div>
                                        <div id="dropzone_upload" style="z-index:0" class="dropzone_upload"> <img src="/assets/uploads/'.$details->image.'"> </div>
                                    </div>
                                    <input type="hidden" value="'.$details->image.'" class="image" id="image-2">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" required placeholder="Title" maxlength="130" value="'.$details->title.'">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Type your Industry description here..." required rows="4" cols="80" maxlength="300">'.$details->description.'</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageIndustryDetails" onclick="manageIndustryDetails(this);" data-industrydetails-id="'.$details->id.'" data-module="update">Update</a> 
                        </div>
                    </form>
            ';
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $html]);
            break;
        default:
            header("Location:" . $_SERVER['HTTP_REFERER']);
            break;
    }
#code end
#mtech
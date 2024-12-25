<?php
    $file = (isset($_FILES['file'])) ? $_FILES['file'] : $_FILES['image_file'];
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $file && $file['error'] == 0) {
            $filename = str_replace(' ', '-', pathinfo($file['name'], PATHINFO_FILENAME)); // get file name
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION); //cget file extension
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg']; // allowed extensions
            $maxFileSize = 1000000; // maxium file size 1MB
            $imgName =  $filename . time() . '.' . $extension; // new file name
            $targetPath = "./" . $imgName;

            if (!in_array($extension, $allowedExtensions)) {
                echo response(0, "Invalid file extension. Only JPG, JPEG, PNG and SVG files are allowed.", []);
                exit;
            }

            if ($file['size'] > $maxFileSize) {
                echo response(0, "Image is too large. Please upload an image with a maximum size of 1MB.", []);
                exit;
            }

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                echo response(1, $imgName, [$targetPath]);
                exit;
            } else {
                echo response(0, "Permission Denied", []);
                exit;
            }
        } else {
            echo response(0, "File Error!", []);
            exit;
        }
    } catch (Exception $error) {
        echo response('0', 'Network Error!', []);
        exit;
    }
//==============================Response==============================
function response($status, $message, $payload = [])
{
    http_response_code($status == 1 ? 200 : 400);
    return json_encode(["status" => (int)$status, "message" => $message, "payload" => $payload]);
}
//=============================Response==============================
#code end
#mtech
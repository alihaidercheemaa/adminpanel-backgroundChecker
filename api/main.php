<?php
    include($_SERVER["DOCUMENT_ROOT"] . "/config/define.php");
    include($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
    $dbobjx     = new Database;
    //==============================Response==============================
    function response($status, $message, $payload = [])
    {
        http_response_code($status == 1 ? 200 : 403);
        return json_encode(["status" => (int)$status, "message" => $message, "payload" => $payload]);
    }
    //=============================Response==============================
    function validateApiRequest($method)
    {
        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($method)) {
            echo  response(0, "Invalid request method. Expected {$method}.", []);
            exit();
        }
    }
    //=============================Encrypt password=================================
    function encryptPassword($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $hash;
    }
    //=============================Encrypt password=================================

    //=============================Verify password=================================
    function verifyPassword($password, $hash)
    {
        $isValid = password_verify($password, $hash);
        return $isValid;
    }
    //=============================Verify password=================================
    //=============================System Notification=================================
    function systemNotification($payload)
    {
        extract($payload);
        switch ($notification) {
            case 'email':
                $headers = "From: xuhldmin@inmedsolution.com\r\n";
                $headers .= "BCC: mubbitech.786@gmail.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
                mail($email, $subject, $message, $headers);
                return true;
                break;
        }
    }
    //=============================System Notification=================================
    //=============================Validate Json=================================
    function schemaValidator($data, $schema, $path = '')
    {
        static $errors = [];
        if (!isset($schema) || gettype($schema) === NULL) {
            $errors[] = [
                "property" => "Request",
                "message" => "Wrong path or invalid json."
            ];
            return json_encode(["status" => "0", "error" => $errors]);
        }
        if (!is_object($schema) && !isset($schema->properties)) {
            $errors[] = [
                "property" => "Request",
                "message" => "Invalid schema format."
            ];
            return json_encode(["status" => "0", "error" => $errors]);
        }
        if (isset($schema->properties)) {
            foreach ((array) $schema->properties as $key => $propertySchema) {
                $property = $path ? "$path.$key" : $key;
                if ($data !== NULL && is_object($data)) {
                    if (isset($data->$key)) {
                        if (gettype($data->$key) === $propertySchema->type) {
                            if ((in_array($propertySchema->type, ["string", "integer"])) && (isset($propertySchema->nullable) || trim($data->$key) || in_array($data->$key, ["0", 0]))) {
                                if (isset($propertySchema->minLength) && strlen($data->$key) < $propertySchema->minLength) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "String length is less than the minimum: {$propertySchema->minLength}"
                                    ];
                                }
                                if (isset($propertySchema->maxLength) && strlen($data->$key) > $propertySchema->maxLength) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "String length is more than the maximum: {$propertySchema->maxLength}"
                                    ];
                                }
                                if (isset($propertySchema->minimum) && $data->$key < $propertySchema->minimum) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "Value is less than the minimum: {$propertySchema->minimum}"
                                    ];
                                }
                                if (isset($propertySchema->maximum) && $data->$key > $propertySchema->maximum) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "Value is greater than the maximum: {$propertySchema->maximum}"
                                    ];
                                }
                                if (isset($propertySchema->enum) && !in_array($data->$key, $propertySchema->enum)) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "Value is not one of the allowed values: " . implode(", ", $propertySchema->enum)
                                    ];
                                }
                                if (isset($propertySchema->format)) {
                                    if ($propertySchema->format === "email" && !filter_var($data->$key, FILTER_VALIDATE_EMAIL)) {
                                        $errors[] = [
                                            "property" => $property,
                                            "message" => "Invalid email format."
                                        ];
                                    }
                                    if ($propertySchema->format === "uri" && !filter_var($data->$key, FILTER_VALIDATE_URL)) {
                                        $errors[] = [
                                            "property" => $property,
                                            "message" => "Invalid URI format."
                                        ];
                                    }
                                    if ($propertySchema->format === "phone" && !preg_match('/^03\d{9}$/', $data->$key)) {
                                        $errors[] = [
                                            "property" => $property,
                                            "message" => "Invalid phone number format."
                                        ];
                                    }
                                }
                            } elseif ($propertySchema->type === "array") {
                                if (isset($propertySchema->minItems) && count($data->$key) < $propertySchema->minItems) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "Array has fewer items than the minimum: {$propertySchema->minItems}"
                                    ];
                                }
                                if (isset($propertySchema->maxItems) && count($data->$key) > $propertySchema->maxItems) {
                                    $errors[] = [
                                        "property" => $property,
                                        "message" => "Array has more items than the maximum: {$propertySchema->maxItems}"
                                    ];
                                }
                            } else {
                                $errors[] = ["property" => $property, "message" => "Empty value found, but a {$propertySchema->type} is required."];
                            }
                        } else {
                            $errors[] = [
                                "property" => $property,
                                "message" => gettype($data->$key) . ' value found, but an ' . $propertySchema->type . ' is required.'
                            ];
                        }
                    } else {
                        if (isset($schema->required) && in_array($key, $schema->required)) {
                            $errors[] = [
                                "property" => $property,
                                "message" => "The property {$property} is required"
                            ];
                        }
                    }
                } else {
                    $errors[] = [
                        "property" => "Request",
                        "message" => gettype($data) . ' value found, but an object is required.'
                    ];
                    return json_encode(["status" => "0", "error" => $errors]);
                }
            }
        }
        return empty($errors) ? json_encode(["status" => "1", "error" => []]) : json_encode(["status" => "0", "error" => $errors]);
    }
    //=============================Validate Json=================================
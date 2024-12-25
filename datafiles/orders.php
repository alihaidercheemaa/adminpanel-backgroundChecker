<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/helpers/utility.php');
    extract($_REQUEST);
    switch ($requestType) {
        case 'manageOrders':
            $productsData = [];
            $total_discount = 0;
            $sub_total = 0;
            $total_quantity = 0;
            foreach ($details as $row) {
                $total_quantity += $row["quantity"];
                $total_discount += (isset($row["discount"]) && !empty($row["discount"]) ? $row["discount"] : 0) * $row["quantity"];
                $sub_total += $row["amount"] * $row["quantity"];
                $productDetail = [
                    "product_id" => $row["id"],
                    "product_quantity" => $row["quantity"],
                    "product_amount" => $row["amount"] * $row["quantity"],
                    "product_discount"=>(isset($row["discount"]) && !empty($row["discount"]) ? $row["discount"] : 0) * $row["quantity"]
                ];
                if ($module == "update") {
                    $productDetail["actual_product"] = $row["actual_product"];
                }
                $productsData[] = $productDetail;
            }
            $total_amount = $sub_total + $shipping_charges;
            $request = ["customer_name" => $customer_name, "customer_contact" => $customer_contact, "order_date" => date('Y-m-d',strtotime($order_date)), "quantity" => $total_quantity, "shipping_charges" => $shipping_charges, "subtotal" => $sub_total, "total_amount" => $total_amount, "total_discount" => $total_discount, "details" => $productsData];
            if ($module == "update") {
                $request["id"] = $id;
            }
            $url = API_URL . "orders/{$module}";
            $result = curlFunction($url, $request, '', '', 'POST', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            exit();
            break;
        case 'orderList':
            $request = ["start_date" => trim($start_date) . ' 00:00:01', "end_date" => trim($end_date) . ' 23:59:59'];
            $url = API_URL . "orders/list";
            $result = curlFunction($url, $request, '', '', 'GET', '1');
            $data = [];
            $i = 1;
            $resultsCount = 0;
            $htm = '';
            if ($result->status == 1 && count($result->payload) > 0) {
                foreach ($result->payload as $row) {
                    extract((array)$row);
                    switch ($payment_status) {
                        case '1':
                            $badge = 'delivered';
                            $text = 'Paid';
                            $payment_htm = '<div class="text-center"><span class="badge badge-' . $badge . '">' . $text . '</span></div>';
                            break;
                        case '0':
                            $badge = 'returned';
                            $text = 'Unpaid';
                            $payment_htm = '<div class="text-center"><span class="cursor-pointer badge badge-' . $badge . '" onclick="updateRecord(' . $id . ')">' . $text . '</span></div>';
                            break;
                    }

                    $data[] = [
                        'ORDERNO' => $id,
                        'ORDERDATE' => date('Y-m-d', strtotime($order_date)),
                        'CUSTOMERNAME' => ucwords($customer_name),
                        'CUSTOMERCONTACT' => $customer_number,
                        'QUANTITY' => $quantity,
                        'SUBTOTAL' => $subtotal,
                        'SHIPPINGCHARGES' => $shipping_charges,
                        'DISCOUNT' => $discount,
                        'TOTALAMOUNNT' => (isset($discount) && !empty($discount) && $discount > 0) ? $total_amount - $discount : $total_amount,
                        'PROFIT' => $profit,
                        'PAYMENTSTATUS' => $payment_htm,
                        'ACTIONS' => '<div class="action-perform-btns d-flex justify-content-center">
                                <a href="editOrder?id=' . $id . '" id="edit_order" data-toggle="tooltip" data-original-title="Edit"><img src="assets/images/svg/edit.svg" width="15px"></a>
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
            $request = ["id" => (int) $id, "table" => "orders", "column" => "is_deleted", "reference" => "id", "value" => "1"];
            $result = curlFunction($url, $request, '', '', 'DELETE', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        case 'updateRecord':
            $url = API_URL . "common/update";
            $request = ["id" => (int) $id, "table" => "orders", "column" => "payment_status", "reference" => "id", "value" => "1"];
            $result = curlFunction($url, $request, '', '', 'PUT', '1');
            echo json_encode(['status' => $result->status, 'message' => $result->message, 'payload' => $result->payload]);
            break;
        default:
            break;
    }

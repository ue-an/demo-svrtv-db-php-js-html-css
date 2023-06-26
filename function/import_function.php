<?php
// require_once('connect.php');
require_once '../connect.php';
require '../users_table/check_dup_users.php';
require '../users_table/is_first_email.php';
require '../events_table/check_dup_events_orders.php';
require '../events_table/check_dup_events_ticket.php';
require '../feastmercyministry_table/check_dup_fmm.php';
require '../holyweek_retreat_table/check_dup_holyweek_retreat.php';
require '../feastph_table/check_dup_feastph.php';
require '../feastmedia_table/check_dup_feastmedia.php';
require '../feastapp_table/check_dup_feastapp.php';
require '../feastbooks_table/check_dup_feastbook_products.php';
require '../feastbooks_table/check_dup_feastbook_orders.php';
require '../feastbooks_table/check_dup_feastbook_transactions.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

function importFunction($p_conn, $p_table, $p_filename, $p_idprefix) {

    if(!empty($_FILES[$p_filename])){
        // $fileName = $_FILES[$p_filename]['name'];
        // $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
        // $allowed_ext = ['xls', 'csv', 'xlsx'];
        $fileName = $_FILES[$p_filename]['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed_ext = ['xls','csv', 'xlsx'];
    
        if (in_array($file_ext, $allowed_ext)) {
            $targetPath = $_FILES[$p_filename]['tmp_name'];
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($targetPath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            unset($sheetData['0']);

                /* USERS */
                if ($p_table === "users") {
                    foreach ($sheetData as $row) {
                        $email = strtolower($row['0']);
                        $attendee_name = strtolower($row['1']);
                        $arr_att_name = explode(" ",$attendee_name);
                        $firstname = count($arr_att_name) == 3 ? $arr_att_name[0].' '.$arr_att_name[1] : $arr_att_name[0];
                        $arr_length = count($arr_att_name)-1;
                        $lastname = $arr_att_name[$arr_length];
                        $mobile_number = $row['2'];
                        $int = (int)$mobile_number;
                        $isFeastAttendee = 0;
                        $feastName = $row['3'];
                        $district = $row['4'];
                        $address = $row['5'];
                        $city = $row['6'];
                        $country = $row['7'];

                        $not_first_email = notFirstEmail($p_conn, $email);
                        if ($not_first_email) {
                            $isBonafied = "1";
                        } else {
                            $isBonafied = "0";
                        }

                        $userID = uniqid($p_idprefix);
            
                        $user_exist = userExist($p_conn, $email, $lastname, $firstname);
                        if ($user_exist === false) {
                            $sql = "INSERT INTO attendees (user_id, email, last_name, first_name, mobile_no, is_bonafied, is_feast_attendee, feast_name, feast_district, address, city, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ssssssssssss",$userID, $email, $lastname, $firstname, $mobile_number, $isBonafied, $isFeastAttendee, $feastName, $district, $address, $city, $country);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                        } else {
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    }
                }
                /* END OF USERS */

                //events_orders
                if ($p_table === "events_orders") {
                    foreach ($sheetData as $row) {
                        $orderno_init = $row['0'];
                        $receiptno_init = $row['1'];
                        
                        $orderStatus = $row['2'];
                        $startOrderDate = $row['3'];
                        $endOrderDate = $row['4'];
                        $payMethod = $row['5'];

                        $eventsOrders_exist = eventsOrdersExist($p_conn, $orderno_init, $receiptno_init);
                        if ($eventsOrders_exist === false) {
                            $sql = "INSERT INTO events_orders (order_no, receipt_no, order_status, order_created_date, order_completed_date, pay_method) VALUES ( ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                exit();
                            }
                            //both is null
                            if (is_null($receiptno_init) && is_null($orderno_init)) {    
                                $orderNo = uniqid("ordno-gen-");
                                $receiptNo = uniqid("rcptno-gen-");
                                mysqli_stmt_bind_param($stmt,"ssssss",$orderNo, $receiptNo, $orderStatus, $startOrderDate, $endOrderDate, $payMethod);
                                mysqli_stmt_execute($stmt);
                                // mysqli_stmt_close($stmt);
                            }

                            //one is null
                            if (is_null($receiptno_init) || is_null($orderno_init)) {
                                if (is_null($orderno_init)) {
                                    $orderNo = uniqid("ordno-gen-");
                                    mysqli_stmt_bind_param($stmt,"ssssss",$orderNo, $receiptno_init, $orderStatus, $startOrderDate, $endOrderDate, $payMethod);
                                    mysqli_stmt_execute($stmt);
                                    // mysqli_stmt_close($stmt);
                                }
                                if (is_null($receiptno_init)) {
                                    $receiptNo = uniqid("rcptno-gen-");
                                    mysqli_stmt_bind_param($stmt,"ssssss",$orderno_init, $receiptNo, $orderStatus, $startOrderDate, $endOrderDate, $payMethod);
                                    mysqli_stmt_execute($stmt);
                                    // mysqli_stmt_close($stmt);
                                }
                            }

                            //both not null
                            if ($orderno_init !== "" && $receiptno_init !== "") {
                                mysqli_stmt_bind_param($stmt,"ssssss",$orderno_init, $receiptno_init, $orderStatus, $startOrderDate, $endOrderDate, $payMethod);
                                mysqli_stmt_execute($stmt);
                                // mysqli_stmt_close($stmt);
                            }

                            //check if orderno is null
                            // mysqli_stmt_bind_param($stmt,"ssssss",$orderno_init, $receiptno_init, $orderStatus, $startOrderDate, $endOrderDate, $payMethod);
                            // mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                            echo json_encode($resp);
                        } else {
                            $resp['status'] = 'success';
                        }   
                    }
                }
                //events_tickets
                if ($p_table === "events_ticket") {
                    foreach ($sheetData as $row) {
                        $ticketID = uniqid($p_idprefix);
                        $eventID = $row['0'];
                        $ticketType = $row['1'];
                        $ticketName = $row['2'];
                        $ticketCost = $row['3'];

                        $eventsTicket_exist = eventsTicketExist($p_conn,$ticketID);
                            if ($eventsTicket_exist === false) {
                                $sql = "INSERT INTO events_tickets (ticket_id, event_id, ticket_type, ticket_name, ticket_cost) VALUES ( ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"sssss",$ticketID, $eventID, $ticketType, $ticketName, $ticketCost);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if ($sql) {
                                $resp['status'] = 'success';
                            }
                            echo json_encode($resp);
                        } else {
                            $resp['status'] = 'success';
                            $resp['msg'] = 'An error occured while saving the data. Error: '.$p_conn->error;
                        }
                        
                        
                    }
                }

                /* FEAST MERCY MINISTRY (FMM) */
                if ($p_table === "fmm") {
                    foreach ($sheetData as $row) {
                        $fmmID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $donorType = $row['1'];
                        $donationStart = strtolower($row['2']);
                        $donationEnd = strtolower($row['3']);
                        $amount = strtolower($row['4']);
                        $payMethod = strtolower($row['5']);
                       
                        $fmm_exist = fmmExist($p_conn, $userID, $address);
                        if ($fmm_exist === false) {
                            $sql = "INSERT INTO feastmercyministry_records (fmm_id, user_id, donor_type, donation_start_date, donation_end_date, amount, pay_method) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"sssssss",$fmmID, $userID, $donorType, $donationStart, $donationEnd, $amount, $payMethod);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                            echo json_encode($resp);
                        } else {
                            $resp['status'] = 'success';
                        } 
                    }
                }
                /* END OF FMM */

                /* HWR */
                if ($p_table === "hwr") {
                    foreach ($sheetData as $row) {
                        $holyweekID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $eventDate = strtolower($row['1']);
                       
                        $hwr_exist = holyweekExist($p_conn, $userID);
                        if ($hwr_exist === false) {
                            $sql = "INSERT INTO holyweekretreat_records (hwr_id, user_id, event_date) VALUES (?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"sss",$holyweekID, $userID, $eventDate);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                            echo json_encode($resp);
                        } else {
                            $resp['status'] = 'success';
                        }
                        
                    }
                }
                /* END OF HWR */

                /* FEASTPH */
                if ($p_table === "feastph") {
                    foreach ($sheetData as $row) {
                        $feastphID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $fileName = strtolower($row['1']);
                        $fileDownloadDate = strtolower($row['2']);
                        $feastph_exist = feastphExist($p_conn, $userID);
                        if ($feastph_exist === false) {
                            $sql = "INSERT INTO feastph_records (feastph_id, user_id, file_name, file_download_date) VALUES (?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ssss",$feastphID, $userID, $fileName, $fileDownloadDate);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                        } else {
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    }
                }
                 /* END OF FEASTPH */

                 /* FEASTMEDIA */
                 if ($p_table === "feastmedia") {
                    foreach ($sheetData as $row) {
                        $feastmediaID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $eventName = strtolower($row['1']);
                        $ticketType = strtolower($row['2']);
                        $eventType = strtolower($row['3']);
                        $eventDate = strtolower($row['4']);
                        $ticketCost = strtolower($row['5']);
                       
                        $feastmedia_exist = feastmediaExist($p_conn, $userID);
                        if ($feastmedia_exist === false) {
                            $sql = "INSERT INTO feastmedia_records (feast_media_event_id, user_id, event_name, ticket_type, event_type, event_date, ticket_cost) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"sssssss",$feastmediaID, $userID, $eventName, $ticketType, $eventType, $eventDate, $ticketCost);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                        } else {
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    }
                 }
                 /* END OF FEASTMEDIA */
                
                /* FEASTAPP */
                if ($p_table === 'feastapp') {
                    foreach ($sheetData as $row) {
                        $feastappID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $downloadDate = $row['1']; //format: yyyy-mm-dd
                        $feastapp_exist = feastappExist($p_conn, $userID, $downloadDate);
                        if ($feastapp_exist === false) {
                            $sql = "INSERT INTO feastapp_records (feastapp_id, user_id, date_downloaded) VALUES (?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"sss",$feastappID, $userID, $downloadDate);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }    
                        }
                        else {
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    }
                 }
            /* END OF FEASTAPP */

            /* FEAST BOOKS */
            //feastbooks products
            if ($p_table === "feastbooks_products") {
                foreach ($sheetData as $row) {
                    $productID = uniqid($p_idprefix);
                    $productName = $row['0'];
                    $cost = $row['1'];
                    $variation = $row['2'];
                    $category = $row['3'];

                    $feastbookProduct_exist = feastbookProductsExist($p_conn, $productName);
                    if ($feastbookProduct_exist === false) {
                        $sql = "INSERT INTO feastbooks_products (product_id, product_name, cost, variation, category) VALUES ( ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($p_conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"sssss",$productID, $productName, $cost, $variation, $category);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        if($sql){
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    } else {
                        $resp['status'] = 'success';
                    }   
                }
            }
            //feastbooks orders
            if ($p_table === "feastbooks_orders") {
                foreach ($sheetData as $row) {
                    $orderID = uniqid($p_idprefix);
                    $orderStatus = $row['0'];
                    $orderCreated = $row['1'];
                    $orderCompleted = $row['2'];
                    
                    $feastbookOrder_exist = feastbookOrdersExist($p_conn, $orderID);
                    if ($feastbookOrder_exist === false) {
                        $sql = "INSERT INTO feastbooks_orders (order_id, order_status, order_created, order_completed) VALUES ( ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($p_conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"ssss",$orderID, $orderStatus, $orderCreated, $orderCompleted);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        if($sql){
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    } else {
                        $resp['status'] = 'success';
                    }   
                }
            }
            //feastbooks transactions
            if ($p_table === "feastbooks_transactions") {
                foreach ($sheetData as $row) {
                    $feastbookID = uniqid($p_idprefix);
                    $orderID = $row['0'];
                    $productID = $row['1'];
                    $userID = $row['2'];
                    $quantity = $row['3'];
                    
                    $feastbookTransaction_exist = feastbookTransactionsExist($p_conn, $orderID, $productID, $userID);
                    if ($feastbookTransaction_exist === false) {
                        $sql = "INSERT INTO feastbooks_transactions (feastbook_id, order_id, product_id, user_id, quantity) VALUES ( ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($p_conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"sssss",$feastbookID, $orderID, $productID, $userID, $quantity);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        if($sql){
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    } else {
                        $resp['status'] = 'success';
                    }   
                }
            }
                 
            /* END OF FEAST BOOKS */
        }
    }
}
?>
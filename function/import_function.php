<?php
// require_once('connect.php');
require_once '../connect.php';
require '../users_table/check_dup_users.php';
require '../users_table/is_first_email.php';
require '../feastph_table/check_dup_feastph.php';
require '../feastmedia_table/check_dup_feastmedia.php';
require '../holyweek_table/check_dup_holyweek.php';
require '../feastmercyministries_table/check_dup_anawim.php';
require '../feastapp_table/check_dup_feastapp.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

function importFunction($p_conn, $p_table, $p_filename, $p_idprefix) {

    if(!empty($_FILES[$p_filename])){
        $fileName = $_FILES[$p_filename]['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed_ext = ['xls', 'csv', 'xlsx'];
    
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
                        $isFeastAttendee = "";
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
                            $sql = "INSERT INTO users (user_id, email, last_name, first_name, mobile_no, is_bonafied) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ssssss",$userID, $email, $lastname, $firstname, $mobile_number, $isBonafied);
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
    
                /* EVENTS */
                //events
                if ($p_table === "events") {
                    foreach ($sheetData as $row) {
                       
                        if ($sql) {
                            $resp['status'] = 'success';
                        } else {
                            $resp['status'] = 'failed';
                            $resp['msg'] = 'An error occured while saving the data. Error: '.$p_conn->error;
                        }
                    }
                }

                //events_orders
                if ($p_table === "events_orders") {
                    foreach ($sheetData as $row) {
                        $eventID = uniqid($p_idprefix);
                        
                        $orderno_init = $row['0'];
                        $receiptno_init = $row['1'];
                        
                        $userID = $row['2'];
                        $transactionDate = $row['3'];
                        $transactionAmount = $row['4'];
                        $eventName = ['5'];
                        $ticketType = $row['6'];
                        $eventType = $row['7'];
                        $paymentMethod = $row['8'];

                        $sql = "INSERT INTO events_orders (order_no, receipt_no, event_id, ticket_id, order_status, order_created_date, order_completed_date, pay_method) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($p_conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            exit();
                        }
                        //check if receiptno is null
                        if (is_null($receiptno_init) && is_null($orderno_init)) {
                            if (str_contains($eventType, 'feast')) {
                                $orderNo = uniqid("fc-ordgen-");
                                $receiptNo = uniqid("fc-rcptgen-");
                            }
                            if (str_contains($eventType, 'jewels')) {
                                $orderNo = uniqid("jc-ordgen-");
                                $receiptNo = uniqid("jc-rcptgen-");
                            }
                            mysqli_stmt_bind_param($stmt,"ssss",$userID, $eventID, $eventName, $eventType);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                        if (is_null($receiptno_init) || is_null($orderno_init)) {
                            if (is_null($orderno_init)) {
                                if (str_contains($eventType, 'feast')) {
                                    $orderNo = uniqid("fc-im-");
                                }
                                if (str_contains($eventType, 'jewels')) {
                                    $orderNo = uniqid("jc-im-");
                                }
                                mysqli_stmt_bind_param($stmt,"ssssssss",$orderNo, $receiptno_init, $userID, $transactionDate, $transactionAmount, $eventName, $ticketType, $eventType, $paymentMethod);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                            }
                            if (is_null($receiptno_init)) {
                                if (str_contains($eventType, 'feast')) {
                                    $receiptNo = uniqid("fc-rcptgen-");
                                }
                                if (str_contains($eventType, 'jewels')) {
                                    $receiptNo = uniqid("jc-rcptgen-");
                                }
                                mysqli_stmt_bind_param($stmt,"sssssssss",$orderno_init, $receiptNo, $userID, $transactionDate, $transactionAmount, $eventName, $ticketType, $eventType, $paymentMethod);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                            }
                        }
                        if ($orderno_init !== "" && $receiptno_init !== "") {
                            mysqli_stmt_bind_param($stmt,"sssssssss",$orderno_init, $receiptno_init, $userID, $transactionDate, $transactionAmount, $eventName, $ticketType, $eventType, $paymentMethod);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }

                        //check if orderno is null
                        // mysqli_stmt_bind_param($stmt,"sssssssss",$orderno_init, $receiptno_init, $userID, $transactionDate, $transactionAmount, $eventName, $ticketType, $eventType, $paymentMethod);
                        // mysqli_stmt_execute($stmt);
                        // mysqli_stmt_close($stmt);
                        if ($sql) {
                            $resp['status'] = 'success';
                        } else {
                            $resp['status'] = 'failed';
                            $resp['msg'] = 'An error occured while saving the data. Error: '.$p_conn->error;
                        }
                    }
                }
                //events_ticket
                if ($p_table === "events_ticket") {
                    foreach ($sheetData as $row) {
                        $ticketID = uniqid($p_idprefix);
                        $ticketType = $row['0'];
                        $ticketName = $row['1'];
                        $ticketCost = $row['2'];
                        
                        $sql = "INSERT INTO events_ticket (ticket_id, ticket_type, ticket_name, ticket_cost) VALUES ( ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($p_conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"ssss",$ticketID, $ticketType, $ticketName, $ticketCost);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        if ($sql) {
                            $resp['status'] = 'success';
                        } else {
                            $resp['status'] = 'failed';
                            $resp['msg'] = 'An error occured while saving the data. Error: '.$p_conn->error;
                        }
                    }
                }
                /* END OF EVENTS */

                /* ANAWIM / FEAST MERCY MINISTRY */
                if ($p_table === "fmm") {
                    foreach ($sheetData as $row) {
                        $anawimID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $donorType = $row['1'];
                        $donationStart = strtolower($row['2']);
                        $donationEnd = strtolower($row['3']);
                        $amount = strtolower($row['4']);
                        $payMethod = strtolower($row['5']);
                       
                        // $anawim_exist = anawimExist($p_conn, $userID, $address);
                        // if ($anawim_exist === false) {
                            $sql = "INSERT INTO feastmercyministry (fmm_id, user_id, donor_type, donation_start_date, donation_end_date, amount, pay_method) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"sssssss",$anawimID, $userID, $donorType, $donationStart, $donationEnd, $amount, $payMethod);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if($sql){
                                $resp['status'] = 'success';
                            }
                            echo json_encode($resp);
                        // } else {
                        //     $resp['status'] = 'success';
                        // } 
                    }
                }
                /* END OF ANAWIM */

                /* HOLYWEEK */
                if ($p_table === "hwr") {
                    foreach ($sheetData as $row) {
                        $holyweekID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $eventDate = strtolower($row['1']);
                       
                        $holyweek_exist = holyweekExist($p_conn, $userID);
                        if ($holyweek_exist === false) {
                            $sql = "INSERT INTO holyweekretreat (hwr_id, user_id, event_date) VALUES (?, ?, ?)";
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
                        } else {
                            $resp['status'] = 'success';
                        }
                        echo json_encode($resp);
                    }
                }
                /* END OF HOLYWEEK */

                /* FEASTPH */
                if ($p_table === "feastph") {
                    foreach ($sheetData as $row) {
                        $feastphID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $fileName = strtolower($row['1']);
                        $fileDownloadDate = strtolower($row['2']);
                        $feastph_exist = feastphExist($p_conn, $userID);
                        if ($feastph_exist === false) {
                            $sql = "INSERT INTO feastph (feastph_id, user_id, file_name, file_download_date) VALUES (?, ?, ?, ?)";
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
                       
                        $feastmedia_exist = feastmediaExist($p_conn, $userID);
                        if ($feastmedia_exist === false) {
                            $sql = "INSERT INTO feastmedia (feast_media_event_id, user_id, event_name, ticket_type, event_type, event_date, ticket_cost, no_of_tickets_bought, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ssssssss",$feastmediaID, $userID);
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
                            $sql = "INSERT INTO feastapp (feastapp_id, user_id, date_downloaded) VALUES (?, ?, ?)";
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
        }
    }
}
?>
<?php
// require_once('connect.php');
require_once '../connect.php';
require '../users_table/check_dup_users.php';
require '../users_table/is_first_email.php';
require '../feastph_table/check_dup_feastph.php';
require '../feastmedia_table/check_dup_feastmedia.php';
require '../holyweek_table/check_dup_holyweek.php';
require '../anawim_table/check_dup_anawim.php';
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
                        $isBonafied = "";
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
                            $sql = "INSERT INTO users (userID, email, lastname, firstname, mobile, isBonafied) VALUES (?, ?, ?, ?, ?, ?)";
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
    
                /* EVENT */
                // if ($p_table === "event") {
                //     foreach ($sheetData as $row) {
                //         $orderNo = uniqid("");
                //         $receiptNo = uniqid("");
                //         $orderno_init = $row['0'];
                //         $receiptno_init = $row['1'];
                //         $userID = $row['2'];
                //         $transactionDate = $row['3'];
                //         $transactionAmount = $row['4'];
                //         $eventName = ['5'];
                //         $ticketType = $row['6'];
                //         $eventType = $row['7'];
                //         $paymentMethod = $row['8'];
                //         $sql = "INSERT INTO events (orderNo, receiptNo, userID, transactionDate, transactionAmount, eventName, ticketType, eventType, paymentMethod) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                //         $stmt = mysqli_stmt_init($p_conn);
                //         if (!mysqli_stmt_prepare($stmt, $sql)) {
                //             exit();
                //         }
                //         mysqli_stmt_bind_param($stmt,"sssssssss",$orderno_init, $receiptno_init, $userID, $transactionDate, $transactionAmount, $eventName, $ticketType, $eventType, $paymentMethod);
                //         mysqli_stmt_execute($stmt);
                //         mysqli_stmt_close($stmt);
                //         if ($sql) {
                //             $resp['status'] = 'success';
                //         } else {
                //             $resp['status'] = 'failed';
                //             $resp['msg'] = 'An error occured while saving the data. Error: '.$p_conn->error;
                //         }
                //     }
                // }
                /* END OF EVENT */

                /* ANAWIM */
                if ($p_table === "anawim") {
                    foreach ($sheetData as $row) {
                        $anawimID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                        $monthlyDonation = $row['1'];
                        $category = strtolower($row['2']);
                       
                        // $anawim_exist = anawimExist($p_conn, $userID, $address);
                        // if ($anawim_exist === false) {
                            $sql = "INSERT INTO anawim (anawimID, userID, monthlyDonation, category) VALUES (?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ssss",$anawimID, $userID, $monthlyDonation, $category);
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
                if ($p_table === "holyweek") {
                    foreach ($sheetData as $row) {
                        $holyweekID = uniqid($p_idprefix);
                        $userID = strtolower($row['0']);
                       
                        $holyweek_exist = holyweekExist($p_conn, $userID);
                        if ($holyweek_exist === false) {
                            $sql = "INSERT INTO holyweekretreat (holyweekretreatID, userID) VALUES (?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ss",$holyweekID, $userID);
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
                        $feastph_exist = feastphExist($p_conn, $userID);
                        if ($feastph_exist === false) {
                            $sql = "INSERT INTO feastph (feastphID, userID) VALUES (?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ss",$feastphID, $userID);
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
                            $sql = "INSERT INTO feastmedia (feastmediaID, userID) VALUES (?, ?)";
                            $stmt = mysqli_stmt_init($p_conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ss",$feastmediaID, $userID);
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
                            $sql = "INSERT INTO feastapp (feastappID, userID, downloadDate) VALUES (?, ?, ?)";
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
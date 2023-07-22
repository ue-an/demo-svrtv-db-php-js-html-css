<?php
// require_once('connect.php');
require_once '../connect.php';
require '../users_table/check_dup_users.php';
require '../users_table/is_first_email.php';
require '../events_table/check_dup_events_ticket.php';
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

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css">
    <title>会議室・備品予約システム</title>
    <?php
        require_once('include/db_connect.php');
        session_start();
    ?>
</head>
<?php include(dirname(__FILE__). '/include/header.php'); ?>
<body>
    <h2>予約情報確認ページ</h2>
    <?php

        $registant_inp = "";
        $date_inp = "";
        $start_inp = "";
        $finish_inp = "";
        $num_of_people_inp = "";
        $purpose_inp = "";
        $code = 0;

        $conf_room_inp = "";
        $equipment_inp = "";
        $equipment_num_inp = "";

        if(isset($_POST["ok"]))
        {
            $registant_inp = $_SESSION['registant'];
            $conf_room_inp = $_SESSION['conf_room'];
            $equipment_inp = $_SESSION['equipment'];
            $equipment_num_inp = $_SESSION['equipment_num'];
            $date_inp = $_SESSION['date'];
            $start_inp = $_SESSION['start'];
            $finish_inp = $_SESSION['finish'];
            $num_of_people_inp = $_SESSION['num_of_people'];
            $purpose_inp = $_SESSION['purpose'];
            $status_inp = "reserved";
            $code = 0;
            
            $connect = connect_db();
            $stmt_reservation = $connect->prepare("INSERT INTO reservation VALUES(:code, :rsv_date, :rsv_start, :rsv_finish, :rsv_redistrant, :rsv_num_of_people)");
            $stmt_conference_room = $connect->prepare("INSERT INTO conference VALUES(:rsv_conf_room)");
            $stmt_equipment = $connect->prepare("INSERT INTO equipment VALUES(:rsv_equipment, :rsv_equipment_num)");

            $stmt_reservation -> bindParam(":rsv_redistrant", $redistrant_inp, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":rsv_date", $date_inp, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":rsv_start", $start_inp, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":rsv_finish", $finish_inp, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":rsv_num_of_people", $num_of_people_inp, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":rsv_purpose", $purpose_inp, PDO::PARAM_STR);

            $stmt_conference_room -> bindParam(":rsv_conf_room", $conf_room_inp, PDO::PARAM_STR);
            $stmt_equipment -> bindParam(":rsv_equipment", $equipment_inp, PDO::PARAM_STR);
            $stmt_equipment -> bindParam(":rsv_equipment_num", $equipment_num_inp, PDO::PARAM_INT);
            
            /*$stmt_reservation -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_conference_room ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_equipment -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
            
            try
            {
                $count_query = $connect -> query("SELECT * FROM reservation");
                $count = $count_query -> rowCount();
                $code = $count * 1;
                $stmt_reservation -> execute();
                $stmt_conference -> execute();
                $stmt_equipment -> execute();
                header("Location: reservation.php");
                exit();
            }
            catch(PDOException $e)
            {
                exit($e->getMessage());
            }
        }
        else
        {

            if(input_check($registant_inp, 'registrant') and input_check($date_inp, 'date') and
                    input_check($start_inp, 'start') and input_check($finish_inp, 'finish') and 
                    input_check($num_of_people_inp, 'num_of_people') and input_check($purpose_inp, 'purpose'))
                {
                    $_SESSION['registant'] = $registant_inp;
                    $_SESSION['date'] = $date_inp;
                    $_SESSION['start'] = $start_inp;
                    $_SESSION['finish'] = $finish_inp;
                    $_SESSION['num_of_people'] = $num_of_people_inp;
                    $_SESSION['purpose'] = $purpose_inp;

                    print "<h1></h1>";
                    print "<p>利用者名:". $registant_inp. "</p>";
                    print "<p>会議室:". $date_inp. "</p>";
                    print "<p>備品:". $start_inp. "</p>";
                    print "<p>備品数:". $finish_inp. "</p>";
                    print "<p>予約日:". $num_of_people_inp. "</p>";
                    print "<p>予約時間:". $first_inp. "~" . $finish_inp."</p>";
                    print "<p>人数:". $num_of_people_inp. "</p>";
                    print "<p>目的:". $purpose_inp. "</p>";
                    
                    print "上記の情報で予約しますか？";
                    print "<form  method=\"post\">\n";
                    print "<input type=\"submit\" formaction=\"index.php\" name=\"ok\" value=\"はい\">\n";
                    print "<input type=\"submit\" formaction=\"reservation.php\"value=\"いいえ\">\n";
                    print "</form>\n";
                }
                else
                {
                    //header("Location: reservation.php");
                    exit();
                }
        }
    ?>
</body>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
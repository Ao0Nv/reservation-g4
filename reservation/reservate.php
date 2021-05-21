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

        function input_check_b(&$input, $key)
        {
            if(isset($_POST[$key]))
            {
                $input = preg_replace('/[^()ぁ-んァ-ヶｦ-ﾟ一-龠０-９a-zA-Z0-9\-]/', '', $_POST[$key]); 

                return true;
            }
            else
            {
                return false;
            }
        }
    ?>
</head>
<?php include(dirname(__FILE__). '/include/header.php'); ?>
<main>
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

        print "<p>利用者名:". $_SESSION['registant']. "</p>";

        

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
            $status = "wait";
            $code = 0;

            $connect = connect_db();

            //$sql = "INSERT INTO reservation VALUES(:code, :date, :start, :finish, :redistrant, :num_of_people, :purpose, :status)";
            
            $stmt = $connect->prepare("INSERT INTO reservation VALUES(:code, :date, :start, :finish, :redistrant, :num_of_people, :purpose, :status)");
            
            
            $stmt -> bindParam(":code", $code, PDO::PARAM_STR);
            $stmt -> bindParam(":date", $date_inp, PDO::PARAM_STR);
            $stmt -> bindParam(":start", $start_inp, PDO::PARAM_STR);
            $stmt -> bindParam(":finish", $finish_inp, PDO::PARAM_STR);
            $stmt -> bindParam(":redistrant", $redistrant_inp, PDO::PARAM_STR);
            $stmt -> bindParam(":num_of_people", $num_of_people_inp, PDO::PARAM_INT);
            $stmt -> bindParam(":purpose", $purpose_inp, PDO::PARAM_STR);
            $stmt -> bindParam(":status", $status, PDO::PARAM_STR);
            

            $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        
            try
            {
                $count_query = $connect -> query("SELECT * FROM reservation");
                $count = $count_query -> rowCount();
                $code = $count * 1;
                
                $stmt -> execute();

                header("Location: reservation.php");
                exit();
                
            }
            catch (PDOException $e)
            {
                exit($e->getMessage());
            }

        }
        else
        {
            if(1/*input_check_b($registant_inp, 'registrant') and input_check_b($date_inp, 'date') and
                    input_check_b($start_inp, 'start') and input_check_b($finish_inp, 'finish') and 
                    input_check_b($num_of_people_inp, 'num_of_people') and input_check_b($purpose_inp, 'purpose') and
                    input_check_b($status_inp, 'status')*/)
            {
                $_SESSION['registant'] = $registant_inp;
                $_SESSION['date'] = $date_inp;
                $_SESSION['start'] = $start_inp;
                $_SESSION['finish'] = $finish_inp;
                $_SESSION['num_of_people'] = $num_of_people_inp;
                $_SESSION['purpose'] = $purpose_inp;
                $_SESSION['status'] = $status_inp;
            

                print "<br>";
                print "<h1></h1>";
                print "<p>利用者名:". $_SESSION['registant']. "</p>";
                print "<p>会議室　:". $_SESSION['conf_room']. "</p>";
                print "<p>備品　　:". $_SESSION['equipment']. "</p>";
                print "<p>備品数　:". $_SESSION['equipment_num']. "</p>";
                print "<p>予約日　:". $_SESSION['date']. "</p>";
                print "<p>予約時間:". $_SESSION['start']. "~" . $_SESSION['finish']."</p>";
                print "<p>人数　　:". $_SESSION['num_of_people']. "</p>";
                print "<p>目的　　:". $_SESSION['purpose']. "</p>";

                print "<br>";

                print "上記の情報で予約しますか？";
                print "<form  method=\"post\">\n";
                print "<input type=\"submit\" formaction=\"reservate.php\" name=\"ok\" value=\"はい\">\n";
                print "<input type=\"submit\" formaction=\"reservation.php\"value=\"いいえ\">\n";
                print "</form>\n";
            }
            else
            {
                header("Location: reservation.php");
                exit();
            }
        }
        $connect = null;
    ?>
</main>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
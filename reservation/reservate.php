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
        
            $code = 1;

            $connect = connect_db();

            $sql = "INSERT INTO reservation VALUES(:code_rsv, :date_rsv, :start_rsv, :finish_rsv, :redistrant_rsv, :num_of_people_rsv, :purpose_rsv)";
            
            $stmt = $connect->prepare($sql);
            
            
            $stmt -> bindParam(":code_rsv", $code);
            $stmt -> bindParam(":date_rsv", $date_inp);
            $stmt -> bindParam(":start_rsv", $start_inp);
            $stmt -> bindParam(":finish_rsv", $finish_inp);
            $stmt -> bindParam(":redistrant_rsv", $redistrant_inp);
            $stmt -> bindParam(":num_of_people_rsv", $num_of_people_inp);
            $stmt -> bindParam(":purpose_rsv", $purpose_inp);
            

            //$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            

            try
            {
                $count_query = $connect -> query("SELECT * FROM reservation");
                $count = $count_query -> rowCount();
                $code = $count * 1;
                
                $stmt -> execute();

                //header("Location: reservation.php");
                exit();
                
            }
            catch (PDOException $e)
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
            

                print "<br>";
                print "<h1></h1>";
                print "<p>利用者名:". $_SESSION['registant']. "</p>";
                print "<p>会議室　:". $_SESSION['conf_room']. "</p>";
                print "<p>備品　　:". $_SESSION['equipment']. "</p>";
                print "<p>備品数　:". $_SESSION['equipment_num']. "</p>";
                print "<p>予約日　:". $_SESSION['date']. "</p>";
                print "<p>予約時間:". $_SESSION['start']. "~" . $_POST['finish']."</p>";
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
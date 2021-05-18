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

        $registant_inp = $_POST["registant"];
        $conf_room_inp = $_POST["conf_room"];
        $equipment_inp = $_POST["equipment"];
        $equipment_num_inp = $_POST["equipment_num"];
        $date_inp = $_POST["date"];
        $start_inp = $_POST["start"];
        $finish_inp = $_POST["finish"];
        $num_of_people_inp = $_POST["num_of_people"];
        $purpose_inp = $_POST["purpose"];
        
        $connect = connect_db();
        
        /*
        $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); 
        $row = 'SELECT * FROM reservation ';
        $stmt = $dbh->query($row);
        $stmt->execute();
        $count=$stmt->rowCount();
        echo $count;
        */
        $code=1;
        
        try
        {
            $sql="INSERT INTO reservation VALUES('".$code."', '".$date_inp."', '".$start_inp."', '".$finish_inp."', '".$registant_inp."', '".$num_of_people_inp."', '".$purpose_inp."', 'wait')";
            
            $res = $connect->query($sql);
            header("Location: reservation.php");
            //exit();
        }
        catch(PDOException $e)
        {
            exit($e->getMessage());
            //die();
        }
        
        
        /*input_check($registant_inp, 'registrant') and input_check($date_inp, 'date') and
                input_check($start_inp, 'start') and input_check($finish_inp, 'finish') and 
                input_check($num_of_people_inp, 'num_of_people') and input_check($purpose_inp, 'purpose'))*/
            
            if(1)
            {
                $_SESSION['registant'] = $registant_inp;
                $_SESSION['date'] = $date_inp;
                $_SESSION['start'] = $start_inp;
                $_SESSION['finish'] = $finish_inp;
                $_SESSION['num_of_people'] = $num_of_people_inp;
                $_SESSION['purpose'] = $purpose_inp;

                print "<br>";
                print "<h1></h1>";
                print "<p>利用者名:". $registant_inp. "</p>";
                print "<p>会議室:". $conf_room_inp. "</p>";
                print "<p>備品:". $equipment_inp. "</p>";
                print "<p>備品数:". $equipment_num_inp. "</p>";
                print "<p>予約日:". $date_inp. "</p>";
                print "<p>予約時間:". $start_inp. "~" . $finish_inp."</p>";
                print "<p>人数:". $num_of_people_inp. "</p>";
                print "<p>目的:". $purpose_inp. "</p>";
                
                print "<br>";

                print "上記の情報で予約しますか？";
                print "<form  method=\"post\">\n";
                print "<input type=\"submit\" formaction=\"index.php\" name=\"ok\" value=\"はい\">\n";
                print "<input type=\"submit\" formaction=\"reservation.php\"value=\"いいえ\">\n";
                print "</form>\n";
            }
            
        $connect = null;
    ?>
</body>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
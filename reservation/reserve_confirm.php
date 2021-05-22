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

    ?>
</head>
<?php include(dirname(__FILE__). '/include/header.php'); ?>
<main>
    <h2>予約情報確認ページ</h2>

    <?php
        
        $registant = "";
        $date = "";
        $start = "";
        $finish = "";
        $num_of_people = "";
        $purpose = "";
        $code = 0;

        $conf_room = "";
        $equipment = [];
        $equipment_num = [];

        $registant = $_POST['registant'];
        $date = $_POST['date'];
        $start = $_POST['start'];
        $finish = $_POST['finish'];
        $num_of_people = $_POST['num_of_people'];
        $purpose = $_POST['purpose'];
        $status = 'wait';

        $conf_room = $_POST['conf_room'];

        $count_p = $_POST ['count'];
        $equipment = array_fill (0, $count_p, "");
        $equipment_num = array_fill (0, $count_p, "");
        for ($i = 0; $i < $count_p; $i++) 
        {
            $equipment     [$i] = $_POST ['equipment' . $i];
            $equipment_num [$i] = $_POST ['equipment_num' . $i];
        }

        try
        {
            $connect = connect_db();

            //reserve
            $count_query = $connect -> query("SELECT * FROM reservation");
            $count_r = $count_query -> rowCount();
            $code = $count_r * 1;

            $sql_r = "CREATE DATABASE reservation INSERT INTO reservation VALUES('$code', '$date', '$start', '$finish', '$registant', '$num_of_people','$purpose', '$status')";
            $sql_e = "UPDATE equipment SET equipment.code = $code WHERE equipment.name=$equipment";
            $sql_c = "UPDATE conferece_room SET conferece_room.code = $code WHERE conferece_room.name=$conf_room";
            $stmt_r = $connect->prepare($sql_r);
            $stmt_e = $connect->prepare($sql_e);
            $stmt_c = $connect->prepare($sql_c);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }

        $sql_max = "SELECT max FROM conferece WHERE conferece_room.name=$conf_room";
        $num_of_max = $connect->prepare($sql_max);

        if($num_of_people>$num_of_max)
        {
            echo('<form action = "input_php" method="post">');
            echo('<input type="hidden" name="error" value="1">');
            echo('</form>');
        }

        print "<br>";
        print "<h1></h1>";
        print "<p>利用者名:". $registant. "</p>";
        print "<p>会議室　:". $conf_room. "</p>";
        print "<p>備品　　:". $equipment. "</p>";
        print "<p>備品数　:". $equipment_num. "</p>";
        print "<p>予約日　:". $date. "</p>";
        print "<p>予約時間:". $start. "~" . $finish."</p>";
        print "<p>人数　　:". $num_of_people. "</p>";
        print "<p>目的　　:". $purpose. "</p>";

        print "<br>";

        print "上記の情報で予約しました<br>";

        print "<button type=“button” onclick="."location.href='index.php'".">戻る</button>";
                    
        $connect = null;
    ?>
</main>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
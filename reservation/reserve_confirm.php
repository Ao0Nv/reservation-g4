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
        
        $dsn = 'pgsql:host=ec2-52-0-114-209.compute-1.amazonaws.com;
                dbname=daqf6kt1g4926a;
                port=5432';
        $user = 'fixkfmqbxlymrn';
        $password = '266fc304db7de88db3a21a36a8fb058bfbdb517cc1260a524760560cfc5d771b';

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
            $equipment     [$i] = $_POST ['$param1_' . $i];
            $equipment_num [$i] = $_POST ['$param2_' . $i];
            echo('eqp'.$equipment[$i]);
        }

        try
        {
            $connect = new PDO($dsn, $user, $password);

            //code
            $result_code = $connect->query("SELECT * FROM reservation");                  
            $data_code = $result_code->fetchAll();

            $datacount_code = count($data_code);
            $code = $datacount_code;

            //reservation_table 
            $sql_r = "INSERT INTO reservation VALUES('$code', '$date', '$start', '$finish', '$registant', '$num_of_people','$purpose', '$status')";
            $result_r = $connect->query($sql_r);                  
            $data_r = $result_r->fetchAll();  
            $datacount_r = count($data_r);

            //equipment_table
            for ($i = 0; $i < $count_p; $i++) 
            {
                $sql_e[$i] = "UPDATE equipment SET equipment.code = $code WHERE equipment.name=$equipment[$i]";
                $result_e[$i] = $connect->query($sql_e[$i]);                  
                $data_e[$i] = $result_e->fetchAll();  
                $datacount_e[$i] = count($data_e[$i]);
            }
            //$sql_e[$i] = "UPDATE equipment SET equipment.code = $code WHERE equipment.name=$equipment['$i']";
            //$result_e[$i] = $connect->query($sql_e);                  
            //$data_e[$i] = $result_e->fetchAll();  
            //$datacount_e[$i] = count($data_e);

            //conferece_room
            $sql_c = "UPDATE conferece_room SET conferece_room.code = $code WHERE conferece_room.name=$conf_room";
            $result_c = $connect->query($sql_c);                  
            $data_c = $result_c->fetchAll();  
            $datacount_c = count($data_c);

            $connect = null; 
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }

        //conference_max
        $sql_max = "SELECT max FROM conferece WHERE conferece_room.name = $conf_room";
        $result_max = $connect->query($sql_max);                  
        $data_max = $result_max->fetchAll();  

        $num_of_max = $data_max;

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
        for ($i = 0; $i < $count_p; $i++) 
        {
            print "<p>備品["."$i"."]:". $equipment[$i]. "</p>";
            print "<p>備品数["."$i"."]:". $equipment_num[$i]. "</p>";
        }
        //print "<p>備品　　:". $equipment. "</p>";
        //print "<p>備品数　:". $equipment_num. "</p>";
        print "<p>予約日　:". $date. "</p>";
        print "<p>予約時間:". $start. "~" . $finish."</p>";
        print "<p>人数　　:". $num_of_people. "</p>";
        print "<p>目的　　:". $purpose. "</p>";

        print "<br>";

        print "上記の情報で予約しました<br>";

        print "<button type=“button” onclick="."location.href='index.php'".">戻る</button>";
                    
    ?>
</main>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
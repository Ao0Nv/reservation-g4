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

        /*
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
        */
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

        $registant_inp = $_POST['registant'];
        $date_inp = $_POST['date'];
        $start_inp = $_POST['start'];
        $finish_inp = $_POST['finish'];
        $num_of_people_inp = $_POST['num_of_people'];
        $purpose_inp = $_POST['purpose'];
        $status = "wait";

        $conf_room_inp = $_POST['conf_room'];
        $equipment_inp = $_POST['equipment'];
        $equipment_num_inp = $_POST['equipment_num'];

        try
        {
            $connect = connect_db();

            //reserve
            $count_query = $connect -> query("SELECT * FROM reservation");
            $count = $count_query -> rowCount();
            $code = $count * 1;
            $sql_r = "INSERT INTO reservation VALUES('$code', '$date', '$registant_inp', '$start_inp', '$finish_inp','$num_of_people_inp','$purpose_inp', '$status')";
            $stmt = $connect->prepare($sql_r);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }

        print "<br>";
        print "<h1></h1>";
        print "<p>利用者名:". $registant_inp. "</p>";
        print "<p>会議室　:". $conf_room_inp. "</p>";
        print "<p>備品　　:". $equipment. "</p>";
        print "<p>備品数　:". $equipment_num. "</p>";
        print "<p>予約日　:". $date_inp. "</p>";
        print "<p>予約時間:". $start_inp. "~" . $finish_inp."</p>";
        print "<p>人数　　:". $num_of_people_inp. "</p>";
        print "<p>目的　　:". $purpose_inp. "</p>";

        print "<br>";

        print "上記の情報で予約しました";

        print "<button type=“button” onclick="."location.href='index.php'".">戻る</button>";
                    
        $connect = null;
    ?>
</main>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
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

        if(isset($_POST["ok"]))
        {
            $registant_inp = $_SESSION['registant'];
            $conf_room_inp = $_SESSION['conf_room'];
            $equipment_inp = $_SESSION['equipment'];
            $equipment_num_inp = $_SESSION['equipment_num'];
            //$date_inp = $_SESSION['date'];
            //$start_inp = $_SESSION['start'];
            //$finish_inp = $_SESSION['finish'];
            $num_of_people_inp = $_SESSION['num_of_people'];
            $purpose_inp = $_SESSION['purpose'];
            $status = "wait";
            $code = 0;

            $connect = connect_db();

            $sql = "INSERT INTO reservation VALUES(:code, :date, :start, :finish, :redistrant, :num_of_people, :purpose, :status)";
            
            $stmt = $connect->prepare($sql);
            

            //code---------------------------------------------------------
            $stmt -> bindValue(":code", $code, PDO::PARAM_STR);

            //date------------------------------------------------------
            $date_inp = new Date('2021-05-22');
            $stmt->bindValue(':date', $date->format('Y-m-d'), PDO::PARAM_STR);

            //$created_at = new Date();
                $created_date = $_SESSION['date']
            $stmt->bindValue(':date', $created_date->format('Y-m-d H:i:s'), PDO::PARAM_STR);

            //time-------------------------------------------------------
            $start_inp = new Time('12:00');
            $finish_inp = new Time('12:00');
            $stmt -> bindValue(":start", $start_inp->format('hh:mm'), PDO::PARAM_STR);
            $stmt -> bindValue(":finish", $finish_inp->format('hh:mm'), PDO::PARAM_STR);

                $created_start = $_SESSION['start'];
                $created_finish = $_SESSION['finish'];

            $stmt -> bindValue(":start", $created_start->format('hh:mm'), PDO::PARAM_STR);
            $stmt -> bindValue(":finish", $created_finish->format('hh:mm'), PDO::PARAM_STR);
            //-----------------------------------------------------------



            $stmt -> bindValue(":redistrant", $redistrant_inp, PDO::PARAM_STR);
            $stmt -> bindValue(":num_of_people", $num_of_people_inp, PDO::PARAM_INT);
            $stmt -> bindValue(":purpose", $purpose_inp, PDO::PARAM_STR);
            $stmt -> bindValue(":status", $status, PDO::PARAM_STR);
            
            $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            try
            {
                $count_query = $connect -> query("SELECT * FROM reservation");
                $count = $count_query -> rowCount();
                $code = $count * 1;
                
                $stmt -> execute();

                header("Location: input_confirm.php");
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
                print "<p>予約時間:". $_SESSION['start']. "~" . $_SESSION['finish']."</p>";
                print "<p>人数　　:". $_SESSION['num_of_people']. "</p>";
                print "<p>目的　　:". $_SESSION['purpose']. "</p>";

                print "<br>";

                print "上記の情報で予約しますか？";
                print "<form  method=\"post\">\n";
                print "<input type=\"submit\" formaction=\"reserve_confirm.php\" name=\"ok\" value=\"はい\">\n";
                print "<input type=\"submit\" formaction=\"input_confirm.php\"value=\"いいえ\">\n";
                print "</form>\n";
            }
            else
            {
                header("Location: input_confirm.php");
                exit();
            }
        }
        $connect = null;
    ?>
</main>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
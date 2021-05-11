<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial -scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css">
    <title>会議室・備品予約システム</title>
</head>
<?php include(dirname(__FILE__). '/include/header.php'); ?>
<body>
    <?


        $registant = "";
        $date = "";
        $start = "";
        $finish = "";
        $num_of_people = "";
        $purpose = "";
        $code = 0;
        $attach_file = "";

        if(isset($_POST["ok"]))
        {
            $registant = $_SESSION['registant'];
            $date = $_SESSION['date'];
            $start = $_SESSION['start'];
            $finish = $_SESSION['finish'];
            $num_of_people = $_SESSION['num_of_people'];
            $purpose = $_SESSION['purpose'];
            $status = "reserved";
            $code = 0;

            $conf_room = $_SESSION['conf_room'];
            $equipment = $_SESSION['equipment'];
            $equipment_num = $_SESSION['equipment_num'];

            
            $connect = connect_db();
            $stmt_resv = $connect->prepare("INSERT INTO reservation VALUES(:code, :date, :start, :finish, :redistrant, :num_of_people)");
            $stmt_conf = $connect->prepare("INSERT INTO conference VALUES(:conf_room)");
            $stmt_eqpm = $connect->prepare("INSERT INTO equipment VALUES(:equipment, :equipment_num)");

            $stmt_reservation -> bindParam(":redistrant", $redistrant, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":date", $date, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":start", $start, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":finish", $finish, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":num_of_people", $num_of_people, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":purpose", $purpose, PDO::PARAM_STR);

            $stmt_conference_room -> bindParam(":conf_room", $conf_room, PDO::PARAM_STR);
            $stmt_equipment -> bindParam(":equipment", $equipment, PDO::PARAM_STR);
            $stmt_equipment -> bindParam(":equipment", $equipment_num, PDO::PARAM_INT);
            
            $stmt_reservation -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_conference_room ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_equipment -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            try
            {
                $count_query = $connect -> query("SELECT * FROM reservation");
                $count = $count_query -> rowCount();
                $code = $count * 1;
                $stmt_reservation -> execute();
                $stmt_reservate -> execute();
                header("Location: index.php");
                exit();
            }
            catch(PDOException $e)
            {
                exit($e->getMessage());
            }
        }
        else
        {

            if(input_check($registant, 'registrant') and input_check_b($date, 'date') and
                    input_check_b($start, 'start') and input_check_b($finish, 'finish') and 
                    input_check_b($num_of_people, 'num_of_people') and input_check_b($purpose, 'purpose'))
                {
                    $_SESSION['registant'] = $registant;
                    $_SESSION['date'] = $date;
                    $_SESSION['start'] = $start;
                    $_SESSION['finish'] = $finish;
                    $_SESSION['num_of_people'] = $num_of_people;
                    $_SESSION['purpose'] = $purpose;

                    print "<h1></h1>";
                    print "<p>利用者名:". $registant. "</p>";
                    print "<p>会議室:". $date. "</p>";
                    print "<p>備品:". $start. "</p>";
                    print "<p>備品数:". $finish. "</p>";
                    print "<p>予約日:". $num_of_peolr. "</p>";
                    print "<p>予約時間:". $first. "~" . $finish ."</p>";
                    print "<p>人数:". $num_of_people. "</p>";
                    print "<p>目的:". $purpose. "</p>";
                    
                    print "上記の情報で予約しますか？";
                    print "<form  method=\"post\">\n";
                    print "<input type=\"submit\" formaction=\"index.php\" name=\"ok\" value=\"はい\">\n";
                    print "<input type=\"submit\" formaction=\"reservation.php\"value=\"いいえ\">\n";
                    print "</form>\n";
                }
                else
                {
                    header("Location: reservation.php");
                    exit();
                }
        }
    ?>
</body>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
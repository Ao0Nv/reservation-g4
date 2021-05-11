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

            $equipment_num
            
            $connect = connect_db();
            $stmt_name = $connect->prepare("INSERT INTO reservation VALUES(:code, :date, :start, :finish, :redistrant, :num_of_people)");

            $stmt_reservation -> bindParam(":redistrant", $redistrant, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":date", $date, PDO::PARAM_STR);
            $stmt_reservation -> bindParam(":start", $start, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":finish", $finish, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":num_of_people", $num_of_people, PDO::PARAM_INT);
            $stmt_reservation -> bindParam(":purpose", $purpose, PDO::PARAM_STR);

            $stmt_conference_room -> bindParam(":conf_room", $conf_room, PDO::PARAM_STR);
            $stmt_equipment -> bindParam(":equipment", $equipment, PDO::PARAM_STR);
            $stmt_equipment -> bindParam(":equipment", $equipment_num, PDO::PARAM_INT);
            
            $stmt_name -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_detail -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            try
            {
                $count_query = $connect -> query("SELECT * FROM reservation");
                $count = $count_query -> rowCount();
                $code = $count * 1;
                $stmt_name -> execute();
                $stmt_detail -> execute();
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
            header("Location: reservation.php");
            exit();
        }
    ?>
</body>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
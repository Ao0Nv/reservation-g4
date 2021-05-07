<!DOCTYPE html>
<html lang="en">

<body>
　  <th>Q1：入院の経験はありますか</th>
    <label><input type="radio" id="user0" name="user" onClick="userflg0(this.checked);"/> 個人</label> 
    <label><input type="radio" id="user1" name="user" onClick="userflg1(this.checked);"/> 部署</label>
    <br>
    <th>Q2: Q1で「はい」と答えた方に質問します。どのような病気で入院されましたか？</th>
    <input type="text" name="num_person" id="user" value="" disabled="disabled">
</body>

<?

                $registant = "";
                $date = "";
                $start = "";
                $finish = "";
                $num_of_people = "";
                $purpose = "";
                $code = 0;
                $attach_file = "";

                $registant = $_SESSION['registant'];
                $date = $_SESSION['date'];
                $start = $_SESSION['start'];
                $finish = $_SESSION['finish'];
                $num_of_people = $_SESSION['num_of_people'];
                $purpose = $_SESSION['purpose'];
                $code = 0;

                $connect = connect_db();
                $stmt_name = $connect->prepare("INSERT INTO reservation VALUES(:code, :date, :start, :finish, :redistrant, :num_of_people, :status)");
                
                $stmt_name -> bindParam(":gomi_name", $name_inp, PDO::PARAM_STR);
                $stmt_name -> bindParam(":gomi_part", $part_inp, PDO::PARAM_STR);
                $stmt_name -> bindParam(":code", $code, PDO::PARAM_INT);

                $stmt_detail -> bindParam(":code", $code, PDO::PARAM_INT);
                $stmt_detail -> bindParam(":div", $division_inp, PDO::PARAM_STR);
                $stmt_detail -> bindParam(":fee", $fee_inp, PDO::PARAM_STR);
                $stmt_detail -> bindParam(":note", $note_inp, PDO::PARAM_STR);
                $stmt_detail -> bindParam(":att_file", $attach_file, PDO::PARAM_STR);

                $stmt_name -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt_detail -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try
                {
                    $count_query = $connect -> query("SELECT * FROM ごみ名称");
                    $count = $count_query -> rowCount();
                    $code = $count * 1;

                    $stmt_name -> execute();
                    $stmt_detail -> execute();

                    header("Location: data1.php");
                    exit();
                }
                catch(PDOException $e)
                {
                    exit($e->getMessage());
                }
?>
                </html>
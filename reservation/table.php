<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial -scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css">
    <title>会議室・備品予約システム</title>

    <?php
        require_once('include/db_connect.php');
        session_start();
    ?>

</head>
<?php include(dirname(__FILE__).'/include/header.php'); ?>
<main>
    <h2>予約テーブルページ</h2>
    <?php
        $connect = connect_db();
        $result = pg_query($conn, "SELECT * FROM reservation");
        $arr = pg_fetch_all($result);

        print "<table id=\"dblist\" summary=\"PostgreSQLのデータベースの一覧\">\n";
        print "<caption>PostgreSQL データベース一覧</caption>\n";

        //テーブルヘッダとしてフィールド（カラム）名を出力
        print "<tr>\n";
        $flds = pg_num_fields($result);
        for($i=0; $i<$flds; $i++){
        $field = pg_field_name($result, $i);
        printf("<th abbr=\"%s\">%s</th>\n", $field, $field);
        }
        print "</tr>\n";

        //データの出力
        foreach($arr as $rows)
        {
            print "<tr>\n";
            foreach($rows as $value)
            {
                printf("<td>%s</td>\n", $value);
            }
            print "</tr>\n";
        }

        print "</table>\n";

        //DBとの接続を閉じる
        pg_close($connenct);
    ?>
    
</main>
<?php include(dirname(__FILE__).'/include/footer.php'); ?>
</html>
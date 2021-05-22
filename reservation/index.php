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
<?php include(dirname(__FILE__).'/include/header.php'); ?>
<main>
    <form action = "reserve_confirm.php" method = "post">
        <lavel for="registant">名 </lavel>
        <input type="text" name="name_ssn">
        <input type="submit" value="送信">
    </form>

    <button type=“button” onclick="location.href='input_confirm.php'">予約へ</button>
    <button type=“button” onclick="location.href='table.php'">テーブル確認</button>
</main>
<?php include(dirname(__FILE__).'/include/footer.php'); ?>
</html>
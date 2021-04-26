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
    <h2>予約</h2>

    <form action = "reserve.php" method = "post">
        <p>利用者：
            <input type="radio" name="users" value="個人" checked/>個人
            <input type="radio" name="users" value="部署">部署
        </p>
        <lavel for="registrant">登録者名</lavel>
        <input type="text" name="registrant">
        <br>
        <select name='equipment'>
            <option value='young'>EPZON EP1010</option>
            <option value='middle'>EPZON EPS500</option>
            <option value='senior'>H実業　SKREEN60</option>
            <option value='senior'>H実業　SKREEN150</option>
            <option value='senior'>無線マイクロフォン</option>
            <option value='senior'>OMKYO</option>
            <option value='senior'>脚立</option>
            <option value='senior'>巻コード</option>
        </select>
      
        <input type="submit" value="予約確定">
    </form>


</body>
<?php include(dirname(__FILE__). '/include/header.php'); ?>
</html>
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
    <br><br>
    <form action = "reserve.php" method = "post">
        <p>利用者：
            <input type="radio" name="users" value="個人" checked/>個人
            <input type="radio" name="users" value="部署">部署
        </p>
        <br>
        <lavel for="registrant">登録者名 </lavel>
        <input type="text" name="registrant">
        <br><br>
        <lavel for="conf_room">会議室 </lavel>
        <select name='conf_room'>
            <option value='roomA'>会議室A</option>
            <option value='roomB'>会議室B</option>
            <option value='roomC'>会議室C</option>
            <option value='roomD'>会議室D</option>
            <option value='s_semi_room'>小セミナー室</option>
            <option value='s_room'>小会議室</option>
            <option value='semi_room'>セミナー室</option>
            <option value='b_room'>大会議室</option>
        </select> 
        <br><br>
        <lavel for="equipment">備品 </lavel>
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
        <br><br>
        <lavel for="registrant">備品数 </lavel>
        <select name='equipment_num'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
        </select>
        <br><br>
        <lavel for="month">予約日 </lavel>
        <select name='month'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
            <option value='11'>11</option>
            <option value='12'>12</option>
        </select> 
        月
        <select name='day'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
            <option value='11'>11</option>
            <option value='12'>12</option>
            <option value='13'>13</option>
            <option value='14'>14</option>
            <option value='15'>15</option>
            <option value='16'>16</option>
            <option value='17'>17</option>
            <option value='18'>18</option>
            <option value='19'>19</option>
            <option value='20'>20</option>
            <option value='21'>21</option>
            <option value='22'>22</option>
            <option value='23'>23</option>
            <option value='24'>24</option>
            <option value='25'>25</option>
            <option value='26'>26</option>
            <option value='27'>27</option>
            <option value='28'>28</option>
            <option value='29'>29</option>
            <option value='30'>30</option>
            <option value='31'>31</option>
        </select>
        日
        <br><br>

        <br>
        <input type="submit" value="予約確定">
    </form>


</body>
<?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
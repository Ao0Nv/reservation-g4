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
    <br>
    <form action = "reservate.php" method = "post">
        利用者
        <label><input type="radio" id="user0" name="user" onClick="userflg0(this.checked);"/> 個人</label> 
        <label><input type="radio" id="user1" name="user" onClick="userflg1(this.checked);"/> 部署</label>
        </p>
        <br>
        <lavel for="registant">利用者名 </lavel>
        <input type="text" name="registant">
        <br><br>
        <lavel for="conf_room">会議室　 </lavel>
        <select name='conf_room'>
            <option hidden value='null'>選択してください</option>
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
        <lavel for="equipment">備品　　 </lavel>
        <select name='equipment'>
            <option hidden value='null'>選択してください</option>
            <option value='ep_1010'>EPZON EP1010</option>
            <option value='ep_500'>EPZON EPS500</option>
            <option value='skreen60'>H実業　SKREEN60</option>
            <option value='skreeen150'>H実業　SKREEN150</option>
            <option value='microphone'>無線マイクロフォン</option>
            <option value='omkyo'>OMKYO</option>
            <option value='stepladder'>脚立</option>
            <option value='senior'>巻コード</option>
        </select>
        <br><br>
        <lavel for="equipment_num">備品数　 </lavel>
        <select name='equipment_num'>
            <option hidden value='null'> ― </option>
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
        <lavel for="date">予約日  </lavel>
        <input type="date" name='date'>
        <br><br>
        予約時間　
        <input type="time" name="start" value="9:00" min="9:00" max="17:00" step="900">
        ～
        <input type="time" name="finish" value="9:00" min="9:00" max="17:00" step="900">
        <br><br>
        <lavel for="num_of_person">人数　　 </lavel>
        <input type="text" name="num_of_person" id="user" value="" disabled="disabled">
        <br><br>
        <lavel for="purpose">目的 　 </lavel>
        <input type="text" name="purpose" size="100">
        <br><br>
        <input type="submit" value="予約確定">
    </form>
    <br><br>
    <script type="text/javascript">
      function userflg0(ischecked)
      {
        if(ischecked == true)
        {
          document.getElementById("user").disabled = false;
        } 
        else 
        {
          document.getElementById("user").disabled = true;
        }
      }
      function userflg1(ischecked)
      {
        if(ischecked == true)
        {
          document.getElementById("user").disabled = true;
        }  
        else 
        {
          document.getElementById("user").disabled = false;
        }
      }
    </script>
  </body>
  <?php include(dirname(__FILE__). '/include/footer.php'); ?>

</html>
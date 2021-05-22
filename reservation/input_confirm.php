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
<main>
    <h2>予約</h2>
    <br>

    <?php
      if($_POST['error']==1)
      {
        echo('<font color="red">会議室の最大人数を超えています。</font>')
      }
    ?>

    <form action = "reserve_confirm.php" method = "post">
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
            <option value='会議室A'>会議室A</option>
            <option value='会議室B'>会議室B</option>
            <option value='会議室C'>会議室C</option>
            <option value='会議室D'>会議室D</option>
            <option value='小セミナー室'>小セミナー室</option>
            <option value='小会議室'>小会議室</option>
            <option value='セミナー室'>セミナー室</option>
            <option value='大会議室'>大会議室</option>
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
        <lavel for="num_of_people">人数　　 </lavel>
        <input type="text" name="num_of_people" id="user" value="" disabled="disabled">
        <br><br>
        <lavel for="purpose">目的 　 </lavel>
        <input type="text" name="purpose" size="100">
        <br><br>
        
        <input type="hidden" name="count" id="count_id" value="0">
        <table width="50%" cellpadding="3" cellspacing="1" id="table">
          <tbody>
            <tr>
              <td width="10%">　　</td>
              <td width="45%">備品</td>
              <td width="45%">備品数</td>
            </tr>
            <tr>
              <td><input type="button" value="追加" onclick="insertTable ()"></td>
            </tr>
            <tr>
              <td><input type='button' value='削除' onclick='deleteTable (getSort(this.parentNode.parentNode));'></td>
              <td>
                <select name='equipment'>
                  <option value="null">選択してください</option>
                    <option value='EPZON EP1010'>EPZON EP1010</option>
                    <option value='EPZON EPS500'>EPZON EPS500</option>
                    <option value='H実業　SKREEN60'>H実業　SKREEN60</option>
                    <option value='H実業　SKREEN150'>H実業　SKREEN150</option>
                    <option value='無線マイクロフォン'>無線マイクロフォン</option>
                    <option value='OMKYO'>OMKYO</option>
                    <option value='脚立'>脚立</option>
                    <option value='巻コード'>巻コード</option>
                </select>
              </td>
              <td><input type='text' value="" name='equipment_num'></td>
            </tr>
          </tbody>
        </table>
        <br>
        <input type="button" value="予約確定" onclick="setParamsName (); submit ();">
    </form>
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


      /**
      * 行追加
      */
      function insertTable () 
      {
          var table1 = document.getElementById ("table");
          var row = table1.insertRow (2); // 行を追加（見出し、追加ボタンの次の行）
          var cell0 = row.insertCell (0); // セルを追加
          var cell1 = row.insertCell (1); // セルを追加
          var cell2 = row.insertCell (2); // セルを追加
          /*var cell3 = row.insertCell (3); // セルを追加
          var cell4 = row.insertCell (4); // セルを追加
          var cell5 = row.insertCell (5); // セルを追加
          var cell6 = row.insertCell (6); // セルを追加
          var cell7 = row.insertCell (7); // セルを追加*/

          //セルに内容を設定
          cell0.innerHTML = "<input type='button' value='削除' onclick='deleteTable (getSort(this.parentNode.parentNode));'>";
          cell1.innerHTML = "<select name='equipment'>"
                          + "<option value='' > 選択してください </option>"
                          + "<option value='EPZON EP1010'>EPZON EP1010</option>"
                          + "<option value='EPZON EPS500'>EPZON EPS500</option>"
                          + "<option value='H実業　SKREEN60'>H実業　SKREEN60</option>"
                          + "<option value='H実業　SKREEN150'>H実業　SKREEN150</option>"
                          + "<option value='無線マイクロフォン'>無線マイクロフォン</option>"
                          + "<option value='OMKYO'>OMKYO</option>"
                          + "<option value='脚立'>脚立</option>"
                          + "<option value='巻コード'>巻コード</option>"
                          + "</select>";
          cell2.innerHTML = "<input type='text' value='' name = 'equipment_num' > ";
      }

      /**
      * 入力欄削除
      */
      function deleteTable (row) 
      {
          document.getElementById ("table").deleteRow (row);
      }

      /**
      * 順番を調べる
      */
      function getSort (target) 
      {
          var nodeLists = document.getElementById ("table").childNodes[1].childNodes;
          var trCount = - 1;
          for (var i = 0; i < nodeLists.length; i++) {
              var node = nodeLists.item (i);
              if (node.tagName == "TR") 
              {
                  trCount++;
              }
              if (node == target) 
              {
                  return trCount;
              }
          }
          return 0;
      }
      /**
      * パラメータ名を設定
      */
      function setParamsName () 
      {
          // 項目数を設定
          var nodeLists = document.getElementById ("table").childNodes[1].childNodes;
          // 名前を設定
          var cnt = 0 - 2; //見出し、追加ボタン分減算
          for (var r = 0; r < nodeLists.length; r++) 
          {
              if (nodeLists.item (r).nodeName != "TR") 
              {
                  continue;
              }
              var tdLists = nodeLists.item (r).childNodes;
              for (var d = 0; d < tdLists.length; d++) 
              {
                  if (tdLists.item (d).nodeName != "TD") 
                  {
                      continue;
                  }
                  // 内容を修正
                  var params = tdLists.item (d).childNodes;
                  for (var p = 0; p < params.length; p++) 
                  {
                      var node = params.item (p);
                      if (node.nodeName != "INPUT"
                      &&  node.nodeName != "TEXTAREA"
                      &&  node.nodeName != "SELECT") 
                      {
                          continue;
                      }
                      if (node.name.lastIndexOf ("_") == node.name.length - 1) 
                      {
                          node.name = node.name + cnt;
                      }
                  }
              }
              cnt++;
          }
          document.getElementById ("count_id").value = cnt;
      }

    </script>
  </main>
  <?php include(dirname(__FILE__). '/include/footer.php'); ?>
</html>
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
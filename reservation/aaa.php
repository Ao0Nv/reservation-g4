<?php
//データベース用の変数
    $dsn = 'pgsql:host=ec2-52-0-114-209.compute-1.amazonaws.com;
            dbname=daqf6kt1g4926a;
            port=5432';
    $user = 'fixkfmqbxlymrn';
    $password = '266fc304db7de88db3a21a36a8fb058bfbdb517cc1260a524760560cfc5d771b';

    try {
    	$connect = new PDO($dsn, $user, $password);     //最初これ必要

        ///////////////////////////////////////////////////////////////////////////////////////////
        $sql = "SELECT * FROM reservation";    //SQL文
        $result = $connect->query($sql);                  //sql実行?
        $datas = $result->fetchAll();                     //データベースを$datasに格納
        /////////////////////////////////////////////////////////////////////////////////////////////

        $datacount_row = count($datas);                   //$datasの行数を$datacount_rowに格納

        $connect = null;                                //最後これ必要
     } catch(PDOException $e) {
        //データベースに接続できなかった場合の処理
        var_dump($e->getMessage());
        die();                                            //処理停止
     } 

?>
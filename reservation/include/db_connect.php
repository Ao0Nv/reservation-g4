<?php
    function connect_db()
    {
        $server = "ec2-52-0-114-209.compute-1.amazonaws.com";
        $database = "daqf6kt1g4926a";
        $port_number = 5432;
        $user_id = "fixkfmqbxlymrn";
        $user_password = "266fc304db7de88db3a21a36a8fb058bfbdb517cc1260a524760560cfc5d771b";
        
        $connect = new PDO("pgsql:host=$server;dbname=$database;port=$port_number;user=$user_id;password=$user_password");

        return $connect;
    }

    function input_check(&$input, $key)
    {
        if(isset($_POST[$key]) and $_POST[$key] != '')
        {
            $input = preg_replace('/[^()ぁ-んァ-ヶｦ-ﾟ一-龠０-９a-zA-Z0-9\-]/', '', $_POST[$key]); 
            if(empty($input))
            {
                return false;
            }
            return true;
        }
        else
        {
            return false;
        }
    }
?>
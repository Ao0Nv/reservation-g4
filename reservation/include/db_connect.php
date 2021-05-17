<?php
    function connect_db(){
        $server = "ec2-54-90-13-87.compute-1.amazonaws.com";
        $database = "d1gsgcv5rqsvoc";
        $port_number = 5432;
        $user_id = "embzsaahgcxswh";
        $user_password = "007dc962782174807e8f71439970a83caefffb2de91754969788625aff742c1d";
        
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
        else{
            return false;
        }
    }
<?php
    function connect_db(){
        $server = "ec2-3-89-230-115.compute-1.amazonaws.com";
        $database = "d23l6otnkrusl3";
        $port_number = 5432;
        $user_id = "rdnkafrobyeogc";
        $user_password = "8360e5af63c0c83be49cdf918f76034aec49c1370c63c12d8e58f192a0310cb8";
        
        $connect = new PDO("pgsql:host=$server;dbname=$database;port=$port_number;user=$user_id;password=$user_password");

        return $connect;
    }

    function input_check(&$input, $key){
        if(isset($_POST[$key]) and $_POST[$key] != ''){
            $input = preg_replace('/[^()ぁ-んァ-ヶｦ-ﾟ一-龠０-９a-zA-Z0-9\-]/', '', $_POST[$key]); 
            if(empty($input)){
                return false;
            }
            return true;
        }
        else{
            return false;
        }
    }
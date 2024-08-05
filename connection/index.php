<?php

    function _connection(){

        $Options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
        ];

        require '_DB_CONFIG.php';

        try{

            return $pdo = new PDO($_Db_DSN, $_Db_User, $_Db_Pass, $Options);

        }catch(PDOException $pde){

            return false;

        }
        
    }    

?>
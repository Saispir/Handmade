<?php
include "Utils.php";
use hm\Utils;

if(!empty($_POST)){
    try {

        $query = "INSERT INTO author(fio, phone, email) values ('{$_POST['fio']}', {$_POST['phone']}, '{$_POST['email']}');";

        $db = Utils::getPDO();

        $code = $db->prepare($query)->execute();

        header("Location: ../catalog.php");
    }catch (\mysql_xdevapi\Exception){
        header("Location: ../index.php");
    }
}
else{
    header("Location: ../index.php");
}


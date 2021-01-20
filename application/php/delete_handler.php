<?php
include "Utils.php";
use hm\Utils;

if(!empty($_GET) ){
    try {
        $query = "delete from maden where id = {$_GET['id']};";

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
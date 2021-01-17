<?php
include "Utils.php";
use hm\Utils;

if(!empty($_POST) and !empty($_FILES)){
    try {
        $decoded = addslashes(file_get_contents($_FILES['pic']['tmp_name']));

        $query = "INSERT INTO maden(price, m_name, pic, author_id) values ({$_POST['price']}, '{$_POST['name']}' , '{$decoded}', {$_POST['author']});";

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

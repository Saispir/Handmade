<?php
include "Utils.php";
use hm\Utils;

if(!empty($_POST)){
    try {
        $query = "";
        if($_FILES['pic']['error']!==4){
            $decoded = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
            $query = "update maden set m_name='{$_POST['name']}', author_id={$_POST['author']}, price={$_POST['price']}, pic='$decoded' where id={$_POST['id']};";
        }
        else {
            $query = "update maden set m_name='{$_POST['name']}', author_id={$_POST['author']}, price={$_POST['price']} where id={$_POST['id']};";
        }

        $db = Utils::getPDO();

        $code = $db->prepare($query)->execute();

        header("Location: ../maden_item.php?id={$_POST['id']}");
    }catch (\mysql_xdevapi\Exception){
        header("Location: ../index.php");
    }
}
else{
    header("Location: ../index.php");
}
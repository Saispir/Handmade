<?php

use hm\Utils;

if (!empty($_GET)){
    $db = Utils::getPDO();
    $stm = $db->prepare("select * from author where id=?;");
    $stm->execute([$_GET['id']]);
    echo json_encode($stm->fetchAll()[0]);
}
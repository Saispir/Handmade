<?php
include "Utils.php";

use hm\Utils;

session_start();

if (!empty($_POST)) {
    $db = Utils::getPDO();
    $reg_cust = "insert into customer(fio, phone, email) value ('{$_POST['fio']}', {$_POST['phone']}, '{$_POST['email']}');";

    $db->exec($reg_cust);
    $lastid = $db->lastInsertId("customer");

    $add_maden = "insert into customer_maden(customer_id, maden_id) values ";
    foreach ($_SESSION['cart'] as $item){
        $add_maden .= "($lastid, $item),";
    }

    $add_maden = rtrim($add_maden, ",");
    $add_maden .= ";";

    $db->exec($add_maden);

    $add_order = "insert into customer_order(adress, customer_id) value ('{$_POST['address']}', {$lastid});";

    $db->exec($add_order);

    $toggle_status = "update maden set status='sold' where id in (";

    foreach ($_SESSION['cart'] as $item) {
        $toggle_status .= "{$item},";
    }
    $toggle_status =rtrim($toggle_status, ',');
    $toggle_status .= ");";

    $db->exec($toggle_status);

    header("Location: ../index.php");
    session_destroy();
} else {
    header("Location: ../index.php");
}
header("Location: ../index.php");
<?php

include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная");
?>
<form method="post" action="php/add_form_handler.php" enctype="multipart/form-data">

    <div class="form_inputs">
        <span>Цена </span> <input name="цена" type="number">
       <span>Название</span> <input name="название" type="text">
        <span>Изображение</span><input name="изображение" type="file">
       <span>Автор</span> <input name="автор" type="number">
        <input type="submit">
    </div>

</form>




<?
include_once "html/footer.html";
?>

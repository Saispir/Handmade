<?php

include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная");
?>
<form method="post" action="php/add_form_handler.php" enctype="multipart/form-data">

    <div class="form_inputs mt-3">
        <div class="input-group mb-3">
            <span class="input-group-text">₽</span>
            <input type="text" class="form-control" name="price" aria-label="Цена" required>
            <span class="input-group-text">.00</span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Название</span>
            <input type="text" class="form-control" aria-label="Название" name="name" aria-describedby="inputGroup-sizing-default" required>
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="pic" id="inputGroupFile02" required>
            <label class="input-group-text" for="inputGroupFile02">Изображение</label>
        </div>
       <?
       echo Utils::renderQueryToSelect('author', 'fio', 'author','Автор');
       ?>
        <button type="submit" class="btn btn-primary">Сохранить</button>

    </div>

</form>




<?
include_once "html/footer.html";
?>

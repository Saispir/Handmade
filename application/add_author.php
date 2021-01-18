<?

include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная");
?>

    <div class="text-center">
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
            <form class="form-signin mt-5" action="php/add_author_handler.php" method="post">
                <h1 class="h3 mb-3 font-weight-normal">Добавление</h1>
                <div class="input-group mb-3">
                    <span class="input-group-text">ФИО</span>
                    <input type="text" id="inputFIO" class="form-control" placeholder="Иванов Иван Иванович" required=""
                           autofocus="" name="fio">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="email" id="inputEmail" class="form-control" placeholder="example@example.org" required=""
                           autofocus="" name="email">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Телефон</span>
                    <input type="tel" id="inputPhone" class="form-control" placeholder="8(999)123-45-67" required=""
                           autofocus="" name="phone">
                </div>
                <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Зарегистрировать</button>
            </form>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>


<?
include_once "html/footer.html";
?>
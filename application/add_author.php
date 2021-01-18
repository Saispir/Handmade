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
                <label for="inputFIO" class="sr-only">Фамилия Имя Отчество</label>
                <input type="text" id="inputFIO" class="form-control mb-3" placeholder="ФИО" required=""
                       autofocus="" name="fio">
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Email" required=""
                       autofocus="" name="email">
                <label for="inputPhone" class="sr-only">Номер телефона</label>
                <input type="tel" id="inputPhone" class="form-control mb-3" placeholder="8(999)123-45-67" required=""
                       autofocus="" name="phone">
                <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Зарегистрировать</button>
            </form>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>


<?
include_once "html/footer.html";
?>
<?
session_start();
include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная");

if (isset($_GET['delete'])) {
    $pos = array_search($_GET['id'], $_SESSION['cart']);
    unset($_SESSION['cart'][$pos]);
}
?>

<?
if ($_SESSION !== null and isset($_SESSION['cart']) and count($_SESSION['cart']) !== 0):
    ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Автор</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?
        $query = "select m.id as id, m.m_name as name, m.price, a.fio as fio from maden m join author a on a.id = m.author_id where m.id in (";
        foreach ($_SESSION['cart'] as $item) {
            $query .= "{$item}, ";
        }
        $query = rtrim($query, ", ");
        $query .= ");";
        $db = Utils::getPDO();
        foreach ($db->query($query) as $row):
            ?>
            <tr>
                <th scope="row"><? echo $row['name'] ?></th>
                <td><? echo $row['price'] ?></td>
                <td><? echo $row['fio'] ?></td>
                <td><a class="btn btn-danger" href="cart.php?id=<? echo $row['id'] ?>&delete">Удалить</a></td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <form action="php/order_handler.php" method="post">
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
        <div class="input-group mb-3">
            <span class="input-group-text">Адрес</span>
            <input type="text" id="inputFIO" class="form-control"
                   placeholder="Россия, Республика Татарстан, Бугульминский район, г.Бугульма, ул. Гоголя, д.71, 423241"
                   required=""
                   autofocus="" name="address">
        </div>
        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Оформить заказ</button>

    </form>

<? else: ?>
    <div class="text-center">
        <h1>Корзина пуста</h1>
    </div>
<? endif; ?>

<?
include_once "html/footer.html";
?>

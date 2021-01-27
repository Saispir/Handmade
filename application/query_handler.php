<?
include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная");
?>


<h1>Запросы</h1>

<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                Изделия выше определенной цены
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <pre><code class="sql bigger_font_size">SELECT m_name, price
FROM maden
WHERE price > ?;</code></pre>
                <form action="query_handler.php" method="post" class="operation">
                    <input type="hidden" name="query"
                           value="select m_name, price from maden where price > :price;">
                    <div class="statements">
                        <input type="number" name="price" min="0" required>
                        <input type="submit" value="Выполнить">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Список изделий по автору
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <pre><code class="sql bigger_font_size">SELECT m_name, price
FROM maden
WHERE author_id= ?;</code></pre>
                <form action="query_handler.php" method="post" class="operation">
                    <input type="hidden" name="query"
                           value="select m_name, price from maden where author_id = :author_id;">
                    <div class="statements">
                        <?
                        echo Utils::renderQueryToSelect("author_id", "fio", "author", "");
                        ?>
                        <input type="submit" value="Выполнить">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Цена заказа
            </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <pre><code class="sql bigger_font_size">SELECT SUM(price)
FROM maden
         JOIN customer_maden CM ON maden.id = cm.maden_id
         JOIN customer_order CO ON cm.customer_id = co.customer_id
WHERE co.status = 'waiting'
  AND co.customer_id = ?;</code></pre>
                <form action="query_handler.php" method="post" class="operation">
                    <input type="hidden" name="query"
                           value="select sum(price) from maden join customer_maden cm on maden.id = cm.maden_id join customer_order co on cm.customer_id = co.customer_id where co.status = 'waiting' and co.customer_id = :customer;">
                    <div class="statements">
                        <?
                        echo Utils::renderQueryToSelect("customer", "email", "customer", "");
                        ?>
                        <input type="submit" value="Выполнить">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Заказы по статусу
            </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <pre><code class="sql bigger_font_size">SELECT adress, fio, phone, email, SUM(price) AS total, m_name
FROM customer_order
         JOIN customer c ON c.id = customer_order.customer_id
         JOIN customer_maden cm ON c.id = cm.customer_id
         JOIN maden m ON cm.maden_id = m.id
WHERE customer_order.status = ?
GROUP BY adress, fio, phone, email, m_name; </code></pre>
                <form action="query_handler.php" method="post" class="operation">
                    <input type="hidden" name="query"
                           value="select adress, fio, phone, email, sum(price) as total, m_name
from customer_order
         join customer c on c.id = customer_order.customer_id
         join customer_maden cm on c.id = cm.customer_id
         join maden m on cm.maden_id = m.id
where customer_order.status = :status
group by adress, fio, phone, email, m_name;">
                    <div class="statements">
                        <select name="status" id="">
                            <option value='payed'>Оплачен</option>
                            <option value='waiting'>В обработке</option>
                        </select>
                        <input type="submit" value="Выполнить">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                Все проданные товары
            </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <pre><code class="sql bigger_font_size">SELECT *
FROM maden
WHERE status = 'sold';</code></pre>
                <form action="query_handler.php" method="post" class="operation">
                    <input type="hidden" name="query"
                           value="SELECT * FROM maden WHERE status='sold';">
                    <div class="statements">
                        <input type="submit" value="Выполнить">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingSeven">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                Сколько потратил один покупатель
            </button>
        </h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                  <pre><code class="sql bigger_font_size">SELECT SUM(price)
FROM maden
         JOIN customer_maden cm ON maden.id = cm.maden_id
         JOIN customer_order co ON cm.customer_id = co.customer_id
WHERE co.status = 'payed'
  AND co.customer_id = ?;</code></pre>
                <form action="query_handler.php" method="post" class="operation">
                    <input type="hidden" name="query"
                           value="SELECT SUM(price)
FROM maden
         JOIN customer_maden cm ON maden.id = cm.maden_id
         JOIN customer_order co ON cm.customer_id = co.customer_id
WHERE co.status = 'payed'
  AND co.customer_id = :customer;">
                    <div class="statements">
                        <?
                        echo Utils::renderQueryToSelect("customer", "email", "customer", "");
                        ?>
                        <input type="submit" value="Выполнить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="result">
    <?
    if (!empty($_POST)) {
        echo Utils::renderSelectQueryToTable($_POST);
    }
    ?>
</div>

<?
include_once "html/footer.html";
?>

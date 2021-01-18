<?
include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная" );
?>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Описание предметной области</h1>
        <p class="lead"> Это Handmade магазин с эксклюзивными уникальными товарами. За каждым товаром стоит свой автор. Каждое изделие состоит из материалов, которые указываются для того, чтобы знать из чего состоит изделие. Покупатель может посмотреть каталог товаров, а также оформить заказ с доставкой.

            Каждому автору соответствует множество изделий, но каждому изделию принадлежит лишь один автор.
            Одно изделие может состоять из множества материалов, но один и тот же материал может использоваться во многих изделиях.
            Покупатель может заказать несколько изделий по одному адресу доставки и с одним статусом и после оплаты сделать следующий заказ.

        </p>
    </div>
<?
include_once "html/footer.html";
?>
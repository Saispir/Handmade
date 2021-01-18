<?
session_start();
if(session_status() === PHP_SESSION_NONE){
    $_SESSION['cart'] = [];
}
?>
<?
include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная" );
?>
 <a href="add_maden.php" class="btn btn-outline-dark mt-3 mb-3">Добавить</a>
<div class="catalog">

<?
$db = Utils::getPDO();
foreach ($db->query("select maden.id as id, m_name, pic, price, status, a.fio as fio from maden join author a on a.id = maden.author_id;") as $row){
    echo Utils::renderMaden($row);
}
?>
</div>
<?
include_once "html/footer.html";
?>
 <?
include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная" );
?>

<!--<table>-->
<!--    <tr>-->
<!--        <th>выбор</th>-->
<!--        <th>id</th>-->
<!--        <th>цена</th>-->
<!--        <th>название</th>-->
<!--        <th>изображение</th>-->
<!--        <th>статус</th>-->
<!--        <th class="foreign_key">имя автора</th>-->
<!--        <th class="foreign_key">почта автора</th>-->
<!--    </tr>-->
<?//
//$db = Utils::getPDO();
//
//$map = ["available" => "доступно", "sold" => "продано"];
//
//foreach ($db->query("select m.id as id, price, m_name, pic, status, a.fio as fio, a.email as email from maden m join author a on a.id = m.author_id;") as $row){
//    echo "
//    <tr>
//        <td><input type='checkbox' name='chosen' value='{$row['id']}'></td>
//        <td>{$row['id']}</td>
//        <td>{$row['price']}</td>
//        <td>{$row['m_name']}</td>
//        <td><img src='{$row['pic']}' alt=''></td>
//        <td>{$map[$row['status']]}</td>
//        <td class='foreign_key'>{$row['fio']}</td>
//        <td class='foreign_key'>{$row['email']}</td>
//</tr>
//    ";
//}
//
//?>
<!--</table>-->
 <a href="add.php" class="button">Добавить...</a>
<div class="catalog">
<?
$db = Utils::getPDO();
foreach ($db->query("select id, m_name, pic, price from maden;") as $row){
    echo Utils::renderMaden($row);
}
?>
</div>
<?
include_once "html/footer.html";
?>
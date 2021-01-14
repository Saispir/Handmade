<?
include "php/Utils.php";
use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная" );

$db = Utils::getPDO();
$query = $db->query("select m.id as id, price, m_name as name, pic, status, a.fio as fio, a.email as email, a.phone as phone from maden m join author a on a.id = m.author_id where m.id = {$_GET['id']};");
$result = $query->fetch();
 print_r($result);
?>



<?
include_once "html/footer.html";
?>

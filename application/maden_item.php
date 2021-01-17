<?
include "php/Utils.php";
use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная" );

$db = Utils::getPDO();
$query = $db->query("select m.id as id, price, m_name as name, pic, status, a.fio as fio, a.email as email, a.phone as phone from maden m join author a on a.id = m.author_id where m.id = {$_GET['id']};");
$result = $query->fetch();
$decoded = base64_encode($result['pic']);
 ?>
<h1 class="mt-3"><?echo $result['name']?></h1>
<a class="btn btn-warning mb-3" href="edit_maden.php?id=<?echo $_GET['id']?>">Изменить</a>
 <div class="row">
  <div class="col">
   <img src='data:image/png;base64,<?echo $decoded?>' class='card-img-top' alt=''>
  </div>
  <div class="col">

    <div class="row"><h2><?echo $result['fio']?></h2></div>
    <div class="row"><h4><a href="mailto:<?echo $result['email']?>"><?echo $result['email']?></a></h4></div>
    <div class="row"><h4><a href="tel:<?echo $result['phone']?>"><?echo $result['phone']?></a></h4></div>
    <div class="row"><h4><?echo $result['price']?> ₽</h4></div>

  </div>
 </div>
<?
include_once "html/footer.html";
?>

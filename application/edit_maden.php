<?
include "php/Utils.php";

use hm\Utils;

echo Utils::renderHeader("./html/header.html", "Главная");

$db = Utils::getPDO();
$query = $db->query("select m.id as id, price, m_name as name, pic, status, a.fio as fio, a.email as email, a.phone as phone from maden m join author a on a.id = m.author_id where m.id = {$_GET['id']};");
$result = $query->fetch();
$decoded = base64_encode($result['pic']);
?>
    <form method="post" action="php/edit_maden_handler.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<? echo $_GET['id'] ?>">
        <h1 class="mt-3">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Название</span>
                <input type="text" class="form-control" aria-label="Название" name="name"
                       aria-describedby="inputGroup-sizing-default" required value="<? echo $result['name'] ?>">
            </div>
        </h1>

        <div class="row">
            <div class="col">
                <img src='data:image/png;base64,<? echo $decoded ?>' class='card-img-top' alt='' id="blah">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="pic" id="inputGroupFile02" onchange="readURL(this);">
                    <label class="input-group-text" for="inputGroupFile02">Изображение</label>
                </div>
            </div>
            <div class="col">
                <div class="row mb-3">
                    <?
                    echo Utils::renderQueryToSelect('author', 'fio', 'author', "Новый автор");
                    ?>
                </div>
                <div class="row mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">₽</span>
                        <input type="text" class="form-control" name="price" aria-label="Цена" required
                               value="<? echo $result['price'] ?>">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const blah = document.getElementById('blah');
                    blah.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        function update_values(url) {
            const request = async () => {
                const json = await fetch(url).then(response => response.json());
                for (const k in json) {
                    if (json.hasOwnProperty(k) && document.getElementById(k) !== null) {
                        document.getElementById(k).value = json[k];
                    }
                }
            }
            return request(url);
        }

        function update(id) {
            return update_values(`${location.protocol}//${host}/php/get_author.php?id=${id}`);
        }
    </script>
<?
include_once "html/footer.html";
?>
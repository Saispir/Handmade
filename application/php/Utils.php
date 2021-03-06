<?php


namespace hm;


use JetBrains\PhpStorm\Pure;
use PDO;

class Utils
{
    public static function getPDO(): PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO('mysql:host=db;dbname=hm', 'devuser', 'devpass', $options);
    }

    #[Pure] public static function renderTable(array $array): string
    {
        $html = '<table>';

        $html .= '<tr>';
        foreach ($array[0] as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        foreach ($array as $key => $value) {
            $html .= '<tr>';
            foreach ($value as $key2 => $value2) {
                $html .= '<th>' . htmlspecialchars($value2) . '</th>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }

    public static function renderQueryToSelect(string $selectName, string $additionalParam, string $nameOfTable, string $default): string
    {
        $db = self::getPDO();
        $select = "<div class='input-group'><select class='form-select' name='{$selectName}' onchange='update(this.value)' id='id' required><option value='' selected>$default</option> ";

        foreach ($db->query("SELECT id, {$additionalParam} FROM {$nameOfTable};") as $row) {
            $select .= "<option value='{$row['id']}'>{$row[$additionalParam]}</option>";
        }

        $select .= "</select></div>";
        return $select;
    }

    public static function renderHeader(string $path, string $nameOfTable): string
    {
        ob_start();
        include $path;
        $buffer = ob_get_contents();
        ob_get_clean();

        $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $nameOfTable . '$3', $buffer);
        return $buffer;
    }


    public static function renderMaden(array $array): string
    {
        $b = $array['status'] === 'sold' ? 'disabled' : '';
        $decoded = base64_encode($array['pic']);
        return "<div class='card mb-3' style='width: 18rem;'>
  <img src='data:image/png;base64,{$decoded}' class='card-img-top' alt=''>
  <div class='card-body'>
    <h5 class='card-title'>{$array['m_name']}</h5>
    <p class='card-text'>{$array['fio']}</p>
    <a href='./maden_item.php?id={$array['id']}' class='btn btn-primary {$b}'>{$array['price']} ₽</a>
    </div>
</div>";
    }

    public static function renderSelectQueryToTable(array $data): string
    {
        $db = Utils::getPDO();
        $stmt = $db->prepare($data['query']);
        unset($data['query']);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $result ? Utils::renderTable($result) : "Запрос вернул пустой результат";
    }

}
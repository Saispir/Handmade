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

    public static function renderHeader(string $path, string $nameOfTable): string
    {
        ob_start();
        include $path;
        $buffer = ob_get_contents();
        ob_get_clean();

        $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $nameOfTable . '$3', $buffer);
        return $buffer;
    }

    public static function renderMaden(array $array) : string {
        return "<div class='maden__item'>
<a class='maden__link' href='./maden_item.php?id={$array['id']}'>{$array['m_name']}</a>
<img class='maden__img' src='{$array['pic']}' alt=''>
<h2 class='price'>{$array['price']}₽</h2>
</div>";
    }
}
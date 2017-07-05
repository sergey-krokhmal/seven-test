<?

$text = 'raz:первый.dva:второй.tri:третий.dva:четвертый.tri:пятый.';
$pattern = '/(?<key>raz|dva|tri):(?<data>.*?)(?=(?:raz|dva|tri|$))/u';
if (preg_match_all($pattern, $text, $matches)) {
    $result_arr = array();
    for($i = 0; $i < count($matches[0]); $i++) {
        $result_arr[$matches['key'][$i]] = $matches['data'][$i];
    }
    echo "<pre>";
    var_dump($result_arr);
    echo "</pre>";
}
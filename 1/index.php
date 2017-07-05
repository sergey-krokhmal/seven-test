<?
$file_text = file_get_contents('test.txt', 'r');
if ($file_text !== false){
    $pattern = '/\[(?<name>\w+)(?::(?<description>[\w ]*))?\](?<content>.*)\[\/(?:\w+)\]/u';
    $description_arr = array();
    $content_arr = array();
    if (preg_match_all($pattern, $file_text, $matches)) {
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++) {
            $content_arr[$matches['name'][$i]] = $matches['content'][$i];
            $description_arr[$matches['name'][$i]] = $matches['description'][$i];
        }
        echo "<pre>";
        var_dump($content_arr);
        var_dump($description_arr);
        echo "</pre>";
    }
}
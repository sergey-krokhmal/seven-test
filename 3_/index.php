<?
define('TOP_LEVEL', 5);

function insertNode(&$tree, $i, $level, $name, $parent) // функция фставки ветви в массив дерева
{
    $tree[$i]['name'] = $name;
    $tree[$i]['parent'] = $parent;
    $tree[$i]['level'] = $level;
}

function printTree($arr, $parent = 0, $level = 0)
{
    $tree = '';
    if ($parent == 0) {
        $pre = '';
    } else {
        $pre = '->';
    }
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]['parent'] == $parent) {
            $tree .= str_repeat('  ', $level);
            $tree .= $pre.$arr[$i]['name'].'<br/>';
            $tree .= printTree($arr, $arr[$i]['id'], $level+1);
        }
    }
    return $tree;
}

function randStr() // Функция генерирования случайной строки длинной до 5 символов
{
    $r_len = rand(1,5);
    $rs = '';
    for($i = 0; $i < $r_len; $i++) {
        $rc = chr(rand(65,90));
        $rs .= $rc;
    }
    return $rs;
}

// Подключение к БД
$db = new PDO('mysql:host=localhost;dbname=tree', 'tree', 'tree');

// Получить количество записей таблицы (дерева)
$stm = $db->query("SELECT * FROM `departs`");
$count = $stm->rowCount();  

// Если таблица пустая, то инициировать ее случайным деревом
if ($count == 0) {
    $top_level_count = 0;   // Колисество ветвей последнего уровня
    $i = 0;                 // Индекс-Id ветви
    $tree = array();        // Массив дерева
    while($top_level_count <= 8) {  // Пока ветвей максимального уровня меньше 8
        $parent = rand(0, $i);      // Выбрать случайного родителя
        if ($parent == 0) {         // Если родитель 0
            $level = 0;             // Новый уровень 0
        } else {
            $level = $tree[$parent]['level']+1; // Иначе взять уроовень родителя + 1
        }
        if ($level == TOP_LEVEL+1) {   // Если новый уровень ниже TOP_LEVEL на единицу
            $level = TOP_LEVEL; // Поставить ему максимальный уровень
            $parent = $tree[$parent]['parent']; // И родителя взять с максимального уровня
        }
        if ($level == TOP_LEVEL) {
            $top_level_count++;
        }
        $i++;
        $name = randStr();
        insertNode($tree, $i, $level, $name, $parent);
    }
    foreach($tree as $id => $node) {
        $db->exec("INSERT INTO `departs` SET id = $id, name = '".$node['name']."', parent = ".$node['parent']);
    }
}

$stm = $db->query("SELECT * FROM `departs`");
$rows = $stm->fetchAll();

echo "<pre>";
echo printTree($rows);
//var_dump($rows);
echo "</pre>";

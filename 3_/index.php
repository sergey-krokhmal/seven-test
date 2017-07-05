<?
define('TOP_LEVEL', 5);

function insertNode(&$tree, $i, $level, $name, $parent) // ������� ������� ����� � ������ ������
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

function randStr() // ������� ������������� ��������� ������ ������� �� 5 ��������
{
    $r_len = rand(1,5);
    $rs = '';
    for($i = 0; $i < $r_len; $i++) {
        $rc = chr(rand(65,90));
        $rs .= $rc;
    }
    return $rs;
}

// ����������� � ��
$db = new PDO('mysql:host=localhost;dbname=tree', 'tree', 'tree');

// �������� ���������� ������� ������� (������)
$stm = $db->query("SELECT * FROM `departs`");
$count = $stm->rowCount();  

// ���� ������� ������, �� ������������ �� ��������� �������
if ($count == 0) {
    $top_level_count = 0;   // ���������� ������ ���������� ������
    $i = 0;                 // ������-Id �����
    $tree = array();        // ������ ������
    while($top_level_count <= 8) {  // ���� ������ ������������� ������ ������ 8
        $parent = rand(0, $i);      // ������� ���������� ��������
        if ($parent == 0) {         // ���� �������� 0
            $level = 0;             // ����� ������� 0
        } else {
            $level = $tree[$parent]['level']+1; // ����� ����� �������� �������� + 1
        }
        if ($level == TOP_LEVEL+1) {   // ���� ����� ������� ���� TOP_LEVEL �� �������
            $level = TOP_LEVEL; // ��������� ��� ������������ �������
            $parent = $tree[$parent]['parent']; // � �������� ����� � ������������� ������
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

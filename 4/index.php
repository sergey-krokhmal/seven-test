<?
$db = new PDO('mysql:host=localhost;dbname=tree', 'tree', 'tree');

$stm = $db->query("
    SELECT a.* FROM `departs` a
    LEFT JOIN `departs` b ON a.parent = b.id
    WHERE b.id IS NULL AND a.id IN (
        SELECT b.parent
        FROM `departs` a
        LEFT JOIN `departs` b ON a.id = b.parent
        GROUP BY b.parent
        HAVING COUNT(b.id) >= 3
    )
");

$rows = $stm->fetchAll();
echo "<pre>";
var_dump($rows);
echo "</pre>";
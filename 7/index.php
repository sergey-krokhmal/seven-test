<?
function incrementIndexes($input_array, &$column_indexes, $row = false) {
    $count = count($column_indexes);
    if ($row === false) {
        $row = $count-1;
    }
    if (isset($column_indexes[$row])) {
        if ($column_indexes[$row] == count($input_array[$row])-1) {
            $column_indexes[$row] = 0;
            incrementIndexes($input_array, $column_indexes, $row-1);
        } else {
            $column_indexes[$row]++;
        }
    } else {
        return;
    }
}
 
$input_array = [
    ['a1', 'a2', 'a3'],
    ['b1', 'b2'],
    ['c1', 'c2', 'c3'],
    ['d1']
];
echo "<pre>";
print_r($input_array);
echo "</pre>";
$result = array();

$comb_count = 1;
foreach($input_array as $row_array) {
    $comb_count *= count($row_array);
}
$comb_row_length = count($input_array);
$column_indexes = array_fill(0, $comb_row_length, 0);

// ��� ���� ���������� 
for ($i = 0; $i < $comb_count; $i++) {
    // ��� ������� ������� �������� ��� ���������� �� ������� ��������� ������� ��������
    foreach ($column_indexes as $row_index => $col_index) {
		// �������� ��������������� �������� �������� � ����� ����������
        $result[$i][$row_index] = $input_array[$row_index][$col_index];
    }
	// ��������� �������
    incrementIndexes($input_array, $column_indexes);
}
echo "<pre>";
print_r($result);
echo "</pre>";
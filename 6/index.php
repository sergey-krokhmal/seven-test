<?
    // ---- Генерируем массив ----
    $array = array();
    for ($i = 0; $i <=1000000; $i++) {
        $rand = mt_rand (100000, 1500000);
        $array[$i] = $rand;
    }
    
    // ---- Поиск повторяющихся значений ----
    echo "Начало поиска.<br>";
    $start_time = microtime(true);                  // Засечь время
    $repeat_counts = array_count_values($array);    // Получить количество повторений каждого значения массива
    $max_repeat_count = max($repeat_counts);        // Максимальное количество повторений
    $repeats = array();
    for ($i = 2; $i <= $max_repeat_count; $i++) {       // Для всех возможных количеств повторений
        $repeats[$i] = array_keys($repeat_counts, $i);  // Получить повторяемые значения
        
        // Елсли нужен одномерный массив из найденых чисел, то использовать эту инструкцию вместо предыдущей
        // $repeats = array_merge($repeats, array_keys($repeat_counts, $i));
        // Но она работать будет дольше использованой
    }
    
    $end_time = microtime(true);            // Засечь время
    $time = ($end_time - $start_time)*1000; // Получить длительность поиска числа
    echo "Конец поиска. Потрачено времени на поиск: ".$time." милисекунд<br>";
?>
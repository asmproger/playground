<?php

include 'tree.php';

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 120);

$profiling = array();

function custom_profiling($flag = 'empty')
{
    global $profiling;
    $memory = round(memory_get_usage() / (1024 * 1024), 4);
    $profiling[$flag] = array(
        'memory' => $memory . ' Mb',
        'time' => time()
    );
}

function custom_search($value, &$array)
{
    /*for($i = 0; $i < count($array); $i++) {
        if($value === $array[$i]) {
            return $i;
        }
    }
    return false;*/
}

function custom_sort(&$array)
{
    sort($array);
}

custom_profiling('init');

$data = array();

for ($i = 0; $i < 1000000; $i++) {
    $data[] = mt_rand(-500000, 500000);
}

custom_profiling('fill');

custom_sort($data);

custom_profiling('sort');
$value = 100;
//$index = custom_search($value, $data);

for ($i = 0; $i < count($data); $i++) {
    if ($value === $data[$i]) {
        $index = $i;
        break;
    }
}

if ($index !== false) {
    $profiling['FOUND'] = $index;
} else {
    $profiling['FOUND'] = 'NULL';
}
custom_profiling('search');

$tree = new BinaryTree();
for ($i = 0; $i < 1000000; $i++) {
    $val = mt_rand(-500000, 500000);
    $tree->insert($val);
}
custom_profiling('tree');
custom_print_r($profiling);
die;
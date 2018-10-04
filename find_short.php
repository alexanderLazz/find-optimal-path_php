<?php

require_once('connect_graph.php');

$start_node = $_POST['node-1'];
$end_node = $_POST['node-2'];
$nodes_last = [];
$nodes_tmp = [];
$nodes_path = [];
$nodes_parent = [];
$selection = [];
$cur_node = $start_node;
$cur_cost = 0;

foreach ($graph as $key => $value) {
	$nodes_tmp[$key] = NULL;
}

$nodes_tmp[$start_node] = 0;

if (!count($graph[$start_node])) {
    print("из заданной точки нет маршрутов");
    die();
}

while (True) {
    if (count($graph[$cur_node]) > 0) {
        foreach ($graph[$cur_node] as $key => $value) {
            if (array_key_exists($key, $nodes_tmp)) {
                $new_cost = $cur_cost + $value;
                if (($nodes_tmp[$key] == NULL) or ($nodes_tmp[$key] > $new_cost)) {
                    $nodes_tmp[$key] = $new_cost;
                    $nodes_parent[$key] = $cur_node;
                }
            }
        }
    }
    $nodes_last[$cur_node] = $cur_cost;
    unset($nodes_tmp[$cur_node]);

    if (count($nodes_tmp) == 0) {
        break;
    }

    foreach ($nodes_tmp as $key => $value) {
        if ($value) {
            $selection[$key] = $value;
        }
    }

    asort($selection);
    reset($selection);
    $cur_node = key($selection);
    $cur_cost = $selection[$cur_node];
    $selection = [];
}

if (!array_key_exists($end_node, $nodes_parent)) {
    print_r("нет маршрута");
}
else {
    $node_point = $end_node;
    while ($node_point) {
        array_push($nodes_path, $node_point);
        if (!array_key_exists($node_point, $nodes_parent)) {
            break;
        }
        $node_point = $nodes_parent[$node_point];
    }
    $sep = '';
    foreach (array_reverse($nodes_path) as $value) {
        echo $sep, $value;
        $sep = '=>';
    }
    echo "<br>Стоимость пути: $nodes_last[$end_node]";
}

?>
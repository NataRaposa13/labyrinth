<?php

include 'class/Graph.php';
include 'class/Dijkstra.php';

$labyrinthStruct = [
	[0, 7, 3, 5, 0],
	[7, 0, 0, 4, 8],
	[3, 0, 0, 9, 0],
	[5, 4, 2, 1, 6]
];

$row = count($labyrinthStruct);
$col = count($labyrinthStruct[0]);

$start = "01";
$finish = "34";

$graph = new Graph();

for ($x = 0; $x < $row; $x++) {
	for ($y = 0; $y < $col; $y++) {
		$graph->addNode("$x$y");
	}
}

for ($x = 0; $x < $row; $x++) {
	for ($y = 0; $y < $col; $y++) {
		if ($x + 1 < $row && $labyrinthStruct[$x + 1][$y] != 0) {
			$graph->addEdge("$x$y", ($x + 1) . ($y), $labyrinthStruct[$x + 1][$y]);
		}
		if ($x - 1 >= 0 && $labyrinthStruct[$x - 1][$y] != 0) {
			$graph->addEdge("$x$y", ($x - 1) . ($y), $labyrinthStruct[$x - 1][$y]);
		}
		if ($y + 1 < $col && $labyrinthStruct[$x][$y + 1] != 0) {
			$graph->addEdge("$x$y", ($x) . ($y + 1), $labyrinthStruct[$x][$y + 1]);
		}
		if ($y - 1 >= 0 && $labyrinthStruct[$x][$y - 1] != 0) {
			$graph->addEdge("$x$y", ($x) . ($y - 1), $labyrinthStruct[$x][$y - 1]);
		}
	}
}

$dijkstra = new Dijkstra($graph);

echo $dijkstra->getShortsPath($start, $finish);

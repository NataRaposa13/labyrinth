<?php

class Graph
{
	// матрица смежности: $edges['вершина1']['вершина2'] = вес (длина)
	// $edges['A']['B'] = 1;

	/** @var array */
	private $edges;

	public function __construct()
	{
		$this->edges = [];
	}

	public function addNode(string $node): void
	{
		$this->edges[$node] = [];
	}

	public function addEdge(string $node1, string $node2, string $length): void
	{
		$this->edges[$node1][$node2] = $length;
	}

	public function getNodes(): iterable
	{
		foreach ($this->edges as $node => $edge) {
			yield $node;
		}
	}

	public function getEdges($node1): iterable
	{
		foreach ($this->edges[$node1] as $node2 => $length) {
			yield $node2 => $length;
		}
	}
}
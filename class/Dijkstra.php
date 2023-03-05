<?php

class Dijkstra
{
	private const INFINITY = 10;
	private $graph;
	private $used = [];
	private $esume = [];
	private $path = [];

	public function __construct(Graph $graph)
	{
		$this->graph = $graph;
	}

	public function getShortsPath(string $fromNode, string $toNode): string
	{
		$this->init();
		$this->esume[$fromNode] = 0;
		while ($currNode = $this->findNearestUnusedNode()) {
			$this->setEsumToNextNodes($currNode);
		}
		return $this->restorePath($fromNode, $toNode);
	}

	private function init(): void
	{
		foreach ($this->graph->getNodes() as $node) {
			$this->used[$node] = false;
			$this->esume[$node] = self::INFINITY;
			$this->path[$node] = '';
		}
	}

	private function findNearestUnusedNode(): string
	{
		$nearestNode = '';
		foreach ($this->graph->getNodes() as $node) {
			if (!$this->used[$node]) {
				if ($nearestNode === '' || $this->esume[$node] < $this->esume[$nearestNode]) {
					$nearestNode = $node;
				}
			}
		}
		return $nearestNode;
	}

	private function setEsumToNextNodes(string $currNode): void
	{
		$this->used[$currNode] = true;
		foreach ($this->graph->getEdges($currNode) as $nextNode => $length) {
			if (!$this->used[$nextNode]) {
				$newEsum = $this->esume[$currNode] + $length;
				if ($newEsum < $this->esume[$nextNode]) {
					$this->esume[$nextNode] = $newEsum;
					$this->path[$nextNode] = $currNode;
				}
			}
		}
	}

	private function restorePath(string $fromNode, string $toNode): string
	{
		$path = $toNode;
		while ($toNode != $fromNode) {
			$toNode = $this->path[$toNode];
			$path = " - " . $toNode . $path;
		}
		return $path;
	}
}
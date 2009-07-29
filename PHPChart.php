<?php


class PHPChart {
	
	const LEFT = 1;
	const RIGHT = 2;
	const TOP = 4;
	const BOTTOM = 8; 
	const CENTER = 16;
	
	
	private $height = 66;
	private $width = 100;
	
	private $margin = array(0, 0, 0, 0);	
	
	private $backgroundcolor = '#ffffff00';
	private $lines = array();
	private $chart = null;
	private $legend = null;
	private $components = array();
	private $driver;
	private $format;
	private $x1space;
	private $y1space;
	private $x2space;
	private $y2space;
	
	
	
	function __construct($width, $height) {
		$this->height = $height;
		$this->width = $width;
	}
	
	function setBackgroundColor($color) {
		$this->backgroundcolor = $color;
	}
	
	function setDriver(PHPChart_Driver $driver) {
		$this->driver = $driver;
		$driver->init($this->width, $this->height, $this->backgroundcolor, $this->format);
	}
	
	function getDriver() {
		return $this->driver;
	}
	
	
	
	function getSpace() {
		return array($this->x1space, $this->y1space, $this->x2space, $this->y2space);
	}
	
	function setSpace(array $array) {
		list($this->x1space, $this->y1space, $this->x2space, $this->y2space) = $array;
		
	}
	
	
	
	function render() {
		
		//Set up some params
		$this->x1space = 0;
		$this->x2space = $this->width;
		$this->y1space = 0;
		$this->y2space = $this->height;
		
		
		
		$this->legend->render();
		$this->chart->render();
		
		
		header("Content-type: image/png");
		
		echo  $this->driver->getimage();
	}
	
	function setChart(PHPChart_AbstractChart $graph) {
		$this->chart = $graph;
		$graph->setChart($this);
	}
	
	function setLegend(PHPChart_Legend $graph) {
		$this->legend = $graph;
		$graph->setChart($this);
	}
	
}

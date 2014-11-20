<?php
require_once("loadData.php");
require_once("../jpgraph-3.5.0b1.tar/jpgraph-3.5.0b1/jpgraph-3.5.0b1/src/jpgraph.php");
require_once ("../jpgraph-3.5.0b1.tar/jpgraph-3.5.0b1/jpgraph-3.5.0b1/src/jpgraph_line.php");
require_once ("../jpgraph-3.5.0b1.tar/jpgraph-3.5.0b1/jpgraph-3.5.0b1/src/jpgraph_utils.inc.php");
require_once ("../jpgraph-3.5.0b1.tar/jpgraph-3.5.0b1/jpgraph-3.5.0b1/src/jpgraph_bar.php");


class drawChart{
	private $obj;
	private function openFile($file)
	{
		$DoFile=new DoFile($file);
		$this->obj=$DoFile;
	}
	function __construct($file){
		$this->openFile($file);
	}
	function getDate(){
		return $this->obj->dateDay;
	}
	function getPeriodTime(){
		return $this->obj->periodTime; //time of start of period of time
	}
	function getPeriodDrinks(){
		return $this->obj->periodDrinks; //how many drinks during period of time
	}
	function getPeriodCoffees(){
		return $this->obj->periodCoffees;//how many coffees during period of time
	}
	function getDrinks(){
		return $this->obj->drinks; //drinks in total in whole time of the day
	}
	function getCoffees(){
		return $this->obj->coffees;
	}
}
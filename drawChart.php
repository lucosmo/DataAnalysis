<?php
require_once("loadData.php");
class drawChart{
	private $timer=null;
	private $drinks=null;
	private $coffees=null;
	private $date;
	private function openFile($file)
	{
			
	}
	function __construct($data){
		$this->openFile($data);
	}
	function getTimer(){ return $this->timer;}
	function getDrinks(){ return $this->drinks;}
	function getCoffees(){ return $this->coffees;}
}
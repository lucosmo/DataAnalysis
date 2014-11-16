<?php
class drawChart{
	private $timer=null;
	private $drinks=null;
	private $coffees=null;
	private $date;
	private function openFile($file)
	{
		$handle=@fopen($file,"r");
		if($handle){
			$i=0;
			while(($buffer=fgets($handle))!=false)
			{
				if($buffer[0]=="#") $this->date=strtotime(substr($buffer,1,count($buffer)-3));
				else{
					$drinkLine=explode(" ",$buffer);
					$this->timer[$i]=$drinkLine[0];
					$this->drinks[$i]=$drinkLine[1];
					$this->coffees[$i]=$drinkLine[2];
				}
				$i++;
			}
		}
		
	}
	function _construct($data){
		$this->openFile($data);
	}
	function getTimer(){ return $this->timer;}
	function getDrinks(){ return $this->drinks;}
	function getCoffees(){ return $this->coffees;}
}
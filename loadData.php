<?php
class DoFile(){
	private $dateDay; //store date after '#'
	private $periodTime; //time of start of period of time
	private $periodDrinks; //how many drinks during period of time
	private $periodCoffees;//how many coffees during period of time
	private $drinks; //drinks in total in whole time of the day
	private $coffees; //coffees in total in whole time of the day
	
	private function open($file){
		$handle=@fopen($file,"r");
		if($handle){
			$i=0;
			while(($buffer=fgets($handle))!=false)
			{
				if($buffer[0]=="#"){				
					if($buffer[1]!="#")$this->dateDay=strtotime(substr($buffer,1,count($buffer)-2));
					else{
						$buffer=substr($buffer,2,count($buffer)-2);
						$drinkLine=explode(" ",$buffer);
						$this->drinks=$drinkLine[0];
						$this->coffees=$drinkLine[1];
					}
				}
				else{
					$buffer=substr($buffer,0,count($buffer)-2);
					$drinkLine=explode(" ",$buffer);
					$this->periodTime[$i]=$drinkLine[0];
					$this->periodDrinks[$i]=$drinkLine[1];
					$this->periodCoffees[$i]=$drinkLine[2];
				}
				$i++;
			}
		}	
	}
	private 
	function __construct($file){
		$this->open($file);
	}
	

}
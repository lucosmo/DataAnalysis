<?php
class DoFile{
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
			$j=-1;
			while(($buffer=fgets($handle))!=false)
			{
				if($buffer[0]=="#"){				
					if($buffer[1]!="#"){
						$j++;
						$this->dateDay[$j]=strtotime(substr($buffer,1,count($buffer)-2));
					}	
					else{
						$buffer=substr($buffer,2,count($buffer)-2);
						$drinkLine=explode(" ",$buffer);
						$this->drinks[$j]=$drinkLine[0];
						$this->coffees[$j]=$drinkLine[1];
					}
				}
				else{
					$buffer=substr($buffer,0,count($buffer)-2);
					$drinkLine=explode(" ",$buffer);
					$this->periodTime[$j][$i]=$drinkLine[0];
					$this->periodDrinks[$j][$i]=$drinkLine[1];
					$this->periodCoffees[$j][$i]=$drinkLine[2];
				}
				$i++;
			}
		}	
	}
	public function __get($property){
		if(property_exists($this, $property))
			return $this->$property;
	}
	function __construct($file){
		$this->open($file);
	}
}
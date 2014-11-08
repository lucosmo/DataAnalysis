<?php
$coffee=(array)null; // array of names of drinks as key and number of drinks as value
$coffeeTime=(array)null; // temprorary array of time of order - just for test, tommorow wanna remove it
$coffeePeriod=(array)null;
$fileName="29-10-2014.txt";



function putOn($drink, $time)
{
	return $a[$drink]=$time;
}
function howMDrinksInPeriod($coffeeTime, &$coffeePeriod, $time1, $time2)
{
	$c=count($coffeeTime);
	foreach($coffeeTime as $key=>$value){
		$c=count($value);
		for($i=0;$i<$c;$i++)
		{
			if($value[$i]>=$time1 && $value[$i]<=$time2)
				$coffeePeriod[]=putOn($key,$value[$i]);
				
		}
	}
}
function readDrink($drink,$time)
{
	$n=1;
	$signs=strlen($drink);
	$drinkName='';
	$inDrinkName=true;
	$coffee=&$GLOBALS['coffee'];
	$coffeeTime=&$GLOBALS['coffeeTime'];
	for($i=0;$i<$signs;$i++)
	{
		if($i==0 && is_numeric($drink[$i])) {$n=(int)$drink[$i];continue;}
		else 
		{
			if(ctype_alpha($drink[$i])&&$inDrinkName)
			{
				$drinkName.=$drink[$i];
				continue;
			}
			elseif($drink[$i]=="/") continue;
		}
		
		if(strlen($drinkName)==0) continue;
	}
	if(strlen($drinkName)!=0){
		
		if(array_key_exists($drinkName,$coffee)){
			$coffee[$drinkName]+=$n;
			for($i=0;$i<$n;$i++)
				$coffeeTime[$drinkName][]=$time; //bit silly idea to create new array... just for test
		}
		else{
			$coffee[$drinkName]=$n;
			for($i=0;$i<$n;$i++)
				$coffeeTime[$drinkName][]=$time;
		}
	}
	
}

function readTime($time)
{
	return strtotime($time);
}

function readBuffer($buffer)
{
	$drink=explode(" ",$buffer);
	$drinks=count($drink);
	$time=readTime($drink[0]);
	for($i=1;$i<$drinks;$i++)
		readDrink($drink[$i],$time);
}
$handle=@fopen($fileName,"r");
if($handle)
{
	while(($buffer=fgets($handle))!=false)
	{
		$buffer=substr($buffer,0,count($buffer)-3); // -cr - lf
		if($buffer[0]=='/'&&$buffer[1]=='/') continue; // ignore code explanation in test file header
		readBuffer($buffer);
		
	}
	if(!feof($handle))
	{
		echo "Error: unexpected fgets fail\n";
	}
	var_dump($coffee);
	echo array_sum($coffee)." coffees was made<br><br>";
	var_dump($coffeeTime);
	$time1=readTime("9:00");
	$time2=readTime("9:59");
	howMDrinksInPeriod($coffeeTime, $coffeePeriod, $time1, $time2);
	var_dump($coffeePeriod);
	
	fclose($handle);
}
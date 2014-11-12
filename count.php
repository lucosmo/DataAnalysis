<?php
$coffee=(array)null; // array of names of drinks as key and number of drinks as value
$coffeeTime=(array)null; // temprorary array of time of order - just for test, tommorow wanna remove it
$coffeePeriod=(array)null; //drinks ordered in particular period of time
$fileName="29-10-2014.txt";
$cof=0; //global coffee counter


function putOn($drink, $time)
{
	$a[$drink]=$time;
	return $a;
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

function checkDrink($drink)
{
	$espresso=array("SE","DE","SED","DED","SETA","DETA","SEDTA","DEDTA");
	$latte=array("L","LD","LS","LSD","LTA","LDTA","LSDTA","LSTA","LL","LDL","LSL","LSDL");
	$black=array("BC","BCTA","BCD","BCDTA","BCL","BCDL","WATA");
	$cap=array("C","CD","CS","CSD","CTA","CDTA","CSDTA","CSTA","CL");
	$macciato=array("MC","MCS","DMC","DMCS","MCD","MCSD","DMCD","DMCSD","MCTA","MCSTA","DMCTA","DMCSTA","MCDTA","MCSDTA","DMCDTA","DMCSDTA");
	$mocca=array("M","MS","MD","MSD","ML","MSL","MSDL");
	$fw=array("FW","FWD","FWS","FWSD","FWTA","FWDTA","FWSDTA","FWSTA","FWL","FWDL","FWSL","FWSDL");
	
	if((in_array($drink, $espresso)) || (in_array($drink, $latte)) || (in_array($drink, $black)) || (in_array($drink, $macciato)) || (in_array($drink, $mocca)) || (in_array($drink, $cap)) || (in_array($drink, $fw)))
		return 1;
	else
		return 0;
	
}

function findMac($coffeeArray)
{
	reset($coffeeArray);
	$max=max($coffeeArray);
	echo "max coffees - $max<br>";
	var_dump($coffeeArray);
	while(($coffee=current($coffeeArray))!==false){
		if($coffee==$max)
			echo key($coffeeArray)." - $max<br>";
		next($coffeeArray);
	}
}

function topCoffee($coffeeArray)
{
	$espresso=array("SE","DE","SED","DED","SETA","DETA","SEDTA","DEDTA");
	$latte=array("L","LD","LS","LSD","LTA","LDTA","LSDTA","LSTA","LL","LDL","LSL","LSDL");
	$black=array("BC","BCTA","BCD","BCDTA","BCL","BCDL","WATA");
	$cap=array("C","CD","CS","CSD","CTA","CDTA","CSDTA","CSTA","CL");
	$macciato=array("MC","MCS","DMC","DMCS","MCD","MCSD","DMCD","DMCSD","MCTA","MCSTA","DMCTA","DMCSTA","MCDTA","MCSDTA","DMCDTA","DMCSDTA");
	$mocca=array("M","MS","MD","MSD","ML","MSL","MSDL");
	$fw=array("FW","FWD","FWS","FWSD","FWTA","FWDTA","FWSDTA","FWSTA","FWL","FWDL","FWSL","FWSDL");

	$tmpCoffee=array("E"=>0,"L"=>0,"B"=>0,"C"=>0,"MC"=>0,"M"=>0,"FW"=>0);
	foreach($coffeeArray as $key=>$value){
		list($k,$v)=each($value);
		if(in_array($k, $espresso)) $tmpCoffee["E"]++;
		elseif(in_array($k, $latte)) $tmpCoffee["L"]++;
		elseif(in_array($k, $black)) $tmpCoffee["B"]++;
		elseif(in_array($k, $cap)) $tmpCoffee["C"]++;
		elseif(in_array($k, $macciato)) $tmpCoffee["MC"]++;
		elseif(in_array($k, $mocca)) $tmpCoffee["M"]++;
		elseif(in_array($k, $fw)) $tmpCoffee["FW"]++;
		else continue;
	}
	findMac($tmpCoffee);
}

function readDrink($drink,$time)
{
	$n=1;
	$signs=strlen($drink);
	$drinkName='';
	
	$coffee=&$GLOBALS['coffee'];
	$coffeeTime=&$GLOBALS['coffeeTime'];
	$cof=&$GLOBALS['cof'];
	for($i=0;$i<$signs;$i++)
	{
		if($i==0 && is_numeric($drink[$i])) {$n=(int)$drink[$i];continue;}
		else 
		{
			if(ctype_alpha($drink[$i]))
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
		$cof+=checkDrink($drinkName);
	}
	
}

function readTime($time) //why did I create this function? 
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
	$counter=0;
	$day=substr($fileName,0,10);
	$day=strtotime($day);
	$sunday=false;
	if(date("w",$day)==0) $sunday=true;
	for($i=0;$i<=7;$i++){
		if($i==0&&$sunday) continue;
		$time1=readTime("8:00+$i hour");
		
		if($i==7) 
		{
			if($sunday) break;
			else $time2=readTime("8:59+$i hour+1 minute");
		}
		else{
			if($i==6 && $sunday) $time2=readTime("14:30");
			else $time2=readTime("8:59+$i hour");
		}
		howMDrinksInPeriod($coffeeTime, $coffeePeriod, $time1, $time2);
		echo "between ".date('H:i',$time1)."and ".date('H:i',$time2)." ".count($coffeePeriod)." ordered drinks<br>";  
		$counter+=count($coffeePeriod);
		$cc=0;
		foreach($coffeePeriod as $key=>$value){
				list($k,$v)=each($value);
				$cc+=checkDrink($k);
		}
		echo $cc." of them were coffees<br>";
		topCoffee($coffeePeriod);
		unset($coffeePeriod);
		if($i==6 && $sunday) break;
		
	}
	echo $counter." drinks was ordered and ".$cof." of them were coffees<br>";

	fclose($handle);
}
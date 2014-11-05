<?php
$coffee=(array)null;

function readDrink($drink)
{
	$n=1;
	$signs=strlen($drink);
	$drinkName='';
	$inDrinkName=true;
	$coffee=&$GLOBALS['coffee'];
	for($i=0;$i<$signs;$i++)
	{
		if($i==0 && is_numeric($drink[$i])) {$n=$drink[$i];continue;}
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
		if(array_key_exists($drinkName,$coffee))
		$coffee[$drinkName]+=$n;
		else $coffee[$drinkName]=$n;
	}
	
}

function readBuffer($buffer)
{
	$drink=explode(" ",$buffer);
	$drinks=count($drink);
	for($i=1;$i<$drinks;$i++)
	{
		readDrink($drink[$i]);
	}
}
$handle=@fopen("02-11-2014.txt","r");
if($handle)
{
	while(($buffer=fgets($handle))!=false)
	{
		$buffer=substr($buffer,0,count($buffer)-3);
		if($buffer[0]=='/'&&$buffer[1]=='/') continue;
		readBuffer($buffer);
		
	}
	if(!feof($handle))
	{
		echo "Error: unexpected fgets fail\n";
	}
	var_dump($coffee);
	echo array_sum($coffee)." coffees was made<br><br>";
	fclose($handle);
}
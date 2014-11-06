<?php
$coffee=(array)null;
$fileName="29-10-2014.txt";
function readDrink($drink)
{
	$n=1;
	$signs=strlen($drink);
	$drinkName='';
	$inDrinkName=true;
	$coffee=&$GLOBALS['coffee'];
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
		if(array_key_exists($drinkName,$coffee))
		$coffee[$drinkName]+=$n;
		else $coffee[$drinkName]=$n;
	}
	
}

function readTime($buffer)
{
	//echo strtotime($buffer)."<br>";
}

function readBuffer($buffer)
{
	$drink=explode(" ",$buffer);
	$drinks=count($drink);
	readTime($drink[0]);
	for($i=1;$i<$drinks;$i++)
		readDrink($drink[$i]);
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
	fclose($handle);
}
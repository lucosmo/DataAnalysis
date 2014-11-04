<?php
$coffee=array("E"=>0,"ETA"=>0,
"ED"=>0,"EDTA"=>0,
"DE"=>0,"DETA"=>0,
"DED"=>0,"DEDTA"=>0,
"MC"=>0,"MCTA"=>0,
"MCS"=>0,"MCSTA"=>0,
"MCSD"=>0,"MCSDTA"=>0,
"MCD"=>0,"MCDTA"=>0,
"DMC"=>0,"DMCTA"=>0,
"DMCS"=>0,"DMCSTA"=>0,
"DMCD"=>0,"DMCDTA"=>0,
"DMCSD"=>0,"DMCSDTA"=>0,
"L"=>0,"LTA"=>0,
"LS"=>0,"LSTA"=>0,
"LD"=>0,"LDTA"=>0,
"LSD"=>0,"LSDTA"=>0,
"C"=>0,"CTA"=>0,
"CS"=>0,"CSTA"=>0,
"CD"=>0,"CDTA"=>0,
"CSD"=>0,"CSDTA"=>0,
"M"=>0,"MTA"=>0,
"MS"=>0,"MSTA"=>0,
"MD"=>0,"MDTA"=>0,
"MSD"=>0,"MSDTA"=>0,
"FW"=>0,"FWTA"=>0,
"FWS"=>0,"FWSTA"=>0,
"FWD"=>0,"FWDTA"=>0,
"FWSD"=>0,"FWSDTA"=>0,
"BC"=>0,"BCTA"=>0,
"BCD"=>0,"BCDTA"=>0);

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
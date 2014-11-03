<?php
$coffee=array(
"E"=>0;
"ED"=>0;
"DE"=>0;
"DED"=>0;
"MC"=>0;
"MCS"=>0;
"MCSD"=>0;
"MCD"=>0;
"DMC"=>0;
"DMCS"=>0;
"DMCD"=>0;
"DMCSD"=>0;
"L"=>0;
"LS"=>0;
"LD"=>0;
"LSD"=>0;
"C"=>0;
"CS"=>0;
"CD"=>0;
"CSD"=>0;
"M"=>0;
"MS"=>0;
"MD"=>0;
"MSD"=>0;
"FW"=>0;
"FWS"=>0;
"FWD"=>0;
"FWSD"=>0;
"BC"=>0;
"BCD"=>0;);

function readDrink($drink)
{
	$n=0;
	$signs=count($drink);
	for($i=0;$i<$signs;$i++)
	{
		if(is_digit($drink[$i])) $n=$drink[$i];
		else $n=1;
		
	}
}

function readBuffer($buffer)
{
	$drink=explode(" ",$buffer);
	$drinks=count($drink);
	for($i=0;$i<$drinks;$i++)
	{
		readDrink($drink[$i]);
	}
}
$handle=@fopen("02-11-2014.txt","r");
if($handle)
{
	while($buffer=fgets($handle)!=false)
	{
		if($buffer[0]&&$buffer[1]=='/') continue;
		readBuffer($buffer);
		
	}
	if(!feof($handle))
	{
		echo "Error: unexpected fgets fail\n";
	}
	fclose($handle);
}
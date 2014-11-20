<?php
require_once("drawChart.php");
$obj=new drawChart("output.txt");

setlocale (LC_ALL, 'et_EE.ISO-8859-1');
 
$data1y=array_map('intval',$obj->getDrinks());
$data2y=array_map('intval',$obj->getCoffees());
$dates=$obj->getDate();
function timetostr($dates){
	return date('D d/m/Y',$dates);
}

$dates=$obj->getDate();
$dates=array_map('timetostr',$dates,$dates);

$graph = new Graph(550,400);    
$graph->SetScale("textint");
 
$graph->SetShadow();
$graph->img->SetMargin(40,90,20,40);
 
// Create the bar plots
$b1plot = new BarPlot($data1y);
$fcol='red:1.2'; //gradient colors
$tcol='red:0.7'; //gradient colors
$b1plot->SetFillGradient($fcol,$tcol,GRAD_LEFT_REFLECTION);
$b1plot->SetLegend('Coffees');
$b2plot = new BarPlot($data2y);
$fcol='blue:1.2';
$tcol='blue:0.7';
$b2plot->SetFillGradient($fcol,$tcol,GRAD_LEFT_REFLECTION);
$b2plot->SetLegend('Drinks');

// Create the grouped bar plot

$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
 
// ...and add it to the graPH
$graph->Add($gbplot);
$graph->legend->SetColumns(1);
$graph->legend->SetFrameWeight(2);
// show values, why works only after adding plot to the graph?
$b1plot->value->SetFormat('%d');
$b2plot->value->SetFormat('%d');
$b1plot->value->Show();
$b2plot->value->Show();
$graph->legend->Pos(0.91,0.35,'center','top');
$graph->title->Set("Ordered coffees/drinks");
$graph->xaxis->SetTitle("Day","center");
$graph->xaxis->SetTickLabels($dates);
$graph->yaxis->title->Set("Number of orders");
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Display the graph
$graph->Stroke();

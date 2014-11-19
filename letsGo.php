<?php
require_once("drawChart.php");
$obj=new drawChart("output.txt");

setlocale (LC_ALL, 'et_EE.ISO-8859-1');
 
$data1y=array_map('intval',$obj->getDrinks());
$data2y=array_map('intval',$obj->getCoffees());
$graph = new Graph(510,400);    
$graph->SetScale("textlin");
 
$graph->SetShadow();
$graph->img->SetMargin(40,30,20,40);
 
// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");
 
// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
 
// ...and add it to the graPH
$graph->Add($gbplot);
 
$graph->title->Set("Ordered coffees/drinks");
$graph->xaxis->title->Set("Day");
$graph->yaxis->title->Set("Number of orders");
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Display the graph
$graph->Stroke();

DataAnalysis
============

Script reads data from test files. Each test file consists of header of code of names of drinks e.g.:<br>
//DE double espresso<br>
//SE Espresso<br>
//DMC Double Macciato<br>
//MC Macciato<br><br>
Then there is row consists of time of the order and ordered drinks e.g.:<br>
11:54 DE SE<br>
11:51 MC SE<br>
11:46 2DMC<br><br>
Digit before drink code means number of ordered drinks. In case of ordered whole bottle of wine there is "b" before wine code e.g.:<br>
11:44 bCasaPiane<br>
what means that it was ordered 1 bottle of CasaPiane<br><br>

Script creates array of drinks symbols as keys, and number of ordered drinks as values. Script gives quick, short report which says how many drinks was ordered/made.<br>
Current script creates also second array of drinks symbols as keys, and then creates array of time of order for each drink (3-d array).<br>
It allows to check how many drinks was ordered in particular period of time.<br>
<br>
Features:
-counting drinks
-sorting:
	+by name 
	+by type (coffee or not)
	+by time of order
	
Future features:<br>
-migrate from functional programming to oo programing<br>
-finding busiest periods of time<br>
-data visualisation (JS)<br>


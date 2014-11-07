DataAnalysis
============

Script reads data from test files. Each test file consists of header of code of names of drinks e.g.:
//DE double espresso
//E Espresso
//DMC Double Macciato
//MC Macciato
Then there is row consists of time of the order and ordered drinks e.g.:
11:54 DE E
11:51 MC E
11:46 2DMC
Digit before drink code means number of ordered drinks. In case of ordered whole bottle of wine there is "b" before wine code e.g.:
11:44 bCasaPiane
what means that it was ordered 1 bottle of CasaPiane

Script creates array of drinks symbols as keys, and number of ordered drinks as values. Script gives quick, short report which says how many drinks was ordered/made.
Current script creates also second array of drinks symbols as keys, and then creates array of time of order for each drink (3-d array).
It allows to check how many drinks was ordered in particular period of time.

Future features:
-migrate from functional programming to oo programing
-finding busiest periods of time
-data visualisation (JS)


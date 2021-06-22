<?php
/*
*DB_NAME --> Database name
*/
define('DB_NAME', 'calendar_contest');
/*
*DB_HOST --> Host Name
*/
define('DB_HOST', 'localhost');
/*
*DB_USER --> Database user name . default name is root
*/
define('DB_USER', 'root');
/*
*DB_NAME --> Database user password
*/
define('DB_PASS', '');


/*
*DSN --> It's need to edit when you have to switch database server. like (sqlite,mongodb,etc)
*/
define("DSN","mysql:host=".DB_HOST.";dbname=".DB_NAME);

//path
define('PATH', __DIR__);




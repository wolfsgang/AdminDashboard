<?php
ob_start();
session_start();

//database credentials
$dbserver="127.0.0.1";
$dbuser="root";
$dbpwd="";
$dbname="clgblog";

$db = mysql_connect($dbserver,$dbuser,$dbpwd) or die('some error,try again');
mysql_select_db($dbname,$db);

//set timezone
date_default_timezone_set('Asia/Kolkata');

function my_select($query)
{
global $dbserver,$dbuser,$dbpwd,$dbname;
$cid=mysql_connect($dbserver,$dbuser,$dbpwd) or die('some error,try again');
mysql_select_db($dbname,$cid);
$rs=mysql_query($query,$cid);
mysql_close($cid);
return $rs;
}

function my_iud($query)
{
global $dbserver,$dbuser,$dbpwd,$dbname;
$cid=mysql_connect($dbserver,$dbuser,$dbpwd) or die('some error,try again');
mysql_select_db($dbname,$cid);
mysql_query($query,$cid);
$n=mysql_affected_rows($cid);
mysql_close($cid);
return $n;
}

//load classes as needed
function __autoload($class) {
   
   $class = strtolower($class);

	//if call from within assets adjust the path
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 	
	
	//if call from within admin adjust the path
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
	
	//if call from within admin adjust the path
   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
	 
}

$user = new User($db); 
?>
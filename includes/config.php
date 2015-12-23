<?php
ob_start();
session_start();

//database credentials
$dbserver="127.0.0.1";
$dbuser="root";
$dbpwd="";
$dbname="";

$db= new PDO('mysql:host='.$dbserver.';dbname='.$dbname.'',$dbuser, $dbpwd);

//set timezone
date_default_timezone_set('Asia/Kolkata');

function my_select($query)
{
	global $dbserver,$dbuser,$dbpwd,$dbname;
	$dbh= new PDO('mysql:host='.$dbserver.';dbname='.$dbname.'',$dbuser, $dbpwd);
	$rs=$dbh->prepare($query);
	$rs->execute();  
	return $rs;
}

function my_iud($query)
{
	global $dbserver,$dbuser,$dbpwd,$dbname;
	$dbh= new PDO('mysql:host='.$dbserver.';dbname='.$dbname.'',$dbuser, $dbpwd);
	$rs=$dbh->prepare($query);
	$rs->execute();
	$n=$rs->rowCount();
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
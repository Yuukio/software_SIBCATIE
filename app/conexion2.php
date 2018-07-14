<?php
$hostname='localhost';
$username='root';
$dbname  ='bd_sibcatie';
$password='';
try 
{
    $pdoConn = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $pdoConn;
}
catch(Exception $e)
{
  echo $e->getMessage();
}

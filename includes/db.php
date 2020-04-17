<?php
ob_start();
session_start();
$db['db_host']="localhost";
$db['db_user']="root";
$db['db_pass']="";
$db['db_name']='cms';

 foreach ($db as $key => $value){
 define(strtoupper($key),$value);
 }


 $connction=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$query="SET NAMES 'utf-8'";
$selected_charset_query=mysqli_query($connction,$query);

 // if ($connction) {
 //   echo "ready";
 // }
 //   ?>

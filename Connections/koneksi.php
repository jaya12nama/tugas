<?
// isilah dengan user dan password dari MySQL anda
$host ="localhost";
$user ="root";
$password ="";
$database ="sistem_database_akademik3c";

$connect=mysql_connect($host,$user,$password);
  if (! $connect)
  {
  echo " tidak bisa ";
  }
 // memilih database pada server
   mysql_select_db($database)
   or die (" database nggak ada tuh, coba di buat dulu ;) (y) ");
   
?><?php

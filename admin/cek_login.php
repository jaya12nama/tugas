<?php
// Script untuk Koneksi halaman ke database User
$host   ="localhost";
$user ="root";
$password ="";
$database ="sistem_database_akademik3c";
mysql_connect($host,$user,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
$login  = mysql_query("SELECT * FROM login WHERE user='$_POST[user]' AND password='$_POST[password]' ");
$berhasil= mysql_num_rows($login);
$r      = mysql_fetch_array($login);
// Apabila user dan password ditemukan
if ($berhasil > 0){
  session_start();
  $_SESSION[user]     = $r[user];
  $_SESSION[password]     = $r[password];
  header('location:menu.php');
}
else{
  echo "<center>LOGIN GAGAL! <br>
        Username atau Password Anda tidak benar.<br>";
  echo "<a href=login.php><b>ULANGI LAGI</b></a></center>";
}
?><strong></strong>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ratih = "localhost";
$database_ratih = "sistem_database_akademik3c";
$username_ratih = "root";
$password_ratih = "";
$ratih = mysql_pconnect($hostname_ratih, $username_ratih, $password_ratih) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
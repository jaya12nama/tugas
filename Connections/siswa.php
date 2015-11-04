<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_siswa = "localhost";
$database_siswa = "sistem_database_akademik3c";
$username_siswa = "root";
$password_siswa = "";
$siswa = mysql_pconnect($hostname_siswa, $username_siswa, $password_siswa) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
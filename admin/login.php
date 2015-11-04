<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	color: #999999;
	font-weight: bold;
	font-size: 36px;
}
.style2 {color: #FFFFFF}
.style3 {color: #CCCCCC}
-->
</style>
</head>

<body background="../foto/background/hfsdfjksdf.jpg">
<form action="../admin/cek_login.php" method="post">
<p align="center" class="style1"><marquee>SELAMAT DATANG DI WEBSITE SMKN 2 SALATIGA</marquee></p>
<br>
<br>
<br>
<h1>
  <p align="center" class="style2">SILAKAN LOGIN DI SINI</p>
</h1>
<table align="center">
    <tr valign="baseline">
      <td nowrap align="right"><div align="left" class="style3">User:</div></td>
      <td><div align="left">
        <input type="text" name="user" value="<?php echo $row_login['user']; ?>" size="32">
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="" class="style3">Password:</div></td>
      <td><div align="left">
        <input type="password" name="password" value="<?php echo $row_login['password']; ?>" size="32">
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Login"></td>
    </tr>
  </table>
</form>
</center></body>
</html>
</body>
</html>

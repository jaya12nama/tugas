<?php require_once('../Connections/siswa.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE nilai SET guru_kode=%s, SK_kode=%s, nilai_angka=%s, nilai_huruf=%s WHERE siswa_NISN=%s",
                       GetSQLValueString($_POST['guru_kode'], "text"),
                       GetSQLValueString($_POST['SK_kode'], "text"),
                       GetSQLValueString($_POST['nilai_angka'], "double"),
                       GetSQLValueString($_POST['nilai_huruf'], "text"),
                       GetSQLValueString($_POST['siswa_NISN'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($updateSQL, $siswa) or die(mysql_error());

  $updateGoTo = "tampilnilai.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_nl = "-1";
if (isset($_GET['siswa_NISN'])) {
  $colname_nl = $_GET['siswa_NISN'];
}
mysql_select_db($database_siswa, $siswa);
$query_nl = sprintf("SELECT * FROM nilai WHERE siswa_NISN = %s ORDER BY siswa_NISN ASC", GetSQLValueString($colname_nl, "text"));
$nl = mysql_query($query_nl, $siswa) or die(mysql_error());
$row_nl = mysql_fetch_assoc($nl);
$totalRows_nl = mysql_num_rows($nl);

mysql_select_db($database_siswa, $siswa);
$query_ss = "SELECT * FROM siswa ORDER BY siswa_NISN ASC";
$ss = mysql_query($query_ss, $siswa) or die(mysql_error());
$row_ss = mysql_fetch_assoc($ss);
$totalRows_ss = mysql_num_rows($ss);

mysql_select_db($database_siswa, $siswa);
$query_gk = "SELECT * FROM guru ORDER BY guru_kode ASC";
$gk = mysql_query($query_gk, $siswa) or die(mysql_error());
$row_gk = mysql_fetch_assoc($gk);
$totalRows_gk = mysql_num_rows($gk);

mysql_select_db($database_siswa, $siswa);
$query_sk = "SELECT * FROM standar_kompetensi ORDER BY SK_kode ASC";
$sk = mysql_query($query_sk, $siswa) or die(mysql_error());
$row_sk = mysql_fetch_assoc($sk);
$totalRows_sk = mysql_num_rows($sk);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ratih Radiyanti</title>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
<style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif
}
.style3 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style></title>
</head>

<body><body>
<div id="header" class="container">
	<div id="logo"><br />
		<h1><a href="#">
		<span class="style2">SMK Negeri 2 Salatiga</span>
		</a></h1>
  </div>
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="../index.html">Home</a></li>
			<li><a href="../sejarah.html">Profil</a></li>
			<li><a href="../siswa.html">Siswa</a></li>
			<li><a href="../artikel.php">artikel</a></li>
		  <li><a href="../agenda.html">agenda</a>  </li>            
      </ul>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center" class="style3">EDIT NILAI</p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Siswa_NISN:</td>
      <td><select name="siswa_NISN">
        <?php 
do {  
?>
        <option value="<?php echo $row_ss['siswa_NISN']?>" <?php if (!(strcmp($row_ss['siswa_NISN'], $row_ss['siswa_NISN']))) {echo "SELECTED";} ?>><?php echo $row_ss['siswa_NISN']?></option>
        <?php
} while ($row_ss = mysql_fetch_assoc($ss));
?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Guru_kode:</td>
      <td><select name="guru_kode">
        <?php 
do {  
?>
        <option value="<?php echo $row_gk['guru_kode']?>" <?php if (!(strcmp($row_gk['guru_kode'], htmlentities($row_gk['guru_kode'])))) {echo "SELECTED";} ?>><?php echo $row_gk['guru_kode']?></option>
        <?php
} while ($row_gk = mysql_fetch_assoc($gk));
?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SK_kode:</td>
      <td><select name="SK_kode">
        <?php 
do {  
?>
        <option value="<?php echo $row_sk['SK_kode']?>" <?php if (!(strcmp($row_sk['SK_kode'], htmlentities($row_sk['SK_kode'])))) {echo "SELECTED";} ?>><?php echo $row_sk['SK_kode']?></option>
        <?php
} while ($row_sk = mysql_fetch_assoc($sk));
?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_angka:</td>
      <td><input type="text" name="nilai_angka" value="<?php echo htmlentities($row_nl['nilai_angka'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_huruf:</td>
      <td><input type="text" name="nilai_huruf" value="<?php echo htmlentities($row_nl['nilai_huruf'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="siswa_NISN" value="<?php echo $row_nl['siswa_NISN']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($nl);

mysql_free_result($ss);

mysql_free_result($gk);

mysql_free_result($sk);
?>

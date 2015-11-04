<?php require_once('../Connections/siswa.php'); ?>
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
  $updateSQL = sprintf("UPDATE wali_murid SET siswa_NISN=%s, wali_nama_ayah=%s, wali_pekerjaan_ayah=%s, wali_nama_ibu=%s, wali_pekerjaan_ibu=%s, wali_alamat=%s, wali_telpon=%s WHERE wali_id=%s",
                       GetSQLValueString($_POST['siswa_NISN'], "text"),
                       GetSQLValueString($_POST['wali_nama_ayah'], "text"),
                       GetSQLValueString($_POST['wali_pekerjaan_ayah'], "text"),
                       GetSQLValueString($_POST['wali_nama_ibu'], "text"),
                       GetSQLValueString($_POST['wali_pekerjaan_ibu'], "text"),
                       GetSQLValueString($_POST['wali_alamat'], "text"),
                       GetSQLValueString($_POST['wali_telpon'], "text"),
                       GetSQLValueString($_POST['wali_id'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($updateSQL, $siswa) or die(mysql_error());

  $updateGoTo = "admin/tampilwalimurid.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE wali_murid SET siswa_NISN=%s, wali_nama_ayah=%s, wali_pekerjaan_ayah=%s, wali_nama_ibu=%s, wali_pekerjaan_ibu=%s, wali_alamat=%s, wali_telpon=%s WHERE wali_id=%s",
                       GetSQLValueString($_POST['siswa_NISN'], "text"),
                       GetSQLValueString($_POST['wali_nama_ayah'], "text"),
                       GetSQLValueString($_POST['wali_pekerjaan_ayah'], "text"),
                       GetSQLValueString($_POST['wali_nama_ibu'], "text"),
                       GetSQLValueString($_POST['wali_pekerjaan_ibu'], "text"),
                       GetSQLValueString($_POST['wali_alamat'], "text"),
                       GetSQLValueString($_POST['wali_telpon'], "text"),
                       GetSQLValueString($_POST['wali_id'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($updateSQL, $siswa) or die(mysql_error());

  $updateGoTo = "tampilwalimurid.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_siswa, $siswa);
$query_wali = "SELECT * FROM wali_murid ORDER BY wali_id ASC";
$wali = mysql_query($query_wali, $siswa) or die(mysql_error());
$row_wali = mysql_fetch_assoc($wali);
$totalRows_wali = mysql_num_rows($wali);

mysql_select_db($database_siswa, $siswa);
$query_siswa = "SELECT * FROM siswa ORDER BY siswa_NISN ASC";
$siswa = mysql_query($query_siswa, $siswa) or die(mysql_error());
$row_siswa = mysql_fetch_assoc($siswa);
$totalRows_siswa = mysql_num_rows($siswa);
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
</style>
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
			<li><a href="../agenda.html">agenda kelas xii</a></li>
           </ul>
	</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="style3">EDIT WALI MURID</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ID Wali:</td>
      <td><?php echo $row_wali['wali_id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">NISN Siswa:</td>
      <td><select name="siswa_NISN">
        <?php 
do {  
?>
        <option value="<?php echo $row_siswa['siswa_NISN']?>" <?php if (!(strcmp($row_siswa['siswa_NISN'], htmlentities($row_siswa['siswa_NISN'])))) {echo "SELECTED";} ?>><?php echo $row_siswa['siswa_NISN']?></option>
        <?php
} while ($row_siswa = mysql_fetch_assoc($siswa));
?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Ayah:</td>
      <td><input type="text" name="wali_nama_ayah" value="<?php echo htmlentities($row_wali['wali_nama_ayah'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pekerjaan Ayah:</td>
      <td><input type="text" name="wali_pekerjaan_ayah" value="<?php echo htmlentities($row_wali['wali_pekerjaan_ayah'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Ibu:</td>
      <td><input type="text" name="wali_nama_ibu" value="<?php echo htmlentities($row_wali['wali_nama_ibu'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pekerjaan Ibu:</td>
      <td><input type="text" name="wali_pekerjaan_ibu" value="<?php echo htmlentities($row_wali['wali_pekerjaan_ibu'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alamat:</td>
      <td><input type="text" name="wali_alamat" value="<?php echo htmlentities($row_wali['wali_alamat'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telpon:</td>
      <td><input type="text" name="wali_telpon" value="<?php echo htmlentities($row_wali['wali_telpon'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="wali_id" value="<?php echo $row_wali['wali_id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($wali);

mysql_free_result($siswa);
?>
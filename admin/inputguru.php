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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO guru (guru_kode, kompetensi_kode, guru_NIP, guru_nama, guru_alamat, guru_telpon) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['guru_kode'], "text"),
                       GetSQLValueString($_POST['kompetensi_kode'], "text"),
                       GetSQLValueString($_POST['guru_NIP'], "text"),
                       GetSQLValueString($_POST['guru_nama'], "text"),
                       GetSQLValueString($_POST['guru_alamat'], "text"),
                       GetSQLValueString($_POST['guru_telpon'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "../admin/tampilguru.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_GK = "-1";
if (isset($_GET['guru_kode'])) {
  $colname_GK = $_GET['guru_kode'];
}
mysql_select_db($database_siswa, $siswa);
$query_GK = sprintf("SELECT * FROM guru WHERE guru_kode = %s ORDER BY guru_kode ASC", GetSQLValueString($colname_GK, "text"));
$GK = mysql_query($query_GK, $siswa) or die(mysql_error());
$row_GK = mysql_fetch_assoc($GK);
$totalRows_GK = mysql_num_rows($GK);

mysql_select_db($database_siswa, $siswa);
$query_KK = "SELECT * FROM kompetensi_keahlian ORDER BY kompetensi_kode ASC";
$KK = mysql_query($query_KK, $siswa) or die(mysql_error());
$row_KK = mysql_fetch_assoc($KK);
$totalRows_KK = mysql_num_rows($KK);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rockcastle by FCT</title>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
<style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif
}
.style4 {
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
			<li><a href="../agenda.html">agenda kelas xii</a></li>
      </ul>
	</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center" class="style4">INPUT GURU</p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode Guru:</td>
      <td><input type="text" name="guru_kode" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode Kompetensi:</td>
      <td><select name="kompetensi_kode">
        <?php 
do {  
?>
        <option value="<?php echo $row_KK['kompetensi_kode']?>" <?php if (!(strcmp($row_KK['kompetensi_kode'], $row_KK['kompetensi_kode']))) {echo "SELECTED";} ?>><?php echo $row_KK['kompetensi_kode']?></option>
        <?php
} while ($row_KK = mysql_fetch_assoc($KK));
?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">NIP Guru:</td>
      <td><input type="text" name="guru_NIP" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Guru:</td>
      <td><input type="text" name="guru_nama" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alamat Guru:</td>
      <td><input type="text" name="guru_alamat" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telpon Guru:</td>
      <td><input type="text" name="guru_telpon" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="masukan" /></td>
    </tr>
  </table>
  <p>&nbsp;  </p>
  <li>
									<h2 align="justify">Menu</h2>
									<p><a href="inputbidngstudi.php">1. Bidang Studi</a><a href=""><br />
									</a><a href="inputkompetensikeahlian.php">2.Kompetensi Keahlian</a><a href=""><br />
		                            </a><a href="inputstandarkompetensi.php">3. Standart Kompetensi</a><a href=""><br />
		                            </a><a href="inputsiswa.php">4. Siswa</a><a href=""><br />
		                            </a><a href="inputguru.php">5. Guru</a><a href=""><br />
                                    </a><a href="inputnilai.php">6. Nilai</a><a href=""><br />
		                            </a><a href="inputwalimurid.php">7. Wali Murid</a><a href=""><br />			                      </p>
								</li>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
    </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($GK);

mysql_free_result($KK);
?>

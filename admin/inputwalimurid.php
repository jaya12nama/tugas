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
  $insertSQL = sprintf("INSERT INTO wali_murid (wali_id, siswa_NISN, wali_nama_ayah, wali_pekerjaan_ayah, wali_nama_ibu, wali_pekerjaan_ibu, wali_alamat, wali_telpon) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['wali_id'], "text"),
                       GetSQLValueString($_POST['siswa_NISN'], "text"),
                       GetSQLValueString($_POST['wali_nama_ayah'], "text"),
                       GetSQLValueString($_POST['wali_pekerjaan_ayah'], "text"),
                       GetSQLValueString($_POST['wali_nama_ibu'], "text"),
                       GetSQLValueString($_POST['wali_pekerjaan_ibu'], "text"),
                       GetSQLValueString($_POST['wali_alamat'], "text"),
                       GetSQLValueString($_POST['wali_telpon'], "varchar"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "tampilwalimurid.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['wali_id'])) {
  $colname_Recordset1 = $_GET['wali_id'];
}
mysql_select_db($database_siswa, $siswa);
$query_Recordset1 = sprintf("SELECT * FROM wali_murid WHERE wali_id = %s ORDER BY wali_id ASC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $siswa) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_siswa, $siswa);
$query_Recordset2 = "SELECT * FROM siswa ORDER BY siswa_NISN ASC";
$Recordset2 = mysql_query($query_Recordset2, $siswa) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
            <li><a href=""><a href="tampil.php"><blink><em><strong>LIHAT DATA</strong></em></a></a></blink></li>
           </ul>
	</div>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center" class="style4">INPUT WALI MURID</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id Wali:</td>
      <td><input type="text" name="wali_id" value="<?php echo $row_Recordset1['wali_id']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">NISN Siswa:</td>
      <td><select name="siswa_NISN">
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset2['siswa_NISN']?>" <?php if (!(strcmp($row_Recordset2['siswa_NISN'], $row_Recordset2['siswa_NISN']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['siswa_NISN']?></option>
        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Ayah:</td>
      <td><input type="text" name="wali_nama_ayah" value="<?php echo $row_Recordset1['wali_nama_ayah']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pekerjaan Ayah:</td>
      <td><input type="text" name="wali_pekerjaan_ayah" value="<?php echo $row_Recordset1['wali_pekerjaan_ayah']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Ibu:</td>
      <td><input type="text" name="wali_nama_ibu" value="<?php echo $row_Recordset1['wali_nama_ibu']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pekerjaan Ibu:</td>
      <td><input type="text" name="wali_pekerjaan_ibu" value="<?php echo $row_Recordset1['wali_pekerjaan_ibu']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alamat:</td>
      <td><input type="text" name="wali_alamat" value="<?php echo $row_Recordset1['wali_alamat']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telepon:</td>
      <td><input type="text" name="wali_telpon" value="<?php echo $row_Recordset1['wali_telpon']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="masukan" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<li>
									<h2 align="justify">Menu</h2>
									<p><a href="inputbidngstudi.php">1. Bidang Studi</a><br />
									</a><a href="inputkompetensikeahlian.php">2.Kompetensi Keahlian</a><br />
		                            </a><a href="inputstandarkompetensi.php">3. Standart Kompetensi</a><br />
		                            </a><a href="inputsiswa.php">4. Siswa</a><br />
		                            </a><a href="inputguru.php">5. Guru</a><br />
		                            </a><a href="inputnilai.php">6. Nilai</a> <br />	
                                     </a><a href="inputwalimurid.php">7. Wali Murid</a>		                      </p>
								</li>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>

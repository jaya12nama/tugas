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
  $insertSQL = sprintf("INSERT INTO nilai (siswa_NISN, guru_kode, SK_kode, nilai_angka, nilai_huruf) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['siswa_NISN'], "text"),
                       GetSQLValueString($_POST['guru_kode'], "text"),
                       GetSQLValueString($_POST['SK_kode'], "text"),
                       GetSQLValueString($_POST['nilai_angka'], "double"),
                       GetSQLValueString($_POST['nilai_huruf'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "tampilnilai.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO nilai (siswa_NISN, guru_kode, SK_kode, nilai_angka, nilai_huruf) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['siswa_NISN'], "text"),
                       GetSQLValueString($_POST['guru_kode'], "text"),
                       GetSQLValueString($_POST['SK_kode'], "text"),
                       GetSQLValueString($_POST['nilai_angka'], "double"),
                       GetSQLValueString($_POST['nilai_huruf'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "tampilnilai.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_siswa, $siswa);
$query_SS = "SELECT * FROM siswa ORDER BY siswa_NISN ASC";
$SS = mysql_query($query_SS, $siswa) or die(mysql_error());
$row_SS = mysql_fetch_assoc($SS);
$totalRows_SS = mysql_num_rows($SS);

mysql_select_db($database_siswa, $siswa);
$query_GK = "SELECT * FROM guru ORDER BY guru_kode ASC";
$GK = mysql_query($query_GK, $siswa) or die(mysql_error());
$row_GK = mysql_fetch_assoc($GK);
$totalRows_GK = mysql_num_rows($GK);

mysql_select_db($database_siswa, $siswa);
$query_SK = "SELECT * FROM standar_kompetensi ORDER BY SK_kode ASC";
$SK = mysql_query($query_SK, $siswa) or die(mysql_error());
$row_SK = mysql_fetch_assoc($SK);
$totalRows_SK = mysql_num_rows($SK);

mysql_select_db($database_siswa, $siswa);
$query_NL = "SELECT * FROM nilai ORDER BY siswa_NISN ASC";
$NL = mysql_query($query_NL, $siswa) or die(mysql_error());
$row_NL = mysql_fetch_assoc($NL);
$totalRows_NL = mysql_num_rows($NL);
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
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: x-large;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif
}
.style3 {color: #AC98AC}
-->
</style></title>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
<style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif
}
.style4 {
	color: #000000;
	font-weight: bold;
	font-size: 24px;
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  
  <p><input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<p>&nbsp;</p>

<div id="header" class="container">
<div id="menu">
		</div>
	<p><br />
	    <br />
	  <br />
</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p align="center" class="style4">&nbsp;</p>
	<p align="center" class="style4">&nbsp;</p>
	<p align="center" class="style4">INPUT NILAI</p>
	<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">NISN Siswa:</td>
          <td><select name="siswa_NISN">
              <?php 
do {  
?>
              <option value="<?php echo $row_SS['siswa_NISN']?>" <?php if (!(strcmp($row_SS['siswa_NISN'], $row_SS['siswa_NISN']))) {echo "SELECTED";} ?>><?php echo $row_SS['siswa_NISN']?></option>
              <?php
} while ($row_SS = mysql_fetch_assoc($SS));
?>
            </select>
          </td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Kode Guru:</td>
          <td><select name="guru_kode">
              <?php 
do {  
?>
              <option value="<?php echo $row_GK['guru_kode']?>" <?php if (!(strcmp($row_GK['guru_kode'], $row_GK['guru_kode']))) {echo "SELECTED";} ?>><?php echo $row_GK['guru_kode']?></option>
              <?php
} while ($row_GK = mysql_fetch_assoc($GK));
?>
            </select>
          </td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Kode SK:</td>
          <td><select name="SK_kode">
              <?php 
do {  
?>
              <option value="<?php echo $row_SK['SK_kode']?>" <?php if (!(strcmp($row_SK['SK_kode'], $row_SK['SK_kode']))) {echo "SELECTED";} ?>><?php echo $row_SK['SK_kode']?></option>
              <?php
} while ($row_SK = mysql_fetch_assoc($SK));
?>
            </select>
          </td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nilai Angka:</td>
          <td><input type="text" name="nilai_angka" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nilai Huruf:</td>
          <td><input type="text" name="nilai_huruf" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="masukan" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2" />
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
mysql_free_result($SS);

mysql_free_result($GK);

mysql_free_result($SK);

mysql_free_result($NL);
?>

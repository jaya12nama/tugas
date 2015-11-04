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

$colname_data = "-1";
if (isset($_GET['keyword'])) {
  $colname_data = $_GET['keyword'];
}
mysql_select_db($database_siswa, $siswa);
$query_data = sprintf("SELECT * FROM siswa WHERE siswa_nama LIKE %s ORDER BY siswa_nama ASC", GetSQLValueString("%" . $colname_data . "%", "text"));
$data = mysql_query($query_data, $siswa) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
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
-->
</style></title>
</head>

<body><body>
<div id="header" class="container">
	<div id="logo"><br />
		<h1><a href="#">
		<span class="style2">SMK Negeri 2 </span></a><a href="#"><span class="style2"> Salatiga</span>
	    </a></h1>
</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="../index.html">Home</a></li>
			<li><a href="../sejarah.html">Profil</a></li>
			<li><a href="../siswa.html">Siswa</a></li>
			<li><a href="../artikel.php">artikel</a></li>
			<li><a href="../agenda.html">agenda kelas xii</a></li>
      </ul>
	</div>
<form id="form1" name="form1" method="get" action="">
  <label> <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <input type="text" name="keyword" id="keyword" />
  </label>
  <label>
  <input type="submit" name="button" id="button" value="search" />
</label>
  <em>cari berdasarkan nama siswa  </em>
</form>

<?php if ($totalRows_data > 0) { // Show if recordset not empty ?>
  <table border="2" cellpadding="2" cellspacing="1">
    <tr>
      <td>NISN Siswa</td>
      <td>kode kompetensi</td>
      <td>nama siswa</td>
      <td>alamat siswa</td>
      <td>tgl lahir siswa</td>
      <td>foto siswa</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_data['siswa_NISN']; ?></td>
        <td><?php echo $row_data['kompetensi_kode']; ?></td>
        <td><?php echo $row_data['siswa_nama']; ?></td>
        <td><?php echo $row_data['siswa_alamat']; ?></td>
        <td><?php echo $row_data['siswa_tgl_lahir']; ?></td>
        <td><img src="<?php echo $row_data['siswa_foto']; ?>" width="100" /></td>
      </tr>
      <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
</body>
</html>
<?php
mysql_free_result($data);
?>

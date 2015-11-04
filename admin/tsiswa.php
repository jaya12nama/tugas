<?php require_once('../Connections/ratih.php'); ?>
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

mysql_select_db($database_ratih, $ratih);
$query_siswa = "SELECT * FROM siswa ORDER BY siswa_NISN ASC";
$siswa = mysql_query($query_siswa, $ratih) or die(mysql_error());
$row_siswa = mysql_fetch_assoc($siswa);
$totalRows_siswa = mysql_num_rows($siswa);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="2" cellpadding="2" cellspacing="1">
  <tr>
    <td>siswa_NISN</td>
    <td>kompetensi_kode</td>
    <td>siswa_nama</td>
    <td>siswa_alamat</td>
    <td>siswa_tgl_lahir</td>
    <td>siswa_foto</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_siswa['siswa_NISN']; ?></td>
      <td><?php echo $row_siswa['kompetensi_kode']; ?></td>
      <td><?php echo $row_siswa['siswa_nama']; ?></td>
      <td><?php echo $row_siswa['siswa_alamat']; ?></td>
      <td><?php echo $row_siswa['siswa_tgl_lahir']; ?></td>
      <td><img src="<?php echo $row_siswa['siswa_foto']; ?>" width="50</"</td>
    </tr>
    <?php } while ($row_siswa = mysql_fetch_assoc($siswa)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($siswa);
?>

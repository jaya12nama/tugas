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

mysql_select_db($database_siswa, $siswa);
$query_tampilnilai = "SELECT * FROM nilai";
$tampilnilai = mysql_query($query_tampilnilai, $siswa) or die(mysql_error());
$row_tampilnilai = mysql_fetch_assoc($tampilnilai);
$totalRows_tampilnilai = mysql_num_rows($tampilnilai);

$colname_nilai = "-1";
if (isset($_GET['keyword'])) {
  $colname_nilai = $_GET['keyword'];
}
mysql_select_db($database_siswa, $siswa);
$query_nilai = sprintf("SELECT * FROM nilai WHERE siswa_NISN LIKE %s ORDER BY siswa_NISN ASC", GetSQLValueString("%" . $colname_nilai . "%", "text"));
$nilai = mysql_query($query_nilai, $siswa) or die(mysql_error());
$row_nilai = mysql_fetch_assoc($nilai);
$totalRows_nilai = mysql_num_rows($nilai);
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
	font-size: 18px;
	font-weight: bold;
	color: #666666;
}
.style4 {color: #000000}
-->
</style>
</head>

<body>
<div id="header" class="container">
<div id="logo"><br />
<h1><a href="#">
		<span class="style2">SMK Negeri 2 Salatiga</span></a></h1>

</div>
	<p>&nbsp;</p>
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="../index.html">Home</a></li>
			<li><a href="../sejarah.html">Profil</a></li>
			<li><a href="../siswa.html">Siswa</a></li>
			<li><a href="../artik<?php /*?><?php */?>el.php">artikel</a></li>
			<li><a href="../agenda.html">agenda kelas xii</a></li>
      </ul>
</div>
    <p>&nbsp;</p>
    <table border="2" cellpadding="2" cellspacing="1">
  <tr>
    <td width="161" bgcolor="#FF0000"><span class="style4">NISN Siswa</span></td>
    <td width="147" bgcolor="#FF0000"><span class="style4">Kode Guru</span></td>
    <td width="142" bgcolor="#FF0000"><span class="style4">Kode SK</span></td>
    <td width="149" bgcolor="#FF0000"><span class="style4">Nilai Angka</span></td>
    <td width="143" bgcolor="#FF0000"><span class="style4">Nilai Action</span></td>
    <td colspan="2" bgcolor="#FF0000"><div align="center" class="style4">action</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><?php echo $row_tampilnilai['siswa_NISN']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_tampilnilai['guru_kode']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_tampilnilai['SK_kode']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_tampilnilai['nilai_angka']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_tampilnilai['nilai_huruf']; ?></td>
      <td width="44" bgcolor="#FFFFFF"><a href="editnilai.php?siswa_NISN=<?php echo $row_tampilnilai['siswa_NISN']; ?>">Edit</a><a href="editnilai.php?siswa_NISN=<?php echo $row_tampilnilai['siswa_NISN']; ?>"></a></td>
      <td width="53" bgcolor="#FFFFFF"><a href="deletenilai.php?siswa_NISN=<?php echo $row_tampilnilai['siswa_NISN']; ?>">Hapus</a></td>
    </tr>
    <?php } while ($row_tampilnilai = mysql_fetch_assoc($tampilnilai)); ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p class="style3">PENCARIAN NILAI</p>
    <p>
      <label></label></p>
    <form id="form1" name="form1" method="get" action="">
      <label>
        <input type="text" name="keyword" id="keyword" />
      </label>
      <label>
      <input type="submit" name="button" id="button" value="search" />
</label>
</form>
    
    <?php if ($totalRows_nilai > 0) { // Show if recordset not empty ?>
    <table border="2" cellpadding="2" cellspacing="1">
          <tr>
            <td>NISN Siswa</td>
            <td>Kode guru</td>
            <td>Kode SK</td>
            <td>Nilai Angka</td>
            <td>Nilai Huruf</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo $row_nilai['siswa_NISN']; ?></td>
              <td><?php echo $row_nilai['guru_kode']; ?></td>
              <td><?php echo $row_nilai['SK_kode']; ?></td>
              <td><?php echo $row_nilai['nilai_angka']; ?></td>
              <td><?php echo $row_nilai['nilai_huruf']; ?></td>
            </tr>
            <?php } while ($row_nilai = mysql_fetch_assoc($nilai)); ?>
      </table>
      <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
									<li>
									<h2 align="justify">Menu</h2>
									<p><a href="inputbidngstudi.php">1. Bidang Studi</a><br />
									</a><a href="inputkompetensikeahlian.php">2.Kompetensi Keahlian</a><br />
		                            </a><a href="inputstandarkompetensi.php">3. Standart Kompetensi</a><br />
		                            </a><a href="inputsiswa.php">4. Siswa</a><br />
		                            </a><a href="inputguru.php">5. Guru</a><br />
		                            </a><a href="inputnilai.php">6. Nilai</a><br /> 	
                                     </a><a href="inputkompetensikeahlian.php">7. Wali Murid</a> 		                      </p>
								</li>
</body>
</html>
<?php
mysql_free_result($tampilnilai);

mysql_free_result($nilai);
?>

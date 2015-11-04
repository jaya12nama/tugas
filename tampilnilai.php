<?php require_once('Connections/koneksi.php'); ?>
<?php
mysql_select_db($database_koneksi, $koneksi);
$query_tampilnilai = "SELECT * FROM nilai";
$tampilnilai = mysql_query($query_tampilnilai, $koneksi) or die(mysql_error());
$row_tampilnilai = mysql_fetch_assoc($tampilnilai);
$totalRows_tampilnilai = mysql_num_rows($tampilnilai);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="1090" border="2" cellpadding="3" cellspacing="2">
  <tr>
    <td width="208" height="28">siswa_NISN</td>
    <td width="191">guru_kode</td>
    <td width="183">SK_kode</td>
    <td width="193">nilai_angka</td>
    <td width="145">nilai_huruf</td>
    <td colspan="2"><div align="center">Aksi</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_tampilnilai['siswa_NISN']; ?></td>
      <td><?php echo $row_tampilnilai['guru_kode']; ?></td>
      <td><?php echo $row_tampilnilai['SK_kode']; ?></td>
      <td><?php echo $row_tampilnilai['nilai_angka']; ?></td>
      <td><?php echo $row_tampilnilai['nilai_huruf']; ?></td>
      <td width="104"><a href="updatenilai.php?siswa_NISN=<?php echo $row_tampilnilai['siswa_NISN']; ?>">Edit</a></td>
      <td width="104"><a href="deletenilai.php?siswa_NISN=<?php echo $row_tampilnilai['siswa_NISN']; ?>">hapus</a></td>
    </tr>
    <?php } while ($row_tampilnilai = mysql_fetch_assoc($tampilnilai)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($tampilnilai);
?>

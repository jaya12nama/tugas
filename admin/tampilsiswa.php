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
$query_siswa = "SELECT * FROM siswa ORDER BY siswa_NISN ASC";
$siswa = mysql_query($query_siswa, $siswa) or die(mysql_error());
$row_siswa = mysql_fetch_assoc($siswa);
$totalRows_siswa = mysql_num_rows($siswa);

$colname_siswa1 = "-1";
if (isset($_GET['keyword'])) {
  $colname_siswa1 = $_GET['keyword'];
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Rock CastleDescription: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20111127

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
.style3 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
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
</div>
<div id="splash-wrapper">
	<div id="splash">
		<h4 class="style1 style2"><marquee><blink>PREPARE FAITHFUL GRADUATES WHO CAN COMPETE IN THE GLOBAL WORLD</blink></marquee></h4>
  </div>
</div>
<!-- end #header -->
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper-bgtop">
			<div id="page">
				<div id="content">
					<div class="post">
                        <center>
						    <h3>TAMPIL SISWA</h3>
				        </center>
					  <hr />
                        <p><table border="2" cellpadding="2" cellspacing="1">
  <tr>
    <td>siswa NISN</td>
    <td>kompetensi kode</td>
    <td>siswa nama</td>
    <td>siswa alamat</td>
    <td>siswa tgl lahir</td>
    <td>siswa foto</td>
    <td colspan="2"><div align="center">action</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_siswa['siswa_NISN']; ?></td>
      <td><?php echo $row_siswa['kompetensi_kode']; ?></td>
      <td><?php echo $row_siswa['siswa_nama']; ?></td>
      <td><?php echo $row_siswa['siswa_alamat']; ?></td>
      <td><?php echo $row_siswa['siswa_tgl_lahir']; ?></td>
      <td><img src="<?php echo $row_siswa['siswa_foto']; ?>" width="100" /></td>
      <td width="15"><a href="editsiswa.php?siswa_NISN=<?php echo $row_siswa['siswa_NISN']; ?>">Edit</a></td>
      <td width="6"><a href="deletesiswa.php?siswa_NISN=<?php echo $row_siswa['siswa_NISN']; ?>">Hapus</a></td>
    </tr>
    <?php } while ($row_siswa = mysql_fetch_assoc($siswa)); ?>
</table> </p>
                    </div>
                    <p>&nbsp;</p>
                    <p class="style3"><a href="searchsiswa.php"><blink>PENCARIAN SISWA</a></p></blink>
			  </div>
    <!-- end #content -->
				<div id="sidebar">
					<div id="sidebar-bgtop">
						<div id="sidebar-bgbtm">
							<ul>
								<li>
									<div id="search" >
										<form method="get" action="#">
											<div>
												<input type="text" name="s" id="search-text" value="" />
												<input type="submit" id="search-submit" value="GO" />
											</div>
										</form>
									</div>
									<div style="clear: both;">&nbsp;</div>
								</li>
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
                          </ul>
					  </div>
				  </div>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #page -->
		</div>
	</div>
</div>
<div id="footer">
	<div class="content">
		<p>Copyright (c) 2013 Sitename.com. All rights reserved. Design by Ratih</p>
  </div>
</div>
<!-- end #footer -->
</body>
</html>
<?php
mysql_free_result($siswa);
?>

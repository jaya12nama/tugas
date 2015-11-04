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
$folder="gambar/";
$tempat=$folder.basename($_FILES['siswa_foto']['name']);
if (move_uploaded_file($_FILES['siswa_foto']['tmp_name'], $tempat)) {
  $insertSQL = sprintf("INSERT INTO siswa (siswa_NISN, kompetensi_kode, siswa_nama, siswa_alamat, siswa_tgl_lahir, siswa_foto) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['siswa_NISN'], "text"),
                       GetSQLValueString($_POST['kompetensi_kode'], "text"),
                       GetSQLValueString($_POST['siswa_nama'], "text"),
                       GetSQLValueString($_POST['siswa_alamat'], "text"),
                       GetSQLValueString($_POST['siswa_tgl_lahir'], "date"),
                       GetSQLValueString($tempat, "text")); }

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "tampilsiswa.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_sisa = "-1";
if (isset($_GET['siswa_NISN'])) {
  $colname_sisa = $_GET['siswa_NISN'];
}
mysql_select_db($database_siswa, $siswa);
$query_sisa = sprintf("SELECT * FROM siswa WHERE siswa_NISN = %s ORDER BY siswa_NISN ASC", GetSQLValueString($colname_sisa, "text"));
$sisa = mysql_query($query_sisa, $siswa) or die(mysql_error());
$row_sisa = mysql_fetch_assoc($sisa);
$totalRows_sisa = mysql_num_rows($sisa);

mysql_select_db($database_siswa, $siswa);
$query_kk = "SELECT * FROM kompetensi_keahlian ORDER BY kompetensi_kode ASC";
$kk = mysql_query($query_kk, $siswa) or die(mysql_error());
$row_kk = mysql_fetch_assoc($kk);
$totalRows_kk = mysql_num_rows($kk);
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
.style4 {
	font-size: 18px;
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
            <li><a href=""><a href="tampil.php"><blink><em><strong>LIHAT DATA</strong></em></a></a></blink></li>
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
						    <h3>&nbsp;</h3>
				        </center>
					  <hr />
                      <p align="center" class="style4">SISWA</p>
                    
                      <form action="<?php echo $editFormAction; ?>" method="post" id="form1" enctype="multipart/form-data">
                        <table>
                          <tr valign="baseline">
                            <td align="right">NISN Siswa:</td>
                            <td><input type="text" name="siswa_NISN" value="<?php echo $row_sisa['siswa_NISN']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">Kode Kompetensi:</td>
                          <td><select name="kompetensi_kode">
                                <?php 
do {  
?>
                                <option value="<?php echo $row_kk['kompetensi_kode']?>" <?php if (!(strcmp($row_kk['kompetensi_kode'], $row_kk['kompetensi_kode']))) {echo "SELECTED";} ?>><?php echo $row_kk['kompetensi_kode']?></option>
                                <?php
} while ($row_kk = mysql_fetch_assoc($kk));
?>
                              </select>
                            </td>
                          </tr>
                          <tr> </tr>
                          <tr valign="baseline">
                            <td align="right">Nama Siswa:</td>
                            <td><input type="text" name="siswa_nama" value="<?php echo $row_sisa['siswa_nama']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">Alamat Siswa:</td>
                            <td><input type="text" name="siswa_alamat" value="<?php echo $row_sisa['siswa_alamat']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">Tgl Lahir Siswa:</td>
                            <td><input type="text" name="siswa_tgl_lahir" value="<?php echo $row_sisa['siswa_tgl_lahir']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">Foto Siswa:</td>
                            <td><input type="file" name="siswa_foto" value="<?php echo $row_sisa['siswa_foto']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">&nbsp;</td>
                            <td><input type="submit" value="Masukan" /></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
                      </form>
                      <p>&nbsp;</p>
				  </div>
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
									<p><a href="inputbidngstudi.php">1. Bidang Studi</a><a href=""><br />
									</a><a href="inputkompetensikeahlian.php">2.Kompetensi Keahlian</a><a href=""><br />
		                            </a><a href="inputstandarkompetensi.php">3. Standart Kompetensi</a><a href=""><br />
		                            </a><a href="inputsiswa.php">4. Siswa</a><a href=""><br />
		                            </a><a href="inputguru.php">5. Guru</a><a href=""><br />
                                    </a><a href="inputnilai.php">5. Nilai</a><a href=""><br />
		                            </a><a href="inputwalimurid.php">6. Wali Murid</a><a href=""></a>	
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
mysql_free_result($sisa);

mysql_free_result($kk);
?>

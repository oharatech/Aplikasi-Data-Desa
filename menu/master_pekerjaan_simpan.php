<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$id 				= $_POST['id'];
$nama_pekerjaan		= $_POST['nama_pekerjaan'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";
$master_pekerjaan = mysql_query("SELECT * from tblpekerjaan where NamaPekerjaan ='$nama_pekerjaan'");
$mpk=mysql_fetch_array($master_pekerjaan);

if ($mpk >0)
{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/>Kategori Pekerjaan sudah pernah dibuat silahkan ulangi lagi !!</p>";
	$hal="?mn=master_pekerjaan_tambah";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
else
{

	$sql=mysql_query("INSERT INTO tblpekerjaan (PekerjaanID,NamaPekerjaan)
												VALUES ('$id',
														'$nama_pekerjaan')") or die (mysql_error());
														
	$aktifitas="User $_SESSION[username] Melakukan Peng-input-an Data Pekerjaan $nama_pekerjaan";
				include"key_log.php";
				
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Penambahan Kategori Pekerjaan <u>$nama_pekerjaan</u> berhasil</b></p>";
		$hal="?mn=master_pekerjaan";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
													
}
echo"</div></div>";
?>

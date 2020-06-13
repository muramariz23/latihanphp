<?php
//mengambil file lain
require 'functions.php';
//result dari database
$members = query("SELECT * FROM buku ORDER BY id_buku DESC");

if (isset($_POST["cari"])) {
	$members = cari($_POST["keyword"]);
	
}

//ambil data dari object result
//1. mengambil dengan nilai balik array numerik
//$row = mysqli_fetch_row($result);
//var_dump($row);
//2. mengambil data dengan nilai balik array associative
//$as = mysqli_fetch_assoc($result);
//var_dump($as);

//cara menampilkan semua data yang ada
//while ($as = mysqli_fetch_assoc($result)) {
//	var_dump($as["judul"]);
//}
 ?>




<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>DAFTAR BUKU</h1>
<form action="" method="post">
	<input type="text" name="keyword" autofocus placeholder="CARI" autocomplete="off">
	<button type="submit" name="cari">CARI!!!</button>

</form>
<br>
<table style="text-align: center; border: 1px solid black;">
<tr>
	<th>NO</th>
	<th>AKSI</th>
	<th>ID</th>
	<th>JUDUL</th>
	<th>PENULIS</th>
	<th>TAHUN</th>
</tr>
<?php $i = 1; ?>
<?php //memasukan data dari database ke tabel
foreach ($members as $member ) : ?>
<tr>
	<td><?php echo $i; ?></td>
	<td><a href="hapus.php?id=<?php echo $member["id_buku"]; ?>" onclick="return confirm('APAKAH DATA INI AKAN DIHAPUS??')">HAPUS</a>
		<a href="ubah.php?id=<?php echo $member["id_buku"]; ?>">UBAH</a>
	</td>
	<td ><?php echo $member["id_buku"]; ?></td>
	<td><?php echo $member["judul"]; ?></td>
	<td><?php echo $member["penulis"]; ?></td>
	<td><?php echo $member["tahun"] ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>
<a href="tambah.php">TAMBAH DATA</a>
</body>
</html>
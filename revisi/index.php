<?php
//memakai session
session_start();

if(!isset($_SESSION['login'])){
 header("Location: login.php");
 exit;
}

//mengambil file lain
require 'functions.php';
//result dari database
$members = query("SELECT * FROM siswa ORDER BY id DESC");

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
<a href="logout.php">KELUAR</a> 
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
	<th>NISN</th>
	<th>NAMA</th>
	<th>EMAIL</th>
	<th>JURUSAN</th>
	<th>PROFILE</th>
</tr>
<?php $i = 1; ?>
<?php //memasukan data dari database ke tabel
foreach ($members as $member ) : ?>
<tr>
	<td><?php echo $i; ?></td>
	<td><a href="hapus.php?id=<?php echo $member["id"]; ?>" onclick="return confirm('APAKAH DATA INI AKAN DIHAPUS??')">HAPUS</a>
		<a href="ubah.php?id=<?php echo $member["id"]; ?>">UBAH</a>
	</td>
	<td ><?php echo $member["id"]; ?></td>
	<td><?php echo $member["nisn"]; ?></td>
	<td><?php echo $member["nama"]; ?></td>
	<td><?php echo $member["email"] ?></td>
	<td><?php echo $member["jurusan"]; ?></td>
	<td><img src="img/<?php echo $member["profile"] ?>" width = 100px;></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>
<a href="tambah.php">TAMBAH DATA</a>
</body>
</html>
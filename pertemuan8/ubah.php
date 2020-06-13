<?php 
//mengkoneksikan ke mysql melalui function
require 'functions.php';

//variabel untuk mengambil data dari url
	$id = $_GET["id"];
	
	//query data berdasarkan ID
	$mem = query("SELECT * FROM buku WHERE id_buku = $id")[0];
	
//mengecek button sudah di tekan atau belum
if (isset($_POST["submit"])) {

	//mengecek data berhasil diubah atau tidak
	if( ubah($_POST) > 0){
	echo "
	<script>
	alert('DATA BERHASIL DIUBAH')
	document.location.href = 'index.php';
	</script>
	";
	}else{
		echo mysqli_error($conn);
	}


}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ubah</title>
</head>
<body>
<h1>UBAH DATA</h1>

<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $mem["id_buku"] ?>">
	<ul>
		
		<li>
			<label for="judul">JUDUL : </label>
			<input type="text" name="judul" id="judul" required value="<?php echo $mem["judul"] ?>">
		</li>
		<li>
			<label for="penulis">PENULIS : </label>
			<input type="text" name="penulis" id="penulis" required value="<?php echo $mem["penulis"] ?>">
		</li>
		<li>
			<label for="tahun">TAHUN : </label>
			<input type="text" name="tahun" id="tahun" required value="<?php echo $mem["tahun"] ?>">
		</li>
		<li>
			<button type="submit" name="submit">UBAH CUK!</button>
		</li>
	</ul>

</form>
</body>
</html>
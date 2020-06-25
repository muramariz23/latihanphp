<?php 
//memakai session
session_start();

if(!isset($_SESSION['login'])){
 header("Location: login.php");
 exit;
}

//mengkoneksikan ke mysql melalui function
require 'functions.php';

//variabel untuk mengambil data dari url
	$id = $_GET["id"];
	
	//query data berdasarkan ID
	$mem = query("SELECT * FROM siswa WHERE id = $id")[0];
	
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
	<input type="hidden" name="id" value="<?php echo $mem["id"] ?>">
	<ul>
		
		<li>
			<label for="nisn">NISN : </label>
			<input type="text" name="nisn" id="nisn" required value="<?php echo $mem["nisn"] ?>">
		</li>
		<li>
			<label for="nama">NAMA : </label>
			<input type="text" name="nama" id="nama" required value="<?php echo $mem["nama"] ?>">
		</li>
		<li>
			<label for="email">EMAIL : </label>
			<input type="text" name="email" id="email" required value="<?php echo $mem["email"] ?>">
		</li>
		<li>
			<label for="jurusan">JURUSAN : </label>
			<input type="text" name="jurusan" id="jurusan" required value="<?php echo $mem["jurusan"] ?>">
		</li>
		<li>
			<label for="profile">PROFILE : </label>
			<input type="text" name="profile" id="profile" required value="<?php echo $mem["profile"] ?>">
		</li>
		<li>
			<button type="submit" name="submit">UBAH DATA</button>
		</li>
	</ul>

</form>
</body>
</html>
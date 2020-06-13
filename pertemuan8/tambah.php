<?php 
//mengkoneksikan ke mysql melalui function
require 'functions.php';
//mengecek button sudah di tekan atau belum
if (isset($_POST["submit"])) {
	
	//mengecek data berhasil ditambah atau tidak
	if( tambah($_POST) > 0){
	echo "
	<script>
	alert('DATA BERHASIL DITAMBAH')
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
	<title>Tambah</title>
</head>
<body>

<style >
	form h1{
		padding-top: 60px;
		text-align: center;
	}
	form{
		border-radius: 50px;
		background-color: orange;
		position: absolute;
		height: 500px;
		width: 500px;
		text-align: center;
	}
	ul li {
		list-style: none;
		padding: 10px;

	}
	body{
		font-family: arial;
		background: black;

	}
	form ul li input{
		padding: 10px;
		border-radius: 10px;
		border: 1px solid #999;
		width: 199px;
	}
	form ul li button{
		padding: 9px;
		border-radius: 10px;
		border: none;
		background-color: yellow;
		width: 200px;
	}
	form ul li button:hover{
		padding: 9px;
		border-radius: 10px;
		border: none;
		color: yellow;
		background-color: black;
		width: 200px;
	}

	
</style>
<center>
	<div class="login">
		<form action="" method="post">
	<h1>TAMBAH DATA</h1>
	<ul>
		<li>
			<label for="judul">Judul : </label>
			<input type="text" name="judul" id="judul">
		</li>
		<li>
			<label for="penulis">Penulis : </label>
			<input type="text" name="penulis" id="penulis">
		</li>
		<li>
			<label for="tahun">Tahun : </label>
			<input type="text" name="tahun" id="tahun">
		</li>
		<li style="padding: 10px;">
			<button type="submit" name="submit" style="padding: 10px;">TAMBAH CUK!</button>
		</li>
	</ul>
	<label> <a href="index.php" style="text-decoration: none; color: black;">Kembali</a></label>
</form>
	</div>
	
</center>

</body>
</html>
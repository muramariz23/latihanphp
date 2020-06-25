<?php  


//connect to database
$conn = mysqli_connect("localhost","root", "", "data_siswa");

//membuat fungsi untuk query
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

//membuat fungsi untuk menambah data
function tambah($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	$nisn = htmlspecialchars($data["nisn"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$profile = htmlspecialchars($data["profile"]);

	//untuk menambahkan data
	$tambah = "INSERT INTO siswa VALUES ('', '$nisn', '$nama', '$email', '$jurusan', '$profile')";

	mysqli_query($conn, $tambah);
	
	return mysqli_affected_rows($conn);
}

//fungsi untuk menghapus data
function hapus($id){
	global $conn;
	$hapus = "DELETE FROM siswa WHERE id = $id";

	mysqli_query($conn, $hapus);

	return mysqli_affected_rows($conn);
}

//fungsi untuk mengubah data
function ubah($data)
{
	global $conn;
	//ambil data dari tiap elemen dalam form
	$id = $data["id"];
	$nisn = htmlspecialchars($data["nisn"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$profile = htmlspecialchars($data["profile"]);

	//untuk menambahkan data
	$ubah = "UPDATE siswa SET 
				nisn = '$nisn',
				nama = '$nama',
				email = '$email',
				jurusan = '$jurusan',
				profile = '$profile'
			WHERE id = $id";


	mysqli_query($conn, $ubah);
	
	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
	$query = "SELECT * FROM siswa WHERE 

				nisn LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR profil LIKE '%$keyword%'";
	return query($query);
}


function login($data)
{
	global $conn;

	$username = htmlspecialchars($data['username']);
	$password = htmlspecialchars($data['password']);


	//cek username
	if ($users = query("SELECT * FROM user WHERE username = '$username'")){
		//cek password
		if (password_verify($password, $users['password'])){
			//setting session
		$_SESSION['login'] = true;
		header("Location: index.php");
		exit;
		}
	}
		return [
			'error' => true,
			'pesan' => 'Username / Password Salah!!!'
		];
	
}

function registrasi($data)
{
	global $conn;

	$username = htmlspecialchars(strtolower($data['username']));
	$password1 = mysqli_real_escape_string($conn, $data['password1']);
	$password2 = mysqli_real_escape_string($conn, $data['password2']);
//jika ada user biadab
	if(empty($username) || empty($password1) || empty($password2)){
		echo "<script> alert('harap isi semua data sebelum menekan tombol!!!!')
				document.location.href = 'registrasi.php'</script>";
				return false;
	}
	//jika data yang diregistrasi sudah ada
	if(query("SELECT * FROM user WHERE username = '$username' && password = '$password1'")){
		echo "<script> alert('username/password sudah ada')
		document.location.href = 'registrasi.php'</script>";
		mysqli_error($conn);
		return false;
	}
	//jika konfirmasi password tidak sesuai
	if($password1 !== $password2){
		echo "<script> alert('password tidak sama/sesuai')
		document.location.href = 'registrasi.php'</script>";
		return false;
	}

	//jika password kurang dari 5 digit
	if(strlen($password1 < 5)){
		echo "<script> alert('password terlalu pendek, minimal 6 digit')
		document.location.href = 'registrasi.php'</script>";
		return false;
	}

	//jika username & password sudah selesai
	//enkripsi password
	$password_baru = password_hash($password1, PASSWORD_DEFAULT);
	//insert kedalam tabel user
	
	$query = "INSERT INTO user VALUES (null, '$username', '$password_baru')";

	mysqli_query($conn, $query) or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}
 ?>

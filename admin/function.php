
<?php

require_once '../config/get_connection.php';
function getAll()
{
	$exe = pagination()["exe"];
	while ($row = mysqli_fetch_assoc($exe)) {
		$data[] = [
			'id_admin' => $row['id_admin'],
			'nama' => $row['nama'],
			'password' => $row['password'],
			'level' => $row['level'],
		];
	}

	return $data;
}
function pagination()
{
	$min_data = 10;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
	$result_page = mysqli_query(connect(), "SELECT * FROM admin");
	$total = mysqli_num_rows($result_page);
	$total_page = ceil($total / $min_data);

	$query = "SELECT * FROM admin ORDER BY id_admin ASC LIMIT $start, $min_data";
	$exe = mysqli_query(connect(), $query);

	$output = [
		'exe' => $exe,
		'total_page' => $total_page,
		'page' => $page
	];
	return $output;
}

function GetById($id)
{
	$query = "SELECT * FROM  `admin` WHERE  `id_admin` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_admin' => $data['id_admin'],
			'nama' => $data['nama'],
			'password' => $data['password'],
			'level' => $data['level'],

		);
	}
	return $datas;
}

function GetBySearch($search)
{
	$query = "SELECT * FROM  `admin` WHERE nama LIKE '%$search%' OR level LIKE '%$search%' ";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_admin' => $data['id_admin'],
			'nama' => $data['nama'],
			'level' => $data['level'],

		);
	}
	return $datas;
}

function insert()
{
	$nama = $_POST['nama'];
	$password = $_POST['password'];
	$level = $_POST['level'];

	$query = "INSERT INTO `admin` (`id_admin`,`nama`,`password`,`level`)
	VALUES (NULL,'$nama','$password','$level')";
	$exe = mysqli_query(connect(), $query);
	if ($exe) {
		// kalau berhasil
		$_SESSION['success'] = " Data added! ";
		header("Location: index.php");
	} else {
		$_SESSION['failed'] = " Data failed to add ";
		header("Location: index.php");
	}
}
function Update($id)
{
	$nama = $_POST['nama'];
	$password = $_POST['password'];
	$level = $_POST['level'];

	$query = "UPDATE `admin` SET `nama` = '$nama', `password` = '$password', `level` = '$level' WHERE  `id_admin` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	if ($exe) {
		// kalau berhasil
		$_SESSION['success'] = " Data updated! ";
		header("Location: index.php");
	} else {
		$_SESSION['failed'] = " Data failed to updated ";
		header("Location: index.php");
	}
}

function getProfile()
{
	$query = "SELECT * FROM  `profile`";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_profile' => $data['id_profile'],
			'desa' => $data['desa'],
			'kecamatan' => $data['kecamatan'],
			'kabupaten' => $data['kabupaten'],
			'kepala_desa' => $data['kepala_desa'],
			'visi' => $data['visi'],
			'foto' => $data['foto'],
		);
	}
	return $datas;
}

function Delete($id)
{
	$query = "DELETE FROM `admin` WHERE `id_admin` = '$id'";
	$exe = mysqli_query(connect(), $query);
	if ($exe) {
		// kalau berhasil
		$_SESSION['success'] = " Data deleted! ";
		header("Location: index.php");
	} else {
		$_SESSION['failed'] = " Data failed to delete ";
		header("Location: index.php");
	}
}
if (isset($_POST['insert'])) {
	insert();
} else if (isset($_POST['update'])) {
	update($_POST['id_admin']);
} else if (isset($_POST['delete'])) {
	delete($_POST['id_admin']);
} else if (isset($_POST['search'])) {
	GetBySearch($_POST['search']);
}
?>

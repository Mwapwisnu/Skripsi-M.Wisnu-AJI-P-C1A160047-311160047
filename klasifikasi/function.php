
<?php

require_once '../config/get_connection.php';
function getAll()
{
	$exe = pagination()["exe"];
	while ($row = mysqli_fetch_assoc($exe)) {
		$data[] = [
			'id_klasifikasi' => $row['id_klasifikasi'],
			'id_kategori' => $row['id_kategori'],
			'klasifikasi' => $row['klasifikasi'],
			'kategori' => $row['kategori'],
		];
	}

	return $data;
}
function pagination()
{
	$min_data = 10;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
	$result_page = mysqli_query(connect(), "SELECT * FROM klasifikasi");
	$total = mysqli_num_rows($result_page);
	$total_page = ceil($total / $min_data);

	$query = "SELECT * FROM klasifikasi ORDER BY id_klasifikasi ASC LIMIT $start, $min_data";
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
	$query = "SELECT * FROM  `klasifikasi` WHERE  `id_klasifikasi` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_klasifikasi' => $data['id_klasifikasi'],
			'id_kategori' => $data['id_kategori'],
			'klasifikasi' => $data['klasifikasi'],
			'kategori' => $data['kategori'],

		);
	}
	return $datas;
}

function GetBySearch($search)
{
	$query = "SELECT * FROM  `klasifikasi` WHERE id_kategori LIKE '%$search%' OR klasifikasi LIKE '%$search%' OR kategori LIKE '%$search%' ";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_klasifikasi' => $data['id_klasifikasi'],
			'id_kategori' => $data['id_kategori'],
			'klasifikasi' => $data['klasifikasi'],
			'kategori' => $data['kategori'],

		);
	}
	return $datas;
}

function insert()
{
	$id_kategori = $_POST['id_kategori'];
	$klasifikasi = $_POST['klasifikasi'];
	$kategori = $_POST['kategori'];

	$query = "INSERT INTO `klasifikasi` (`id_klasifikasi`,`id_kategori`,`klasifikasi`,`kategori`)
	VALUES (NULL,'$id_kategori','$klasifikasi','$kategori')";
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
	$id_kategori = $_POST['id_kategori'];
	$klasifikasi = $_POST['klasifikasi'];
	$kategori = $_POST['kategori'];

	$query = "UPDATE `klasifikasi` SET `id_kategori` = '$id_kategori',`klasifikasi` = '$klasifikasi',`kategori` = '$kategori' WHERE  `id_klasifikasi` =  '$id'";
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
function Delete($id)
{
	$query = "DELETE FROM `klasifikasi` WHERE `id_klasifikasi` = '$id'";
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


if (isset($_POST['insert'])) {
	insert();
} else if (isset($_POST['update'])) {
	update($_POST['id_klasifikasi']);
} else if (isset($_POST['delete'])) {
	delete($_POST['id_klasifikasi']);
} else if (isset($_POST['search'])) {
	GetBySearch($_POST['search']);
}
?>

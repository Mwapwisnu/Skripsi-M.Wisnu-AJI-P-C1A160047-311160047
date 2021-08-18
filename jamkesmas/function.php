<?php

session_start();

require_once '../config/get_connection.php';
function getAll()
{
	$exe = pagination()["exe"];
	while ($row = mysqli_fetch_assoc($exe)) {
		$data[] = [
			'id_jamkesmas' => $row['id_jamkesmas'],
			'nama_kepala_keluarga' => $row['nama_kepala_keluarga'],
			'jumlah_tunggangan' => $row['jumlah_tunggangan'],
			'jumlah_uang' => $row['jumlah_uang'],
			'keterangan' => $row['keterangan'],
			'rt' => $row['rt'],
			'rw' => $row['rw'],
		];
	}

	return $data;
}
function pagination()
{
	$min_data = 10;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
	$result_page = mysqli_query(connect(), "SELECT * FROM jamkesmas");
	$total = mysqli_num_rows($result_page);
	$total_page = ceil($total / $min_data);

	$query = "SELECT * FROM jamkesmas ORDER BY id_jamkesmas ASC LIMIT $start, $min_data";
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
	$query = "SELECT * FROM  `jamkesmas` WHERE  `id_jamkesmas` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_jamkesmas' => $data['id_jamkesmas'],
			'nama_kepala_keluarga' => $data['nama_kepala_keluarga'],
			'jumlah_tunggangan' => $data['jumlah_tunggangan'],
			'jumlah_uang' => $data['jumlah_uang'],
			'keterangan' => $data['keterangan'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],

		);
	}
	return $datas;
}

function GetBySearch($search)
{
	$query = "SELECT * FROM  `jamkesmas` WHERE nama_kepala_keluarga LIKE '%$search%' OR jumlah_tunggangan LIKE '%$search%' OR jumlah_uang LIKE '%$search%' OR keterangan LIKE '%$search%' OR rt LIKE '%$search%' OR rw LIKE '%$search%' ";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_jamkesmas' => $data['id_jamkesmas'],
			'nama_kepala_keluarga' => $data['nama_kepala_keluarga'],
			'jumlah_tunggangan' => $data['jumlah_tunggangan'],
			'jumlah_uang' => $data['jumlah_uang'],
			'keterangan' => $data['keterangan'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],

		);
	}
	return $datas;
}

function insert()
{
	$nama_kepala_keluarga = $_POST['nama_kepala_keluarga'];
	$jumlah_tunggangan = $_POST['jumlah_tunggangan'];
	$jumlah_uang = $_POST['jumlah_uang'];
	$keterangan = $_POST['keterangan'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];

	$query = "INSERT INTO `jamkesmas` (`id_jamkesmas`,`nama_kepala_keluarga`,`jumlah_tunggangan`,`jumlah_uang`,`keterangan`,`rt`,`rw`)
			VALUES (NULL,'$nama_kepala_keluarga','$jumlah_tunggangan','$jumlah_uang','$keterangan','$rt','$rw')";
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
	$nama_kepala_keluarga = $_POST['nama_kepala_keluarga'];
	$jumlah_tunggangan = $_POST['jumlah_tunggangan'];
	$jumlah_uang = $_POST['jumlah_uang'];
	$keterangan = $_POST['keterangan'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];

	$query = "UPDATE `jamkesmas` SET `nama_kepala_keluarga` = '$nama_kepala_keluarga',`jumlah_tunggangan` = '$jumlah_tunggangan',`jumlah_uang` = '$jumlah_uang',`keterangan` = '$keterangan',`rt` = '$rt',`rw` = '$rw' WHERE  `id_jamkesmas` =  '$id'";
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
	$query = "DELETE FROM `jamkesmas` WHERE `id_jamkesmas` = '$id'";
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

function getData()
{
	$query = "SELECT * FROM  `jamkesmas`";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_jamkesmas' => $data['id_jamkesmas'],
			'nama_kepala_keluarga' => $data['nama_kepala_keluarga'],
			'jumlah_tunggangan' => $data['jumlah_tunggangan'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],
			'jumlah_uang' => $data['jumlah_uang'],
			'keterangan' => $data['keterangan'],
		);
	}
	return $datas;
}

if (isset($_POST['insert'])) {
	insert();
} else if (isset($_POST['update'])) {
	update($_POST['id_jamkesmas']);
} else if (isset($_POST['delete'])) {
	delete($_POST['id_jamkesmas']);
} else if (isset($_POST['search'])) {
	GetBySearch($_POST['search']);
}

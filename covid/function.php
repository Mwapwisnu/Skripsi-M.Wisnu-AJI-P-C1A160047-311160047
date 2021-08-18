<?php
session_start();
require_once '../config/get_connection.php';
function getAll()
{
	$exe = pagination()["exe"];
	while ($row = mysqli_fetch_assoc($exe)) {
		$data[] = [
			'id_covid' => $row['id_covid'],
			'nik' => $row['nik'],
			'nama' => $row['nama'],
			'tempat_lahir' => $row['tempat_lahir'],
			'tanggal_lahir' => $row['tanggal_lahir'],
			'jenis_kelamin' => $row['jenis_kelamin'],
			'gol_darah' => $row['gol_darah'],
			'alamat' => $row['alamat'],
			'pekerjaan' => $row['pekerjaan'],
			'agama' => $row['agama'],
			'status' => $row['status'],
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
	$result_page = mysqli_query(connect(), "SELECT * FROM covid");
	$total = mysqli_num_rows($result_page);
	$total_page = ceil($total / $min_data);

	$query = "SELECT * FROM covid ORDER BY id_covid ASC LIMIT $start, $min_data";
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
	$query = "SELECT * FROM  `covid` WHERE  `id_covid` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_covid' => $data['id_covid'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'tempat_lahir' => $data['tempat_lahir'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'gol_darah' => $data['gol_darah'],
			'alamat' => $data['alamat'],
			'pekerjaan' => $data['pekerjaan'],
			'agama' => $data['agama'],
			'status' => $data['status'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],

		);
	}
	return $datas;
}

function GetBySearch($search)
{
	$query = "SELECT * FROM  `covid` WHERE nik LIKE '%$search%' OR nama LIKE '%$search%' OR tempat_lahir LIKE '%$search%' OR tanggal_lahir LIKE '%$search%' OR jenis_kelamin LIKE '%$search%' OR gol_darah LIKE '%$search%' OR alamat LIKE '%$search%' OR pekerjaan LIKE '%$search%' OR agama LIKE '%$search%' OR status LIKE '%$search%' OR rt LIKE '%$search%' OR rw LIKE '%$search%'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_covid' => $data['id_covid'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'tempat_lahir' => $data['tempat_lahir'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'gol_darah' => $data['gol_darah'],
			'alamat' => $data['alamat'],
			'pekerjaan' => $data['pekerjaan'],
			'agama' => $data['agama'],
			'status' => $data['status'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],

		);
	}
	return $datas;
}

function GetBySearchRT($search_rt)
{
	$query = "SELECT * FROM  `covid` WHERE rt LIKE '%$search_rt%'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_covid' => $data['id_covid'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'tempat_lahir' => $data['tempat_lahir'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'gol_darah' => $data['gol_darah'],
			'alamat' => $data['alamat'],
			'pekerjaan' => $data['pekerjaan'],
			'agama' => $data['agama'],
			'status' => $data['status'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],
		);
	}
	return $datas;
}

function GetBySearchRW($search_rw)
{
	$query = "SELECT * FROM  `covid` WHERE rw LIKE '%$search_rw%'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_covid' => $data['id_covid'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'tempat_lahir' => $data['tempat_lahir'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'gol_darah' => $data['gol_darah'],
			'alamat' => $data['alamat'],
			'pekerjaan' => $data['pekerjaan'],
			'agama' => $data['agama'],
			'status' => $data['status'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],
		);
	}
	return $datas;
}

function insert()
{
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$gol_darah = $_POST['gol_darah'];
	$alamat = $_POST['alamat'];
	$pekerjaan = $_POST['pekerjaan'];
	$agama = $_POST['agama'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$status = $_POST['status'];

	$query = "INSERT INTO `covid` (`id_covid`,`nik`,`nama`,`tempat_lahir`,`tanggal_lahir`,`jenis_kelamin`,`gol_darah`,`alamat`,`pekerjaan`,`agama`, `rt`, `rw`, `status`)
			VALUES (NULL,'$nik','$nama','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$gol_darah','$alamat','$pekerjaan','$agama', '$rt', '$rw', '$status')";
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
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$gol_darah = $_POST['gol_darah'];
	$alamat = $_POST['alamat'];
	$pekerjaan = $_POST['pekerjaan'];
	$agama = $_POST['agama'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$status = $_POST['status'];

	$query = "UPDATE `covid` SET `nik` = '$nik',`nama` = '$nama',`tempat_lahir` = '$tempat_lahir',`tanggal_lahir` = '$tanggal_lahir',`jenis_kelamin` = '$jenis_kelamin',`gol_darah` = '$gol_darah',`alamat` = '$alamat',`pekerjaan` = '$pekerjaan',`agama` = '$agama', `rt` = '$rw', `rw` = '$rw', `status` = '$status' WHERE  `id_covid` =  '$id'";
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
	$query = "DELETE FROM `covid` WHERE `id_covid` = '$id'";
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

function GetAgama()
{
	$query = "SELECT * FROM  `agama`";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_agama' => $data['id_agama'],
			'id_agama' => $data['id_agama'],
			'agama' => $data['agama'],

		);
	}
	return $datas;
}

if (isset($_POST['insert'])) {
	insert();
} else if (isset($_POST['update'])) {
	update($_POST['id_covid']);
} else if (isset($_POST['delete'])) {
	delete($_POST['id_covid']);
} else if (isset($_POST['search'])) {
	GetBySearch($_POST['search']);
} else if (isset($_POST['search_rt'])) {
	GetBySearchRT($_POST['search_rt']);
} else if (isset($_POST['search_rw'])) {
	GetBySearchRW($_POST['search_rw']);
}

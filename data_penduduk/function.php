
<?php

require_once '../config/get_connection.php';
function getAll()
{
	$exe = pagination()["exe"];
	while ($row = mysqli_fetch_assoc($exe)) {
		$data[] = [
			'id_data_penduduk' => $row['id_data_penduduk'],
			'no_kk' => $row['no_kk'],
			'rt' => $row['rt'],
			'rw' => $row['rw'],
			'jumlah_individu' => $row['jumlah_individu'],
			'kepala_keluarga' => $row['kepala_keluarga'],
			'nama' => $row['nama'],
		];
	}

	return $data;
}
function pagination()
{
	$min_data = 10;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
	$result_page = mysqli_query(connect(), "SELECT * FROM data_penduduk JOIN data_individu ON data_individu.no_kk = data_penduduk.no_kk");
	$total = mysqli_num_rows($result_page);
	$total_page = ceil($total / $min_data);

	$query = "SELECT * FROM data_penduduk ORDER BY no_kk ASC LIMIT $start, $min_data";
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
	$query = "SELECT * FROM  `data_penduduk` WHERE  `id_data_penduduk` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_data_penduduk' => $data['id_data_penduduk'],
			'no_kk' => $data['no_kk'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],
			'jumlah_individu' => $data['jumlah_individu'],
			'kepala_keluarga' => $data['kepala_keluarga'],

		);
	}
	return $datas;
}

function GetBySearch($search)
{
	$query = "SELECT * FROM  `data_penduduk` WHERE nik LIKE '%$search%' OR nama LIKE '%$search%' OR alamat LIKE '%$search%' OR rt LIKE '%$search%' OR rw LIKE '%$search%' OR jumlah_individu LIKE '%$search%' OR kepala_keluarga LIKE '%$search%' ";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_data_penduduk' => $data['id_data_penduduk'],
			'no_kk' => $data['no_kk'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'alamat' => $data['alamat'],
			'rt' => $data['rt'],
			'rw' => $data['rw'],
			'jumlah_individu' => $data['jumlah_individu'],
			'kepala_keluarga' => $data['kepala_keluarga'],

		);
	}
	return $datas;
}

function insert()
{
	$no_kk = $_POST['no_kk'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$jumlah_individu = $_POST['jumlah_individu'];
	$kepala_keluarga = $_POST['kepala_keluarga'];

	$query = "INSERT INTO `data_penduduk` (`id_data_penduduk`,`no_kk`,`rt`,`rw`,`jumlah_individu`,`kepala_keluarga`)
	VALUES (NULL,'$no_kk','$rt','$rw','$jumlah_individu','$kepala_keluarga')";
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
	$no_kk = $_POST['no_kk'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$jumlah_individu = $_POST['jumlah_individu'];
	$kepala_keluarga = $_POST['kepala_keluarga'];

	$query = "UPDATE `data_penduduk` SET `no_kk` = '$no_kk',`rt` = '$rt',`rw` = '$rw',`jumlah_individu` = '$jumlah_individu',`kepala_keluarga` = '$kepala_keluarga' WHERE  `id_data_penduduk` =  '$id'";
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
	$query = "DELETE FROM `data_penduduk` WHERE `id_data_penduduk` = '$id'";
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

function getPenduduk()
{
	$query = "SELECT * FROM data_individu INNER JOIN data_penduduk ON data_penduduk.no_kk = data_individu.no_kk";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'no_kk' => $data['no_kk'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'tempat_lahir' => $data['tempat_lahir'],
			'tanggal' => $data['tanggal'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'gol_darah' => $data['gol_darah'],
			'alamat' => $data['alamat'],
			'pekerjaan' => $data['pekerjaan'],
			'kewarganegaraan' => $data['kewarganegaraan'],
			'agama' => $data['agama'],
			'foto' => $data['foto'],
			'klasifikasi' => $data['klasifikasi'],
			'jumlah_individu' => $data['jumlah_individu']
		);
	}
	return $datas;
}


if (isset($_POST['insert'])) {
	insert();
} else if (isset($_POST['update'])) {
	update($_POST['id_data_penduduk']);
} else if (isset($_POST['delete'])) {
	delete($_POST['id_data_penduduk']);
} else if (isset($_POST['search'])) {
	GetBySearch($_POST['search']);
}
?>

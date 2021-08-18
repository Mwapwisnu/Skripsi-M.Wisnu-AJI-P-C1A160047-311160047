
<?php
require_once '../config/get_connection.php';
function getAll()
{
	$exe = pagination()["exe"];
	while ($row = mysqli_fetch_assoc($exe)) {
		$data[] = [
			'id_data_individu' => $row['id_data_individu'],
			'no_kk' => $row['no_kk'],
			'nik' => $row['nik'],
			'nama' => $row['nama'],
			'tempat_lahir' => $row['tempat_lahir'],
			'tanggal' => $row['tanggal'],
			'jenis_kelamin' => $row['jenis_kelamin'],
			'gol_darah' => $row['gol_darah'],
			'alamat' => $row['alamat'],
			'pekerjaan' => $row['pekerjaan'],
			'kewarganegaraan' => $row['kewarganegaraan'],
			'agama' => $row['agama'],
			'foto' => $row['foto'],
			'klasifikasi' => $row['klasifikasi'],
		];
	}

	return $data;
}
function pagination()
{
	$min_data = 10;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
	$result_page = mysqli_query(connect(), "SELECT * FROM data_individu");
	$total = mysqli_num_rows($result_page);
	$total_page = ceil($total / $min_data);

	$level = $_SESSION["level"];
	$id_data_individu = $_SESSION["id_data_individu"];

	$query = "SELECT * FROM data_individu ORDER BY id_data_individu ASC LIMIT $start, $min_data";
	$exe = mysqli_query(connect(), $query);

	if ($level != "Masyarakat") {
		$query = "SELECT * FROM data_individu ORDER BY id_data_individu ASC LIMIT $start, $min_data";
		$exe = mysqli_query(connect(), $query);
	}

	if ($level == "Masyarakat") {
		$query = "SELECT * FROM data_individu WHERE id_data_individu = $id_data_individu ORDER BY id_data_individu ASC LIMIT $start, $min_data";
		$exe = mysqli_query(connect(), $query);
	}


	$output = [
		'exe' => $exe,
		'total_page' => $total_page,
		'page' => $page
	];
	return $output;
}

function GetById($id)
{
	$query = "SELECT * FROM  `data_individu` WHERE  `id_data_individu` =  '$id'";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_data_individu' => $data['id_data_individu'],
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
			'akta' => $data['akta'],
			'ktp' => $data['ktp'],
			'surat_nikah' => $data['surat_nikah'],

		);
	}
	return $datas;
}

function GetBySearch($search)
{
	$query = "SELECT * FROM  `data_individu` WHERE no_kk LIKE '%$search%' OR nik LIKE '%$search%' OR nama LIKE '%$search%' OR tempat_lahir LIKE '%$search%' OR tanggal LIKE '%$search%' OR jenis_kelamin LIKE '%$search%' OR gol_darah LIKE '%$search%' OR alamat LIKE '%$search%' OR pekerjaan LIKE '%$search%' OR kewarganegaraan LIKE '%$search%' OR agama LIKE '%$search%' OR foto LIKE '%$search%' OR klasifikasi LIKE '%$search%' ";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_data_individu' => $data['id_data_individu'],
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

		);
	}
	return $datas;
}

function insert()
{
	$no_kk = $_POST['no_kk'];
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal = $_POST['tanggal'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$gol_darah = $_POST['gol_darah'];
	$alamat = $_POST['alamat'];
	$pekerjaan = $_POST['pekerjaan'];
	$kewarganegaraan = $_POST['kewarganegaraan'];
	$agama = $_POST['agama'];
	$klasifikasi = $_POST['klasifikasi'];
	$foto = $_POST['foto'];

	$query = "INSERT INTO `data_individu` (`id_data_individu`,`no_kk`,`nik`,`nama`,`tempat_lahir`,`tanggal`,`jenis_kelamin`,`gol_darah`,`alamat`,`pekerjaan`,`kewarganegaraan`,`agama`,`foto`,`klasifikasi`)
	VALUES (NULL,'$no_kk','$nik','$nama','$tempat_lahir','$tanggal','$jenis_kelamin','$gol_darah','$alamat','$pekerjaan','$kewarganegaraan','$agama','$nama_file','$klasifikasi')";
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
	$tanggal = $_POST['tanggal'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$gol_darah = $_POST['gol_darah'];
	$alamat = $_POST['alamat'];
	$pekerjaan = $_POST['pekerjaan'];
	$kewarganegaraan = $_POST['kewarganegaraan'];
	$agama = $_POST['agama'];
	$klasifikasi = $_POST['klasifikasi'];

	// Foto
	$nama_file = $_FILES['foto']['name'];
	$source = $_FILES['foto']['tmp_name'];
	$folder = './../assets/img/individu/';

	if ($nama_file != '') {
		$nama_file = uniqid();
		$nama_file .= '.png';

		move_uploaded_file($source, $folder . $nama_file);
		$query = "UPDATE `data_individu` SET `nik` = '$nik',`nama` = '$nama',`tempat_lahir` = '$tempat_lahir',`tanggal` = '$tanggal',`jenis_kelamin` = '$jenis_kelamin',`gol_darah` = '$gol_darah',`alamat` = '$alamat',`pekerjaan` = '$pekerjaan',`kewarganegaraan` = '$kewarganegaraan',`agama` = '$agama',`foto` = '$nama_file',`klasifikasi` = '$klasifikasi' WHERE  `id_data_individu` =  '$id'";
		$exe = mysqli_query(connect(), $query);
		if ($exe) {
			// kalau berhasil
			$_SESSION['success'] = " Data added! ";
			header("Location: index.php");
		} else {
			$_SESSION['failed'] = " Data failed to add ";
			header("Location: index.php");
		}
	} else {
		$query = "UPDATE `data_individu` SET `nik` = '$nik',`nama` = '$nama',`tempat_lahir` = '$tempat_lahir',`tanggal` = '$tanggal',`jenis_kelamin` = '$jenis_kelamin',`gol_darah` = '$gol_darah',`alamat` = '$alamat',`pekerjaan` = '$pekerjaan',`kewarganegaraan` = '$kewarganegaraan',`agama` = '$agama',`klasifikasi` = '$klasifikasi' WHERE  `id_data_individu` =  '$id'";
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


	//Akta
	$nama_file_akta = $_FILES['akta']['name'];
	$source_akta = $_FILES['akta']['tmp_name'];
	$folder_akta = './../assets/pdf/akta/';

	if ($nama_file_akta != '') {
		$nama_file_akta = uniqid();
		$nama_file_akta .= '.pdf';
		move_uploaded_file($source_akta, $folder_akta . $nama_file_akta);
		$query = "UPDATE `data_individu` SET `akta` = '$nama_file_akta' WHERE `id_data_individu` =  '$id'";
		$exe = mysqli_query(connect(), $query);
		if ($exe) {
			// kalau berhasil
			$_SESSION['success'] = " Data terverifikasi! ";
			header('Location: index.php');
		} else {
			$_SESSION['failed'] = " Data tidak terverifikasi ";
			header('Location: edit.php' . '<?= $id_data_individu ?>');
		}
	}

	// KTP
	$nama_file_ktp = $_FILES['ktp']['name'];
	$source_ktp = $_FILES['ktp']['tmp_name'];
	$folder_ktp = './../assets/pdf/ktp/';

	if ($nama_file_ktp != '') {
		$nama_file_ktp = uniqid();
		$nama_file_ktp .= '.pdf';

		move_uploaded_file($source_ktp, $folder_ktp . $nama_file_ktp);
		$query = "UPDATE `data_individu` SET `ktp` = '$nama_file_ktp' WHERE `id_data_individu` =  '$id'";
		$exe = mysqli_query(connect(), $query);
		if ($exe) {
			// kalau berhasil
			$_SESSION['success'] = " Data terverifikasi! ";
			header('Location: index.php');
		} else {
			$_SESSION['failed'] = " Data tidak terverifikasi ";
			header('Location: index.php');
		}
	}

	// Surat nikah
	$nama_file_surat_nikah = $_FILES['surat_nikah']['name'];
	$source_surat_nikah = $_FILES['surat_nikah']['tmp_name'];
	$folder_surat_nikah = './../assets/pdf/surat_nikah/';

	if ($nama_file_surat_nikah != '') {
		$nama_file_surat_nikah = uniqid();
		$nama_file_surat_nikah .= '.pdf';
		move_uploaded_file($source_surat_nikah, $folder_surat_nikah . $nama_file_surat_nikah);
		$query = "UPDATE `data_individu` SET `surat_nikah` = '$nama_file_surat_nikah' WHERE `id_data_individu` =  '$id'";
		$exe = mysqli_query(connect(), $query);
		if ($exe) {
			// kalau berhasil
			$_SESSION['success'] = " Data terverifikasi! ";
			header('Location: index.php');
		} else {
			$_SESSION['failed'] = " Data tidak terverifikasi ";
			header('Location: index.php');
		}
	}

	// Download PDf

}

function Delete($id)
{
	$query = "DELETE FROM `data_individu` WHERE `id_data_individu` = '$id'";
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

function GetKlasifikasi()
{
	$query = "SELECT * FROM  `klasifikasi`";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_klasifikasi' => $data['id_klasifikasi'],
			'id_klasifikasi' => $data['id_klasifikasi'],
			'klasifikasi' => $data['klasifikasi'],

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

function detail($id)
{
	$no_kk = $_POST['no_kk'];
	$query = "SELECT * FROM  `data_individu`";
	$exe = mysqli_query(connect(), $query);
	while ($data = mysqli_fetch_array($exe)) {
		$datas[] = array(
			'id_individu' => $data['id_individu'],
			'nama' => $data['nama'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'alamat' => $data['alamat'],
		);
	}
	return $datas;
}

if (isset($_POST['insert'])) {
	insert();
} else if (isset($_POST['update'])) {
	update($_POST['id_data_individu']);
} else if (isset($_POST['delete'])) {
	delete($_POST['id_data_individu']);
} else if (isset($_POST['search'])) {
	GetBySearch($_POST['search']);
} else if (isset($_POST['detail'])) {
	detail($_POST['detail']);
}
?>

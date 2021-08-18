
		<?php
		session_start();
		require_once '../config/get_connection.php';
		function getAll()
		{
			$exe = pagination()["exe"];
			while ($row = mysqli_fetch_assoc($exe)) {
				$data[] = [
					'id_keterangan_usaha' => $row['id_keterangan_usaha'],
					'id_data_individu' => $row['id_data_individu'],
					'nomor' => $row['nomor'],
					'nama' => $row['nama'],
					'nik' => $row['nik'],
					'no_kk' => $row['no_kk'],
					'ttl' => $row['ttl'],
					'jenis_kelamin' => $row['jenis_kelamin'],
					'agama' => $row['agama'],
					'pendidikan' => $row['pendidikan'],
					'pekerjaan' => $row['pekerjaan'],
					'status_perkawinan' => $row['status_perkawinan'],
					'nama_ortu' => $row['nama_ortu'],
					'alamat' => $row['alamat'],
					'nama_tertanda' => $row['nama_tertanda'],
					'ttd' => $row['ttd'],
					'rt' => $row['rt'],
					'rw' => $row['rw'],
					'tanggal' => $row['tanggal'],
					'status_surat' => $row['status_surat'],
					'nama_usaha' => $row['nama_usaha'],
					'bidang' => $row['bidang'],
				];
			}

			return $data;
		}
		function pagination()
		{
			$level = $_SESSION['level'];
			$id_data_individu = $_SESSION['id_data_individu'];

			if ($level != "Masyarakat") {
				$min_data = 10;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
				$result_page = mysqli_query(connect(), "SELECT * FROM keterangan_usaha");
				$total = mysqli_num_rows($result_page);
				$total_page = ceil($total / $min_data);
			}

			if ($level == "Masyarakat") {
				$min_data = 10;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page > 1) ? ($page * $min_data) - $min_data : 0;
				$result_page = mysqli_query(connect(), "SELECT * FROM keterangan_usaha WHERE id_data_individu = $id_data_individu && status_surat = 1");
				$total = mysqli_num_rows($result_page);
				$total_page = ceil($total / $min_data);
			}

			if ($level != "Masyarakat") {
				$query = "SELECT * FROM keterangan_usaha ORDER BY id_keterangan_usaha DESC LIMIT $start, $min_data";
				$exe = mysqli_query(connect(), $query);
			}

			if ($level == "Masyarakat") {
				$query = "SELECT * FROM keterangan_usaha WHERE id_data_individu = $id_data_individu && status_surat = 1 ORDER BY id_keterangan_usaha DESC LIMIT $start, $min_data";
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
			$query = "SELECT * FROM  `keterangan_usaha` WHERE  `id_keterangan_usaha` =  '$id'";
			$exe = mysqli_query(connect(), $query);
			while ($data = mysqli_fetch_array($exe)) {
				$datas[] = array(
					'id_keterangan_usaha' => $data['id_keterangan_usaha'],
					'id_data_individu' => $data['id_data_individu'],
					'nomor' => $data['nomor'],
					'nama' => $data['nama'],
					'nik' => $data['nik'],
					'no_kk' => $data['no_kk'],
					'ttl' => $data['ttl'],
					'jenis_kelamin' => $data['jenis_kelamin'],
					'agama' => $data['agama'],
					'pendidikan' => $data['pendidikan'],
					'pekerjaan' => $data['pekerjaan'],
					'status_perkawinan' => $data['status_perkawinan'],
					'nama_ortu' => $data['nama_ortu'],
					'alamat' => $data['alamat'],
					'nama_tertanda' => $data['nama_tertanda'],
					'ttd' => $data['ttd'],
					'rt' => $data['rt'],
					'rw' => $data['rw'],
					'tanggal' => $data['tanggal'],
					'status_surat' => $data['status_surat'],
					'nama_usaha' => $data['nama_usaha'],
					'bidang' => $data['bidang'],

				);
			}
			return $datas;
		}

		function GetBySearch($search)
		{
			$query = "SELECT * FROM  `keterangan_usaha` WHERE id_data_individu LIKE '%$search%' OR nomor LIKE '%$search%' OR nama LIKE '%$search%' OR nik LIKE '%$search%' OR no_kk LIKE '%$search%' OR ttl LIKE '%$search%' OR jenis_kelamin LIKE '%$search%' OR agama LIKE '%$search%' OR pendidikan LIKE '%$search%' OR pekerjaan LIKE '%$search%' OR status_perkawinan LIKE '%$search%' OR nama_ortu LIKE '%$search%' OR alamat LIKE '%$search%' OR nama_tertanda LIKE '%$search%' OR ttd LIKE '%$search%' OR rt LIKE '%$search%' OR rw LIKE '%$search%' OR tanggal LIKE '%$search%' OR status_surat LIKE '%$search%' OR nama_usaha LIKE '%$search%' OR bidang LIKE '%$search%' ";
			$exe = mysqli_query(connect(), $query);
			while ($data = mysqli_fetch_array($exe)) {
				$datas[] = array(
					'id_keterangan_usaha' => $data['id_keterangan_usaha'],
					'id_data_individu' => $data['id_data_individu'],
					'nomor' => $data['nomor'],
					'nama' => $data['nama'],
					'nik' => $data['nik'],
					'no_kk' => $data['no_kk'],
					'ttl' => $data['ttl'],
					'jenis_kelamin' => $data['jenis_kelamin'],
					'agama' => $data['agama'],
					'pendidikan' => $data['pendidikan'],
					'pekerjaan' => $data['pekerjaan'],
					'status_perkawinan' => $data['status_perkawinan'],
					'nama_ortu' => $data['nama_ortu'],
					'alamat' => $data['alamat'],
					'nama_tertanda' => $data['nama_tertanda'],
					'ttd' => $data['ttd'],
					'rt' => $data['rt'],
					'rw' => $data['rw'],
					'tanggal' => $data['tanggal'],
					'status_surat' => $data['status_surat'],
					'nama_usaha' => $data['nama_usaha'],
					'bidang' => $data['bidang'],

				);
			}
			return $datas;
		}

		function insert()
		{
			$id_data_individu = $_POST['id_data_individu'];
			$nomor = $_POST['nomor'];
			$nama = $_POST['nama'];
			$nik = $_POST['nik'];
			$no_kk = $_POST['no_kk'];
			$ttl = $_POST['ttl'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$agama = $_POST['agama'];
			$pendidikan = $_POST['pendidikan'];
			$pekerjaan = $_POST['pekerjaan'];
			$status_perkawinan = $_POST['status_perkawinan'];
			$nama_ortu = $_POST['nama_ortu'];
			$alamat = $_POST['alamat'];
			$ttd = $_POST['ttd'];
			$rt = $_POST['rt'];
			$rw = $_POST['rw'];
			$nama_usaha = $_POST['nama_usaha'];
			$bidang = $_POST['bidang'];

			$status_surat = 0;

			$nama_usaha = strtoupper($nama_usaha);
			$bidang = strtoupper($bidang);
			$alamat = strtoupper($alamat);
			$nama_ortu = strtoupper($nama_ortu);
			$tanggal = date('d-m-Y');
			$hari = date('d');
			$bulan = date('m');
			$tahun = date('Y');


			$tes = strlen($nomor);
			if ($tes == 1) {
				$nomors = "000{$nomor}/$hari.$bulan/DS/X/$tahun";
			}

			$tes = strlen($nomor);
			if ($tes == 2) {
				$nomors = "00{$nomor}/$hari.$bulan/DS/X/$tahun";
			}

			if ($tes == 3) {
				$nomors = "0{$nomor}/$hari.$bulan/DS/X/$tahun";
			}

			$query = "INSERT INTO `keterangan_usaha` (`id_keterangan_usaha`,`id_data_individu`,`nomor`,`nama`,`nik`,`no_kk`,`ttl`,`jenis_kelamin`,`agama`,`pendidikan`,`pekerjaan`,`status_perkawinan`,`nama_ortu`,`alamat`,`ttd`, `rt`, `rw`, `tanggal`, `status_surat`, `nama_usaha`, `bidang`)
			VALUES (NULL,'$id_data_individu','$nomors','$nama','$nik','$no_kk','$ttl','$jenis_kelamin','$agama','$pendidikan','$pekerjaan','$status_perkawinan','$nama_ortu','$alamat','$ttd', '$rt', '$rw', '$tanggal', '$status_surat', '$nama_usaha', '$bidang')";
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
			$id_data_individu = $_POST['id_data_individu'];
			$nomor = $_POST['nomor'];
			$nama = $_POST['nama'];
			$nik = $_POST['nik'];
			$no_kk = $_POST['no_kk'];
			$ttl = $_POST['ttl'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$agama = $_POST['agama'];
			$pendidikan = $_POST['pendidikan'];
			$pekerjaan = $_POST['pekerjaan'];
			$status_perkawinan = $_POST['status_perkawinan'];
			$nama_ortu = $_POST['nama_ortu'];
			$alamat = $_POST['alamat'];
			$nama_tertanda = $_POST['nama_tertanda'];
			$ttd = $_POST['ttd'];
			$rt = $_POST['rt'];
			$rw = $_POST['rw'];
			$status_surat = $_POST['status_surat'];
			$nama_usaha = $_POST['nama_usaha'];
			$bidang = $_POST['bidang'];

			$tanggal = date('d-m-Y');
			$nama_usaha = strtoupper($nama_usaha);
			$bidang = strtoupper($bidang);
			$alamat = strtoupper($alamat);
			$nama_ortu = strtoupper($nama_ortu);

			// Tertanda
			$nama_file = $_FILES['ttd']['name'];
			$source = $_FILES['ttd']['tmp_name'];
			$folder = './../assets/img/ttd/';

			$level = $_SESSION['level'];

			if ($level == "Masyarakat") {
				$query = "UPDATE `keterangan_usaha` SET `id_data_individu` = '$id_data_individu',`nomor` = '$nomor',`nama` = '$nama',`nik` = '$nik',`no_kk` = '$no_kk',`ttl` = '$ttl',`jenis_kelamin` = '$jenis_kelamin',`agama` = '$agama',`pendidikan` = '$pendidikan',`pekerjaan` = '$pekerjaan',`status_perkawinan` = '$status_perkawinan',`nama_ortu` = '$nama_ortu',`alamat` = '$alamat',`ttd` = '$ttd', `rt` = '$rt', `rw` = '$rw', `tanggal` = '$tanggal', `status_surat` = '$status_surat', `nama_usaha` = '$nama_usaha', `bidang` = '$bidang' WHERE  `id_keterangan_usaha` =  '$id'";
			}

			if ($level != "Masyarakat") {

				$ttd = "ttd.png";
				$query = "UPDATE `keterangan_usaha` SET `nama_tertanda` = '$nama_tertanda',`ttd` = '$ttd', `tanggal` = '$tanggal', `status_surat` = '$status_surat' WHERE  `id_keterangan_usaha` =  '$id'";
			}

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
			$query = "DELETE FROM `keterangan_usaha` WHERE `id_keterangan_usaha` = '$id'";
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

		function GetKeteranganUsaha()
		{
			$query = "SELECT * FROM `keterangan_usaha`";
			$exe = mysqli_query(connect(), $query);
			while ($data = mysqli_fetch_array($exe)) {
				$datas[] = array(
					'id_keterangan_usaha' => $data['id_keterangan_usaha'],
					'id_data_individu' => $data['id_data_individu'],
					'nomor' => $data['nomor'],
					'nama' => $data['nama'],
					'nik' => $data['nik'],
					'no_kk' => $data['no_kk'],
					'ttl' => $data['ttl'],
					'jenis_kelamin' => $data['jenis_kelamin'],
					'agama' => $data['agama'],
					'pendidikan' => $data['pendidikan'],
					'pekerjaan' => $data['pekerjaan'],
					'status_perkawinan' => $data['status_perkawinan'],
					'nama_ortu' => $data['nama_ortu'],
					'alamat' => $data['alamat'],
					'nama_tertanda' => $data['nama_tertanda'],
					'ttd' => $data['ttd'],
					'rt' => $data['rt'],
					'rw' => $data['rw'],
					'tanggal' => $data['tanggal'],
					'nama_usaha' => $data['nama_usaha'],
					'bidang' => $data['bidang'],
				);
			}
			return $datas;
		}

		if (isset($_POST['insert'])) {
			insert();
		} else if (isset($_POST['update'])) {
			update($_POST['id_keterangan_usaha']);
		} else if (isset($_POST['delete'])) {
			delete($_POST['id_keterangan_usaha']);
		} else if (isset($_POST['search'])) {
			GetBySearch($_POST['search']);
		}
		?>
		
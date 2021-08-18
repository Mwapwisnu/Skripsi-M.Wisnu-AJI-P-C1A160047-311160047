<?php

require_once 'function.php';

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$menu = "Catatan Kepolisian";

$id_data_individu = $_SESSION['id_data_individu'];
$no_kk = $_SESSION['no_kk'];
$nik = $_SESSION['ktp'];
$nama = strtoupper($_SESSION['nama']);
$tempat = strtoupper($_SESSION['tempat']);
$tanggal = $_SESSION['tanggal'];
$jk = ucwords(strtolower($_SESSION['jk']));

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');


$dataAgama = GetAgama();

$query = mysqli_query(connect(), "SELECT MAX(id_catatan_kepolisian) AS max FROM catatan_kepolisian ");

?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Input Surat Keterangan</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<div class="row">
							<div class="col-md-6 pr-md-1">
								<input type="hidden" name="id_data_individu" value="<?= $id_data_individu ?>">
								<input type="hidden" name="status_surat" value="0">
								<input type="hidden" name="ttd" value="0">
								<div class="form-group">
									<?php while ($row = mysqli_fetch_assoc($query)) : ?>
										<?php $nomors = 1 + $row['max']; ?>
										<input type='hidden' name='nomor' class="form-control mt-2" value="<?= $nomors; ?>" readonly>
									<?php endwhile;; ?>
								</div>
								<div class=" form-group">
									<label>RT</label>
									<input type='text' name='rt' class="form-control mt-2" placeholder="Masukan RT">
								</div>
								<div class=" form-group">
									<label>RW</label>
									<input type='text' name='rw' class="form-control mt-2" placeholder="Masukan RW">
								</div>
								<div class="form-group">
									<label>No KK</label>
									<input type='text' name='no_kk' class="form-control mt-2 text-warning" value="<?= $no_kk; ?>" readonly>
								</div>
								<div class="form-group">
									<label>No NIK</label>
									<input type='text' name='nik' class="form-control mt-2 text-warning" value="<?= $nik; ?>" readonly>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type='text' name='nama' class="form-control mt-2 text-warning" value="<?= $nama ?>" readonly>
								</div>
								<div class="form-group">
									<label>Tempat/Tanggal Lahir</label>
									<input type='text' name='ttl' class="form-control mt-2 text-warning" value="<?= $tempat . ', ' . $tanggal ?>" readonly>
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<input type='text' name='jenis_kelamin' class="form-control mt-2 text-warning" value="<?= $jk; ?>" readonly>
								</div>
								<div class=" form-group">
									<label for="exampleFormControlSelect1">Agama</label>
									<select class="form-control" name="agama" id="exampleFormControlSelect1">
										<?php foreach ($dataAgama as $data) : ?>
											<option class="text-primary" value="<?= $data['agama']; ?>"><?= $data['agama']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleFormControlSelect1">Pendidikan Terakhir</label>
									<select class="form-control" name="pendidikan" id="exampleFormControlSelect1">
										<option class="text-primary" value="SD">SD</option>
										<option class="text-primary" value="SLTP">SLTP</option>
										<option class="text-primary" value="SLTA">SLTA</option>
										<option class="text-primary" value="Perguruan Tinggi">Perguruan Tinggi</option>
										<option class="text-primary" value="Tidak Tamat SD">Tidak Tamat SD</option>
										<option class="text-primary" value="Tidak Sekolah">Tidak Sekolah</option>
									</select>
								</div>
								<div class=" form-group">
									<label for="exampleFormControlSelect1">Status Perkawinan</label>
									<select class="form-control" name="status_perkawinan" id="exampleFormControlSelect1">
										<option class="text-primary" value="Kawin">Kawin</option>
										<option class="text-primary" value="Tidak Kawin">Tidak Kawin</option>
										<option class="text-primary" value="Janda">Janda</option>
										<option class="text-primary" value="Duda">Duda</option>
									</select>
								</div>
								<div class="form-group">
									<label>Pekerjaan</label>
									<input type='text' name='pekerjaan' class="form-control mt-2" placeholder="Masukan Pekerjaan">
								</div>
								<div class="form-group">
									<label>Nama Orang Tua</label>
									<input type='text' name='nama_ortu' class="form-control mt-2" placeholder="Contoh : Nama Ayah / Nama Ibu">
								</div>
								<div class=" form-group">
									<label>Alamat</label><small class="text-danger"> Catatan* Hanya berisi nama Kampung</small>
									<input type='text' name='alamat' class="form-control mt-2" placeholder="Contoh : KP.PANGKALAN RAJA">
								</div>
							</div>
						</div>
				</div>
				<div class=" card-footer">
					<button type='submit' name='insert' class="btn btn-fill btn-primary">Save</button>
				</div>
				</form>
			</div>
		</div>
		<?php require_once('../templates/profile.php'); ?>
	</div>
</div>


<?php require_once('../templates/footer.php'); ?>
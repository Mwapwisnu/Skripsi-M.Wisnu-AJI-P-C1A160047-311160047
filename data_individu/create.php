<?php
session_start();

$menu = "Data Penduduk";

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];

if ($level == "Masyarakat") {
	header("Location: ../index.php");
	exit;
}

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

$dataKlasifikasi = GetKlasifikasi();
$dataAgama = GetAgama();

$no_kk = $_POST['no_kk'];

?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Input Data Individu</h5>
					<a href="../data_individu/index.php" class="btn btn-primary btn-sm">Kembali</a>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<div class="row">
							<div class="col-md-10 pr-md-1">
								<div class="form-group">
									<label>NO KK</label>
									<input type='text' name='no_kk' class="form-control mt-2" placeholder="Masukan Nomor KK">
								</div>
								<div class="form-group">
									<label>NIK</label>
									<input type='text' name='nik' class="form-control mt-2" placeholder="Masukan Nomor NIK">
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type='text' name='nama' class="form-control mt-2" placeholder="Masukan Nama">
								</div>
								<div class="form-group">
									<label>Tempat Lahir</label>
									<input type='text' name='tempat_lahir' class="form-control mt-2" placeholder="Masukan Tempat Lahir">
								</div>
								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="text" name="tanggal" class="form-control datepicker" required />
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
										<option class="text-primary" value="LAKI-LAKI">Laki-Laki</option>
										<option class="text-primary" value="PEREMPUAN">Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleFormControlSelect1">Golongan Darah</label>
									<select class="form-control" name="gol_darah" id="exampleFormControlSelect1">
										<option class="text-primary" value="A">A</option>
										<option class="text-primary" value="B">B</option>
										<option class="text-primary" value="AB">AB</option>
										<option class="text-primary" value="O">O</option>
									</select>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type='text' name='alamat' class="form-control mt-2" placeholder="Masukan Alama">
								</div>
								<div class="form-group">
									<label>Pekerjaan</label>
									<input type='text' name='pekerjaan' class="form-control mt-2" placeholder="Masukan Pekerjaan">
								</div>
								<div class="form-group">
									<label>Kewarganegaraan</label>
									<input type='text' name='kewarganegaraan' class="form-control mt-2" placeholder="Masaukan Kewarganegaraan">
								</div>
								<div class="form-group">
									<label for="exampleFormControlSelect1">Agama</label>
									<select class="form-control" name="agama" id="exampleFormControlSelect1">
										<?php foreach ($dataAgama as $data) : ?>
											<option class="text-primary" value="<?= $data['agama']; ?>"><?= $data['agama']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleFormControlSelect1">Klasifikasi</label>
									<select class="form-control" name="klasifikasi" id="exampleFormControlSelect1">
										<?php foreach ($dataKlasifikasi as $data) : ?>
											<option class="text-primary" value="<?= $data['klasifikasi']; ?>"><?= $data['klasifikasi']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
				</div>
				<div class="card-footer">
					<button type='submit' name='insert' class="btn btn-fill btn-primary">Save</button>
				</div>
				</form>
			</div>
		</div>
		<?php require_once('../templates/profile.php'); ?>
	</div>
</div>

<?php require_once('../templates/footer.php'); ?>
<?php

session_start();

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];

if ($level == "Masyarakat") {
	header("Location: ../index.php");
	exit;
}

$menu = "Data Individu";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

$id_data_individu = $_POST['id_data_individu'];
$datas = GetById($id_data_individu);

$dataAgama = GetAgama();
$dataKlasifikasi = GetKlasifikasi();
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
					<form action='function.php' method='post' enctype="multipart/form-data">
						<input type='hidden' name='id_data_individu' value="<?php echo $_POST['id_data_individu']; ?>">
						<?php
						foreach ($datas as $data) { ?>
							<div class="row">
								<div class="col-md-11 pr-md-1">
									<div class="form-group">
										<label>NIK</label>
										<input type='text' name='nik' class="form-control mt-2" value="<?= $data['nik']; ?>">
									</div>
									<div class="form-group">
										<label>Nama</label>
										<input type='text' name='nama' class="form-control mt-2" value="<?= $data['nama']; ?>">
									</div>
									<div class="form-group">
										<label>Tempat Lahir</label>
										<input type='text' name='tempat_lahir' class="form-control mt-2" value="<?= $data['tempat_lahir']; ?>">
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="text" name="tanggal" class="form-control datepicker" value="<?= $data['tanggal']; ?>" required />
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
											<option class="text-primary" value="LAKI-LAKI" <?php if ($data['jenis_kelamin'] == "LAKI-LAKI") { echo 'selected'; } ?>>Laki-Laki</option>
											<option class="text-primary" value="PEREMPUAN" <?php if ($data['jenis_kelamin'] == "PEREMPUAN") { echo 'selected'; } ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleFormControlSelect1">Golongan Darah</label>
										<select class="form-control" name="gol_darah" id="exampleFormControlSelect1">
											<option class="text-primary" value="A" <?php if ($data['gol_darah'] == "A") { echo 'selected'; } ?>>A</option>
											<option class="text-primary" value="B" <?php if ($data['gol_darah'] == "B") { echo 'selected';} ?>>B</option>
											<option class="text-primary" value="AB" <?php if ($data['gol_darah'] == "AB") { echo 'selected'; } ?>>AB</option>
											<option class="text-primary" value="O" <?php if ($data['gol_darah'] == "O") { echo 'selected';} ?>>O</option>
										</select>
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<input type='text' name='alamat' class="form-control mt-2" value="<?= $data['alamat']; ?>">
									</div>
									<div class="form-group">
										<label>Pekerjaan</label>
										<input type='text' name='pekerjaan' class="form-control mt-2" value="<?= $data['pekerjaan']; ?>">
									</div>
									<div class="form-group">
										<label>Kewarganegaraan</label>
										<input type='text' name='kewarganegaraan' class="form-control mt-2" value="<?= $data['kewarganegaraan']; ?>">
									</div>
									<div class="form-group">
										<label for="exampleFormControlSelect1">Agama</label>
										<select class="form-control" name="agama" id="exampleFormControlSelect1">
											<?php foreach ($dataAgama as $data2) : ?>
												<option class="text-primary" value="<?= $data2['agama']; ?>" <?php if ($data['agama'] == $data2['agama']) { echo 'selected'; } ?>><?= $data2['agama']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleFormControlSelect1">Klasifikasi</label>
										<select class="form-control" name="klasifikasi" id="exampleFormControlSelect1">
											<?php foreach ($dataKlasifikasi as $data3) : ?>
												<option class="text-primary" value="<?= $data3['klasifikasi']; ?>" <?php if ($data['klasifikasi'] == $data3['klasifikasi']) { echo 'selected'; } ?>><?= $data3['klasifikasi']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<label for="">Foto</label>
									<div class="custom-file">
										<?php if ($data['foto'] != "") { ?>
											<img src="../assets/img/individu/<?= $data['foto']; ?>" width="50">
											<span class="ml-2">Nama file awal : <?= $data['foto']; ?></span><br><br>
										<?php } else { ?>
											<img src="../assets/img/individu/no-data.png" width="50">
											<span class="ml-2">Tidak ada data</span><br><br>
										<?php } ?>
										<input type="file" name="foto" class="" id="customFile">
									</div><br><br>
									<hr class="bg-white">

									<label for="">Akta</label>
									<div class="custom-file">
										<?php if ($data['akta'] != "") { ?>
											<img src="../assets/img/individu/pdf.png" width="50">
											<span class="ml-2">Nama file awal : <?= $data['akta']; ?></span><br><br>
										<?php } else { ?>
											<img src="../assets/img/individu/no-data.png" width="50">
											<span class="ml-2">Tidak ada data</span><br><br>
										<?php } ?>
										<input type="file" name="akta" class="" id="customFile">
									</div><br><br>
									<hr class="bg-white">

									<label for="">KTP</label>
									<div class="custom-file">
										<?php if ($data['ktp'] != "") { ?>
											<img src="../assets/img/individu/pdf.png" width="50">
											<span class="ml-2">Nama file awal : <?= $data['ktp']; ?></span><br><br>
										<?php } else { ?>
											<img src="../assets/img/individu/no-data.png" width="50">
											<span class="ml-2">Tidak ada data</span><br><br>
										<?php } ?>

										<input type="file" name="ktp" class="" id="customFile">
									</div><br><br>
									<hr class="bg-white">

									<label for="">Surat Nikah</label>
									<div class="custom-file">
										<?php if ($data['surat_nikah'] != "") { ?>
											<img src="../assets/img/individu/pdf.png" width="50">
											<span class="ml-2">Nama file awal : <?= $data['surat_nikah']; ?></span><br><br>
										<?php } else { ?>
											<img src="../assets/img/individu/no-data.png" width="50">
											<span class="ml-2">Tidak ada data</span><br><br>
										<?php } ?>
										<input type="file" name="surat_nikah" class="" id="customFile">
									</div><br><br>
									<hr class="bg-white">
								</div>
							</div>
				</div>
				<div class="card-footer">
					<button type='submit' name='update' class="btn btn-fill btn-primary">Save</button>
				</div>
			<?php } ?>
			</form>
			</div>
		</div>
		<?php require_once('../templates/profile.php'); ?>
	</div>
</div>

<?php require_once('../templates/footer.php'); ?>
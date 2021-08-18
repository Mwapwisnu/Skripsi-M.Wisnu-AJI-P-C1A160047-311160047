<?php

require_once 'function.php';

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$menu = "Catatan Kepolisian";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');


$id_catatan_kepolisian = $_POST['id_catatan_kepolisian'];
$datas = GetById($id_catatan_kepolisian);
$dataAgama = GetAgama();
?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Edit Catatan Kepolisian</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<input type='hidden' name='id_catatan_kepolisian' value="<?php echo $_POST['id_catatan_kepolisian']; ?>">
						<input type="hidden" name="ttd">
						<?php
						foreach ($datas as $data) { ?>
							<div class="row">
								<div class="col-md-6 pr-md-1">
									<?php if ($level != "Masyarakat") { ?>
										<div class="form-group">
											<label>Status Surat</label>
											<select class="form-control" name="status_surat" id="exampleFormControlSelect1">
												<option class="text-primary" value="1" <?php if ($data['status_surat'] == "1") { echo 'selected'; } ?>>Izinkan</option>
												<option class="text-primary" value="0" <?php if ($data['status_surat'] == "0") { echo 'selected'; } ?>>Tidak di izinkan</option>
											</select>
										</div>
										<div class="form-group">
											<!-- <label>Nama Tertanda</label> -->
											<select class="form-control" name="nama_tertanda" id="exampleFormControlSelect1" hidden>
												<option class="text-primary" value="DENI SUTISNA">DENI SUTISNA</option>
											</select>
										</div>
										<hr class="bg-primary">
										<div class="form-group">
											<label>Nomor</label>
											<input type='text' name='nomor' class="form-control mt-2 text-warning" value="<?= $data['nomor']; ?>" readonly>
										</div>
										<div class="form-group">
											<label>Nama</label>
											<input type='text' name='nama' class="form-control mt-2 text-warning" value="<?= $data['nama']; ?>">
										</div>
										<div class="form-group">
											<label>RT</label>
											<input type='text' name='rt' class="form-control mt-2 text-warning" value="<?= $data['rt']; ?>" readonly>
										</div>
										<div class="form-group">
											<label>RW</label>
											<input type='text' name='rw' class="form-control mt-2 text-warning" value="<?= $data['rw']; ?>" readonly>
										</div>
									<?php } ?>
									<?php if ($level == "Masyarakat") { ?>
										<div class="form-group">
											<input type='hidden' name='status_surat' class="form-control mt-2 " value="<?= $data['status_surat']; ?>" readonly>
										</div>
										<div class="form-group">
											<input type='hidden' name='id_data_individu' class="form-control mt-2 " value="<?= $data['id_data_individu']; ?>" readonly>
										</div>
										<div class="form-group">
											<input type='hidden' name='no_kk' class="form-control mt-2 " value="<?= $data['no_kk']; ?>">
										</div>
										<div class="form-group">
											<input type='hidden' name='nik' class="form-control mt-2 " value="<?= $data['nik']; ?>">
										</div>
										<div class="form-group">
											<input type='hidden' name='ttd' class="form-control mt-2 " value="<?= $data['ttd']; ?>">
										</div>
										<div class="form-group">
											<label>Nomor</label>
											<input type='text' name='nomor' class="form-control mt-2 " value="<?= $data['nomor']; ?>" readonly>
										</div>
										<div class="form-group">
											<label>RT</label>
											<input type='text' name='rt' class="form-control mt-2" value="<?= $data['rt']; ?>">
										</div>
										<div class="form-group">
											<label>RW</label>
											<input type='text' name='rw' class="form-control mt-2" value="<?= $data['rw']; ?>">
										</div>
										<div class="form-group">
											<label>Nama</label>
											<input type='text' name='nama' class="form-control mt-2" value="<?= $data['nama']; ?>" readonly>
										</div>
										<div class="form-group">
											<label>Tempat/Tanggal Lahir</label>
											<input type='text' name='ttl' class="form-control mt-2" value="<?= $data['ttl']; ?>" readonly>
										</div>
										<div class="form-group">
											<label>jenis Kelamin</label>
											<select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
												<option class="text-primary" value="Laki-Laki" <?php if ($data['jenis_kelamin'] == "L") { echo 'selected'; } ?>>Laki-Laki</option>
												<option class="text-primary" value="Perempuan" <?php if ($data['jenis_kelamin'] == "P") { echo 'selected'; } ?>>Perempuan</option>
											</select>
										</div>
										<div class="form-group">
											<label for="exampleFormControlSelect1">Agama</label>
											<select class="form-control" name="agama" id="exampleFormControlSelect1">
												<?php foreach ($dataAgama as $data2) : ?>
													<option class="text-primary" value="<?= $data2['agama']; ?>" <?php if ($data['agama'] == $data2['agama']) {	echo 'selected'; } ?>><?= $data2['agama']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="exampleFormControlSelect1">Pendidikan</label>
											<select class="form-control" name="pendidikan" id="exampleFormControlSelect1">
												<option class="text-primary" value="SD" <?php if ($data['pendidikan'] == "SD") { echo 'selected'; } ?>>SD</option>
												<option class="text-primary" value="SLTP" <?php if ($data['pendidikan'] == "SLTP") { echo 'selected'; } ?>>SLTP</option>
												<option class="text-primary" value="SLTA" <?php if ($data['pendidikan'] == "SLTA") { echo 'selected'; } ?>>SLTA</option>
												<option class="text-primary" value="Perguruan Tinggi" <?php if ($data['pendidikan'] == "Perguruan Tinggi") { echo 'selected'; } ?>>Perguruan Tinggi</option>
												<option class="text-primary" value="Tidak Tamat SD" <?php if ($data['pendidikan'] == "Tidak Tamat SD") { echo 'selected'; } ?>>Tidak Tamat SD</option>
												<option class="text-primary" value="Tidak Sekolah" <?php if ($data['pendidikan'] == "Tidak Sekolah") { echo 'selected'; } ?>>Tidak Sekolah</option>
											</select>
										</div>
										<div class="form-group">
											<label>Pekerjaan</label>
											<input type='text' name='pekerjaan' class="form-control mt-2" value="<?= $data['pekerjaan']; ?>">
										</div>
										<div class="form-group">
											<label for="exampleFormControlSelect1">Status Perkawinan</label>
											<select class="form-control" name="status_perkawinan" id="exampleFormControlSelect1">
												<option class="text-primary" value="Kawin" <?php if ($data['status_perkawinan'] == "Kawin") { echo 'selected'; } ?>>Kawin</option>
												<option class="text-primary" value="Tidak Kawin" <?php if ($data['status_perkawinan'] == "Tidak Kawin") { echo 'selected'; } ?>>Tidak Kawin</option>
												<option class="text-primary" value="Janda" <?php if ($data['status_perkawinan'] == "Janda") { echo 'selected'; } ?>>Janda</option>
												<option class="text-primary" value="Duda" <?php if ($data['status_perkawinan'] == "Duda") { echo 'selected'; } ?>>Duda</option>
											</select>
										</div>
										<div class="form-group">
											<label>Nama Orang Tua</label>
											<input type='text' name='nama_ortu' class="form-control mt-2" value="<?= $data['nama_ortu']; ?>">
										</div>
										<div class="form-group">
											<label>Alamat</label>
											<input type='text' name='alamat' class="form-control mt-2" value="<?= $data['alamat']; ?>">
										</div>
									<?php } ?>
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
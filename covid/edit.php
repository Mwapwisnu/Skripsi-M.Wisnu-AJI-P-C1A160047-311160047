<?php

require_once 'function.php';

$menu = "Data Covid-19";

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

$id_covid = $_POST['id_covid'];
$datas = GetById($id_covid);
$dataAgama = GetAgama();

?>
<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Input Data Covid - 19</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post' enctype="multipart/form-data">
						<input type='hidden' name='id_covid' value="<?php echo $_POST['id_covid']; ?>">
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
										<input type="text" name="tanggal_lahir" class="form-control datepicker" value="<?= $data['tanggal_lahir']; ?>" required />
									</div>
									<div class=" form-group">
										<label>Tanggal Lahir</label>
										<input class="form-control" name="tanggal" type="date" id="example-date-input" value="<?= $data['tanggal']; ?>">
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
											<option class="text-primary" value="LAKI-LAKI" <?php if ($data['jenis_kelamin'] == "LAKI-LAKI") {
																																				echo 'selected';
																																			} ?>>Laki-Laki</option>
											<option class="text-primary" value="PEREMPUAN" <?php if ($data['jenis_kelamin'] == "PEREMPUAN") {
																																				echo 'selected';
																																			} ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleFormControlSelect1">Golongan Darah</label>
										<select class="form-control" name="gol_darah" id="exampleFormControlSelect1">
											<option class="text-primary" value="A" <?php if ($data['gol_darah'] == "A") {
																																echo 'selected';
																															} ?>>A</option>
											<option class="text-primary" value="B" <?php if ($data['gol_darah'] == "B") {
																																echo 'selected';
																															} ?>>B</option>
											<option class="text-primary" value="AB" <?php if ($data['gol_darah'] == "AB") {
																																echo 'selected';
																															} ?>>AB</option>
											<option class="text-primary" value="O" <?php if ($data['gol_darah'] == "O") {
																																echo 'selected';
																															} ?>>O</option>
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
										<label for="exampleFormControlSelect1">Agama</label>
										<select class="form-control" name="agama" id="exampleFormControlSelect1">
											<?php foreach ($dataAgama as $data2) : ?>
												<option class="text-primary" value="<?= $data2['agama']; ?>" <?php if ($data['agama'] == $data2['agama']) {
																																												echo 'selected';
																																											} ?>><?= $data2['agama']; ?></option>
											<?php endforeach; ?>
										</select>
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
										<label for="exampleFormControlSelect1">Status</label>
										<select class="form-control" name="status" id="exampleFormControlSelect1">
											<option class="text-primary" value="OTG" <?php if ($data['status'] == "OTG") {
																																	echo 'selected';
																																} ?>>OTG</option>
											<option class="text-primary" value="ODP" <?php if ($data['status'] == "ODP") {
																																	echo 'selected';
																																} ?>>ODP</option>
											<option class="text-primary" value="PDP" <?php if ($data['status'] == "PDP") {
																																	echo 'selected';
																																} ?>>PDP</option>
											<option class="text-primary" value="Meninggal" <?php if ($data['status'] == "Meninggal") {
																																				echo 'selected';
																																			} ?>>Meninggal</option>
											<option class="text-primary" value="Sembuh" <?php if ($data['status'] == "Sembuh") {
																																		echo 'selected';
																																	} ?>>Sembuh</option>
										</select>
									</div>
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
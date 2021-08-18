<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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


$menu = "Data Penduduk";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

$id_data_penduduk = $_POST['id_data_penduduk'];
$no_kk = $_POST['no_kk'];
$datas = GetById($id_data_penduduk);
$datas2 = getPenduduk();
	// GET Pengidap yang status covid-19 = Meninggal
	$query = "SELECT * FROM data_individu WHERE no_kk = $no_kk";
	$exe = mysqli_query(connect(), $query);
	$total_individu = mysqli_num_rows($exe);

?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Edit Data Penduduk</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<input type='hidden' name='id_data_penduduk' value="<?php echo $_POST['id_data_penduduk']; ?>">
						<?php
						foreach ($datas as $data) { ?>
							<div class="row">
								<div class="col-md-6 pr-md-1">
									<div class="form-group">
										<label>No KK</label>
										<input type='text' name='no_kk' class="form-control mt-2" value="<?= $data['no_kk']; ?>">
									</div>
									<div class="form-group">
										<label>RT</label>
										<input type='text' name='rt' class="form-control mt-2" value="<?= $data['rt']; ?>">
									</div>
									<div class="form-group">
										<label>RW</label>
										<input type='text' name='rw' class="form-control mt-2" value="<?= $data['rw']; ?>">
									</div>
									<input type="text" name="jumlah_individu" value="<?= $total_individu; ?>" hidden>
									<div class="form-group">
										<label>Kepala Keluarga</label>
										<select class="form-control" name="kepala_keluarga" id="exampleFormControlSelect1">
											<?php foreach ($datas2 as $data2) { ?>
												<?php if ($data2['no_kk'] == $no_kk) { ?>
													<option class="text-primary" value="<?= $data2['nama'] ?>"><?= $data2['nama']; ?></option>
												<?php } ?>
											<?php } ?>
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
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

$menu = "Jamkesmas";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

$id_jamkesmas = $_POST['id_jamkesmas'];
$datas = GetById($id_jamkesmas);
?>
<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Edit Jamkesmas</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<input type='hidden' name='id_jamkesmas' value="<?php echo $_POST['id_jamkesmas']; ?>">
						<?php
						foreach ($datas as $data) { ?>
							<div class="row">
								<div class="col-md-6 pr-md-1">
									<div class="form-group">
										<label>Nama Kepala Keluarga</label>
										<input type='text' name='nama_kepala_keluarga' class="form-control mt-2" value="<?= $data['nama_kepala_keluarga']; ?>">
									</div>

									<div class="form-group">
										<label>Jumlah Tunggangan</label>
										<input type='text' name='jumlah_tunggangan' class="form-control mt-2" value="<?= $data['jumlah_tunggangan']; ?>">
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
										<label>Jumlah Uang</label>
										<input type='text' name='jumlah_uang' class="form-control mt-2" value="<?= $data['jumlah_uang']; ?>">
									</div>

									<div class="form-group">
										<label>Keterangan</label>
										<input type='text' name='keterangan' class="form-control mt-2" value="<?= $data['keterangan']; ?>">
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
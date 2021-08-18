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

$menu = "Data Penduduk";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';
?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Input Data Penduduk</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<div class="row">
							<div class="col-md-8 pr-md-1">
								<div class="form-group">
									<label>No KK</label>
									<input type='text' name='no_kk' class="form-control mt-2" placeholder="Masukan no kk">
								</div>
								<div class="form-group">
									<label>RT</label>
									<input type='text' name='rt' class="form-control mt-2" placeholder="Masukan rt">
								</div>
								<div class="form-group">
									<label>RW</label>
									<input type='text' name='rw' class="form-control mt-2" placeholder="Masukan rw">
								</div>
								<div class="form-group">
									<!-- <label>Jumlah Individu</label> -->
									<input type='hidden' name='jumlah_individu' class="form-control mt-2">
								</div>
								<div class="form-group">
									<!-- <label>Kepala keluarga</label> -->
									<input type='hidden' name='kepala_keluarga' class="form-control mt-2" value="Belum diupdate">
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
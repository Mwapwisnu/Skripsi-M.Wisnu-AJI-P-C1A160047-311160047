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

$menu = "Kategori";

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
					<h5 class="title">Form Input Kategori</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<div class="row">
							<div class="col-md-6 pr-md-1">
								<div class="form-group">
									<label>Kategori</label>
									<input type='text' name='kategori' class="form-control mt-2" placeholder="Masukan kategori">
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
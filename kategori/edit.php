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

$id_kategori = $_POST['id_kategori'];
$datas = GetById($id_kategori);
?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Edit Kategori</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<input type='hidden' name='id_kategori' value="<?php echo $_POST['id_kategori']; ?>">
						<?php
						foreach ($datas as $data) { ?>
							<div class="row">
								<div class="col-md-6 pr-md-1">
									<div class="form-group">
										<label>Kategori</label>
										<input type='text' name='kategori' class="form-control mt-2" value="<?= $data['kategori']; ?>">
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

<?= require_once('../templates/footer.php'); ?>
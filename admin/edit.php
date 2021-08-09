<?php

session_start();

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];

if ($level == "Admin") {
	header("Location: ../index.php");
	exit;
}

if ($level == "Masyarakat") {
	header("Location: ../index.php");
	exit;
}

$menu = "Manajemen Akses";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

$id_admin = $_POST['id_admin'];
$datas = GetById($id_admin);

?>

<div class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Form Edit Admin</h5>
				</div>
				<div class="card-body">
					<form action='function.php' method='post'>
						<input type='hidden' name='id_admin' value="<?php echo $_POST['id_admin']; ?>">
						<?php
						foreach ($datas as $data) { ?>
							<div class="row">
								<div class="col-md-6 pr-md-1">
									<div class="form-group">
										<label>Admin</label>
										<input type='text' name='nama' class="form-control mt-2" value="<?= $data['nama']; ?>">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type='password' name='password' class="form-control mt-2" value="<?= $data['password']; ?>">
									</div>
									<div class="form-group">
										<label for="exampleFormControlSelect1">Level</label>
										<select class="form-control" name="level" id="exampleFormControlSelect1">
											<option class="text-primary" value="Superadmin" <?php if ($data['level'] == "Superadmin") echo "selected" ?>>Superadmin</option>
											<option class="text-primary" value="Admin" <?php if ($data['level'] == "Admin") echo "selected" ?>>Admin</option>
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
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

$menu = "Agama";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

// GET Penganut agama Islam
$query = "SELECT * FROM data_individu WHERE agama = 'Islam'";
$exe = mysqli_query(connect(), $query);
$total_islam = mysqli_num_rows($exe);

// GET Penganut agama katolik
$query = "SELECT * FROM data_individu WHERE agama = 'Katolik'";
$exe = mysqli_query(connect(), $query);
$total_katolik = mysqli_num_rows($exe);

// GET Penganut agama protestan
$query = "SELECT * FROM data_individu WHERE agama = 'Protestan'";
$exe = mysqli_query(connect(), $query);
$total_protestan = mysqli_num_rows($exe);


// GET Penganut agama hindu
$query = "SELECT * FROM data_individu WHERE agama = 'Hindu'";
$exe = mysqli_query(connect(), $query);
$total_hindu = mysqli_num_rows($exe);

// GET Penganut agama buddha
$query = "SELECT * FROM data_individu WHERE agama = 'Buddha'";
$exe = mysqli_query(connect(), $query);
$total_buddha = mysqli_num_rows($exe);

// GET Penganut agama khongucu
$query = "SELECT * FROM data_individu WHERE agama = 'Khonghucu'";
$exe = mysqli_query(connect(), $query);
$total_khongucu = mysqli_num_rows($exe);


?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header">
					<h4 class="card-title"> Table Data Agama</h4>
					<div class="row">
						<div class="col-2">
							<h1><span class="badge badge-secondary">Islam = <?= $total_islam; ?></span></h1>
						</div>
						<div class="col-2">
							<h1><span class="badge badge-warning">Katolik = <?= $total_katolik; ?></span></h1>
						</div>
						<div class="col-2">
							<h1><span class="badge badge-info">Protestan = <?= $total_protestan; ?></span></h1>
						</div>
						<div class="col-2">
							<h1><span class="badge badge-success font-weight-bold">Hindu = <?= $total_hindu; ?></span></h1>
						</div>
						<div class="col-2">
							<h1><span class="badge badge-danger">Buddha = <?= $total_buddha; ?></span></h1>
						</div>
						<div class="col-2">
							<h1><span class="badge badge-light">Khongucu = <?= $total_khongucu; ?></span></h1>
						</div>
					</div>
				</div>

				<div class='container mt-3'>
					<?php if (isset($_SESSION['success'])) : ?>
						<div class='alert alert-success'>
							<?= $_SESSION['success']; ?>
						</div>
					<?php unset($_SESSION['success']);
					endif; ?>

					<?php if (isset($_SESSION['failed'])) : ?>
						<div class='alert alert-danger'>
							<?= $_SESSION['failed']; ?>
						</div>
					<?php unset($_SESSION['failed']);
					endif; ?>
					<div class='card-header'>
						<div class='row'>
							<?php if ($level == "Superadmin") { ?>
								<div class='col-8'><a href='create.php' class='btn btn-primary btn-sm'>Tambah Data</a></div>
							<?php } ?>
							<div class='col-4' align='right'>
								<form action='' method='get'>
									<input type='text' name='search' class='form-control' placeholder='Search...'>
								</form>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table tablesorter " id="">
								<thead class="text-primary">
									<tr>
										<th>
											No.
										</th>
										<th>
											Agama
										</th>
										<?php if ($level == "Superadmin") { ?>
											<th class="text-center">
												Action
											</th>
										<?php } ?>
									</tr>
								</thead>

								<?php
								if (isset($_GET['search'])) {
									$data = GetBySearch($_GET['search']);
								} else {
									$data = getAll();
								}
								$no = ($_GET['page'] > 1) ? ($_GET['page'] * 10) - 9 : 1;
								?>

								<?php if ($data) : ?>
									<tbody>
										<?php foreach ($data as $td) : ?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $td['agama']; ?></td>
												<?php if ($level == "Superadmin") { ?>
													<td class='text-center'>
														<form method='POST' action='edit.php' class='d-inline'>
															<input type='hidden' name='id_agama' value='<?= $td['id_agama']; ?>'>
															<input type='submit' name='edit' Value='Edit' class='btn btn-warning btn-sm text-white'>
														</form>

														<form method='POST' action='function.php' class='d-inline' onclick="return confirm('Are you sure?')">
															<input type='hidden' name='id_agama' value='<?= $td['id_agama']; ?>'>
															<input type='submit' name='delete' Value='Delete' class='btn btn-danger btn-sm'>
														</form>
													</td>
												<?php } ?>
											</tr>
										<?php $no++;
										endforeach; ?>
									</tbody>
								<?php else : ?>
									<td colspan='10' class='text-center'>Tidak ada data</td>
								<?php endif; ?>
							</table>
						</div>
					</div>
					<div class='card-footer'>
						<nav aria-label='Page navigation example'>
							<ul class='pagination'>
								<?php for ($i = 1; $i <= pagination()['total_page']; $i++) : ?>
									<?php if ($i == pagination()['page']) : ?>
										<li class='page-item active'><a class='page-link' href='?page=<?= $i; ?>'><?= $i; ?></a></li>
									<?php else : ?>
										<li class='page-item'><a class='page-link' href='?page=<?= $i; ?>'><?= $i; ?></a></li>
									<?php endif; ?>
								<?php endfor; ?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('../templates/footer.php'); ?>
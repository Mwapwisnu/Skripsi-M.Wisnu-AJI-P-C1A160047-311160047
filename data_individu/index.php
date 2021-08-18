<?php
session_start();

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];
if ($level != "Masyarakat") {
	$id_data_individu = "";
}

if ($level == "Masyarakat") {
	$id_data_individu =	$_SESSION['id_data_individu'];
}

$menu = "Data Individu";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

require_once 'function.php';

$no_kk = $_POST['no_kk'];
?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header">
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
							<?php if ($level != "Masyarakat") { ?>
								<div class='col-8'>
									<form method='POST' action='create.php' class='d-inline'>
										<input type='hidden' name='no_kk' value='<?= $no_kk; ?>'>
										<input type='submit' name='create' Value='Tambah Data' class='btn btn-primary btn-sm text-white'>
									</form>
								</div>
								<div class='col-4' align='right'>
									<form action='' method='get'>
										<input type='text' name='search' class='form-control' placeholder='Search...'>
									</form>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table tablesorter " id="">
								<thead class=" text-primary">
									<tr>
										<th>No.</th>
										<th>foto</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Jenis Kelamin</th>
										<th>Gol Darah</th>
										<th>Alamat</th>
										<th>Pekerjaan</th>
										<th>Kewarganegaraan</th>
										<th>Agama</th>
										<th>Klasifikasi</th>
										<?php if ($level != "Masyarakat") { ?>
											<th class="text-center">Action</th>
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
												 <?php if($td['foto'] != ''){ ?>
												<td><img src="../assets/img/individu/<?= $td['foto']; ?>"></td>
												 <?php }else{ ?>
												<td><img src="../assets/img/individu/default.png" alt=""></td>
												<?php } ?>
												<td><?= $td['nik']; ?></td>
												<td><?= $td['nama']; ?></td>
												<td><?= $td['tempat_lahir']; ?></td>
												<td><?= $td['tanggal']; ?></td>
												<td><?= $td['jenis_kelamin']; ?></td>
												<td><?= $td['gol_darah']; ?></td>
												<td><?= $td['alamat']; ?></td>
												<td><?= $td['pekerjaan']; ?></td>
												<td><?= $td['kewarganegaraan']; ?></td>
												<td><?= $td['agama']; ?></td>
												<td><?= $td['klasifikasi']; ?></td>
												<?php if ($level != "Masyarakat") { ?>
													<td class='text-center'>

														<form method='POST' action='detail.php' class='d-inline'>
															<input type='hidden' name='id_data_individu' value='<?= $td['id_data_individu']; ?>'>
															<input type='submit' name='GetById' Value='Detail' class='btn btn-info btn-sm text-white'>
														</form>

														<form method='POST' action='edit.php' class='d-inline'>
															<input type='hidden' name='id_data_individu' value='<?= $td['id_data_individu']; ?>'>
															<input type='submit' name='edit' Value='Edit' class='btn btn-warning btn-sm text-white'>
														</form>

														<form method='POST' action='function.php' class='d-inline' onclick="return confirm('Are you sure?')">
															<input type='hidden' name='id_data_individu' value='<?= $td['id_data_individu']; ?>'>
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
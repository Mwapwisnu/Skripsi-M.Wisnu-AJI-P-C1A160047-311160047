<?php

require_once 'function.php';

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];

if ($level == "Masyarakat") {
	header("location: ../index.php");
	exit;
}

$menu = "Jamkesmas";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header">
					<h4 class="card-title"> Table Data Pemegang Kartu Jamkesmas</h4>
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
							<div class='col-2'><a href='create.php' class='btn btn-primary btn-sm'>Tambah Data</a></div>
							<div class='col-6'><a href='print.php' class='btn btn-info btn-sm'>Print</a></div>
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
								<thead class=" text-primary">
									<tr>
										<th>No.</th>
										<th>Nama Kepala Keluarga</th>
										<th class="text-center">Jumlah Tunggangan</th>
										<th class="text-center">RW</th>
										<th class="text-center">RT</th>
										<th class="text-center">Jumlah Uang</th>
										<th>Keterangan</th>
										<th class="text-center">Action</th>
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
												<td><?= $td['nama_kepala_keluarga']; ?></td>
												<td class="text-center"><?= $td['jumlah_tunggangan']; ?></td>
												<td class="text-center"><?= $td['rw']; ?></td>
												<td class="text-center"><?= $td['rt']; ?></td>
												<td class="text-center"><?= $td['jumlah_uang']; ?></td>
												<td><?= $td['keterangan']; ?></td>


												<td class='text-center'>
													<form method='POST' action='edit.php' class='d-inline'>
														<input type='hidden' name='id_jamkesmas' value='<?= $td['id_jamkesmas']; ?>'>
														<input type='submit' name='edit' Value='Edit' class='btn btn-warning btn-sm text-white'>
													</form>

													<form method='POST' action='function.php' class='d-inline' onclick="return confirm('Are you sure?')">
														<input type='hidden' name='id_jamkesmas' value='<?= $td['id_jamkesmas']; ?>'>
														<input type='submit' name='delete' Value='Delete' class='btn btn-danger btn-sm'>
													</form>
												</td>
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
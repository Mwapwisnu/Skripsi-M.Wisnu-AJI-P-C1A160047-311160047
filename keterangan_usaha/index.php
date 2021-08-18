<?php

require_once 'function.php';

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];
$id_data_individu = $_SESSION['id_data_individu'];

$menu = "Keterangan Usaha";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');


?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header">
					<h4 class="card-title"> Table Data Surat Keterangan Usaha</h4>
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
							<?php if ($level == "Masyarakat") { ?>
								<div class='col-2'><a href='create.php' class='btn btn-primary btn-sm'>Tambah Data</a></div>
							<?php } ?>
							<?php if ($level != "Masyarakat") { ?>
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
								<thead class="text-primary">
									<tr>
										<th>No.</th>
										<th>Tanggal</th>
										<th>Nomor_surat_pengantar</th>
										<th class="text0-center">no_kk</th>
										<th class="text0-center">no_nik</th>
										<th>Nama</th>
										<th>TTL</th>
										<th class="text0-center">Jenis_kelamin</th>
										<th>Agama</th>
										<th>Pendidikan</th>
										<th>Pekerjaan</th>
										<th class="text0-center">Status</th>
										<th>Nama_Ortu</th>
										<th>Alamat</th>
										<th>Nama_Usaha</th>
										<th>Keperluan/Bidang</th>
										<th class="text-center">
											Action
										</th>
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
									<tr>
										<tbody>
											<?php foreach ($data as $td) : ?>

												<td><?= $no; ?></td>
												<td><?= $td['tanggal']; ?></td>
												<td><?= $td['nomor']; ?></td>
												<td class="text0-center"><?= $td['no_kk']; ?></td>
												<td class="text0-center"><?= $td['nik']; ?></td>
												<td><?= $td['nama']; ?></td>
												<td class="text0-center"><?= $td['ttl']; ?></td>
												<td><?= $td['jenis_kelamin']; ?></td>
												<td><?= $td['agama']; ?></td>
												<td><?= $td['pendidikan']; ?></td>
												<td><?= $td['pekerjaan']; ?></td>
												<td><?= $td['status_perkawinan']; ?></td>
												<td><?= $td['nama_ortu']; ?></td>
												<td><?= $td['alamat']; ?></td>
												<td><?= $td['nama_usaha']; ?></td>
												<td><?= $td['bidang']; ?></td>
												<td class='text-center'>
													<?php if($td['status_surat'] == 1){ ?>
													<form method='POST' action='print.php' class='d-inline'>
														<input type='hidden' name='id_keterangan_usaha' value='<?= $td['id_keterangan_usaha']; ?>'>
														<input type='submit' name='GetById' Value='Print' class='btn btn-info btn-sm text-white'>
													</form>
													<?php } ?>

													<form method='POST' action='edit.php' class='d-inline'>
														<input type='hidden' name='id_keterangan_usaha' value='<?= $td['id_keterangan_usaha']; ?>'>
														<input type='submit' name='edit' Value='Edit' class='btn btn-warning btn-sm text-white'>
													</form>

													<?php if ($level != "Masyarakat") { ?>
														<form method='POST' action='function.php' class='d-inline' onclick="return confirm('Are you sure?')">
															<input type='hidden' name='id_keterangan_usaha' value='<?= $td['id_keterangan_usaha']; ?>'>
															<input type='submit' name='delete' Value='Delete' class='btn btn-danger btn-sm'>
														</form>
													<?php } ?>
												</td>
									</tr>
								<?php $no++;
											endforeach; ?>
								</tbody>
							<?php else : ?>
								<td colspan='10' class='text-center'>Tidak ada data / Pengajuan surat belum disetujui</td>
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
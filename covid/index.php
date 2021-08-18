<?php

require_once 'function.php';

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$menu = "Covid-19";

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header">
					<h4 class="card-title text-center weight-bold"> TABEL DATA PENDERITA COVID-19</h4>
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
					<div class="content">
						<?php 

						for ($rw=1; $rw < 15; $rw++) { 
							
							$a = "00{$rw}";
							if($rw > 9){
								$a = "0{$rw}";
							}

							// GET Pengidap yang status covid-19 = Sembuh
							$query = "SELECT * FROM covid WHERE status = 'OTG' && rw = $a";
							$exe = mysqli_query(connect(), $query);
							$total_sembuh = mysqli_num_rows($exe);

							// GET Pengidap yang status covid-19 = ODP
							$query = "SELECT * FROM covid WHERE status = 'ODP' && rw = $a";
							$exe = mysqli_query(connect(), $query);
							$total_odp_rw1 = mysqli_num_rows($exe);

							// GET Pengidap yang status covid-19 = PDP
							$query = "SELECT * FROM covid WHERE status = 'PDP' && rw = $a";
							$exe = mysqli_query(connect(), $query);
							$total_pdp_rw1 = mysqli_num_rows($exe);

							// GET Pengidap yang status covid-19 = Sembuh
							$query = "SELECT * FROM covid WHERE status = 'Sembuh' && rw = $a";
							$exe = mysqli_query(connect(), $query);
							$total_sembuh_rw1 = mysqli_num_rows($exe);

							// GET Pengidap yang status covid-19 = Meninggal
							$query = "SELECT * FROM covid WHERE status = 'Meninggal' && rw = $a";
							$exe = mysqli_query(connect(), $query);
							$total_meninggal_rw1 = mysqli_num_rows($exe);
						
						
						?>
						<h5>TOTAL WARGA YANG TERCATAT DI RW = <?= $rw; ?></h5>
						<div class="row">
							<div class="col-2">
								<h1><span class="badge badge-secondary p-4">OTG = <?=  $total_sembuh; ?></span></h1>
							</div>
							<div class="col-2">
								<h1><span class="badge badge-warning p-4">ODP = <?= $total_odp_rw1;  ?></span></h1>
							</div>
							<div class="col-2">
								<h1><span class="badge badge-info p-4">PDP = <?= $total_pdp_rw1;  ?></span></h1>
							</div>
							<div class="col-2">
								<h1><span class="badge badge-success font-weight-bold p-4">SEMBUH = <?=  $total_sembuh_rw1; ?> </span></h1>
							</div>
							<div class="col-2">
								<h1><span class="badge badge-danger p-4">MENINGGAL = <?= $total_meninggal_rw1;  ?></span></h1>
							</div>
						</div>
						<?php } ?>
					<?php if($level != "Masyarakat") { ?>
						<div class='row'>
							<div class='col-4'><a href='create.php' class='btn btn-primary btn-sm'>Tambah Data</a></div>
							<div class='col-2' align='right'>
								<form action='' method='get'>
									<input type='text' name='search_rt' class='form-control' placeholder='Search RT ...'>
								</form>
							</div>
							<div class='col-2' align='right'>
								<form action='' method='get'>
									<input type='text' name='search_rw' class='form-control' placeholder='Search RW ...'>
								</form>
							</div>
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
										<th>NIK</th>
										<th>Nama</th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Jenis Kelamin</th>
										<th>Gol Darah</th>
										<th>Alamat</th>
										<th>Pekerjaan</th>
										<th>Agama</th>
										<th>RT</th>
										<th>RW</th>
										<th>Status</th>
										<?php if ($level != "Masyarakat") { ?>
											<th class="text-center">Action</th>
										<?php } ?>
									</tr>
								</thead>

								<?php
								if (isset($_GET['search'])) {
									$data = GetBySearch($_GET['search']);
								} else if (isset($_GET['search_rt'])) {
									$data = GetBySearchRT($_GET['search_rt']);
								} else if (isset($_GET['search_rw'])) {
									$data = GetBySearchRW($_GET['search_rw']);
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
												<td><?= $td['nik']; ?></td>
												<td><?= $td['nama']; ?></td>
												<td><?= $td['tempat_lahir']; ?></td>
												<td><?= $td['tanggal_lahir']; ?></td>
												<td><?= $td['jenis_kelamin']; ?></td>
												<td class="text-center"><?= $td['gol_darah']; ?></td>
												<td><?= $td['alamat']; ?></td>
												<td><?= $td['pekerjaan']; ?></td>
												<td><?= $td['agama']; ?></td>
												<td><?= $td['rt']; ?></td>
												<td><?= $td['rw']; ?></td>
												<td><?= $td['status']; ?></td>
												<?php if ($level != "Masyarakat") {  ?>
													<td class='text-center'>
														<form method='POST' action='edit.php' class='d-inline'>
															<input type='hidden' name='id_covid' value='<?= $td['id_covid']; ?>'>
															<input type='submit' name='edit' Value='Edit' class='btn btn-warning btn-sm text-white'>
														</form>

														<form method='POST' action='function.php' class='d-inline' onclick="return confirm('Are you sure?')">
															<input type='hidden' name='id_covid' value='<?= $td['id_covid']; ?>'>
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
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('../templates/footer.php'); ?>
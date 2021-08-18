<?php
session_start();

$menu = "Data Individu";

if (!isset($_SESSION["level"])) {
	header("Location: ../login/index.php");
	exit;
}

$level = $_SESSION['level'];

if ($level == "Masyarakat") {
	header("Location: ../index.php");
	exit;
}

require_once 'function.php';

require_once('../templates/header.php');
require_once('../templates/sidebar.php');
require_once('../templates/navbar.php');

$id_data_individu = $_POST['id_data_individu'];
$datas = GetById($id_data_individu);

?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-user">
				<div class="card-body">
					<?php foreach ($datas as $data) : ?>
						<p class="card-text">
						<div class="author">
							<div class="block block-one"></div>
							<div class="block block-two"></div>
							<div class="block block-three"></div>
							<div class="block block-four"></div>
							<img class="avatar" src="../assets/img/individu/<?= $data['foto']; ?>" alt="...">
							<h3 class="title"><?= $data['nama']; ?></h3>
							<p>NIK : <?= $data['nik']; ?></p>
							<p>Jenis Kelamin : <?= $data['jenis_kelamin']; ?></p>
							<p>Alamat : <?= $data['alamat']; ?></p>
							<p>Agama : <?= $data['agama'] ?></p>
						</div>
						</p>
						<div class="card-description">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table tablesorter " id="">
										<thead class=" text-primary">
											<tr>
												<th>No.</th>
												<th>Kategori</th>
												<th>Nama File</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php foreach ($datas as $td) : ?>
												<tr>
													<td>1.</td>
													<td>Foto</td>
													<td><?= $td['foto']; ?></td>
													<td class="text-center">
														<a href="download_foto.php?filename=<?= $td['foto']; ?>" class="btn btn-warning btn-sm text-white">Download</a>
													</td>
												</tr>
												<tr>
													<td>2.</td>
													<td>AKTA</td>
													<td><?= $td['akta']; ?></td>
													<td class="text-center">
														<a href="download_akta.php?filename=<?= $td['akta']; ?>" class="btn btn-warning btn-sm text-white">Download</a>
													</td>
												</tr>
												<tr>
													<td>3.</td>
													<td>KTP</td>
													<td><?= $td['ktp']; ?></td>
													<td class="text-center">
														<a href="download_ktp.php?filename=<?= $td['ktp']; ?>" class="btn btn-warning btn-sm text-white">Download</a>
													</td>
												</tr>
												<tr>
													<td>4.</td>
													<td>Surat Nikah</td>
													<td><?= $td['surat_nikah']; ?></td>
													<td class="text-center">
														<a href="download_surat_nikah.php?filename=<?= $td['surat_nikah']; ?>" class="btn btn-warning btn-sm text-white">Download</a>
													</td>
												</tr>
											<?php $no++;
											endforeach; ?>
										</tbody>
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
	<?php endforeach; ?>
	</div>
</div>



<?php require_once('../templates/footer.php'); ?>
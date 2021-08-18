<?php
session_start();

$menu = "Data Penduduk";

if (!isset($_SESSION["level"])) {
  header("Location: ../login/index.php");
  exit;
}

$level = $_SESSION['level'];

if ($level == "Masyarakat") {
  header("Location: ../index.php");
  exit;
}

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
          <h4 class="card-title"> Table Data Detail KK : <b><?= $no_kk; ?></b></h4>
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
              <div class='col-8'>
                <form method='POST' action='create.php' class='d-inline'>
                  <input type='hidden' name='no_kk' value='<?= $no_kk; ?>'>
                  <input type='submit' name='create' Value='Tambah Data' class='btn btn-primary btn-sm text-white'>
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
                  </tr>
                </thead>

                <?php
                if (isset($_GET['search'])) {
                  $data = GetBySearch($_GET['search']);
                } else {
                  $data = getPenduduk();
                }
                $no = ($_GET['page'] > 1) ? ($_GET['page'] * 10) - 9 : 1;
                ?>

                <?php if ($data) : ?>
                  <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($data as $td) : ?>
                      <?php if ($td['no_kk'] == $no_kk) { ?>
                        <tr>
                          <td><?= $nomor; ?></td>
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
                        </tr>
                        <?php $nomor++; ?>
                      <?php } ?>
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
<?php

session_start();

require_once('config/get_connection.php');

if (!isset($_SESSION["level"])) {
	header("Location: login/index.php");
	exit;
}

$menu = "dashboard";

$foto = $_SESSION['foto'];
$level = $_SESSION['level'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<title>
		Home | Desa Sukamukti
	</title>
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<!-- Nucleo Icons -->
	<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
	<div class="wrapper">
		<div class="sidebar">
			<!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
			<div class="sidebar-wrapper">
				<div class="logo">
					<a href="index.php" class="simple-text logo-mini">
						DESA
					</a>
					<a href="index.php" class="simple-text logo-normal">
						SUKA MUKTI
					</a>
				</div>
				<ul class="nav">
					<li class="<?php if ($menu == "dashborad") {
																	echo 'active';
																} ?>">
						<a href="index.php">
							<i class="tim-icons icon-bank"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<hr>
					<?php if ($level == "Superadmin") { ?>
						<p class="ml-2">Manajemen Akses</p>
						<li class="<?php if ($menu == "Manajemen Akses") {
																		echo 'active';
																	} ?>">
							<a href="admin/index.php">
								<i class="tim-icons icon-vector"></i>
								<p>Data Admin</p>
							</a>
						</li>
						<hr>
					<?php } ?>
					<?php if ($level == "Admin" or $level == "Superadmin") { ?>
						<p class="ml-2">Master Data</p>
						<li class="<?php if ($menu == "Agama") {
																		echo 'active';
																	} ?>">
							<a href="agama/index.php">
								<i class="tim-icons icon-istanbul"></i>
								<p>Agama</p>
							</a>
						</li>
						<li class="<?php if ($menu == "Kategori") {
																		echo 'active';
																	} ?>">
							<a href="kategori/index.php">
								<i class="tim-icons icon-pin"></i>
								<p>Kategori</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Klasifikasi</p>
						<li class="<?php if ($menu == "Klasifikasi") {
																		echo 'active';
																	} ?>">
							<a href="klasifikasi/index.php">
								<i class="tim-icons icon-bell-55"></i>
								<p>Klasifikasi</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Penduduk</p>
						<li class="<?php if ($menu == "Data Penduduk") {
																		echo 'active';
																	} ?>">
							<a href="data_penduduk/index.php">
								<i class="tim-icons icon-single-02"></i>
								<p>Data Penduduk</p>
							</a>
						</li>
						<li class="<?php if ($menu == "Data Individu") {
																		echo 'active';
																	} ?>">
							<a href="data_individu/index.php">
								<i class="tim-icons icon-single-02"></i>
								<p>Data Individu</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Manajemen Desa</p>
						<li class="<?php if ($menu == "Profile") {
																		echo 'active';
																	} ?>">
							<a href="profile/index.php">
								<i class="tim-icons icon-badge"></i>
								<p>Profile</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Manajemen Surat</p>
						<li class="<?php if ($menu == "Menu Surat Keterangan") {
																		echo 'active';
																	} ?>">
							<a href="menu_surat/surat_keterangan.php">
								<i class="tim-icons icon-notes"></i>
								<p>Surat Keterangan</p>
							</a>
						</li>
						<li class="<?php if ($menu == "Menu Surat Pengantar") {
																		echo 'active';
																	} ?>">
							<a href="menu_surat/surat_pengajuan.php">
								<i class="tim-icons icon-single-copy-04"></i>
								<p>Surat Pengantar</p>
							</a>
						</li>
						<li class="<?php if ($menu == "Menu Surat Pengantar") {
																		echo 'active';
																	} ?>">
							<a href="jamkesmas/index.php">
								<i class="tim-icons icon-sound-wave"></i>
								<p>Jamkesmas</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Pengidap Covid-19</p>
						<li class="<?php if ($menu == "Covid-19") {
																		echo 'active';
																	} ?>">
							<a href="covid/index.php">
								<i class="tim-icons icon-atom"></i>
								<p>Data Pengidap Covid-19</p>
							</a>
						</li>
						<li class="">
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
						<li class="">
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
						<li class="">
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
						<li class="">
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
						<li>
							<a href="">
								<i class="tim-icons"></i>
								<p></p>
							</a>
						</li>
					<?php } ?>
					<?php if ($level == "Masyarakat") { ?>
						<p class="ml-2">Manajemen Desa</p>
						<li class="<?php if ($menu == "Profile") {
																		echo 'active';
																	} ?>">
							<a href="profile/index.php">
								<i class="tim-icons icon-badge"></i>
								<p>Profile</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Manajemen Surat</p>
						<li class="<?php if ($menu == "Menu Surat Keterangan") {
																		echo 'active';
																	} ?>">
							<a href="menu_surat/surat_keterangan.php">
								<i class="tim-icons icon-notes"></i>
								<p>Surat Keterangan</p>
							</a>
						</li>
						<li class="<?php if ($menu == "Menu Surat Pengantar") {
																		echo 'active';
																	} ?>">
							<a href="menu_surat/surat_pengajuan.php">
								<i class="tim-icons icon-single-copy-04"></i>
								<p>Surat Pengantar</p>
							</a>
						</li>
						<hr>
						<p class="ml-2">Pengidap Covid-19</p>
						<li class="<?php if ($menu == "Covid-19") {
																		echo 'active';
																	} ?>">
							<a href="covid/index.php">
								<i class="tim-icons icon-atom"></i>
								<p>Data Pengidap Covid-19</p>
							</a>
						</li>
						<br><br>
						<li>
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
						<li>
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
						<li>
							<a href="">
								<i class=""></i>
								<p></p>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<div class="navbar-toggle d-inline">
							<button type="button" class="navbar-toggler">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</button>
						</div>
						<a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
					</button>
					<div class="collapse navbar-collapse" id="navigation">
						<ul class="navbar-nav ml-auto">
							<li class="dropdown nav-item">
								<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
									<div class="photo">
										<?php if ($level == "Admin" || $level == "Superadmin") { ?>
											<img src="assets/img/anime3.png" alt="Profile Photo">
										<?php } ?>
										<img src="assets/img/individu/<?= $td['foto']; ?>" alt="Profile Photo">
									</div>
									<b class="caret d-none d-lg-block d-xl-block"></b>
									<a href="login/logout.php">
										<p class="d-lg-none">
											Log out
										</p>
									</a>
								</a>
								<ul class="dropdown-menu dropdown-navbar">
									<li class="nav-link"><a href="data_individu/index.php" class="nav-item dropdown-item">Profile</a></li>
									<li class="dropdown-divider"></li>
									<li class="nav-link"><a href="login/logout.php" class="nav-item dropdown-item">Log out</a></li>
								</ul>
							</li>
							<li class="separator d-lg-none"></li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i class="tim-icons icon-simple-remove"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End Navbar -->
			<div class="content">
				<div class="row">
					<div class="col-lg-6">
						<div class="card card-chart">
							<div class="card-header">
								<h5 class="card-category text-white">DATA INDIVIDU</h5>
								<?php
								$query = "SELECT * FROM data_individu";
								$exe = mysqli_query(connect(), $query);

								$total = mysqli_num_rows($exe);
								?>
								<h3 class="card-title"><i class="tim-icons icon-single-02 text-primary"></i>Total data = <span class="text-warning"><?= $total; ?></span></h3>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card card-chart">
							<div class="card-header">
								<h5 class="card-category text-white">DATA KARTU KELUARGA</h5>
								<?php
								$query = "SELECT * FROM data_penduduk";
								$exe = mysqli_query(connect(), $query);
								$total = mysqli_num_rows($exe);
								?>
								<h3 class="card-title"><i class="tim-icons icon-single-02 text-primary"></i> Total Data = <span class="text-warning"><?= $total; ?></span></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="card card-chart">
							<div class="card-header">
								<h5 class="card-category text-white">PEREMPUAN</h5>
								<?php
								$queryPerempuan = "SELECT * FROM data_individu WHERE jenis_kelamin = 'PEREMPUAN'";
								$exePerempuan = mysqli_query(connect(), $queryPerempuan);
								$total = mysqli_num_rows($exePerempuan);
								?>
								<h3 class="card-title"><i class="tim-icons icon-align-center text-primary"></i> Total Data = <span class="text-warning"><?= $total; ?></span></h3>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card card-chart">
							<div class="card-header">
								<h5 class="card-category text-white">LAKI-LAKI</h5>
								<?php
								$queryLaki = "SELECT * FROM data_individu WHERE jenis_kelamin = 'LAKI-LAKi'";
								$exeLaki = mysqli_query(connect(), $queryLaki);
								$total = mysqli_num_rows($exeLaki);
								?>
								<h3 class="card-title"><i class="tim-icons icon-align-center text-primary"></i> Total Data = <span class="text-warning"><?= $total; ?></span></h3>

							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card card-chart">
							<div class="card-header">
								<h5 class="card-category text-white">COVID-19</h5>
								<?php
								$queryCovid = "SELECT * FROM covid";
								$exeCovid = mysqli_query(connect(), $queryCovid);
								$total = mysqli_num_rows($exeCovid);
								?>
								<h3 class="card-title"><i class="tim-icons icon-align-center text-primary"></i> Total Data = <span class="text-warning"><?= $total; ?></span></h3>

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="container">
							<?php
							$queryProfile = "SELECT * FROM profile";
							$exeProfile = mysqli_query(connect(), $queryProfile);
							$data = mysqli_fetch_assoc($exeProfile);
							?>
							<h1 class="jumbotron-heading">Desa <?= $data['desa']; ?></h1>
							<h4><?= $data['visi']; ?></h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">

						<div class="container">

							<div class="row">
								<div class="col-md-6">
									<div class="card mb-4 box-shadow">
										<?php
										$query = "SELECT * FROM profile";
										$exe = mysqli_query(connect(), $query);
										$row = mysqli_fetch_assoc($exe);
										?>
										<?php if ($row['foto'] != '') {  ?>
											<img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="assets/img/profile/<?= $data['foto']; ?>" data-holder-rendered="true">
										<?php } else { ?>
											<img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="assets/img/profile/noimage.png" data-holder-rendered="true">
										<?php } ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card mb-4 box-shadow">
										<?php if ($row['foto'] != '') {  ?>
											<img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="assets/img/profile/<?= $data['struktur_organisasi'] ?>" data-holder-rendered="true">
										<?php } else { ?>
											<img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="assets/img/profile/noimage.png" data-holder-rendered="true">
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright">
						©<?= date('Y'); ?> Desa <a href="index.php" target="_blank"><?= $data['desa']; ?></a></span>, Theme by
						<a href="https://www.creative-tim.com/product/black-dashboard" target="_blank">Creative Tim</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<div class="fixed-plugin">
		<div class="dropdown show-dropdown">
			<a href="#" data-toggle="dropdown">
				<i class="fa fa-cog fa-2x"> </i>
			</a>
			<ul class="dropdown-menu">
				<li class="header-title"> Sidebar Background</li>
				<li class="adjustments-line">
					<a href="javascript:void(0)" class="switch-trigger background-color">
						<div class="badge-colors text-center">
							<span class="badge filter badge-primary active" data-color="primary"></span>
							<span class="badge filter badge-info" data-color="blue"></span>
							<span class="badge filter badge-success" data-color="green"></span>
						</div>
						<div class="clearfix"></div>
					</a>
				</li>
				<li class="adjustments-line text-center color-change">
					<span class="color-label">LIGHT MODE</span>
					<span class="badge light-badge mr-2"></span>
					<span class="badge dark-badge ml-2"></span>
					<span class="color-label">DARK MODE</span>
				</li>
				<li class="button-container">
					<a href="https://www.creative-tim.com/product/black-dashboard" target="_blank" class="btn btn-primary btn-block btn-round">Download Now</a>
					<a href="https://demos.creative-tim.com/black-dashboard/docs/1.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block btn-round">
						Documentation
					</a>
				</li>
				<li class="header-title">Thank you for 95 shares!</li>
				<li class="button-container text-center">
					<button id="twitter" class="btn btn-round btn-info"><i class="fab fa-twitter"></i> &middot; 45</button>
					<button id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot; 50</button>
					<br>
					<br>
					<a class="github-button" href="https://github.com/creativetimofficial/black-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
				</li>
			</ul>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="assets/js/core/jquery.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
	<!--  Google Maps Plugin    -->
	<!-- Place this tag in your head or just before your close body tag. -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	<!-- Chart JS -->
	<script src="assets/js/plugins/chartjs.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="assets/js/plugins/bootstrap-notify.js"></script>
	<!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/demo/demo.js"></script>
	<script>
		$(document).ready(function() {
			$().ready(function() {
				$sidebar = $('.sidebar');
				$navbar = $('.navbar');
				$main_panel = $('.main-panel');

				$full_page = $('.full-page');

				$sidebar_responsive = $('body > .navbar-collapse');
				sidebar_mini_active = true;
				white_color = false;

				window_width = $(window).width();

				fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



				$('.fixed-plugin a').click(function(event) {
					if ($(this).hasClass('switch-trigger')) {
						if (event.stopPropagation) {
							event.stopPropagation();
						} else if (window.event) {
							window.event.cancelBubble = true;
						}
					}
				});

				$('.fixed-plugin .background-color span').click(function() {
					$(this).siblings().removeClass('active');
					$(this).addClass('active');

					var new_color = $(this).data('color');

					if ($sidebar.length != 0) {
						$sidebar.attr('data', new_color);
					}

					if ($main_panel.length != 0) {
						$main_panel.attr('data', new_color);
					}

					if ($full_page.length != 0) {
						$full_page.attr('filter-color', new_color);
					}

					if ($sidebar_responsive.length != 0) {
						$sidebar_responsive.attr('data', new_color);
					}
				});

				$('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
					var $btn = $(this);

					if (sidebar_mini_active == true) {
						$('body').removeClass('sidebar-mini');
						sidebar_mini_active = false;
						blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
					} else {
						$('body').addClass('sidebar-mini');
						sidebar_mini_active = true;
						blackDashboard.showSidebarMessage('Sidebar mini activated...');
					}

					// we simulate the window Resize so the charts will get updated in realtime.
					var simulateWindowResize = setInterval(function() {
						window.dispatchEvent(new Event('resize'));
					}, 180);

					// we stop the simulation of Window Resize after the animations are completed
					setTimeout(function() {
						clearInterval(simulateWindowResize);
					}, 1000);
				});

				$('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
					var $btn = $(this);

					if (white_color == true) {

						$('body').addClass('change-background');
						setTimeout(function() {
							$('body').removeClass('change-background');
							$('body').removeClass('white-content');
						}, 900);
						white_color = false;
					} else {

						$('body').addClass('change-background');
						setTimeout(function() {
							$('body').removeClass('change-background');
							$('body').addClass('white-content');
						}, 900);

						white_color = true;
					}


				});

				$('.light-badge').click(function() {
					$('body').addClass('white-content');
				});

				$('.dark-badge').click(function() {
					$('body').removeClass('white-content');
				});
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			// Javascript method's body can be found in assets/js/demos.js
			demo.initDashboardPageCharts();

		});
	</script>
	<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
	<script>
		window.TrackJS &&
			TrackJS.install({
				token: "ee6fab19c5a04ac1a32a645abde4613a",
				application: "black-dashboard-free"
			});
	</script>
</body>

</html>
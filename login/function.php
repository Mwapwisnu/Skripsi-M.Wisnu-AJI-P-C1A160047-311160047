<?php
session_start();
require_once '../config/get_connection.php';

function getProfile()
{
  $query = "SELECT * FROM  `profile`";
  $exe = mysqli_query(connect(), $query);
  while ($data = mysqli_fetch_array($exe)) {
    $datas[] = array(
      'id_profile' => $data['id_profile'],
      'desa' => $data['desa'],
      'kecamatan' => $data['kecamatan'],
      'kabupaten' => $data['kabupaten'],
      'kepala_desa' => $data['kepala_desa'],
      'visi' => $data['visi'],
      'foto' => $data['foto'],
    );
  }
  return $datas;
}

function GetLogin()
{
  $uid = $_POST['uid'];
  $tgl_pass = $_POST['password'];

  $query = "SELECT * FROM  `data_individu` WHERE nik =  '$uid' AND tanggal = '$tgl_pass'";
  $exe = mysqli_query(connect(), $query);

  if (mysqli_num_rows($exe) == 0) {
    $_SESSION['pesan'] = "NIK atau password yang anda masukan salah";
    header("location: index.php");
  } else {
    $row = mysqli_fetch_assoc($exe);

    $_SESSION["login"] = true;
    $_SESSION["id_data_individu"] = $row['id_data_individu'];
    $_SESSION["level"] = "Masyarakat";
    $_SESSION["ktp"] = $row['nik'];
    $_SESSION["no_kk"] = $row['no_kk'];
    $_SESSION["nama"] = $row['nama'];
    $_SESSION["tempat"] = $row['tempat_lahir'];
    $_SESSION["tanggal"] = $row['tanggal'];
    $_SESSION["jk"] = $row['jenis_kelamin'];
    $_SESSION["agama"] = $row['agama'];
    
    header("Location: ../index.php");
  }
}

function GetLoginAdmin()
{
  $uid = $_POST['uid'];
  $password = $_POST['password'];

  $query = "SELECT * FROM  `admin` WHERE nama = '$uid' AND password = '$password'";
  $exe = mysqli_query(connect(), $query);

  if (mysqli_num_rows($exe) == 0) {
    $_SESSION['pesan'] = "Username atau password yang anda masukan salah";
    header("location: index.php");
  } else {
    $row = mysqli_fetch_assoc($exe);

    $_SESSION["login"] = true;
    $_SESSION["id_admin"] = $row['id_admin'];
    $_SESSION["level"] = $row['level'];

    header("Location: ../index.php");
  }
}

if (isset($_POST['login'])) {
  GetLogin($_POST['login']);
} else if (isset($_POST['login_admin'])) {
  GetLoginAdmin($_POST['login_admin']);
}

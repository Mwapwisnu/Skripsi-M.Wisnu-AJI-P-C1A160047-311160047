<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Surat Pengantar</title>
<style type="text/css">
  .ttd {
    width:200px;
    height:180px;
    position:absolute;
    bottom:85px;
    right: 53px;
  }

  </style>
</head>
<body>';

$id_domisili = $_POST['id_domisili'];

$data = GetDomisili();
foreach ($data as $td) :

  if ($id_domisili == $td['id_domisili']) {
    $html .=
      '<img src="../assets/img/logo-kabupaten-bandung.jpeg" width="100" height="100" style="float:left; background-color:red;"> 
    <h4 style="text-align:center;float:left; margin-right:27px;">PEMERINTAH KABUPATEN BANDUNG <br> KECAMATAN MAJALAYA <br> <b style="font-size: x-large;">DESA SUKAMUKTI</b> <br> <small style="font-size: xx-small">jln Pelangi No.2017 Majalaya - Bandung 40382 Tlp: (022) 84221534 e-mail: desasukamuktimajalaya@gmail.com website: <b>www.sukamukti.desa.id</b></small></h4>
    <hr style="border-style:double; color:black; margin-top:-8px;">
    <hr style="border-style:double; height:1.5px; color:black; margin-top:-10px;">
    <br>
    <h4 style="text-align:center; font-weight: bold; text-decoration: underline; margin-top: -5px;">SURAT KETERANGAN DOMISILI</h4>
    <p style="text-align:center; margin-top:-20px;">NO SURAT: ' . $td['nomor'] . '</p>
    <p style="text-align:justify">Yang bertanda tangan dibawah ini, Kepala Desa SUKAMUKTI Kecamatan MAJALAYA Kabupaten BANDUNG , menerangkan dengan sebenarnnya bahwa : </p>
    <br>';
  }
endforeach;
$html .=

  '<table cellpadding="3" cellspacing="0">';

$data = GetDomisili();
$id_domisili = $_POST['id_domisili'];
foreach ($data as $td) :
  if ($id_domisili == $td['id_domisili']) {

    $html .=
      '<tr>
    <td style="width:220px">Nama</td>
    <td>:</td>
    <td>' . $td['nama'] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Nomor Induk Kependudukan</td>
    <td>:</td>
    <td>' . $td["no_kk"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Nomor Kartu Keluarga</td>
    <td>:</td>
    <td>' . $td["nik"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Tempat, tanggal lahir</td>
    <td>:</td>
    <td>' . $td["ttl"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Jenis Kelamin</td>
    <td>:</td>
    <td>' . $td["jenis_kelamin"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Agama</td>
    <td>:</td>
    <td>' . $td["agama"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Pendidikan</td>
    <td>:</td>
    <td>' . $td["pendidikan"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Pekerjaan</td>
    <td>:</td>
    <td>' . $td["pekerjaan"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Status Perkawinan</td>
    <td>:</td>
    <td>' . $td["status_perkawinan"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Nama Orang Tua</td>
    <td>:</td>
    <td>' . $td["nama_ortu"] . '</td>
    </tr>
    <tr>
    <td style="width:220px">Alamat</td>
    <td>:</td>
    <td>' . $td["alamat"] . '</td>
    </tr>';
  }
endforeach;

$id_domisili = $_POST['id_domisili'];
foreach ($data as $td) :
  if ($id_domisili == $td['id_domisili']) {

    $html .=

      '</table>
    <br>
    Berdasarkan keterangan RT/RW setempat benar bahwa yang bersangkutan Penduduk Desa SUKAMUKTI Kecamatan MAJALAYA dan sepengethuan kami bahwa yang bersangkutan :
    <br><br>
    Surat Keterangan ini dipergunakan untuk : 
    <h4 style="font-weight: bold; text-align:center;">== benar berdomisili di alamat tersebut ==</h4>
    <p>Keterangan ini beralku 1 (satu) bulan dari tanggal pembuatan. Demikian keterangan ini, untuk di pergunakan sebagai mana mestinya.
    <br><br>
    <div style="position:absolute; margin-bottom:30px; bottom:95; right:53px; text-align:center">
    Bandung, ' . date('d-m-Y') . ' <br>
    
     Kepala Desa SUKAMUKTI
    <br><br><br><br><br>
    <small style="font-size: 1.1em; margin-top:5px; text-decoration: underline; text-align:center;">' . $td['nama_tertanda'] . '</small><br>
    </div>
    <div class="ttd">
      <img src="../assets/img/ttd/' . $td['ttd'] . '" style="width:200px;
      height:140px; margin-left:20px; margin-top:15px;">
    </div>
    </body>
    </html>';
  }
endforeach;

$mpdf->WriteHTML($html);
$mpdf->Output();

<?php

require_once '../vendor/autoload.php';
require_once 'function.php';

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengantar</title>
</head>
  <body>';

$html .=
  '<img src="../assets/img/logo-kabupaten-bandung.jpeg" width="100" height="100" style="float:left; background-color:red;"> 
  <h4 style="text-align:center;float:left; margin-right:27px;">PEMERINTAH KABUPATEN BANDUNG <br> KECAMATAN MAJALAYA <br> <b style="font-size: x-large;">DESA SUKAMUKTI</b> <br> <small style="font-size: xx-small">jln Pelangi No.2017 Majalaya - Bandung 40382 Tlp: (022) 84221534 e-mail: desasukamuktimajalaya@gmail.com website: <b>www.sukamukti.desa.id</b></small></h4>
  <hr style="border-style:double; color:black; margin-top:-10px;">
  <hr style="border-style:double; height:1.5px; color:black; margin-top:-7px;">
  <br><br>
  <h3 style="text-align:center; font-weight: bold; margin-top: -6px;">DAFTAR PEMEGANG KARTU JAMKESMAS</h3>';

$html .=

  '

<table border="1">
<thead >
<tr style="background-color:gray;">
  <th>No.</th>
  <th style="width:200px;">Nama Kepala Keluarga</th>
  <th style="width:100px">Jumlah Tunggangan</th>
  <th>RT</th>
  <th>RW</th>
  <th style="width:100px">Hasil Pendapatan</th>
  <th style="width:250px;">Keterangan</th>
</tr>
</thead>
<tbody>';

$data = getData();
$no = 1;
foreach ($data as $td) :
  $html .=

    '
<tr>
  <td style="text-align:center">' . $no++ . '</td>
  <td>' . $td['nama_kepala_keluarga'] . '</td>
  <td style="text-align:center">' . $td['jumlah_tunggangan'] . '</td>
  <td style="text-align:center">' . $td['rw'] . '</td>
  <td style="text-align:center">' . $td['rt'] . '</td>
  <td>Rp. ' . $td['jumlah_uang'] . '</td>
  <td>' . $td['keterangan'] . '</td>
</tr>';
endforeach;
$html .=

  '
</tbody>
</table>
 
  <br>
  <br>
  <div style="position:absolute; bottom:0; left:0; ">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mengetahui, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bandung,' . date('d-m-Y') . ' </p>
  <p style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kepala Desa  ..................  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sekretaris Desa ..................</p>
  <br><br><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( .............................  ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( .............................  )
  <br>
  <br>
  </div>
  </body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();

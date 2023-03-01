<?php
$file = 'data2.json';
// membaca file json
$data = file_get_contents('data.json');

// mengubah data json menjadi array
$data_array = json_decode($data, true);

// menambahkan data baru ke dalam array
array_push($data_array, array(
				"maskapai" => $maskapai,
				"asal" => $asal,
				"tujuan" => $tujuan,
				"harga" => $harga,
				"pajak" => $pajak,
				"total" => $total
));

// menambahkan data baru ke dalam array $data_array
$data_array[] = $new_data;

// mengubah kembali array menjadi data json
$data = json_encode($data_array, JSON_PRETTY_PRINT);

// menuliskan data json ke dalam file
file_put_contents('data.json', $data);

// redirect ke halaman utama
header('location: index.php');
?>

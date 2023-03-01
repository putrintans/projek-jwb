<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Rute Penerbangan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
body {
	background-color: #dee2e6;
}
</style>
</head>
<body>

<div class="container mt-5">
	<center>
    <h2> Pendaftaran Rute Penerbangan</h2>
	</center>
    <form method="post" action="process.php">
        <div class="form-group">
            <label for="maskapai">Maskapai:</label>
            <input type="text" class="form-control" id="maskapai" placeholder="Masukkan nama maskapai" name="maskapai" required>
        </div>
        <div class="form-group">
            <label for="asal">Bandara Asal :</label>
            <select type="select" class="form-control" id="asal" name="asal" required>
			<option value="cgk">Soekarno-Hatta (CGK)</option>
			<option value="bdo">Hussein Sastra Negara (BDO)</option>
			<option value="cgk">Abdul Rachman Saleh (MLG)</option>
			<option value="bdo">Juanda (SUB)</option>
			</select>
        </div>
        <div class="form-group">
            <label for="tujuan">Bandara Tujuan :</label>
            <select type="text" class="form-control" id="tujuan" name="tujuan" required>
			<option value="cgk">Sultan Iskandarmuda (BTJ)</option>
			<option value="bdo">Hasanuddin (UPG)</option>
			<option value="bdo">Ngurah Rai (DPS)</option>
			<option value="bdo">Inanwatan (INX)</option>
			</select>
        </div>
        <div class="form-group">
            <label for="harga">Harga Tiket :</label>
            <input type="number" class="form-control" id="number_format" placeholder="Masukkan harga tiket" name="harga" required>
        </div>
        <button type="submit" class="btn btn-primary value="proses data" >Submit</button>
    </form>
</div>

</body>
</html>

<?php
	if(isset($_POST['submit'])){
		$maskapai = $_POST['maskapai'];
		$asal = $_POST['asal'];
		$tujuan = $_POST['tujuan'];
		$tiket = $_POST['tiket'];
		$pajak = hitung_pajak($asal);
		$pajak = hitung_pajak($tujuan);
		$total = $pajak + $harga;
		switch ($asal) {
			case 'total':
				$submit = $maskapai+$asal+$tujuan+$harga+$pajak+$total;
			break;		
		}
	}

function hitung_pajak($asal, $tujuan) {
    // Fungsi ini menghitung pajak berdasarkan bandara asal dan tujuan
    if ($asal == 'Soekarno-Hatta (CGK)' && $tujuan == 'Inanwatan (INX)') {
        $asal = 50000;
		$tujuan = 90000;
    } elseif ($asal == 'Husein Sastranegara (BDO)' && $tujuan == 'Ngurah Rai (DPS)') {
        $pajak = 110000;
    } elseif ($asal == 'Husein Sastranegara (BDO)' && $tujuan == 'Hasanuddin (UPG)') {
        $pajak = 100000;
    } elseif ($asal == 'Husein Sastranegara (BDO)' && $tujuan == 'Inanwatan (INX)') {
        $pajak = 120000;
    } elseif ($asal == 'Abdul Rachman Saleh (MLG)' && $tujuan == 'Ngurah Rai (DPS)') {
        $pajak = 120000;
    } elseif ($asal == 'Abdul Rachman Saleh (MLG)' && $tujuan == 'Hasanuddin (UPG)') {
        $pajak = 110000;
    }
    // Menghitung total pajak
	$pajak = $asal + $tujuan;
    $total = $pajak + $harga;
    return $total;
}

?>

<html>
<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
			color: #333;
			font-family: Arial, sans-serif;
			font-size: 0.8em;
			text-align: left;
		}
		table th {
			background-color: #2c3e50;
			color: #fff;
			font-weight: bold;
			padding: 8px;
			text-transform: uppercase;
		}
		table td, table th {
			border: 1px solid #ccc;
			padding: 8px;
			vertical-align: middle;
		}
		table tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
<body>
<div class="container mt-5">
    <center>
	<h2>Daftar Rute Yang Tersedia</h2>
    </center>
	<table class="table">
        <thead>
            <tr>
                <th>Maskapai</th>
                <th>Asal Penerbangan</th>
                <th>Tujuan Penerbangan</th>
                <th>Harga Tiket</th>
				<th>Pajak</th>
				<th>Total Harga Tiket</th>
            </tr>
        </thead>
        <tbody>
<?php
	// membaca file json
	$data = file_get_contents('data.json');

	// mengubah data json menjadi array
	$data_array = json_decode($data, true);

	// menampilkan data dalam bentuk tabel
	foreach ($data_array as $row) {
		$pajak = floatval($row['asal']) + floatval($row['tujuan']);
		$total = $row['harga'] + $pajak;
		echo "<tr>";
		echo "<td>" . $row['maskapai'] . "</td>";
		echo "<td>" . $row['asal'] . "</td>";
		echo "<td>" . $row['tujuan'] . "</td>";
		echo "<td>" . $row['harga'] . "</td>";
		echo "<td>" . number_format($row['pajak'], 0, ',', '.') . "</td>";
		echo "<td>" . $total . "</td>";
		echo "</tr>";
	error_reporting(0);
	}

?>
</tbody>
</table>
</div>
</body>
</html>
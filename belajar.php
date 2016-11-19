<h1>Kalkulator Sederhana Versi 1.0</h1>
<form method="post" action="">
	Angka pertama<br/>
	<input type="text" name="angka_1"/><br/><br/>
	<select name="kondisi">
		<option>--pilih--</option>
		<option value="plus">+</option>
		<option value="minus">-</option>
		<option value="kali">x</option>
		<option value="bagi">/</option>
	</select><br/><br/>
	Angka Kedua<br/>
	<input type="text" name="angka_2"/><br/><br/>
	<input type="submit" value="submit"/>
</form>
<?php
	$angka_1 = @$_POST['angka_1'];
	$angka_2 = @$_POST['angka_2'];
	$kondisi = @$_POST['kondisi'];

	//memulai logika
	if($kondisi == 'plus'){
		$perhitungan = '+';
		$output = $angka_1 + $angka_2;
	}else if($kondisi == 'minus'){
		$perhitungan = '-';
		$output = $angka_1 - $angka_2;
	}else if($kondisi == 'kali'){
		$perhitungan = '*';
		$output = $angka_1 * $angka_2;
	}else if($kondisi == 'bagi'){
		$perhitungan = '/';
		$output = $angka_1 / $angka_2;
	}
	//akhir logika
	$hasil = $angka_1.' '.$perhitungan.' '.$angka_2;
	echo 'angka satu = '.$angka_1.'<br/>';
	echo 'angka dua = '.$angka_2.'<br/>';
	echo 'kondisi = '.$kondisi.'<br/>';
	echo '<h3>Hasil '.$hasil.' adalah <font color="red">'.$output.'</font></h3>';
?>

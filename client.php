<?php
	/*
		Kelompok 11
		Nama Anggota Kelompok:
		Safira Pusparanti - 1506689244
		Andre Ramadhani - 1506689484
		Atikah Luthfiana - 1506689250
	*/

	// import nusoap dan assign alamat server web service
	require_once('tutorial/webservice/nusoap-0.9.5/lib/nusoap.php');
	$client = new nusoap_client('http://currencyconverter.kowabunga.net/converter.asmx?WSDL', true);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Web Service SOAP - CurrencyConverter</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
			integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
	<div class="container mt-5 mb-5">
		<h1 class="mb-5">Currency Conversion Rate & Amount</h1>
	<div class="row">
	<div class="col">
	<!-- form untuk memasukkan input-->
	<form name="form" action="" method="POST">
		
        <div class="form-group">
			<label for="CurrencyFrom">Currency From*</label>
			<select name="CurrencyFrom" id="CurrencyFrom" class="form-control custom-select" required="">
				<option disabled selected value=""> Select a currency </option>
					<?php
						// Memanggil fungsi untuk mendapatkan Currencies
						$response = $client->call('GetCurrencies');

						var_dump($response);
						$currencies = $response['GetCurrenciesResult'];
						$currency = $currencies['string'];

						//Menampilkan daftar currency
						for($i = 0; $i < sizeof($currency); $i++){
							echo "<option value='$currency[$i]'>$currency[$i]</option>";
						}
					?>
			</select>
		</div>
		
        <div class="form-group">
			<label for="CurrencyTo">Currency To*</label>
			<select name="CurrencyTo" id="CurrencyTo" class="form-control custom-select" required="">
				<option disabled selected value=""> Select a currency </option>
					<?php
						// Memanggil fungsi untuk mendapatkan Currencies
						$response = $client->call('GetCurrencies');

						var_dump($response);
						$currencies = $response['GetCurrenciesResult'];
						$currency = $currencies['string'];

						//Menampilkan daftar currency
						for($i = 0; $i < sizeof($currency); $i++){
							echo "<option value='$currency[$i]'>$currency[$i]</option>";
						}
					?>
			</select>
		</div>
		
        <div class="form-group">
			<label for="RateDate">Date*</label>
			<input type="date" name="RateDate" id="RateDate" class="form-control" required>
		</div>

		<!-- memasukkan nilai yang akan dikonversikan -->
        <div class="form-group">
			<label for="Amount">Amount*</label>
			<input placeholder="Enter the amount" type="number" name="Amount" id="Amount" value="0" class="form-control" min="0" step="500" required>
		</div>
		<a>* required to be filled in</a>
		<div class="float-right">
		<button type="submit" class="btn btn-outline-dark">SUBMIT</button>
		</div>
	</form>
	</div>
	<div class="col ml-5 mt-4">
		<?php
			// Cek apakah nilai yang dibutuhkan sudah terpenuhi
			if(isset($_POST['CurrencyFrom']) && isset($_POST['CurrencyTo']) && isset($_POST['RateDate']) && isset($_POST['Amount'])){

				//data untuk parameter yang akan dikirim
				$data = array(
					'CurrencyFrom'=>$_POST['CurrencyFrom'],
					'CurrencyTo'=>$_POST['CurrencyTo'],
					'RateDate'=>$_POST['RateDate'],
					'Amount'=>$_POST['Amount']
				);

				// Memanggil fungsi GetConversionRate dan GetConversionAmount berdasarkan parameter yang dipilih
				$responseConversionRate = $client->call('GetConversionRate', array('parameters'=>$data));
				if(!isset($responseConversionRate['GetConversionRateResult'])) {
					$responseConversionRate = "An error occurs. Please try again.";
				} else {
					$responseConversionRate = $responseConversionRate['GetConversionRateResult'];
				}

				$responseConversionAmount = $client->call('GetConversionAmount', array('parameters'=>$data));
				if(!isset($responseConversionAmount['GetConversionAmountResult'])) {
					$responseConversionAmount = "An error occurs. Please try again.";
				} else {
					$responseConversionAmount = $responseConversionAmount['GetConversionAmountResult'];
				}
				
				// Menampilkan hasil response
				echo "<p><strong class='mt-5'>Currency From</strong><br>";
				echo $_POST['CurrencyFrom'];
				echo "</p><p><strong>Currency To</strong><br>";
				echo $_POST['CurrencyTo'];
				echo "</p><p><strong>Date</strong><br>";
				echo $_POST['RateDate'];
				echo "</p><p><strong>Amount</strong><br>";
				echo $_POST['Amount'];
				echo "</p><p><strong>Currency Conversion Rate</strong><br>";
				echo $responseConversionRate;
				echo "</p><strong>Currency Conversion Amount</strong><br>";
				echo $responseConversionAmount;
			}
		?>
	</div>
	</div>
	</div>
</body>
</html>
<?php 
//file proses
//menjalankan perhitungan backpropagation neural network

//header pemformatan json
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//include file connection.php
//memangil file koneksi untuk melakukan koneksi ke database
include '../db/connection.php';
//include file bpnn.php
// file yang berisi fungsi backpropagation nerual network
include '../algorithm/bpnn.php';
//include file error_measurement.php
//file yang berisi fungsi perhitungan metode pengukuran kesalahan prediksi
include '../algorithm/error_measurement.php';
//include file training_periode.php
//file yang berisi fungsi untuk mencari bulan dan tahun berdasarkan periode paramater
include '../option/training_periode.php';

//deklarasi variabel dataset
//variabel konversi database kedalam array
$dataset = array();
//deklarasi variabel data training
//dataset sebagai data training
//untuk dikonversi ke dalam format json
$training = array();

//menampilkan tabel berdasarkan kriteria parameter url
$data = mysqli_query($conn,"select * from audusd where ".month(2));

$model_from = mysqli_query($conn, "select * from online onl join audusd au on onl.id=au.id WHERE squared=(select min(squared) from online) and ".month(1));
$model = mysqli_fetch_array($model_from);

//deklarasi variabel bobot
$w1; $w2; $w3; $w4; $w5; $w6; $w7; $w8; $w9; $w10;  $w11; $w12; 
$v1; $v2; $v3; $v4;

$w1 = $model['w1'];
$w2 = $model['w2'];
$w3 = $model['w3'];
$w4 = $model['w4'];
$w5 = $model['w5'];
$w6 = $model['w6'];
$w7 = $model['w7'];
$w8 = $model['w8'];
$w9 = $model['w9'];
$w10 = $model['w10'];
$w11 = $model['w11'];
$w12 = $model['w12'];
//pembobotan unit output layer
$v1 = $model['v1'];
$v2 = $model['v2'];
$v3 = $model['v3'];
$v4 = $model['v4'];

//variabel unit bias
$bias = 1;

//deklarasi dan inisialisasi variabel laju pemahaman
$alpha = rand(0,100)/100;

//deklarasi variabel net di setiap unit
$neth1 = 0; //net di unit hidden layer h1
$neth2 = 0; //net di unit hidden layer h2
$neth3 = 0; //net di unit hidden layer h3
$neto = 0; //net di unit output

//deklarasi variabel output masing-masing unit
$h1 = 0; //output di unit hidden layer h1
$h2 = 0; //output di unit hidden layer h1
$h3 = 0; //output di unit hidden layer h1
$out = 0; //output di unit output //hasil prediksi


//deklarasi variable faktor delta unit output
$deltaoutput = 0;

//deklarasi variable suku perubahan bobot di unit output layer
$deltav1 = 0;
$deltav2 = 0;
$deltav3 = 0;

//deklarasi faktor delta unit hidden layer
$deltahidden1 = 0;
$deltahidden2 = 0;
$deltahidden3 = 0;

//deklarasi variabel suku perubahan bobot di unit hidden layer
$deltaw1 = 0;
$deltaw2 = 0;
$deltaw3 = 0;
$deltaw4 = 0;


//variabel index
$i = 0;
//deklarasi variabel eppoach //menghitung jumlah eppoach / lama iterasi disetiap baris data
$eppoach = 0;

//deklarasi variabel pengukuran kesalah 
$mad = 0; //Mean Absolte Deviation(MAD)
$mse = 0; //Mean Squared Error(MSE)
$mape = 0; //Mean Absolte Percentage Error(MAPE)

//konversi database ke dalam data array agar lebih mudah diolah
while($d = mysqli_fetch_array($data))
{
    $dataset[] = $d;
}

//menghitung jumlah baris / data
$n_data = mysqli_num_rows($data);


//deklarasi variabel error
$error = 0;
$sqrt_error = 0;
$percentage_error = 0;

$sum_error = 0;
$sum_sqrt_error = 0;
$sum_percentage_error = 0;

//banyak iterasi maksimal
$maxiter = 1000;

//mulai menghitung
do
{
	//jumlah eppoach
    $eppoach++;
    $sum_error = 0; //total error
    $sum_sqrt_error = 0; //total error^2
    $sum_percentage_error = 0; //total prosentase error
    $i=0;
    foreach($dataset as $d)
    {
        //variabel dataset
        //id data
        $id = $training[$i]['id'] = intval($d['id']);
        //tanggal data
        $date = $training[$i]['date'] = $d['date'];
        //variabel fitur
        //x1
        //data open
        $x1 = $training[$i]['x1'] = floatval($d['open']);
        //x2 
        //data high
        $x2 = $training[$i]['x2'] = floatval($d['high']);
        //x3
        //data close
        $x3 = $training[$i]['x3'] = floatval($d['low']);
        //target
        //data hasil yang sebenarnya
        $target = $training[$i]['target'] = floatval($d['close']);
        
        //fase propagasi maju
        //feedforward
        //menghitung net disetiap unit di unit hiden layer
        //net, bisa disebut juga treshold
        $neth1 = Net($w1, $w2, $w3, $w4, $x1, $x2, $x3);
        $neth2 = Net($w5, $w6, $w7, $w8, $x1, $x2, $x3);
        $neth3 = Net($w9, $w10, $w11, $w12, $x1, $x2, $x3);

        //menghitung output di unit hidden layer
        //menggunakan fungsi aktifasi sigmoid
        $h1 = SigmoidActivation($neth1);
        $h2 = SigmoidActivation($neth1);
        $h3 = SigmoidActivation($neth1);

        //menghitung net di unit output layer
        //net, bisa disebut juga treshold
        $neto = Net($v1, $v2, $v3, $v4, $h1, $h2, $h3);
        //menghitung output di unit output layer
        //menghitung hasil prediksi
        //menggunakan fungsi aktifasi sigmoid
        $out = SigmoidActivation($neto);
        //memasukkan hasil prediksi ke array
        $training[$i]['output'] = $out;
        $training[$i]['eppoach'] = $eppoach;


        //menghitung nilai margin error
        $error = error($out,$target);
        $sqrt_error = pow(error($out,$target),2);
        $percentage_error = percentage_error($error,$target);
        //menghitung jumlah eror semua data
        $sum_error = $sum_error + $error;
        $sum_sqrt_error = $sum_sqrt_error + $sqrt_error;
        $sum_percentage_error = $sum_percentage_error + $percentage_error;

        //memasukkan data bobot ke variabel array
        $training[$i]['w'][0] = $w1; 
        $training[$i]['w'][1] = $w2 ;
        $training[$i]['w'][2] = $w3 ;
        $training[$i]['w'][3] = $w4 ;
        $training[$i]['w'][4] = $w5 ;
        $training[$i]['w'][5] = $w6 ;
        $training[$i]['w'][6] = $w7 ;
        $training[$i]['w'][7] = $w8 ;
        $training[$i]['w'][8] = $w9 ;
        $training[$i]['w'][9] = $w10;
        $training[$i]['w'][10] = $w1;
        $training[$i]['w'][11] = $w1;
        //menghitung perubahan bobot ;
        $training[$i]['v'][0] = $v1;
        $training[$i]['v'][1] = $v2;
        $training[$i]['v'][2] = $v3;
        $training[$i]['v'][3] = $v4 ;
        
        //menghitung nilai error
        $training[$i]['error']['absolute'] = $error; 
        $training[$i]['error']['squared'] = $sqrt_error;
        $training[$i]['error']['percentage'] = $percentage_error;
		
		/*if($eppoach==99)
		{
			$check_duplicate = mysqli_query($conn, "select * from online where id=".$d['id']);
			if(mysqli_fetch_array($check_duplicate) == true)
			{
				mysqli_query($conn,"update online set
					prediksi = ".$out.",
					w1 = ".$w1.",
					w2 = ".$w2.",
					w3 = ".$w3.",
					w4 = ".$w4.",
					w5 = ".$w5.",
					w6 = ".$w6.",
					w7 = ".$w7.",
					w8 = ".$w8.",
					w9 = ".$w9.",
					w10 = ".$w10.",
					w11 = ".$w11.",
					w12 = ".$w12.",
					v1 = ".$v1.",
					v2 = ".$v2.",
					v3 = ".$v3.",
					v4 = ".$v4.",
					absolute = ".$error.",
					squared = ".$sqrt_error.",
					percentage = ".$percentage_error."
					where id = ".$d['id']
				);
			}
			else
			{
				mysqli_query($conn,"insert into online values(
					".$id.",
					".$out.",
					".$w1.",
					".$w2.",
					".$w3.",
					".$w4.",
					".$w5.",
					".$w6.",
					".$w7.",
					".$w8.",
					".$w9.",
					".$w10.",
					".$w11.",
					".$w12.",
					".$v1.",
					".$v2.",
					".$v3.",
					".$v4.",
					".$error.",
					".$sqrt_error.",
					".$percentage_error."
					)
				");
			}
		}*/
            
        //propagasi mundur
        //menghitung faktor delta unit output
        $deltaoutput = deltaOutput($target, $out);
        
        //menghitung suku perubahan bobot unit output layer
        $deltav1 = deltaWeight($alpha, $deltaoutput, $h1);
        $deltav2 = deltaWeight($alpha, $deltaoutput, $h2);
        $deltav3 = deltaWeight($alpha, $deltaoutput, $h3);
        $deltav4 = deltaWeight($alpha, $deltaoutput, $bias);

        //menghitung faktor delta unit hidden layer
        $deltahidden1 = deltahidden($neth1, $h1);
        $deltahidden2 = deltahidden($neth2, $h2);
        $deltahidden3 = deltahidden($neth3, $h3);

        //menghitung suku perubahan bobot unit hidden layer
        $deltaw1 = deltaWeight($alpha, $deltahidden1, $x1);
        $deltaw2 = deltaWeight($alpha, $deltahidden1, $x2);
        $deltaw3 = deltaWeight($alpha, $deltahidden1, $x3);
        $deltaw4 = deltaWeight($alpha, $deltahidden1, $bias);
        $deltaw5 = deltaWeight($alpha, $deltahidden2, $x1);
        $deltaw6 = deltaWeight($alpha, $deltahidden2, $x2);
        $deltaw7 = deltaWeight($alpha, $deltahidden2, $x3);
        $deltaw8 = deltaWeight($alpha, $deltahidden2, $bias);
        $deltaw9 = deltaWeight($alpha, $deltahidden3, $x1);
        $deltaw10 = deltaWeight($alpha, $deltahidden3, $x2);
        $deltaw11 = deltaWeight($alpha, $deltahidden3, $x3);
        $deltaw12 = deltaWeight($alpha, $deltahidden3, $bias);

        //pembaruan bobot
        //bobot di unit hidden layer
        $w1 = updateWeight($w1, $deltaw1);
        $w2 = updateWeight($w2, $deltaw2);
        $w3 = updateWeight($w3, $deltaw3);
        $w4 = updateWeight($w4, $deltaw4);
        $w5 = updateWeight($w5, $deltaw5);
        $w6 = updateWeight($w6, $deltaw6);
        $w7 = updateWeight($w7, $deltaw7);
        $w8 = updateWeight($w8, $deltaw8);
        $w9 = updateWeight($w9, $deltaw9);
        $w10 = updateWeight($w10, $deltaw10);
        $w11 = updateWeight($w11, $deltaw11);
        $w12 = updateWeight($w12, $deltaw12);

        //bobot di unit output layer
        $v1 = updateWeight($v1, $deltav1);
        $v2 = updateWeight($v2, $deltav2);
        $v3 = updateWeight($v3, $deltav3);
        $v4 = updateWeight($v4, $deltav4);
        
        $i++;
        
    }
    //total nilai error
    $mad = mad($sum_error, $n_data);
    $mse = mse($sum_sqrt_error, $n_data);
    $mape = mape($sum_percentage_error, $n_data);
    
    if($eppoach==500 or $mad<0.005)
        break;
}while($mse>0.00001);

//memasukkan total kesalahan kedalam array
$conc['eppoach'] = $eppoach;
$conc['mad'] = $mad;
$conc['mse'] = $mse;
$conc['mape'] = $mape;

//konversi data ke format json
echo json_encode(array($conc,$training));

foreach($training as $training)
{
	$id = $training['id'];
	$prediksi = $training['output'];
	$w1 = $training['w'][0];
	$w2 = $training['w'][1];
	$w3 = $training['w'][2];
	$w4 = $training['w'][3];
	$w5 = $training['w'][4];
	$w6 = $training['w'][5];
	$w7 = $training['w'][6];
	$w8 = $training['w'][7];
	$w9 = $training['w'][8];
	$w10 = $training['w'][9];
	$w11 = $training['w'][10];
	$w12 = $training['w'][11];
	$v1 = $training['v'][0];
	$v2 = $training['v'][1];
	$v3 = $training['v'][2];
	$v4 = $training['v'][3];
	$absolute = $training['error']['absolute'];
	$squared = $training['error']['squared'];
	$percentage = $training['error']['percentage'];
	$eppoach = $training['eppoach'];
	mysqli_query($conn,"update online set
					prediksi = ".$prediksi.",
					w1 = ".$w1.",
					w2 = ".$w2.",
					w3 = ".$w3.",
					w4 = ".$w4.",
					w5 = ".$w5.",
					w6 = ".$w6.",
					w7 = ".$w7.",
					w8 = ".$w8.",
					w9 = ".$w9.",
					w10 = ".$w10.",
					w11 = ".$w11.",
					w12 = ".$w12.",
					v1 = ".$v1.",
					v2 = ".$v2.",
					v3 = ".$v3.",
					v4 = ".$v4.",
					absolute = ".$absolute.",
					squared = ".$squared.",
					percentage = ".$percentage.",
					eppoach = ".$eppoach."
					where id = ".$id
				);
}

?>
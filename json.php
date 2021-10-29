<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//include file connection.php
//memangil file koneksi untuk melakukan koneksi ke database
include 'db/connection.php';
//include file bpnn.php
//file yang berisi fungsi untuk mencari bulan dan tahun berdasarkan periode paramater
include 'option/training_periode.php';

$period = $_GET['period'];

$month = month($period);

$learning='online';

if($period>36)
{
	$learning='offline';
}

$data = mysqli_query($conn, "select * from audusd au join ".$learning." ol on au.id=ol.id where ".$month);
$n_data = mysqli_num_rows($data);

$training = array();

$i=0;
$sum_absolute_error = 0;
$sum_sqrt_error = 0;
$sum_percentage_error=0;
$sum_eppoach=0;

foreach($data as $dt):
	$id = $training[$i]['id'] = intval($dt['id']);
    $training[$i]['date'] = $dt['date'];
    
	$training[$i]['x1'] = floatval($dt['open']);
    $training[$i]['x2'] = floatval($dt['high']);
    $training[$i]['x3'] = floatval($dt['low']);
    $training[$i]['target'] = floatval($dt['close']);
	$training[$i]['output'] = floatval($dt['prediksi']);
	
	$training[$i]['w'][0] = floatval($dt['w1']); 
    $training[$i]['w'][1] = floatval($dt['w2']);
	$training[$i]['w'][2] = floatval($dt['w3']);
	$training[$i]['w'][3] = floatval($dt['w4']);
	$training[$i]['w'][4] = floatval($dt['w5']);
	$training[$i]['w'][5] = floatval($dt['w6']);
	$training[$i]['w'][6] = floatval($dt['w7']);
	$training[$i]['w'][7] = floatval($dt['w8']);
	$training[$i]['w'][8] = floatval($dt['w9']);
	$training[$i]['w'][9] = floatval($dt['w10']);
	$training[$i]['w'][10] = floatval($dt['w11']);
	$training[$i]['w'][11] = floatval($dt['w12']);
	
	$training[$i]['v'][0] = floatval($dt['v1']);
	$training[$i]['v'][1] = floatval($dt['v2']);
	$training[$i]['v'][2] = floatval($dt['v3']);
	$training[$i]['v'][3] = floatval($dt['v4']);
	
	$training[$i]['absolute'] = floatval($dt['absolute']);
	$training[$i]['squared'] = floatval($dt['squared']);
	$training[$i]['percentage'] = floatval($dt['percentage']);
	
	$sum_sqrt_absolute_error+=$dt['absolute'];
	$sum_sqrt_error+=$dt['squared'];
	$sum_percentage_error+=$dt['percentage'];
	$sum_eppoach+=$dt['eppoach'];
	
	$i++;
endforeach;

//memasukkan total kesalahan kedalam array
$conc['eppoach'] = intval($sum_eppoach/$n_data);
$conc['mad'] = $sum_sqrt_absolute_error/$n_data;
$conc['mse'] = $sum_sqrt_error/$n_data;
$conc['mape'] = $sum_percentage_error/$n_data;

//konversi data ke format json
echo json_encode(array($conc,$training));
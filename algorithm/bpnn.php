<?php

//file BPNN
//berisi fungsi-fungsi yang dibutuhkan untuk melakukan perhitungan backpropagation neural network 

//fase propagasi maju
//fase feedforward
//Menghitung net di setiap layer
function Net($w0, $w1, $w2, $w3, $x0, $x1, $x2)
{
    $treshold = ($x0 * $w0) + ($x1 * $w1) + ($x2 * $w2) + (1 * $w3);
    $treshold = round($treshold, 5);
    return $treshold; 
}

//Menghitung Output disetiap unit menggunakan fungsi akktifasi sigmoid
function SigmoidActivation($treshold)
{
    $output = 1 / (1 + exp(-$treshold));
    $output = round($output, 5);
    return $output; 
}

//fase propagasi balik
//Fase Backward
//Menghitung faktor delta di unit output layer
function deltaOutput($target, $output)
{
    $delta = ($target - $output) * $output * (1 - $output);
    $delta = round($delta, 5);
    return $delta;
}

//Menghitung faktor delta di unit hidden layer
function deltaHidden($net, $output)
{
    $delta = $net * $output * (1 - $output);
    $delta = round($delta, 5);
    return $delta ;
}

//Menghitung suku perubahan bobot
function deltaWeight($alpha, $deltaunit, $unit)
{
    $delta = $alpha * $deltaunit * $unit;
    $delta = round($delta, 5);
    return $delta;
}

//Fase pembaruan bobot
function updateWeight($w, $deltaw)
{
    $weight = $w + $deltaw;
    $weight = round($weight, 5);
    return $weight;
}

?>
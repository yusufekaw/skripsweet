<?php
//metode perthitungan pengukuran kesalahan

//menghitung absolut error
function error($output, $target)
{
    $diverent = $target - $output;
    $absolute_error = abs($diverent);
    return $absolute_error;
}

//menghitung prosentase eror
function percentage_error($error, $target)
{
    $percent = ($error/$target)*100;
    //$percent = round($percent,2);
    return $percent;
}

//menghitung rata-rata error dengan metode Mean Absolute Deviation (MAD)
function mad($error, $n)
{
    $mad = $error/$n;
    return $mad;
}

//menghitung rata-rata error dengan metode Mean Squared Error (MSE)
function mse($error, $n)
{
    $mse = $error/$n;
    return $mse;
}

//menghitung rata-rata error dengan metode Mean Absolute Percentage Eror (MAPE)
function mape($error, $n)
{
    $mape = $error/$n;
    //$mape = round($mape,2);
    return $mape;
}

?>
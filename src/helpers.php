<?php
function generateRandomString($length = 15)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function rand_float($st_num = 0, $end_num = 1, $mul = 100)
{
    if ($st_num > $end_num) return false;
    return round(mt_rand($st_num * $mul, $end_num * $mul) / $mul, 2);
}

function randomDate($start_date, $end_date)
{
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    $val = rand($min, $max);
    return date('Y-m-d H:i:s', $val);
}

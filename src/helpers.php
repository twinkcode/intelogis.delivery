<?php

/** генерирует рандомную строку
 * @param int $length
 * @param string $characters
 * @return string
 * @throws Exception
 */
function generateRandomString($length = 15, $characters = '0123456789'): string
{
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

/** генерирует рандомное вещественное число
 * @param $st_num int от
 * @param $end_num int до
 * @param $mul int число знаков после запятой
 * @return float
 */
function rand_float($st_num = 0, $end_num = 1, $mul = 100): float
{
    if ($st_num > $end_num) return false;
    return round(mt_rand($st_num * $mul, $end_num * $mul) / $mul, 2);
}

/** генерирует рандомную дату
 * @param $start_date string
 * @param $end_date string
 * @return string Y-m-d H:i:s
 */
function randomDate($start_date, $end_date): string
{
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    $val = rand($min, $max);
    return date('Y-m-d H:i:s', $val);
}

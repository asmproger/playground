<?php
include 'functions.php';

function getPi($n)
{
    $magik = 10;
    $k = ceil($n * $magik / 3);

    $pi = [];

    $numerator = range(0, 9);
    $denominator = range(3, 19, 2);
    array_unshift($denominator, 0);

    $transferGlobal = array_fill(0, $n * $magik, 0);
    $cnt = $n * $magik - 1;
    $init = array_fill(0, $k, 2);

    for ($j = 0; $j < $n; $j++) {
        $x10 = array_fill(0, $k, 0);
        $transfer = array_fill(0, $k, 0);
        $summ = array_fill(0, $k, 0);
        $rest = array_fill(0, $k, 0);

        for ($i = $k - 1; $i >= 0; $i--) {
            if ($i == 0) {
                $x10[$i] = $init[$i] * $magik;
                $summ[$i] = $transferGlobal[$cnt] + $x10[$i];

                $pi[] = $summ[$i] / $magik;
                $transferGlobal[$cnt - 1] = $summ[$i] % $magik;
            } else {
                $x10[$i] = $init[$i] * $magik;
                $summ[$i] = $transferGlobal[$cnt] + $x10[$i];
                $rest[$i] = $summ[$i] % $denominator[$i];
                $transferGlobal[$cnt - 1] = intval((intval($summ[$i] / $denominator[$i])) * $numerator[$i]);
                $transferGlobal[$cnt - 1] = intval((intval($summ[$i] / $denominator[$i])) * $numerator[$i]);
            }
            $cnt--;
        }
        $init = $rest;
        var_dump(
            'pi        : ' . implode('  ', $pi),
            'init      : ' . implode('  ', $init),
            'x10       : ' . implode('  ', $x10),
            'transfer  : ' . implode('  ', $transferGlobal),
            'summ      : ' . implode('  ', $summ),
            'rest      : ' . implode('  ', $rest)
        );
    }
    die;

    $piFraction = implode(' ', array_slice($pi, 1));
    //$piFraction = str_replace('.', '', $piFraction);
    $response = $pi[0] . ',' . $piFraction;

    //3,141592653589793238462643
    //3,11111111111111111111111
    return $response;
}

$p = getPi(3);
var_dump('Pi - ' . $p);
<?php
include 'functions.php';

function getPi($n)
{
    $magik = 10;
    $k = $n * $magik / 3;
    $pi = [];

    $numerator = range(0, 9);
    $denominator = range(3, 19, 2);
    array_unshift($denominator, 0);

    $transferGlobal = array_fill(0, $n * $magik, 0);
    $cnt = $n * $magik - 1;

    $init = array_fill(0, $k, 2);
    $x10 = array_fill(0, $k, 0);
    $transfer = array_fill(0, $k, 0);
    $summ = array_fill(0, $k, 0);
    $rest = array_fill(0, $k, 0);

    for ($j = 0; $j < $n; $j++) {

    }

    for ($i = $k - 1; $i >= 0; $i--) {
        if ($i == 0) {
            $x10[$i] = $init[$i] * $magik;
            $summ[$i] = $transfer[$i] + $x10[$i];

            $number = $summ[$i] / $magik;
            $pi[] = $number;
            $transferGlobal[$cnt - 1] = $summ[$i] % $magik;
        } else {
            $x10[$i] = $init[$i] * $magik;
            $summ[$i] = $transfer[$i] + $x10[$i];
            $rest[$i] = $summ[$i] % $denominator[$i];
            $transfer[$i - 1] = intval((intval($summ[$i] / $denominator[$i])) * $numerator[$i]);
            $transferGlobal[$cnt - 1] = intval((intval($summ[$i] / $denominator[$i])) * $numerator[$i]);
        }

        $cnt--;
    }

    var_dump(
        'pi        : ' . implode('  ', $pi   ),
        'init      : ' . implode('  ', $init),
        'x10       : ' . implode('  ', $x10),
        'transfer  : ' . implode('  ', $transfer),
        'summ      : ' . implode('  ', $summ),
        'rest      : ' . implode('  ', $rest)
    );
    die;

}

getPi(3);
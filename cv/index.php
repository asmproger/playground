<?php

include '../functions.php';
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/19/18
 * Time: 11:43 AM
 */
//custom_print_r(php_ini_loaded_file());
//echo '<br>';
//custom_print_r(get_loaded_extensions());
//echo '<br>';


ini_set('display_errors', 1);


/************        FACE DETECTION      **********/
use CV\Face\LBPHFaceRecognizer;

use CV\CascadeClassifier, CV\Scalar;
use function CV\{imread, imwrite, cvtColor, equalizeHist, rectangleByRect};
use const CV\{COLOR_BGR2GRAY};

/*$classes = get_declared_classes();
custom_print_r($classes);
die;*/

$src = imread('lock.jpg');

$gray = cvtColor($src, COLOR_BGR2GRAY);

equalizeHist($gray, $gray);

$faceRecognizer = LBPHFaceRecognizer::create();

/* ... */ //get $images and $labels for train
$faceRecognizer->train($images, $labels);//How to get $image and $labels, see the document
/* ... */ //Face detection using CascadeClassifier
$faceLabel = $faceRecognizer->predict($gray);
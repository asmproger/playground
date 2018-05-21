<?php
include 'functions.php';
include 'vendor/autoload.php';

use Symfony\Component\Finder\Finder;

$finder = new Finder();
$finder->files()->in(__DIR__)->exclude('vendor');

foreach($finder as $file) {

    var_dump($file->getContents());

    var_dump( $file->getFileInfo()->getATime() );

    var_dump($file);
    die;
}
<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 5/21/18
 * Time: 5:27 PM
 */


class DES
{
    function __construct()
    {

    }

    protected function readFile($file)
    {
        $content = file_get_contents($file);

        return $content;
    }

    protected function saveFile($file, $content)
    {
        file_put_contents($file, $content);
    }
}

$des = new DES();

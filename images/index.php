<?php
ini_set('memory_limit', '512M');
set_time_limit(0);

/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 5/14/18
 * Time: 12:51 PM
 */

function getGrayFromRGB(&$image, $rgb)
{

    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;

    $gray = intval(($r + $g + $b) / 3);
    $gray = imagecolorallocate($image, $gray, $gray, $gray);
    return $gray;
}

$startTime = time();
$fileName = 'test.jpg';
$targetFileName = 'destination.jpg';

$image = imagecreatefromjpeg($fileName);


$targetImage = '';
if (!$image) {
    die('invalid file');
}

$size = getimagesize($fileName);

if (!$size) {
    die('invalid data');
}
$targetImage = imagecreatetruecolor($size[0], $size[1]);

$colors = [];

for ($x = 0; $x < $size[0]; $x++) {
    for ($y = 0; $y < $size[1]; $y++) {
        $color = imagecolorat($image, $x, $y);
        $colors[$x][$y] = $color;
        $grayColor = getGrayFromRGB($targetImage, $color);
        imagesetpixel($targetImage, $x, $y, $grayColor);
    }
}
$result = imagejpeg($targetImage, $targetFileName);

$endTime = time();
$time = $endTime - $startTime;
$memory = memory_get_usage() / (1024 * 1024);
?>

<table>
    <tr>
        <td>
            <img src="<?php echo $fileName; ?>" width="300px" />
        </td>
        <td>
            <?php if(file_exists($targetFileName)): ?>
                <img src="<?php echo $targetFileName; ?>" width="300px" />
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>Time: </td>
        <td><?php echo $time; ?> seconds</td>
    </tr>
    <tr>
        <td>Memory: </td>
        <td><?php echo $memory; ?> Mb</td>
    </tr>
</table>
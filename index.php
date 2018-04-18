<?php

function calc($prev, $i)
{
    if ($prev == 0) { // first step
        $prev = 100;
    }
    if ($i < 2) {
        $step = 500;
    } else if ($i < 5) {
        $step = 3000;
    } else if ($i < 8) {
        $step = 5000;
    } else if ($i < 10) {
        $step = 10000;
    } else if ($i < 20) {
        $step = 50000;
    } else if ($i < 30) {
        $step = 100000;
    } else if ($i < 40) {
        $step = 500000;
    } else if ($i < 50) {
        $step = 1000000;
    } else if ($i < 60) {
        $step = 5000000;
    } else if ($i < 70) {
        $step = 10000000;
    } else if ($i < 80) {
        $step = 500000000;
    } else if ($i < 90) {
        $step = 1000000000;
    } else if ($i < 95) {
        $step = 15000000000;
    } else {
        $step = 50000000000;
    }
    return $step + $prev;
}

$ranges = array("0-100");
$prev = 100;
for ($i = 1; $i < 100; $i++) {
    $start = ($i == 0) ? 0 : $prev;
    $end = calc($prev, $i);

    $prev = $end;
    if ($end >= 214748364700) {
        $end = 214748364700;
        $ranges[] = "{$start} - {$end}";
        break;
    } else {
        $ranges[] = "{$start} - {$end}";
    }
}

var_dump($ranges);
die;


$params = array(

    'CURLOPT_SSL_VERIFYHOST' => '',
    'CURLOPT_SSL_VERIFYPEER' => '',
    'CURLOPT_USERAGENT' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36',
    'CURLOPT_RETURNTRANSFER' => 1,
    'CURLOPT_PROXY' => 'http://zproxy.luminati.io:22225',
    'CURLOPT_PROXYUSERPWD' => 'lum-customer-wsanalytics-zone-residential-country-:f989b227ede6',
    'CURLOPT_CONNECTTIMEOUT' => 50,
    'CURLE_FTP_WEIRD_PASV_REPLY' => 50,
    'CURLOPT_ACCEPT_ENCODING' => '',
    'CURLPROTO_RTMP' => 1,
    'CURLOPT_MAXREDIRS' => 5,
    'CURLOPT_URL' => 'https://www.facebook.com/api/graphql/',
    'CURLOPT_POST' => 1,
    'CURLOPT_POSTFIELDS' => 'av=0&__user=0&__a=1&__dyn=5V8WXxaAcUmgDxKS5o9FEbFbGAdyedJLFCwWxG3Kq6oG5UK3u2a9wHx2ubyRG8wPGiidBCDK8UjKcU8V8uwh9VoboGq79UkxueyFeawJwm98CQ3e4oW3S68mCye49943G7oy10xq3G1uxy7EW6pHxC2ecBy9EiJ4yAU4mm9yk5HyUG7ryVu6bwGwAyLxiGzUeoG4o-5efw&__af=h0&__req=t&__be=-1&__pc=PHASED%3ADEFAULT&__rev=3298192&lsd=AVrxJ6nD&fb_api_caller_class=RelayModern&variables=%7B%22count%22%3A50%2C%22cursor%22%3Anull%2C%22locationID%22%3A%22106078429431815%22%2C%22marketplaceID%22%3Anull%2C%22categoryIDArray%22%3A%5B%221670493229902393%22%5D%2C%22radius%22%3A256000%2C%22priceRange%22%3A%5B%225100%22%2C%2210000%22%5D%2C%22MARKETPLACE_FEED_ITEM_IMAGE_WIDTH%22%3A197%2C%22viewerIsAnonymous%22%3Atrue%7D&doc_id=1557694004294152',
    'CURLE_ABORTED_BY_CALLBACK' => 0,
    'CURLOPT_HTTPHEADER' => array(
        'user-agent' => 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36',
        'content-type' => 'Content-Type: application/x-www-form-urlencoded'
    )
);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.facebook.com/api/graphql/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, array(
    'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36'
));
curl_setopt($ch, CURLOPT_POSTFIELDS,
    "av=0&__user=0&__a=1&__dyn=5V8WXxaAcUmgDxKS5o9FEbFbGAdyedJLFCwWxG3Kq6oG5UK3u2a9wHx2ubyRG8wPGiidBCDK8UjKcU8V8uwh9VoboGq79UkxueyFeawJwm98CQ3e4oW3S68mCye49943G7oy10xq3G1uxy7EW6pHxC2ecBy9EiJ4yAU4mm9yk5HyUG7ryVu6bwGwAyLxiGzUeoG4o-5efw&__af=h0&__req=t&__be=-1&__pc=PHASED%3ADEFAULT&__rev=3298192&lsd=AVrxJ6nD&fb_api_caller_class=RelayModern&variables=%7B%22count%22%3A50%2C%22cursor%22%3Anull%2C%22locationID%22%3A%22106078429431815%22%2C%22marketplaceID%22%3Anull%2C%22categoryIDArray%22%3A%5B%221670493229902393%22%5D%2C%22radius%22%3A256000%2C%22priceRange%22%3A%5B%220%22%2C%220%22%5D%2C%22MARKETPLACE_FEED_ITEM_IMAGE_WIDTH%22%3A197%2C%22viewerIsAnonymous%22%3Atrue%7D&doc_id=1557694004294152"
);

$response = curl_exec($ch);
curl_close($ch);
custom_print_r($response);
die;


include 'tree.php';

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 120);

$profiling = array();

function custom_profiling($flag = 'empty')
{
    global $profiling;
    $memory = round(memory_get_usage() / (1024 * 1024), 4);
    $profiling[$flag] = array(
        'memory' => $memory . ' Mb',
        'time' => time()
    );
}

function custom_search($value, &$array)
{
    /*for($i = 0; $i < count($array); $i++) {
        if($value === $array[$i]) {
            return $i;
        }
    }
    return false;*/
}

function custom_sort(&$array)
{
    sort($array);
}

custom_profiling('init');

$data = array();

for ($i = 0; $i < 1000000; $i++) {
    $data[] = mt_rand(-500000, 500000);
}

custom_profiling('fill');

custom_sort($data);

custom_profiling('sort');
$value = 100;
//$index = custom_search($value, $data);

for ($i = 0; $i < count($data); $i++) {
    if ($value === $data[$i]) {
        $index = $i;
        break;
    }
}

if ($index !== false) {
    $profiling['FOUND'] = $index;
} else {
    $profiling['FOUND'] = 'NULL';
}
custom_profiling('search');

$tree = new BinaryTree();
for ($i = 0; $i < 1000000; $i++) {
    $val = mt_rand(-500000, 500000);
    $tree->insert($val);
}
custom_profiling('tree');
custom_print_r($profiling);
die;
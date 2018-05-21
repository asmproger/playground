<?php

//curl 'https://www.idealista.com/'
// -H 'authority: www.idealista.com'
// -H 'upgrade-insecure-requests: 1'
// -H 'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36'
// -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
// -H 'referer: https://www.idealista.com/login'
// -H 'accept-encoding: gzip, deflate, br'
// -H 'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
// -H $'cookie: pxvid=7e844530-46b6-11e8-bdd2-fff9885b7c39; _pxvid=7e844530-46b6-11e8-bdd2-fff9885b7c39; userUUID=37d813c2-4ea3-4937-a0a3-8d8fbe920fbe; SESSION=0b28304f-e548-4e4e-958b-87b0aa5ecbac; xtvrn=$352991$; xtan352991=2-anonymous; xtant352991=1; cookieDirectiveClosed=true; atidvisitor=%7B%22name%22%3A%22atidvisitor%22%2C%22val%22%3A%7B%22vrn%22%3A%22-582065-%22%7D%2C%22options%22%3A%7B%22path%22%3A%22%2F%22%2C%22session%22%3A15724800%2C%22end%22%3A15724800%7D%7D; optimizelyEndUserId=oeu1524461276051r0.35722098194691987; _hjIncludedInSample=1; contact0b28304f-e548-4e4e-958b-87b0aa5ecbac="{\'email\':null,\'phone\':null,\'phonePrefix\':null,\'friendEmails\':null,\'name\':null,\'message\':null,\'message2Friends\':null,\'maxNumberContactsAllow\':10,\'defaultMessage\':true}"; TestIfCookie=ok; TestIfCookieP=ok; pbw=%24b%3d16660%3b%24o%3d99999%3b%24sw%3d1920%3b%24sh%3d1080; pid=313940885186659338; pdomid=10; sasd2=q=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0&c=1&l=&lo=&lt=636600661426884180; sasd=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0; cookieSearch-1="/venta-obranueva/alava/:1524462209196"; vs=33114=8051503; dyncdn=2; utag_main=v_id:0162f0f909970018f7d4ee2a893d04069001f06100bd0$_sn:1$_ss:0$_st:1524464411989$ses_id:1524461275545%3Bexp-session$_pn:8%3Bexp-session; _px2=eyJ1IjoiMzAzOGE0ODAtNDZiYS0xMWU4LWIzZDEtMWQ0ZmE4NzMyY2IzIiwidiI6IjdlODQ0NTMwLTQ2YjYtMTFlOC1iZGQyLWZmZjk4ODViN2MzOSIsInQiOjE1MjQ0NjI5MTIzOTMsImgiOiJhMDU1NWRmNjFkZjE2ZWZkODllMmRjMzQxZDc2N2I2NjkzYzM5OGE0YjY0YmY3YjVhODUyNDBmYmM1ZTg4MjkzIn0=; CASTGC=TGT-2230172-FdSYcvYhh5JynN7gfbpMfKDJhlcvG6hoC4CCffSnK4c4Lii4W3-webcas1.pro.es.sys.idealista; uc=BNxA0G2If+9uXRTeR/WOip6bVM2ONgAxoH3TK6sHs/6eGcwAH+UeyA460UobDnlm4cm58huI9dfh5AvhUjDWpNKZFZDImvv4yqNZBwIzrXjNZlkPngGTGB+5xI6Isbi/; nl="nTeylRNFZ7qKQUdY/7/gYrcdsTDD107xTsd9d7v1YXg="; ml="nTeylRNFZ7qKQUdY/7/gYrcdsTDD107xTsd9d7v1YXg="; cc=eyJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1MjQ1NDkwMTUsImN0IjoxMDY2MjQ4NH0.6Sba6ATi0cgTDb2OF-AX5giLuysnCha7N0Rg7Otw9So; WID=8b128ccc505810c9|Wt10D|Wt1u0'
// --compressed

$cookies = [
    '_px2' => base64_encode(json_encode([
        'u' => '9c0755a0-4393-11e8-9f3e-5926e5a083bc',
        'v' => '97286a40-4390-11e8-bc40-5f4b542c9a66',
        't' => time() - 18000,
        'h' => '63f5abb9002d19324ede60d5dc38cb2c3ce872673c86ec5a86d19997d093b64d',
    ])),
];
$cookiesTmp = array();
foreach ($cookies as $k => $v) {
    $cookiesTmp[] = $k . '=' . $v;
}
$cookie = implode(';', $cookiesTmp);

$headers = [
    'authority: www.idealista.com',
    'pragma: no-cache',
    'cache-control: no-cache',
    'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36',
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
    'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    //'cookie: ' . $cookie
    'cookie: pxvid=7e844530-46b6-11e8-bdd2-fff9885b7c39; _pxvid=7e844530-46b6-11e8-bdd2-fff9885b7c39; userUUID=37d813c2-4ea3-4937-a0a3-8d8fbe920fbe; SESSION=0b28304f-e548-4e4e-958b-87b0aa5ecbac; xtvrn=$352991$; xtan352991=2-anonymous; xtant352991=1; cookieDirectiveClosed=true; atidvisitor=%7B%22name%22%3A%22atidvisitor%22%2C%22val%22%3A%7B%22vrn%22%3A%22-582065-%22%7D%2C%22options%22%3A%7B%22path%22%3A%22%2F%22%2C%22session%22%3A15724800%2C%22end%22%3A15724800%7D%7D; optimizelyEndUserId=oeu1524461276051r0.35722098194691987; _hjIncludedInSample=1; contact0b28304f-e548-4e4e-958b-87b0aa5ecbac="{\'email\':null,\'phone\':null,\'phonePrefix\':null,\'friendEmails\':null,\'name\':null,\'message\':null,\'message2Friends\':null,\'maxNumberContactsAllow\':10,\'defaultMessage\':true}"; TestIfCookie=ok; TestIfCookieP=ok; pbw=%24b%3d16660%3b%24o%3d99999%3b%24sw%3d1920%3b%24sh%3d1080; pid=313940885186659338; pdomid=10; sasd2=q=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0&c=1&l=&lo=&lt=636600661426884180; sasd=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0; cookieSearch-1="/venta-obranueva/alava/:1524462209196"; vs=33114=8051503; dyncdn=2; WID=8b128ccc505810c9|Wt1zR|Wt1u0; utag_main=v_id:0162f0f909970018f7d4ee2a893d04069001f06100bd0$_sn:1$_ss:0$_st:1524464217509$ses_id:1524461275545%3Bexp-session$_pn:6%3Bexp-session; _px2=eyJ1IjoiYmM2YzUzMzAtNDZiOS0xMWU4LTg0ZDUtZWY3MmRhODRjMGFjIiwidiI6IjdlODQ0NTMwLTQ2YjYtMTFlOC1iZGQyLWZmZjk4ODViN2MzOSIsInQiOjE1MjQ0NjI3MTgxNjQsImgiOiJmMDM0ZThiOTFmYTczMzcyMGQ3YWRmM2ZjZDY1YTZhMzA5NDk3NThiNmM0MDM1Yzg1MTk5ZDM0MjVlZGU2NGE3In0='
];
//curl 'https://www.idealista.com/' -H 'authority: www.idealista.com' -H 'upgrade-insecure-requests: 1' -H 'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
// -H $'cookie: pxvid=7e844530-46b6-11e8-bdd2-fff9885b7c39; _pxvid=7e844530-46b6-11e8-bdd2-fff9885b7c39; userUUID=37d813c2-4ea3-4937-a0a3-8d8fbe920fbe; SESSION=0b28304f-e548-4e4e-958b-87b0aa5ecbac; xtvrn=$352991$; xtan352991=2-anonymous; xtant352991=1; cookieDirectiveClosed=true; atidvisitor=%7B%22name%22%3A%22atidvisitor%22%2C%22val%22%3A%7B%22vrn%22%3A%22-582065-%22%7D%2C%22options%22%3A%7B%22path%22%3A%22%2F%22%2C%22session%22%3A15724800%2C%22end%22%3A15724800%7D%7D; optimizelyEndUserId=oeu1524461276051r0.35722098194691987; _hjIncludedInSample=1; contact0b28304f-e548-4e4e-958b-87b0aa5ecbac="{\'email\':null,\'phone\':null,\'phonePrefix\':null,\'friendEmails\':null,\'name\':null,\'message\':null,\'message2Friends\':null,\'maxNumberContactsAllow\':10,\'defaultMessage\':true}"; TestIfCookie=ok; TestIfCookieP=ok; pbw=%24b%3d16660%3b%24o%3d99999%3b%24sw%3d1920%3b%24sh%3d1080; pid=313940885186659338; pdomid=10; sasd2=q=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0&c=1&l=&lo=&lt=636600661426884180; sasd=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0; cookieSearch-1="/venta-obranueva/alava/:1524462209196"; vs=33114=8051503; dyncdn=2; WID=8b128ccc505810c9|Wt1zR|Wt1u0; utag_main=v_id:0162f0f909970018f7d4ee2a893d04069001f06100bd0$_sn:1$_ss:0$_st:1524464217509$ses_id:1524461275545%3Bexp-session$_pn:6%3Bexp-session; _px2=eyJ1IjoiYmM2YzUzMzAtNDZiOS0xMWU4LTg0ZDUtZWY3MmRhODRjMGFjIiwidiI6IjdlODQ0NTMwLTQ2YjYtMTFlOC1iZGQyLWZmZjk4ODViN2MzOSIsInQiOjE1MjQ0NjI3MTgxNjQsImgiOiJmMDM0ZThiOTFmYTczMzcyMGQ3YWRmM2ZjZDY1YTZhMzA5NDk3NThiNmM0MDM1Yzg1MTk5ZDM0MjVlZGU2NGE3In0=' --compressed
$url = 'https://www.idealista.com';
$url = 'https://www.idealista.com/venta-obranueva/alava/';
//$url = 'https://www.idealista.com/login';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 35);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//curl_setopt($ch, CURLOPT_PROXY, '194.182.74.203:3128');

// 194.182.74.203:3128
$response = curl_exec($ch);
curl_close($ch);
custom_print_r($response);
die;

// curl 'https://www.idealista.com/venta-obranueva/alicante/'
// -H 'authority: www.idealista.com'
// -H 'cache-control: max-age=0'
// -H 'upgrade-insecure-requests: 1'
// -H 'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36'
// -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
// -H 'accept-encoding: gzip, deflate, br'
// -H 'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
// -H $'cookie: userUUID=7b443b47-450b-44d8-874f-ab2dd409ce12; xtvrn=$352991$; xtan352991=2-anonymous; xtant352991=1; cookieDirectiveClosed=true; atidvisitor=%7B%22name%22%3A%22atidvisitor%22%2C%22val%22%3A%7B%22vrn%22%3A%22-582065-%22%7D%2C%22options%22%3A%7B%22path%22%3A%22%2F%22%2C%22session%22%3A15724800%2C%22end%22%3A15724800%7D%7D; optimizelyEndUserId=oeu1524114892218r0.6263442785893905; _pxvid=97286a40-4390-11e8-bc40-5f4b542c9a66; pxvid=97286a40-4390-11e8-bc40-5f4b542c9a66; cookieSearch-1="/venta-obranueva/alicante/:1524205287451"; contactb2e5f986-9b20-42db-b897-ab24b02c6691="{\'email\':null,\'phone\':null,\'phonePrefix\':null,\'friendEmails\':null,\'name\':null,\'message\':null,\'message2Friends\':null,\'maxNumberContactsAllow\':10,\'defaultMessage\':true}"; _hjIncludedInSample=1; TestIfCookie=ok; TestIfCookieP=ok; vs=33114=8047221; pbw=%24b%3d16660%3b%24o%3d99999%3b%24sw%3d1920%3b%24sh%3d1080; pid=4621675710173324313; pdomid=25; sasd2=q=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0&c=1&l=&lo=&lt=636598092901206995; sasd=%24qc%3d1308953853%3b%24ql%3dunknown%3b%24qpc%3d720000%3b%24qpp%3d0%3b%24qt%3d118_2428_43091t%3b%24dma%3d0; dyncdn=1; SESSION=da041a23-091d-4804-afae-84efa65b9217; WID=8b128ccc505810c9|WtmSw|WtmG4; utag_main=v_id:0162dc53a480000a45596b0a7c3e04069001a06100bd0$_sn:5$_ss:1$_st:1524210131589$ses_id:1524208331589%3Bexp-session$_pn:1%3Bexp-session; _px2=eyJ1IjoiMjU0NjVhYjAtNDQ2YS0xMWU4LTgwMTItYTlkZjJkMjIwZDc4IiwidiI6Ijk3Mjg2YTQwLTQzOTAtMTFlOC1iYzQwLTVmNGI1NDJjOWE2NiIsInQiOjE1MjQyMDg4NzI1ODEsImgiOiJiZjk4MzUyZTc1ZWM1NGI0M2IxOWY1ODQ0Nzg2ZmNiYWFlYmQ1MDdiMzMwMjJiYTU3YWUwMjQ5MzIwOTg3ZjdlIn0='
// --compressed



/*
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
die;*/

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
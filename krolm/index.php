<?php

include '../functions.php';

custom_print_r(array(
    '1527759201067',
    time(),
    microtime()
));
die;


/*
12615911356486315"	.www.linkedin.com	/	1969-12-31T23:59:59.000Z	36
RT	s=1527759201067&r=https%3A%2F%2Fwww.linkedin.com%2Fuas%2Flogin%3Fgoback%3D%26trk%3Dhb_signin	.linkedin.com	/	2018-05-31T09:43:21.000Z	94
bcookie	"v=2&28b52fb5-eb24-48bb-8d4c-f233326fd9e2"	.linkedin.com	/	2020-05-30T20:56:23.829Z	49
bscookie	"v=1&2018053109185146b4c2e3-1c22-4170-8848-c48a646c9753AQF-A9bB8uUbFsMcE-B186bgqH6eWPC_"	.www.linkedin.com	/	2020-05-30T20:56:23.829Z	96	✓	✓
lang	"v=2&lang=ru-ru"	.linkedin.com	/	1969-12-31T23:59:59.000Z	20
leo_auth_token	"GST:96xkIgVMJrHuUQAOnvsksoVCoOt5FK8S57NKdY-iMOHhfCzSs4YvOh:1527759209:b8ecaf25fe4b40edb46d7fbcd92c61939473293a"	www.linkedin.com	/	2018-05-31T10:03:28.345Z	126
lidc	"b=OGST03:g=746:u=1:i=1527758320:t=1527844720:s=AQEsfuL7i8SH7Xyg9qBaZAG_7kJqND4_"	.linkedin.com	/	2018-06-01T09:18:40.829Z	85
visit	"v=1&*/




/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 5/22/18
 * Time: 3:42 PM
 */

function getDomByContent(&$str, $encoding = 'UTF-8')
{
    $dom = new \DOMDocument('1.0', $encoding);
    if ($encoding === 'UTF-8') {
        try {
            $str = mb_convert_encoding($str, 'HTML-ENTITIES', $encoding);
        } catch (\Exception $e) {
            unset($e);
        }
    }

    if (empty($str)) {
        die(' EMPTY STRING ');
        return null;
    }

    try {
        libxml_use_internal_errors(true);
        $dom->loadHTML($str);
        libxml_clear_errors();
        return new \DomXPath($dom);
    } catch (\Exception $e) {
        unset($e);
    }

    return null;
}

/**
 * @param $dom DOMXPath
 */
function getFoundedYear(&$dom)
{
    $foundedBlock = $dom->query('//div[contains(@class, "about__primary-content")]//h3[contains(text(), "Founded")]/following-sibling::p[1]')->item(0);
    $year = $foundedBlock->nodeValue;

    $typeBlock = $dom->query('//div[contains(@class, "about__primary-content")]//h3[contains(text(), "Type")]/following-sibling::p[1]')->item(0);
    $type = $typeBlock->nodeValue;

    var_dump($year, $type);
}

/**
 * @param array $data Data
 * @param string $type Type
 * @param string $field Field
 * @param string $typeField Type Field
 * @return null
 */
function getValueByType($data, $type, $field, $typeField = '$type')
{
    foreach ($data['included'] as $include) {
        if (isset($include[$typeField]) && $include[$typeField] == $type && isset($include[$field])) {
            return $include[$field];
        }
    }

    return null;
}

/**
 * @param $dom \DOMXPath
 */
function clearCrunchInvestments($str)
{
    $factor = 1;
    if (strpos($str, 'K')) {
        $factor = 1000;
    }
    if (strpos($str, 'M')) {
        $factor = 1000000;
    }
    if (strpos($str, 'B')) {
        $factor = 1000000000;
    }
    $str = str_replace(array('Rp', 'руб', 'Rs.', '€', 'RM', 'R', '$', 'M', '-'), '', $str);
    $str = preg_replace('/\s\s+/', ' ', $str);
    $str = trim($str);
    $str = str_replace('  ', '', $str);

    return $str * $factor;
}

function minifyCrunchInvestments($amount, $forCurrency)
{
    $str = $amount . '';
    $len = strlen($str);
    $sign = '';
    if($len >= 10) {
        $sign = 'B';
        $factor = 1000000000;
    } elseif ($len >= 7) {
        $sign = 'M';
        $factor = 1000000;
    } elseif ($len >= 4) {
        $sign = 'K';
        $factor = 1000;
    } else {
        $factor = 1;
    }

    $currency = '';
    preg_match('/\d+./', $forCurrency, $raw);
    if(isset($raw[0])) {
        $currency = str_replace($raw[0], '', $forCurrency);
    }

    $result = round($amount / $factor, 3);
    $result = $currency . $result . $sign;

    return $result;
}

function collectMoneyFromTable(&$rows) {
    $raw = '';
    $rounds = 0;
    $amount = 0;
    $amountStr = '';

    foreach($rows as $cell) {
        $value = trim($cell->nodeValue);
        $raw .= $value . ' ';
        $amount += clearCrunchInvestments($value);
        $amountStr = minifyCrunchInvestments($amount, trim($value));
        $rounds++;
    }

    return [
        $amount,
        $amountStr,
        $rounds
    ];
}

function someCallback() {
    $response = file_get_contents('files/company_page_crunch_invesments_list.html');
    $dom2 = getDomByContent($response);

    $investmentsData = collectMoneyFromTable($dom2->query('//span[contains(@class, "field-type-money")]'));
    var_dump($investmentsData);
    die;
}

function collectFundsTotal(&$dom)
{
    $investmentsList = $dom->query('//section-layout[@id="section-investments"]//a[contains(@href, "investments_list")]')->item(0);

    if($investmentsList) {
        someCallback();

        return;
    }

    $investmentsData = collectMoneyFromTable($dom->query('//section-layout[@id="section-investments"]//span[contains(@class, "field-type-money")]'));

    return $investmentsData;
}

$file = file_get_contents('files/max_page');
$dom = getDomByContent($file);
$node = $dom->query('//code[contains(text(), "metadata")]')->item(0);

$object = htmlentities($node->nodeValue, ENT_IGNORE, 'UTF-8');
$object = str_replace('&quot;', '"', $object);

$data = json_decode($object, true);

custom_print_r($data);
die;

$nodeFundingRoundsCnt = $dom->query('//section-layout[@id="section-funding-rounds"]//a[contains(@href, "num_funding_rounds")]')->item(0);
if (!$nodeFundingRoundsCnt) {
    $nodeFundingRoundsCnt = $dom->query('//a[contains(@href, "num_investments")]')->item(0);
}
$fundingRoundsCnt = (intval($nodeFundingRoundsCnt->nodeValue));

$nodeFundingTotal = $dom->query('//section-layout[@id="section-funding-rounds"]//a[contains(@href, "funding_total")]')->item(0);
if (!$nodeFundingTotal) {
    collectFundsTotal($dom);
    die;
}
$fundingTotal = trim($nodeFundingTotal->nodeValue);

$nodeTitle = $dom->query('//section-layout[@id="section-overview"]//image-with-text-card//span[@class="ng-star-inserted"]')->item(0);
$title = $nodeTitle->nodeValue;
var_dump(
    $title,
    $fundingRoundsCnt,
    $fundingTotal
);
die;


//$node = $dom->query('//code[contains(text(), "staffingCompany")]')->item(0);
//$node = $dom->query('//code[contains(@id, "bpr-guid-598609")]')->item(0);
$node = $dom->query('//code[contains(text(), "included")]')->item(0);

$object = htmlentities($node->nodeValue, ENT_IGNORE, 'UTF-8');
$object = str_replace('&quot;', '"', $object);
$data = json_decode($object, true);
custom_print_r($data);
foreach ($data as $datum) {
    var_dump($datum);
}

die(' ok  ');
$wtf = $dom->query('//code[@id="decoratedJobPostingsModule"]/comment()')->item(0);

$object = htmlentities($wtf->nodeValue, ENT_IGNORE, 'UTF-8');
var_dump(
    $object
);

$object = str_replace('&quot;', '"', $object);

$data = json_decode($object, true);

$values = array();
if ($data && isset($data['elements'])) {
    foreach ($data['elements'] as $element) {
        if (!isset($element['decoratedJobPosting']) ||
            !isset($element['decoratedJobPosting']['decoratedCompany']) ||
            !isset($element['decoratedJobPosting']['decoratedCompany']['company'])
        ) {
            continue;
            /*print_r(sprintf('skipped company, because details not exists'));
            custom_print_r($element);
            die;*/
        }

        $details = $element['decoratedJobPosting']['decoratedCompany']['company'];

        $name = $details['universalName'];
        $companyId = $details['companyId'];

        $values[] = array(
            'id' => $companyId,
            'name' => $name,
            'listing_url' => $request->url,
            'time' => date('Y-m-d H:i:s'),
            'status' => 0,
        );
    }

    var_dump($values);
}
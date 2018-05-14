<?php
/*$url = 'https://www.wayfair.com/brand/bnd/million-dollar-baby-classic-c1796642.html?itemsperpage=24&curpage=2#sbprodgrid';
$url = explode('-', $url);
if (count($url) > 0) {
    $url = explode('.html', $url[count($url) - 1]);
    $productNum = $url[0];
}
var_dump($url);
die;*/


////$html = file_get_contents('product_one_page.html');
$html = file_get_contents('html_product_empty');
//$html = file_get_contents('bestsellers_html.html');
$dom = new \DOMDocument();
$dom->loadHTML($html);

$xPath = new \DOMXPath($dom);

$brand = ' empty ';
$brandWrapper = $xPath->query('//h2[@class="BrandCard-name"]');

if (!$brandWrapper->length) {
    $brandWrapper = $xPath->query('//h1[@id="browse-page-title"]');
}
if ($brandWrapper->length) {
    $brand = $brandWrapper->item(0)->textContent;
}
var_dump(
    $brandWrapper,
    $brand
);
die;


//$totalReviewsTextWrapper = $xPath->query('//p[@class="BrandRatingCard-totalReviews"]');
//$totalReviewsCount = 0;
//if($totalReviewsTextWrapper->length) {
//    $text = $totalReviewsTextWrapper->item(0)->textContent;
//
//    $regexp = '/\d+\,?\d+/';
//    preg_match_all($regexp, $text,$matches);
//    if(count($matches)) {
//        $totalReviewsCount = implode('', $matches[0]);
//        $totalReviewsCount = str_replace(',','', $totalReviewsCount);
//        $totalReviewsCount = intval($totalReviewsCount);
//    }
//}
//return $totalReviewsCount;
//die;
//
//// jQuery('.Grid-item').find('a.LinkCard')
//$brandsSelector = $xPath->query('//div[contains(@class, "Grid-item")]//a[contains(@class, "LinkCard")]');
//$urls = [];
//for ($i = 0; $i < $brandsSelector->length; $i++) {
//    $brand = $brandsSelector->item($i);
//    $urls[] = $brand->getAttribute('href');
//}
//var_dump($brandsSelector);
//die;
//$brand = ' empty ';
//$brandWrapper = $xPath->query('//h2[@class="BrandCard-name"]');
//if ($brandWrapper->length) {
//    $brand = $brandWrapper->item(0)->textContent;
//}
//
//$rate = 0.0;
//$rateWrapper = $xPath->query('//p[@class="BrandRatingCard-numberRating"]');
//if ($rateWrapper->length) {
//    $content = $rateWrapper->item(0)->textContent;
//    $tmp = explode('/', $content);
//    $rate = floatval($tmp[0]);
//}
//
//$productsAmount = 0;
//
//$ipp = 0;
//$ippWrapper = $xPath->query('//div[@id="ItemsPerPage"]//span[@class="pl-Dropdown-selector-label"]');
//if ($ippWrapper->length) {
//    $ipp = intval($ippWrapper->item(0)->textContent);
//}
//
//$pages = 1;
//$totalPagesWrapper =
//    $xPath->query('//div[@class="BrowseCore-footer"]//nav[@class="Pagination"]//*[contains(@class, "Pagination-item")][last() - 1]');
//
//if ($totalPagesWrapper->length) {
//    $pages = intval($totalPagesWrapper->item(0)->textContent);
//}
//
//if ($pages == 1) {
//    $items = $xPath->query('//div[@class="BrowseProductGrid"]//div[contains(@class, "Grid-item")]');
//    $productsAmount = $items->length;
//} else {
//    $productsAmount = $ipp * $pages;
//}
//
//var_dump([
//    'brand' => $brand,
//    'rate' => $rate,
//    'ipp' => $ipp,
//    'pages' => $pages,
//    'productsAmount' => $productsAmount
//]);
//die('ok');

//curl 'https://www.wayfair.com/a/browse_by_brand/load_all_brands?department_id=7&_csrf_token=52797762075C250E7C97748CE049B024&_txid=otAgYVrdwLuzkz0mLqupAg%3D%3D'
// -H 'pragma: no-cache'
// -H 'cookie: CSNUtId=a2d02065-5aa9-0c43-1ec7-05f0f74a4b02; vid=a2d0206c-5add-8b23-7d9e-962fdf0dbe02; WFDC=BO; WFSID=geqv2dl1ldieom5if6j1l3kcn6; serverUAInfo=%7B%22browser%22%3A%22Google+Chrome%22%2C%22browserVersion%22%3A66.03359117%2C%22OS%22%3A%22Linux%22%2C%22OSVersion%22%3A%22%22%2C%22isMobile%22%3Afalse%2C%22isTablet%22%3Afalse%7D; _pxvid=f1dfeaa0-46c7-11e8-a4ae-971e9dd7d153; _ga=GA1.2.1950649817.1524468521; _gid=GA1.2.823724143.1524468521; pushNotificationsSignupSent=true; pluginHashCookie=true; languageHashCookie=true; fallbackFontCookie=true; standardFontCookie=true; webGlCookie=true; fontHashCookie=true; CSNBrief=SLoc%3Dbo1%26TopNavCSSCachedByBrowser%3Dtrue; __ssid=c387379e-da0a-4128-8d03-370ea84946cb; wfgelfs=JS_Tracking%3D0; CSNID=9DB9BD9F-018A-465A-AE22-DB02C56DB5A8; Current_Sort_B2B=0; featureDetect={"isTouch":false,"hasMQ":true,"deviceWidth":1855,"deviceHeight":965,"devicePixelRatio":1}; CSN=PRVW%3DOUT1183%257COUT1174%257COUT1111%257COUT1181%26CLVW%3D3757; active_user_heartbeat=1; _px3=b525474c542fe215d19a44e9da0076d629e3a61679574b92b6813540aec31106:5MorkQk/CBmOXH9RqomuBetTkCPPTI4Ci5Jkd/0JIfEQEkSYwrQ3fEJwpci5B53MWCvPmsDtiOfc9oc2BI3okg==:1000:Kd6GbOkqbEJyGVGA2cojnMpNKQe1ia7zllT+0daqX8SS1ErNWiQ+HPr7L8aaWs5waHXoGmbavKN9Hgno3Qv6fVuNIbknMmJclgyB2eRGt1BoJr100JHeaKEQ1iuokdb1YUThTAIINb+YtlSEjWxom0bGa7xanrhxjO0tKq8Ji2Q=; _gat_a=1; _gat_b=1; otx=otAgYlrdwLe0P6A3MMBIAg%3D%3D; CSNPersist=page_of_visit%3D257%26user_was_recognized%3D1%26latestRefid%3DDTR1'
// -H 'accept-encoding: gzip, deflate, br'
// -H 'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
// -H 'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36'
// -H 'accept: */*' -H 'cache-control: no-cache' -H 'authority: www.wayfair.com'
// -H 'x-requested-with: XMLHttpRequest'
// -H 'referer: https://www.wayfair.com/brand/bbb/browse-by-brand-pet-brands-7'
// --compressed

$category_id = 7;
$csrf_token = '52797762075C250E7C97748CE049B024';

$headers = [
    'authority: www.wayfair.com',
    'pragma: no-cache',
    'cache-control: no-cache',
    'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36',
    'accept: */*',
    'accept-language: en',
    'accept-encoding: gzip, deflate, br',
    //'cookie: CSNUtId=a2d02065-5aa9-0c43-1ec7-05f0f74a4b02; vid=a2d0206c-5add-8b23-7d9e-962fdf0dbe02; WFDC=BO; WFSID=geqv2dl1ldieom5if6j1l3kcn6; serverUAInfo=%7B%22browser%22%3A%22Google+Chrome%22%2C%22browserVersion%22%3A66.03359117%2C%22OS%22%3A%22Linux%22%2C%22OSVersion%22%3A%22%22%2C%22isMobile%22%3Afalse%2C%22isTablet%22%3Afalse%7D; _pxvid=f1dfeaa0-46c7-11e8-a4ae-971e9dd7d153; _ga=GA1.2.1950649817.1524468521; _gid=GA1.2.823724143.1524468521; pushNotificationsSignupSent=true; pluginHashCookie=true; languageHashCookie=true; fallbackFontCookie=true; standardFontCookie=true; webGlCookie=true; fontHashCookie=true; CSNBrief=SLoc%3Dbo1%26TopNavCSSCachedByBrowser%3Dtrue; __ssid=c387379e-da0a-4128-8d03-370ea84946cb; wfgelfs=JS_Tracking%3D0; CSNID=9DB9BD9F-018A-465A-AE22-DB02C56DB5A8; Current_Sort_B2B=0; featureDetect={"isTouch":false,"hasMQ":true,"deviceWidth":1855,"deviceHeight":965,"devicePixelRatio":1}; CSN=PRVW%3DOUT1183%257COUT1174%257COUT1111%257COUT1181%26CLVW%3D3757; active_user_heartbeat=1; _px3=b525474c542fe215d19a44e9da0076d629e3a61679574b92b6813540aec31106:5MorkQk/CBmOXH9RqomuBetTkCPPTI4Ci5Jkd/0JIfEQEkSYwrQ3fEJwpci5B53MWCvPmsDtiOfc9oc2BI3okg==:1000:Kd6GbOkqbEJyGVGA2cojnMpNKQe1ia7zllT+0daqX8SS1ErNWiQ+HPr7L8aaWs5waHXoGmbavKN9Hgno3Qv6fVuNIbknMmJclgyB2eRGt1BoJr100JHeaKEQ1iuokdb1YUThTAIINb+YtlSEjWxom0bGa7xanrhxjO0tKq8Ji2Q=; _gat_a=1; _gat_b=1; otx=otAgYlrdwLe0P6A3MMBIAg%3D%3D; CSNPersist=page_of_visit%3D257%26user_was_recognized%3D1%26latestRefid%3DDTR1'
];
//$url = "https://www.wayfair.com/a/browse_by_brand/load_all_brands?department_id={$category_id}";
$url = "https://www.wayfair.com";
//$url = "https://px.wayfair.com/px/xhr/api/v1/collector";

//die($url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 35);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
var_dump($response);
die;
<?php

function parseBrandNumFromUrl($url)
{
    $url = 'https://www.wayfair.co.uk/brand/bnd/demeyere-b10813.html';
    preg_match('/-(.*).htm/', $url, $result);

    return (count($result) > 1) ? $result[1] : '';
}

function parseProductNumFromUrl($url)
{
    $url = 'https://www.wayfair.co.uk/furniture/pdp/fjorde-co-regean-double-upholstered-bed-frame-hlcp1033.html';
    preg_match('/-(\w+\d+).htm/', $url, $result);
    var_dump($result[1]);

    $url = explode('-', $url);
    if (count($url)) {
        $num = $url[count($url) - 1];
        $num = explode('.', $num);
        if (count($num)) {
            var_dump( $num[0] );
        }
    }
    die;
    return (count($result) > 1) ? $result[1] : '';
}
parseProductNumFromUrl('');

function getHtml($url)
{
    $headers = [
        'authority: www.wayfair.co.uk',
        'pragma: no-cache',
        'cache-control: no-cache',
        'upgrade-insecure-requests: 1',
        'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        'referer: https://www.wayfair.co.uk/furniture/sb0/dog-beds-c508332.html',
        'accept-encoding: gzip, deflate, br',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        'cookie: CSNUtId=a2d02184-5ae0-4f82-7639-2cb4f2f39702; WFSID=b933of7h235phah2db6i0f6s45; serverUAInfo=%7B%22browser%22%3A%22Google+Chrome%22%2C%22browserVersion%22%3A66.03359117%2C%22OS%22%3A%22Linux%22%2C%22OSVersion%22%3A%22%22%2C%22isMobile%22%3Afalse%2C%22isTablet%22%3Afalse%7D; _pxvid=292408f0-486e-11e8-a388-6dfcf0f9524e; _ga=GA1.3.1381052407.1524649863; _gid=GA1.3.1216441846.1524649863; pushNotificationsSignupSent=true; CSNBrief=is_new_user%3D1%26SLoc%3Die2%26TopNavCSSCachedByBrowser%3Dtrue; CookiesPolicy=displayed%3D1524649859%26closed%3D1524649866; ibb=1; wfgelfs=JS_Tracking%3D0; Current_Sort_B2B=0; CSN=PRVW%3DMAJS1016%257CMAJS1008%257CMAJS1018%257CMGBX2498%257CMAJS1009%257CWLDH2947%257CANDM1453%257CANDM1217%257CMAJS1031%257CMHN1155%257CQYB1025%257CWAYS1000%26CLVW%3D915%257C1318%257C6906%257C12; featureDetect={"isTouch":false,"hasMQ":true,"deviceWidth":1855,"deviceHeight":965,"devicePixelRatio":1}; vid=a2d02184-5ae2-8ae2-bb92-ba7e48599802; dtr=1; CSNPersist=page_of_visit%3D490%26latestRefid%3DSG; _px3=82728939c042d317670091cd580260ac9b64026a31aeecd7faaf017ba28cf806:69Wf3ynQWi/xXHL6pBuN6OLMLh3wfNc0W0HMdxj56Uppz55YagHmi+PMze6cVTns7vR+DUnm37fdfkC7FINsZQ==:1000:RZCJaVBDu337s+KXZlvoAe8bo4oBpGJNK+rE7BL+aZVnKdTfZ2wBk1tuTL3PP4DtuhZyZd+gbmZEyvC0ZlclrKg4L1PlaQFMzSYVyn3sx733DacK66y9O95YIbqPxolBKGQoCuLI2pjiCpwq5ftoXYYqORtEPSiQ1EAssHhC7Sc=; otx=otAhhFriiuK7krp%2BSFmYAg%3D%3D'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 35);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if (curl_errno($ch) > 0) {
        var_dump([
            'problem:' => 'Curl error',
            'err_num:' => curl_errno($ch),
            'err_msg:' => curl_error($ch)
        ]);
        die;
    }
    curl_close($ch);
    return $response;
}

function getBrandsUrls(&$html, &$urls)
{
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $dom = new \DOMXPath($dom);
    $categories = $dom->query('//div[@id="brands_list"]//a');

    foreach ($categories as $item) {
        /**
         * @var $item \DOMElement
         */

        $urls[] = [$item->nodeValue => $item->getAttribute('href')];
    }
}

function getCategories(&$html)
{
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $dom = new \DOMXPath($dom);
//    $departments = $dom->query('//ul[@class="StoreNavigation-subMenu-categoryList"]//li[contains(@class, "StoreNavigation-subMenu-item")]');
//
//    foreach($departments as $dep) {
//        var_dump($dep);
//    }
    $hrefs = $dom->query('//ul[@class="StoreNavigation-subMenu-categoryList"]//a[@class="StoreNavDropdown-link"]');

    $t = [];
    foreach ($hrefs as $href) {
        /**
         * @var $href \DOMElement
         */
        $a = $href->getAttribute('href');
        $a = str_replace('https://www.wayfair.co.uk/', '', $a);
        $t[] = ' - "' . $a . '"' . PHP_EOL;
    }

    $hrefs = implode('', $t);
    file_put_contents('wayfair_uk_cats.txt', $hrefs);
    var_dump($t);
    die;
}

function getSubCategories(&$html)
{
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $dom = new \DOMXPath($dom);

    $categoriesItems = $dom->query('//section[@class="Category-group"]//a[contains(@class, "Category-card")]');
    $result = [];
    foreach ($categoriesItems as $item) {
        /**
         * @var $item \DOMElement
         */
        if (strpos($item->nodeValue, ' Sale') !== false || strpos($item->nodeValue, ' All') !== false) {
            continue;
        }
        $result[] = ' - "' . getCategoryFromUrl($item->getAttribute('href')) . '"' . PHP_EOL;
    }
    return $result;
}

function getCategoryFromUrl($url)
{
    $category = str_replace('https://www.wayfair.co.uk/', '', $url);
    if (($pos = strpos($category, '?')) !== false) {
        $category = substr($category, 0, $pos);
    }
    return $category;
}

function getMaxPage()
{
    $html = file_get_contents('../test_html/wayfair_uk_max_page');
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $dom = new DOMXPath($dom);

    $totalPagesWrapper =
        $dom->query('//div[@class="BrowseCore-footer"]//nav[contains(@class,"Pagination")]//*[contains(@class, "Pagination-item")][last() - 1]');

    var_dump($totalPagesWrapper->item(0));
    die;
}

function getProductsUrlsFromContent($html)
{
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $dom = new \DOMXPath($dom);
    $products = $dom->query('//div[contains(@class, "BrowseProductCard-wrapper")]//a[contains(@class, "ProductCard")]');
    foreach ($products as $element) {

        $href = $element->getAttribute('href');
        if (($pos = strpos($href, '?')) !== false) {
            $href = substr($href, 0, $pos);
        }

        $urls[] = $href;
    }

    return $urls;
}

function getProductNum()
{
    $url = 'https://www.wayfair.co.uk/rugs/pdp/three-posts-eastlawn-trendy-light-grey-area-rug-tpos1866.html';
    $url = explode('-', $url);
    if (count($url)) {
        $num = $url[count($url) - 1];
        $num = explode('.', $num);
        if (count($num)) {

            return $num[0];
        }
    }

    return '';
}

function getTitle(&$dom)
{
    $val = parseSingleValue($dom, '//h1[@class="pl-PageTitle-header"]');

    return $val;
}

function getBrand(&$dom)
{
    $brandLink = $dom->query('//a[@class="ProductDetailInfoBlock-header-manuLink"]');
    if ($brandLink->length) {

        return [
            'brand' => $brandLink->item(0)->nodeValue,
            'url' => $brandLink->item(0)->getAttribute('href')
        ];
    }

    return [];
}

function getDepartment(&$dom)
{
    $val = parseSingleValue($dom, '//ol[@class="Breadcrumbs-list"]//li[@class="Breadcrumbs-listItem"][1]//a[contains(@class, "Link")]');

    return $val;
}

function getReviewsCount(&$dom)
{
    $val = parseSingleValue($dom, '//p[@class="ReviewStars-reviews"]');

    return intval($val);
}

function getPrice(&$dom)
{
    $val = parseSingleValue($dom, '//h2[contains(@class, "ProductPricing-amount")]');

    return $val;
}

function parseSingleValue($dom, $selector)
{
    $el = $dom->query($selector);
    if ($el->length) {
        return $el->item(0)->nodeValue;
    }

    return '';
}

function main()
{
/*    getProductNum();

    $html = file_get_contents('../test_html/wayfair_uk_max_page');

    $urls = getProductsUrlsFromContent($html);
    var_dump($urls);
    die('_ OK _');*/

    $html = file_get_contents('../test_html/wayfair_uk_single_product');

    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $dom = new \DOMXPath($dom);

    $title = getTitle($dom);
    $brand = getBrand($dom);
    $department = getDepartment($dom);
    $reviewsCount = getReviewsCount($dom);
    $price = getPrice($dom);

    var_dump([
        'title        ' => $title,
        'brand        ' => $brand,
        'department   ' => $department,
        'reviewsCount ' => $reviewsCount,
        'price        ' => $price,
    ]);
    die;

}

main();
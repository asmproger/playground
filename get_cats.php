<?php
die('GO TO CODE!');
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
            'problem : ' => 'Curl error',
            'url     : ' => '|' . $url . '|',
            'err_num : ' => curl_errno($ch),
            'err_msg : ' => curl_error($ch)
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

        $urls[] = [$item->textContent => $item->getAttribute('href')];
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
        if (strpos($item->textContent, ' Sale') !== false || strpos($item->textContent, ' All') !== false) {
            continue;
        }
        $result[] = ' - "' . getCategoryFromUrl($item->getAttribute('href')) . '"' . PHP_EOL;
    }
    return $result;
}

function getCategoryFromUrl($url)
{
    return str_replace('https://www.wayfair.co.uk/', '', $url);
}

function main()
{
    $page = array_key_exists('page', $_REQUEST) ? $_REQUEST['page'] : false;
    if ($page !== false) {
        $categories = file('wayfair/wayfair_uk_cats.txt');

        if (isset($categories[$page])) {
            $category = $categories[$page];
        } else {
            echo json_encode(['status' => true, 'finish' => true]);
            die;
        }

        $url = trim('https://www.wayfair.co.uk/' . str_replace([' - "', '"'], '', $category));

        $html = getHtml($url);
        $subCats = getSubCategories($html);
        $cnt = count($subCats);

        if (count($subCats)) {
            $file_name = 'cats/category_' . $page . '.txt';
            $content = implode('', $subCats);
        } else {
            $content = $category;
        }

        $file_name = 'cats/wayfair_cats.txt';
        file_put_contents($file_name, $content, FILE_APPEND);

        echo json_encode([
            'status' => true,
            'page' => $page + 1,
            'category' => $category,
            'filename' => $file_name,
            'sub_cats' => $cnt
        ]);
    } else {
        echo json_encode(['status' => false]);
    }
    die;
    //$html = getHtml('https://www.wayfair.co.uk/');
    //getCategories($html);

    $categoriesRaw = file('wayfair_uk_cats.txt');
    $categories = [];
    $i = 0;
    foreach ($categoriesRaw as $c) {
//        if($i >= 4) {
//            break;
//        }
        $url = trim('https://www.wayfair.co.uk/' . str_replace([' - ', '"'], '', $c));
        $html = getHtml($url);

        //$html = file_get_contents('../test_html/cat_page.html');
        //$categories[$c] = getSubCategories($html);;
        $subCategories = getSubCategories($html);
        $categories = array_merge($categories, $subCategories);
        //$i++;
    }

    $hrefs = implode('', $categories);
    file_put_contents('wayfair_uk_cats_full.txt', $hrefs);
    var_dump($categories);
    die;
}

main();
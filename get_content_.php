<?
function getUrlContent($url) {
    fopen("cookies.txt", "w");
    $parts = parse_url($url);
    $host = $parts['host'];
    $host = 'public.api.openprocurement.org';
    $ch = curl_init();
    $header = array(
        'Authorization: Basic YnJva2VyOg==',
'Content-Length: 4164',
'Content-Type: application/json',
'Host: api-sandbox.openprocurement.org'
        //'GET /1575051 HTTP/1.1',
        //"Host: {$host}",
        //'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        //'Accept-Language:en-US,en;q=0.8',
        //'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        //'Cache-Control:max-age=0',
        //'Connection:keep-alive',
        //'Host:adfoc.us',
        //'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
        //'GET /1575051 HTTP/1.1',
        //'Host: public.api.openprocurement.org',
        //'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
//'Accept-Encoding: gzip, deflate, br',
//'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
//'Cache-Control: no-cache',
//'Connection: keep-alive',
//'Cookie: SERVER_ID=47570a2afe0781b2b616a711eab19c228c5afece9e0ff829e44e4470dc1fc01a122d19e989dfc7bea786d8a62ff1d8c410987ebcd83d4176a159eda8fd28c796; _ga=GA1.2.1591651155.1536323869',

//'Pragma: no-cache',
//'Upgrade-Insecure-Requests: 1',
//'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'


    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'gdemon:123456');
    curl_setopt($ch, CURLOPT_PROXY, "192.168.200.6:3128"); 
    
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); 
    //curl_easy_setopt(curl, CURLOPT_PROXY, "localhost");
    //curl_easy_setopt(curl, CURLOPT_PROXYPORT, 8080L);
    //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, 1);
    echo '22';
    echo "<pre>";
    print_r($ch);
    echo "</pre>";
    $result = curl_exec($ch);
    
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    echo 'Ошибка curl: ' . curl_error($ch);

    curl_close($ch);
    return $result;
}
$url = 'https://public.api.openprocurement.org/api/2.4/tenders/2c199ff642c64b339bab7373dba1e6e1';
//$url = 'https://www.google.com.ua/';
$res = getUrlContent($url);

echo $res;
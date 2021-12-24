<?
 $res = file_get_contents('http://128.199.52.146/index.php?time=1585645202&companyID=12173&userID=442480&targetID=29&format=json&lang=ru&token=ee4ffa92a923852bac0c79f4cc47b3f83f717276c7e469f92a691406d9558653eda4523383ffc198f075450946560a3efbe19bf23656f4e81ed56a3284022022&full=0');
echo $res;
exit; 
function getUrlContent($url) {
    fopen("cookies.txt", "w");
    $parts = parse_url($url);
    $host = $parts['host'];
    $ch = curl_init();
    $header = array('GET /1575051 HTTP/1.1',
        "Host: {$host}",
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language:en-US,en;q=0.8',
        'Cache-Control:max-age=0',
        'Connection:keep-alive',
        'Host:adfoc.us',
        'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);

    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $result = curl_exec($ch);
    echo 'Ошибка curl: ' . curl_error($ch);
    curl_close($ch);
    
    return $result;
}
$url = 'https://public.api.openprocurement.org/api/2.4/tenders/2c199ff642c64b339bab7373dba1e6e1';
$res = getUrlContent($url);

echo $res;
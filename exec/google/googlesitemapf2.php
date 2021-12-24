<?php
function url_get_contents($url, $useragent='cURL', $headers=false, $follow_redirects=true, $debug=false) {

    // initialise the CURL library
    $ch = curl_init();

    // specify the URL to be retrieved
    curl_setopt($ch, CURLOPT_URL,$url);

    // we want to get the contents of the URL and store it in a variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    // specify the useragent: this is a required courtesy to site owners
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

    // ignore SSL errors
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // return headers as requested
    if ($headers==true){
        curl_setopt($ch, CURLOPT_HEADER,1);
    }

    // only return headers
    if ($headers=='headers only') {
        curl_setopt($ch, CURLOPT_NOBODY ,1);
    }

    // follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
    if ($follow_redirects==true) {
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
    }

    // if debugging, return an array with CURL debug info and the URL contents
    if ($debug==true) {
        $result['contents']=curl_exec($ch);
        $result['info']=curl_getinfo($ch);
    }

    // otherwise just return the contents as a variable
    else $result=curl_exec($ch);

    // free resources
    curl_close($ch);

    // send back the data
    return $result;
}


$GFEED = url_get_contents("https://prote.ua/sitemapf2.xml");


$GFEED = str_replace('<loc>prote.ua/stationery/doski-flipcharty/f1-2h3/f1120-probkovie/','<loc>https://prote.ua/stationery/doski-flipcharty/f1-2h3/f1120-probkovie/',$GFEED);
$GFEED = str_replace('<loc>/uaprote.ua/stationery/doski-flipcharty/f1-2h3/f1120-probkovie/','<loc>https://prote.ua/ua/stationery/doski-flipcharty/f1-2h3/f1120-probkovie/',$GFEED);


$file=fopen("/var/www/prote/data/www/prote.ua/sitemapf2.xml", "w+");
fputs($file,$GFEED);
fclose($file);

var_dump($GFEED);
exit();

//header("Location: https://prote.ua/exec/google/googlefeed.xml");
//exit();





?>
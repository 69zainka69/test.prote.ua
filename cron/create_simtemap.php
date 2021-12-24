<?php

require_once(__DIR__.'/../config.php');

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap';
$file   = DIR_ROOT.'sitemapc.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/brands';
$file   = DIR_ROOT.'sitemapb.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/other';
$file   = DIR_ROOT.'sitemapo.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/filters&part=0';
$file   = DIR_ROOT.'sitemapf0.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/filters&part=1';
$file   = DIR_ROOT.'sitemapf1.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/filters&part=2';
$file   = DIR_ROOT.'sitemapf2.xml';
wget($url,$file);


$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/filters&part=3';
$file   = DIR_ROOT.'sitemapf3.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/mapindex';
$file   = DIR_ROOT.'sitemap.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/sitemapi';
$file   = DIR_ROOT.'sitemapi.xml';
wget($url,$file);

$url = HTTPS_SERVER.'index.php?route=feed/google_sitemap/sitemapp';
$file   = DIR_ROOT.'sitemapp.xml';
wget($url,$file);


function wget($url,$filename) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true );
  // follows a location header redirect
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($ch, CURLOPT_POSTFIELDS, '');
  curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'cron/cookies.txt');
  curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'cron/cookies.txt');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  curl_close($ch);

  $handle = fopen($filename, 'w');
  fwrite($handle, $response);
  fclose($handle);
  echo "writed - ".$filename."\n";
  //return $response;
}

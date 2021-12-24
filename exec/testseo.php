<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$memory = ini_get("memory_limit");
echo $memory;

$mem_start = memory_get_usage();
echo $mem_start."\n";

// $a=file_get_contents('/var/www/prote.com.ua/exec/cache.seo_pro.1524488902');
// $b=unserialize($a);

echo  memory_get_usage()-mem_start;
var_dump($b);


<?php
   
   echo date('Y-m-d H:i:s').': start...';

    $cdatestamp = date('Y-m-d');


    // Установка соединения с БД (с помощью сокета)
    $mysqli = new mysqli("localhost", "root", "RooT", "prote", 3306, '/var/lib/mysql/mysql.sock');
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $mysqli->set_charset ('utf8');
    // echo $mysqli->host_info . "\n";

    // Список товаров
    $res=$mysqli->query("SELECT *
        FROM prote.`oc_product` p
        LEFT JOIN prote.`oc_product_description` pd ON pd.`product_id`=p.`product_id` AND `language_id`=1
        WHERE p.`status`=1
        ORDER BY p.`product_id`"
    );
    
     
    $out='<?xml version="1.0" encoding="UTF-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
    $curout='';
    
    // Подготовка запроса
    $stmt = $mysqli->prepare("SELECT `keyword` FROM prote.oc_url_alias WHERE query=?");
    
    // Проходим все изображения
    while ($row = $res->fetch_assoc()) {        
        $stmt->bind_param("s", $val1);
        $val1='product_id='.$row['product_id'];
        $stmt->execute();
        $r=$stmt->get_result();
            
            // $r=$mysqli->query("select keyword from prote.oc_url_alias where query='product_id=".$row['product_id']."'");
        $a=$r->fetch_assoc();
        $out .= "<url>\n"
                ."<loc>https://prote.ua/". mb_strtolower($a['keyword']).".html</loc>"."\n"
                ."<lastmod>$cdatestamp</lastmod>\n"
                ."<changefreq>weekly</changefreq>\n"
                ."<priority>0.7</priority>\n"
                ."</url>\n";
        
        $out .= "<url>\n"
                ."<loc>https://prote.ua/ua/". mb_strtolower($a['keyword']).".html</loc>"."\n"
                ."<lastmod>$cdatestamp</lastmod>\n"
                ."<changefreq>weekly</changefreq>\n"
                ."<priority>0.7</priority>\n"
                ."</url>\n";
        
    }
    // out .= sprintf ( $itempl, $row['image'], htmlspecialchars($row['name'], ENT_XML1) . ' фото ' . (++$curnum), htmlspecialchars($row['name'], ENT_XML1) . $row['title'] . ' фото ' . $curnum );
    
    
    $out .= '</urlset>';
    // Запись в файл
    file_put_contents('/var/www/prote.com.ua/sitemapp.xml',$out);
    echo date('Y-m-d H:i:s').": done\n";
    

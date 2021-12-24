<?php
class ControllerFeedGoogleSitemap extends Controller {
    private $datestamp;

    private function getSitemapUrlTemplate($link, $changefreq, $priority)
    {
        $lastmod = $this->datestamp;

        $templateBuilder = function ($loc) use ($lastmod, $changefreq, $priority) {
            return (
                '<url>'."\n".
                    '<loc>' . $loc .'</loc>' ."\n".
                    '<lastmod>' . $lastmod . '</lastmod>' ."\n".
                    '<changefreq>' . $changefreq . '</changefreq>' ."\n".
                    '<priority>' . $priority . '</priority>'."\n".
                '</url>'
            );
        };

        $linkPath = parse_url($link, PHP_URL_PATH);
        $linkDomain = substr($link, 0, strlen($link) - strlen($linkPath));
        $linkPath = preg_replace('/^\/ua/', '', $linkPath);

        $linkRu = $linkDomain.$linkPath;
        $linkUa = $linkDomain.'/ua'.$linkPath;

        $templateRu = $templateBuilder($linkRu);
        $templateUa = $templateBuilder($linkUa);

        return ( $templateRu . $templateUa );
    }

    public function index()
    {
        if ($this->config->get('google_sitemap_status')) {
            set_time_limit (1800);
            $this->datestamp=date('Y-m-d');

            $output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

            $output .= '<url>'."\n".
                       '<loc>https://prote.ua/</loc>' ."\n".
                       '<lastmod>' . $this->datestamp . '</lastmod>' ."\n".
                       '<changefreq>daily</changefreq>' ."\n".
                       '<priority>1.0</priority>'."\n".
                       '</url>';

            $output .= '<url>'."\n".
                       '<loc>https://prote.ua/ua/</loc>' ."\n".
                       '<lastmod>' . $this->datestamp . '</lastmod>' ."\n".
                       '<changefreq>daily</changefreq>' ."\n".
                       '<priority>1.0</priority>'."\n".
                       '</url>'."\n";

            $this->load->model('catalog/product');
            $this->load->model('tool/image');

            // $this->load->model('module/brainyfilter');

            // $output .= $this->getCategoriesFilters(0);

            // echo $output;

            // die();

            /*
            $products = $this->model_catalog_product->getProducts();
            // echo count($products);
            // die();

            $outp=array();
            foreach ($products as $product) {
                $outitem = '<url>' .
                   '<loc>' . $this->url->link('product/product', 'product_id=' . $product['product_id']) . '</loc>' .
                   '<lastmod>' . $this->datestamp . '</lastmod>' .
                   '<changefreq>weekly</changefreq>' .
                   '<priority>1.0</priority>'.
                   '</url>'.
                   '<url>' .
                   '<loc>' . $this->url->link('product/product', array('product_id=' . $product['product_id'], 'language=uk' )) . '</loc>' .
                   '<lastmod>' . $this->datestamp . '</lastmod>' .
                   '<changefreq>weekly</changefreq>' .
                   '<priority>1.0</priority>';

                if (0 && $product['image']) {
                    $outitem .= '<image:image>' .
                        '<image:loc>' . $this->model_tool_image->resize($product['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')) . '</image:loc>' .
                        '<image:caption>' . $product['name'] . '</image:caption>' .
                        '<image:title>' . $product['name'] . '</image:title>' .
                        '</image:image>';
                }

                $outitem .= '</url>';
                // $outp[] = $outitem;
                $output .= $outitem;
            }

            // echo count($outp); die();
            */

            $this->load->model('catalog/category');

            $output .= $this->getCategories(0);

            $this->load->model('catalog/manufacturer');

            $manufacturers = $this->model_catalog_manufacturer->getManufacturers();

            foreach ($manufacturers as $manufacturer) {
                $output .= '<url>';
                $output .= '<loc>' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']) . '</loc>';
                $output .= '<changefreq>weekly</changefreq>';
                $output .= '<priority>0.7</priority>';
                $output .= '</url>';
            }

            // Информация на сайте
            $this->load->model('catalog/information');

            $informations = $this->model_catalog_information->getInformations();

            foreach ($informations as $information) {
                $output .= '<url>'."\n";
                $output .= '<loc>' . $this->url->link('information/information', 'information_id=' . $information['information_id']) . '</loc>'."\n";
                $output .= '<lastmod>' . $this->datestamp . '</lastmod>' ."\n";
                $output .= '<changefreq>weekly</changefreq>'."\n";
                $output .= '<priority>0.8</priority>'."\n";
                $output .= '</url>'."\n";
                $output .= '<url>'."\n";
                $output .= '<loc>' . str_replace('prote.ua/', 'prote.ua/ua/', $this->url->link('information/information', 'information_id=' . $information['information_id'])) . '</loc>'."\n";
                $output .= '<lastmod>' . $this->datestamp . '</lastmod>' ."\n";
                $output .= '<changefreq>weekly</changefreq>'."\n";
                $output .= '<priority>0.8</priority>'."\n";
                $output .= '</url>'."\n";
            }


            // Статьи
            $this->load->model('extension/articles');

            $total = $this->model_extension_articles->getTotalArticles();

            $filter_data = array();

            $all_articles = $this->model_extension_articles->getAllArticles($filter_data);
            foreach ($all_articles as $articles) {
                $output .= '<url>'."\n";
                $output .= '<loc>' . $this->url->link('information/articles/articles', 'articles_id=' . $articles['articles_id']) . '</loc>'."\n";
                $output .= '<lastmod>' . $this->datestamp . '</lastmod>' ."\n";
                $output .= '<changefreq>weekly</changefreq>'."\n";
                $output .= '<priority>0.8</priority>'."\n";
                $output .= '</url>'."\n";
                $output .= '<url>'."\n";
                $output .= '<loc>' . str_replace('prote.ua/', 'prote.ua/ua/', $this->url->link('information/articles/articles', 'articles_id=' . $articles['articles_id'])) . '</loc>'."\n";
                $output .= '<lastmod>' . $this->datestamp . '</lastmod>' ."\n";
                $output .= '<changefreq>weekly</changefreq>'."\n";
                $output .= '<priority>0.8</priority>'."\n";
                $output .= '</url>'."\n";

                // $data['all_articles'][] = array (
                //     'title' => html_entity_decode($articles['title'], ENT_QUOTES),
                //     'image' => $this->model_tool_image->resize($articles['image'], 100, 100),
                //     'description' => (strlen(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))) > 150 ? mb_substr(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES)), 0, 150) . '...' : strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))),
                //     'view' => $this->url->link('information/articles/articles', 'articles_id=' . $articles['articles_id']),
                //     'date_added' => date($this->language->get('date_format_short'), strtotime($articles['date_added']))
                // );
            }

            $output .= '</urlset>';

            $this->response->addHeader('Content-Type: application/xml');
            $this->response->setOutput($output);
        }
    }

    public function mapindex()
    {
        $parts=array(
            "sitemapc.xml",
            "sitemapb.xml",
            "sitemapo.xml",
            "sitemapf0.xml",
            "sitemapf1.xml",
            "sitemapf2.xml",
            "sitemapf3.xml",
            "sitemapi.xml",
            "sitemapp.xml"
        );

        $output = '';
        foreach ($parts as $item) {
            $output .= '<sitemap><loc>https://prote.ua/'.$item."</loc>\n<lastmod>".date('Y-m-d')."</lastmod></sitemap>\n";
        }

        $output="<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n".$output."</sitemapindex>";
        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($output);
    }

    // 2019.03.01 = gdemon
    public function other()
    {
        //informal

        $output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

        $this->datestamp=date('Y-m-d');

        $catalogmenu_new = $this->cache->get('menu_categoriesru' . $_SERVER['HTTPS']);
        //vdump($catalogmenu_new);

        foreach ($catalogmenu_new as $key => $category){
            if($category['href']){$urls[] = 'https://prote.ua'.$category['href'];}
            if($category['children']){
                  foreach ($category['children'] as $children){
                      if($children['href']){
                      $urls[] = 'https://prote.ua'.$children['href'];
                      }
                     if(isset($children['children']) && !empty($children['children'])){
                          foreach ($children['children'] as $child2){
                              if($child2['href']){
                              $urls[] = 'https://prote.ua'.$child2['href'];
                              }
                          }
                     }
                 }
            }
        }

        $urls[]= $this->url->link('product/special');
        $urls[]= $this->url->link('information/readycart');
        $urls[]= $this->url->link('information/solutions');
        $urls[]= $this->url->link('information/solutions','solution_id=362');
        $urls[]= $this->url->link('information/solutions','solution_id=437');
        $urls[]= $this->url->link('information/solutions','solution_id=447');
        $urls[]= $this->url->link('information/solutions','solution_id=448');
        $urls[]= $this->url->link('information/solutions','solution_id=449');
        $urls[]= $this->url->link('information/solutions','solution_id=450');

        $urls[]= $this->url->link('information/preorder');
        $urls[]= $this->url->link('information/workers');
        $urls[]= $this->url->link('information/workers','workers_id=212');
        $urls[]= $this->url->link('information/workers','workers_id=213');
        $urls[]= $this->url->link('information/workers','workers_id=214');

        foreach ($urls as $url) {
            $output .= '<url>'."\n";
            $output .= '<loc>' . $url . '</loc>'."\n";
            $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
            $output .= '<changefreq>daily</changefreq>'."\n";
            $output .= '<priority>0.9</priority>'."\n";
            $output .= '</url>'."\n";
            $output .= '<url>'."\n";
            $output .= '<loc>' . str_replace('prote.ua/', 'prote.ua/ua/', $url) . '</loc>'."\n";
            $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
            $output .= '<changefreq>daily</changefreq>'."\n";
            $output .= '<priority>0.9</priority>'."\n";
            $output .= '</url>'."\n";
        }


        $this->load->model('catalog/informal');
        $results = $this->model_catalog_informal->getinformals();

        foreach ($results as $result) {

            $url =  $this->url->link('product/informal', 'informal_id='.$result['informal_id'] );

            $output .= '<url>'."\n";
            $output .= '<loc>' . $url . '</loc>'."\n";
            $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
            $output .= '<changefreq>daily</changefreq>'."\n";
            $output .= '<priority>0.9</priority>'."\n";
            $output .= '</url>'."\n";
            $output .= '<url>'."\n";
            $output .= '<loc>' . str_replace('prote.ua/', 'prote.ua/ua/', $url) . '</loc>'."\n";
            $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
            $output .= '<changefreq>daily</changefreq>'."\n";
            $output .= '<priority>0.9</priority>'."\n";
            $output .= '</url>'."\n";

        }


        $output .= '</urlset>';

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($output);

    }

    public function brands()
    {
        $output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

        $this->datestamp = date('Y-m-d');

        $this->load->model('catalog/product');
        $brands = $this->model_catalog_product->getPrinterBrandsCats();
        $brands['datecs'] = [50 => 'кассовые'];

        foreach ($brands as $brand => $categories) {
            $brandId = str_replace(' ', '-', strtolower($brand));

            $brandLink = $this->url->link('product/brand', 'brand_id='.$brandId);
            $output .= $this->getSitemapUrlTemplate($brandLink, 'daily', '0.9');

            foreach ($categories as $category => $categoryName) {
                $brandCategoryLink =  $this->url->link('product/brand', 'brand_id='.$brandId.'&tech_id='.$category );
                $output .= $this->getSitemapUrlTemplate($brandCategoryLink, 'daily', '0.9');

                $brandProducts = $this->model_catalog_product->getPrinterCompabilityList($brand, $category);
                if (!$brandProducts) {
                    continue;
                }

                foreach ($brandProducts as $brandProduct) {
                    $absnum = $brandProduct['absnum'];

                    $productLink = $this->url->link('product/brand', 'prn='.$absnum);
                    $output .= $this->getSitemapUrlTemplate($productLink, 'daily', '0.7');

                    $productCompatibleCategories = $this->model_catalog_product->getProductCompabilityListByAbsnumCats([
                        'filter_prn' => $absnum
                    ]);
                    if (!$productCompatibleCategories) {
                        continue;
                    }

                    foreach ($productCompatibleCategories as $compatibleCategory) {
                        $productCategoryLink = $this->url->link(
                            'product/brand',
                            'prn=' . $absnum . '&cat_id=' . $compatibleCategory['category_id']
                        );
                        $output .= $this->getSitemapUrlTemplate($productCategoryLink, 'daily', '0.7');
                    }
                }
            }
        }

        $output .= '</urlset>';

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($output);
    }

    public function filters()
    {
        $sitemapPartsCount = 4;

        $minPartId = 0;
        $maxPartId = $sitemapPartsCount - 1;
        $partId = 0;

        if (isset($this->request->get['part'])) {
            $partId = intval($this->request->get['part']);
        }
        if ($partId < $minPartId) {
            $partId = $minPartId;
        }
        if ($partId > $maxPartId) {
            $partId = $maxPartId;
        }

        if ($this->config->get('google_sitemap_status')) {
            $this->datestamp = date('Y-m-d');
            $output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

            $this->load->model('catalog/product');

            $categories = $this->_getLayoutToCategory();

            $sitemapPartSize = ceil(count($categories) / $sitemapPartsCount);
            $categories = array_slice($categories, $partId * $sitemapPartSize, $sitemapPartSize, true);

            foreach ($categories as $categoryId => $layoutId) {
                $output .= $this->getCategoriesFilters($categoryId, $layoutId);
            }

            $output .= '</urlset>';

            $this->response->addHeader('Content-Type: application/xml');
            $this->response->setOutput($output);
        }
    }

    public function sitemapi()
    {
        //echo date('Y-m-d H:i:s').': start...';
        // Шаблон блока  изображения
        $itempl = '
            <image:image>
                <image:loc>https://prote.ua/image/%s</image:loc>
                <image:caption>%s</image:caption>
                <image:title>%s</image:title>
            </image:image>';

        // Список изображений
        $res = $this->db->query("
            SELECT pi.`product_id`, pi.`image`, pd.`name` FROM `oc_product_image` pi
            INNER JOIN `oc_product` p on p.`product_id`=pi.`product_id`
            INNER JOIN `oc_product_description` pd on pd.`product_id`=p.`product_id` AND `language_id`=1
            WHERE p.`status`=1
            ORDER BY p.`product_id`
        ");

        $curitem = '';
        $out='<?xml version="1.0" encoding="UTF-8"?>
              <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                      xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        $curout='';

        set_time_limit (1800);
        ini_set('memory_limit','256MB');

        // Проходим все изображения
        foreach ($res->rows as $row) {
            if ($curitem<>$row['product_id']) {
                $curnum=0;
                $curitem=$row['product_id'];

                if ($curout) {
                    $out .= "\n<url>\n" . $curout . "\n</url>\n";
                }

                /*$stmt->bind_param("s", $val1);
                $val1='product_id='.$row['product_id'];
                $stmt->execute();
                $r=$stmt->get_result();

                // $r=$mysqli->query("select keyword from prote.oc_url_alias where query='product_id=".$row['product_id']."'");
                $a=$r->fetch_assoc();*/
                $a = $this->db->query("SELECT `keyword` FROM oc_url_alias WHERE query='product_id=".$row['product_id']."'");
                if ($a->row){
                    $curout="<loc>https://prote.ua/". mb_strtolower($a->row['keyword']).".html</loc>";
                }
            }

            $curout .= sprintf ( $itempl, $row['image'], htmlspecialchars($row['name'], ENT_XML1) . ' фото ' . (++$curnum), htmlspecialchars($row['name'], ENT_XML1) . $row['title'] . ' фото ' . $curnum );
        }

        $out .= '</urlset>';

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($out);

        // Запись в файл
        //file_put_contents('/var/www/prote.com.ua/sitemapi.xml',$out);
        //echo date('Y-m-d H:i:s').": done\n";
    }

    public function sitemapp()
    {
        $cdatestamp = date('Y-m-d');

        // Список товаров
        $res = $this->db->query("SELECT *
            FROM `oc_product` p
            INNER JOIN `oc_product_description` pd ON pd.`product_id`=p.`product_id` AND `language_id`=1
            WHERE p.`status`=1
            ORDER BY p.`product_id`"
        );

        $out='<?xml version="1.0" encoding="UTF-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        $curout='';

        // Проходим все изображения
        foreach ($res->rows as $row) {
            // $r=$mysqli->query("select keyword from prote.oc_url_alias where query='product_id=".$row['product_id']."'");
            $a = $this->db->query("SELECT `keyword` FROM oc_url_alias WHERE query='product_id=".$row['product_id']."'");
            if ($a->row) {
                $out .= "<url>\n"
                    ."<loc>https://prote.ua/". mb_strtolower($a->row['keyword']).".html</loc>"."\n"
                    ."<lastmod>$cdatestamp</lastmod>\n"
                    ."<changefreq>weekly</changefreq>\n"
                    ."<priority>0.7</priority>\n"
                    ."</url>\n";

                $out .= "<url>\n"
                    ."<loc>https://prote.ua/ua/". mb_strtolower($a->row['keyword']).".html</loc>"."\n"
                    ."<lastmod>$cdatestamp</lastmod>\n"
                    ."<changefreq>weekly</changefreq>\n"
                    ."<priority>0.7</priority>\n"
                    ."</url>\n";
            }
        }

        $out .= '</urlset>';

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($out);

        // Запись в файл
        /*file_put_contents('/var/www/prote.com.ua/sitemapp.xml',$out);
        echo date('Y-m-d H:i:s').": done\n";*/
    }

    public function images()
    {
        $partId = 0;
        if (isset($this->request->get['part'])) $partId = $this->request->get['part'];

        $output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $output  .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        $this->load->model('catalog/product');

        $products = $this->model_catalog_product->getProducts();
        echo count($products);
        die();
        echo count($products);
        $products = array_slice($products, $partId*1000, 1000);

        foreach ($products as $product) {
            // $data['images'] = array();

            $results = $this->model_catalog_product->getProductImages($product['product_id']);
            $imgList="";
            $imgNo=1;
            foreach ($results as $result) {
                $path_str= '/image/cache/' . $result['image'];
                $path_parts=pathinfo($path_str);
                $path_name=$path_parts['dirname'] . '/' .
                $path_parts['filename'] . '-'.
                $this->config->get('config_image_popup_width') . 'x' .
                $this->config->get('config_image_popup_height') . '.' .
                $path_parts['extension'];
                // if  (file_exists('/var/www/prote.com.ua' . $path_name)) {
                if (file_exists(DIR_ROOT . $path_name)) {
                    $imgList .= '<image:image>' .
                        '<image:loc>https://prote.ua' . $path_name . '</image:loc>' .
                        '<image:caption>' . htmlspecialchars($product['name_short']) . '. Фото ' . $imgNo . '</image:caption>' .
                        '<image:title>'   . htmlspecialchars($product['name']) . '. Фото ' . $imgNo++ . '</image:title>' .
                    '</image:image>';
                }
            }

            if ($imgList) {
                $output .= '<url><loc>' . $this->url->link('product/product', 'product_id=' . $product['product_id']) . '</loc>'.$imgList.'</url>';
            }
        }

        $output .= '</urlset>';

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($output);
    }

    protected function getCategories($parent_id, $current_path = '')
    {
        global $datestamp;

        $output = '';

        $results = $this->model_catalog_category->getCategories($parent_id);

        foreach ($results as $result) {
            if (!$current_path) {
                $new_path = $result['category_id'];
            } else {
                $new_path = $current_path . '_' . $result['category_id'];
            }

            $output .= '<url>'."\n";
            $output .= '<loc>' . $this->url->link('product/category', 'path=' . $new_path) . '</loc>'."\n";
            $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
            $output .= '<changefreq>daily</changefreq>'."\n";
            $output .= '<priority>0.9</priority>'."\n";
            $output .= '</url>'."\n";

            $output .= '<url>'."\n";
            $output .= '<loc>' . str_replace('prote.ua/', 'prote.ua/ua/', $this->url->link('product/category', 'path=' . $new_path)) . '</loc>'."\n";
            $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
            $output .= '<changefreq>daily</changefreq>'."\n";
            $output .= '<priority>0.9</priority>'."\n";
            $output .= '</url>'."\n";

            // $products = $this->model_catalog_product->getProducts(array('filter_category_id' => $result['category_id']));

            foreach ($products as $product) {
                // $proditem .= '<url>';
                // $proditem .= '<loc>' . $this->url->link('product/product', 'path=' . $new_path . '&product_id=' . $product['product_id']) . '</loc>';
                // $proditem .= '<lastmod>' . $this->datestamp . '</lastmod>' ;
                // $proditem .= '<changefreq>weekly</changefreq>';
                // $proditem .= '<priority>1.0</priority>';
                // $proditem .= '</url>';

                // $output .= $proditem; //. str_replace('com.ua/', 'com.ua/ua/', $proditem);
                $output .= '<url>'."\n";
                $output .= '<loc>' . $this->url->link('product/product', 'path=' . $new_path . '&product_id=' . $product['product_id']) . '</loc>'."\n";
                $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
                $output .= '<changefreq>weekly</changefreq>'."\n";
                $output .= '<priority>0.7</priority>'."\n";
                $output .= '</url>'."\n";
                $output .= '<url>'."\n";
                $output .= '<loc>' . str_replace('prote.ua/', 'prote.ua/ua/', $this->url->link('product/product', 'path=' . $new_path . '&product_id=' . $product['product_id'])) . '</loc>'."\n";
                $output .= '<lastmod>' . $this->datestamp . '</lastmod>'."\n";
                $output .= '<changefreq>weekly</changefreq>'."\n";
                $output .= '<priority>0.7</priority>'."\n";
                $output .= '</url>'."\n";
            }

            $output .= $this->getCategories($result['category_id'], $new_path);
        }

        return $output;
    }

    private function getCategoryClampedFiltersUrls($categoryId)
    {
        $query = $this->db->query("
            SELECT `fs`.`filterseo_id`, `fs`.`url`, COUNT(`ftf`.`filter_id`) AS `filters_count`
            FROM `oc_filterseo` AS `fs`
            INNER JOIN `oc_filterseo_to_filter` AS `ftf` ON `fs`.`filterseo_id` = `ftf`.`filterseo_id`
            WHERE `fs`.`status` = 1 AND `fs`.`category_id` = {$categoryId}
            GROUP BY `fs`.`filterseo_id`
            HAVING `filters_count` > 1
        ");

        $clampedFiltersUrls = [];
        foreach ($query->rows as $row) {
            $clampedFiltersUrls[] = $row['url'];
        }

        $clampedFiltersUrls = array_filter(array_unique($clampedFiltersUrls));

        return $clampedFiltersUrls;
    }

    // Получение фильтров для категорий
    protected function getCategoriesFilters($categoryId, $layoutId)
    {
        $categoryPath = $categoryId;
        $output = '';

        /* Фильтр в наличии */
        $instokLink = $this->url->link('product/category', ['path' => $categoryPath]).'instock/';
        $output .= $this->getSitemapUrlTemplate($instokLink, 'weekly', '0.7');

        /* Зажатые фильтры */
        $clampedLinks = $this->getCategoryClampedFiltersUrls($categoryId);
        foreach ($clampedLinks as $clampedLink) {
            $output .= $this->getSitemapUrlTemplate($clampedLink, 'weekly', '0.7');
        }

        /* Одиночные фильтры */
        $filtersData = [
            'filter_category_id' => $categoryId,
            'filter_sub_category' => false
        ];
        $this->load->model('module/brainyfilter');
        $this->model_module_brainyfilter->setData($filtersData);
        $filters = $this->model_module_brainyfilter->getFilters(true);

        $layoutSettings = $this->_getLayoutSettings($layoutId);
        $this->_applySettings($filters, 'filters', $layoutSettings);
        // $this->_applySettings($filters, 'attributes', $layoutSettings);
        // $this->_applySettings($filters, 'options', $layoutSettings);

        foreach ($filters as $filterGroupId => $filterGroup) {
            foreach ($filterGroup as $filterValues) {
                foreach ($filterValues as $filterValue) {
                    // Проверка на наличие товара по данному фильтру
                    $filterProductsCount = $this->model_catalog_product->getFilteredProductsCount(
                        $categoryId,
                        $filterGroupId,
                        $filterValue['id']
                    );
                    if ($filterProductsCount) {
                        // Создание УРЛ и добавление в сайтмап
                        $filterLink = $this->url->link('product/category', [
                            'path' => $categoryPath,
                            'bfilter' => 'f'.$filterGroupId.':'.$filterValue['id'].';'
                        ]);

                        // Отсекаем фильтра без настроенных УРЛ
                        if (strpos($filterLink, 'index.php') === false) {
                            $output .= $this->getSitemapUrlTemplate($filterLink, 'weekly', '0.7');
                        }
                    }
                }
            }
        }

        return $output;
    }

    // From BRAINYFILTER add-on
    private function _applySettings(&$filters, $type, $settings)
    {
        if (!is_array($filters) || !count($filters) || !isset($settings[$type])) {
            return;
        }
        $secSettings = $settings[$type];

        foreach ($filters as $k => $f) {
            if (!isset($secSettings[$k]) || !isset($secSettings[$k]['enabled']) || !$secSettings[$k]['enabled']) {
                unset($filters[$k]);
            } else {
                $f['type'] = isset($secSettings[$k]['control']) ? $secSettings[$k]['control'] : '';
                if (isset($secSettings[$k]['mode'])) {
                    $f['mode'] = $secSettings[$k]['mode'];
                }
                if (in_array($f['type'], array('slider', 'slider_lbl', 'slider_lbl_inp'))) {
                    $values = array();
                    foreach ($f['values'] as $val) {
                        $values[] = array('n' => $val['name'], 's' => $val['sort']);
                    }
                    $f['values'] = $values;
                    $f['min'] = array_shift($values);
                    $f['max'] = array_pop($values);
                }
                $filters[$k] = $f;
            }
        }
    }

    private function _getLayoutSettings($layoutId)
    {
        $basicSettings = [];
        if ($this->config->get('brainyfilter_layout_basic')) {
            $basicSettings = $this->config->get('brainyfilter_layout_basic');
        }

        $layoutSettings = [];
        if ($this->config->get('brainyfilter_layout_' . $layoutId)) {
            $layoutSettings = $this->config->get('brainyfilter_layout_' . $layoutId);
        }

        $settings = self::_arrayReplaceRecursive($basicSettings, $layoutSettings);

        return $settings;
    }

    private function _getLayoutToCategory()
    {
        $query = $this->db->query("SELECT `category_id` FROM `oc_category` WHERE `status`='1'");
        $activeCategoriesIds = [];
        foreach ($query->rows as $row) {
            $activeCategoriesIds[] = intval($row['category_id']);
        }

        $categories = [];

        $layoutId = 0;
        while ($set = $this->config->get('brainyfilter_layout_' . $layoutId)) {
            if ($set['layout_enabled'] && isset($set['categories'])) {
                foreach ($set['categories'] as $categoryId => $onecat) {
                    $categoryId = intval($categoryId);
                    if ($onecat == 1 && in_array($categoryId, $activeCategoriesIds)) {
                        $categories[ $categoryId ] = $layoutId;
                    }
                }
            }

            $layoutId ++;
        }

        ksort($categories);

        return $categories;
    }

    private static function _arrayReplaceRecursive($array, $array1)
    {
        if (is_array($array1) && count($array1)) {
            foreach ($array1 as $key => $value) {
                if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
                    $array[$key] = array();
                }

                if (is_array($value)) {
                    $value = self::_arrayReplaceRecursive($array[$key], $value);
                }
                $array[$key] = $value;
            }
        }
        return $array;
    }
}

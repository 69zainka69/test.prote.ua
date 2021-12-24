<?php
class ControllerFeedGoogleSitemap extends Controller {
  private $datestamp;
  
	public function index() {
            if ($this->config->get('google_sitemap_status')) {
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

			// $this->load->model('catalog/manufacturer');

			// $manufacturers = $this->model_catalog_manufacturer->getManufacturers();

      
//			foreach ($manufacturers as $manufacturer) {
//				$output .= '<url>';
//				$output .= '<loc>' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']) . '</loc>';
//				$output .= '<changefreq>weekly</changefreq>';
//				$output .= '<priority>0.7</priority>';
//				$output .= '</url>';
//
//				$products = $this->model_catalog_product->getProducts(array('filter_manufacturer_id' => $manufacturer['manufacturer_id']));
//
//				foreach ($products as $product) {
//					$output .= '<url>';
//					$output .= '<loc>' . $this->url->link('product/product', 'manufacturer_id=' . $manufacturer['manufacturer_id'] . '&product_id=' . $product['product_id']) . '</loc>';
//					$output .= '<changefreq>weekly</changefreq>';
//					$output .= '<priority>1.0</priority>';
//					$output .= '</url>'."\n";
//				}
//			}

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

                        $filter_data = array(
                        );

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

//                            $data['all_articles'][] = array (
//                                'title' 		=> html_entity_decode($articles['title'], ENT_QUOTES),
//                                'image'			=> $this->model_tool_image->resize($articles['image'], 100, 100),
//                                'description' 	=> (strlen(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))) > 150 ? mb_substr(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES)), 0, 150) . '...' : strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))),
//                                'view' 			=> $this->url->link('information/articles/articles', 'articles_id=' . $articles['articles_id']),
//                                'date_added' 	=> date($this->language->get('date_format_short'), strtotime($articles['date_added']))
//                            );
                        }


			$output .= '</urlset>';

			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($output);
		}
	}
  

  public function mapindex() {

      $parts=array("sitemapc.xml", "sitemapf0.xml", "sitemapf1.xml", "sitemapi.xml", "sitemapp.xml");
      $output = '';
      foreach ($parts as $item) {
          $output .= '<sitemap><loc>https://prote.ua/'.$item."</loc>\n<lastmod>".date('Y-m-d')."</lastmod></sitemap>\n";
      }
      $output="<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n".$output."</sitemapindex>";
      $this->response->addHeader('Content-Type: application/xml');
      $this->response->setOutput($output);

  }

  public function filters() {
      $partId = 0;      
      if (isset($this->request->get['part'])) $partId = $this->request->get['part'];
      
    // По умолчанию, файлы разбиваются на части по 50 категорий в каждой
		if ($this->config->get('google_sitemap_status')) {
      $this->datestamp=date('Y-m-d');
      
			$output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
			$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";
      
			$this->load->model('catalog/product');	
      
      
      $cattable=$this->_getLayoutToCategory();
      // echo count($cattable);
      $cattable=array_slice($cattable, $partId*50, 50, true);
      // echo '<pre>';print_r($cattable); die();
      
      foreach ($cattable as $key=>$val) {
        $output .= $this->getCategoriesFilters($key);
      }  
      
			$output .= '</urlset>';

			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($output);
      
		}
	}
  
  public function images() {
      
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
            if  (file_exists('/var/www/prote.com.ua' . $path_name)) {
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
  

    protected function getCategories($parent_id, $current_path = '') {
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
  // Получение фильтров для категорий   
  protected function getCategoriesFilters($parent_id, $current_path = '') {
      
      $this->load->model('module/brainyfilter');
      
      global $datestamp; 
  		
      $output = '';
      
      
	
      $cattable=$this->_getLayoutToCategory();
      
      $key0=$parent_id;
      $val0= $cattable[$key0];
      
        
      // Путь от корня до фильтра          
      if (!$current_path) {
		    	$new_path = $key0;
		  } else {
  				$new_path = $current_path . '_' . $key0;
 			}
        
      $categoryadd=$this->url->link('product/category', 'path=' . $new_path);
      
      
      $settings = $this->_getSettings($val0);
      
      // echo '<pre>'; print_r($settings); echo '</pre>';
      // $data = $this->_prepareFilterInitialData();
      
      $data = array (
          'filter_category_id'=>$key0, 
          'filter_sub_category'=>false           
      );
      
      
      $this->model_module_brainyfilter->setData($data);
      
      $arr = $this->model_module_brainyfilter->getFilters(true);
      
      $this->_applySettings($arr, 'filters', $settings);
      // $this->_applySettings($arr, 'attributes', $settings);
      // $this->_applySettings($arr, 'options', $settings);
      $e=$this->url->link('product/category', array('path'=>$new_path)).'instock/';
      
      $output .= '<url>'."\n".
                  '<loc>' .$e.'</loc>' ."\n".
                  '<lastmod>' . $this->datestamp . '</lastmod>' ."\n". 
                  '<changefreq>weekly</changefreq>' ."\n".
                  '<priority>0.7</priority>'."\n".
                  '</url>'; 
      
      $e=str_replace('prote.ua', 'prote.ua/ua', $e);
      
      $output .= '<url>'."\n".
                  '<loc>' .$e.'</loc>' ."\n".
                  '<lastmod>' . $this->datestamp . '</lastmod>' ."\n". 
                  '<changefreq>weekly</changefreq>' ."\n".
                  '<priority>0.7</priority>'."\n".
                  '</url>'; 
      
      foreach ($arr as $key=>$val) {
        foreach ($val as $val1) {
           foreach ($val1 as $val2) { 
             // Проверка на наличие товара по данному фильтру
             // echo '<p>'.$key0,$key, $val2['id'], '-',$this->model_catalog_product->getFilteredProductsCount($key0, $key, $val2['id']);
              
             if ($this->model_catalog_product->getFilteredProductsCount($key0, $key, $val2['id']) ) {
               
               // Создание УРЛ и добавление в сайтмап            
               $e=$this->url->link('product/category', array('path'=>$new_path, 'bfilter'=>'f'.$key.':'.$val2['id'].';')); 
               
               // Отсекаем фильтра без настроенных УРЛ
               if (strpos($e, 'index.php')===false) {
                    $output .= '<url>'."\n".
                       '<loc>' .$e.'</loc>' ."\n".
                       '<lastmod>' . $this->datestamp . '</lastmod>' ."\n". 
                       '<changefreq>weekly</changefreq>' ."\n".
                       '<priority>0.7</priority>'."\n".
                       '</url>';

                    $e=str_replace('prote.ua', 'prote.ua/ua', $e);   

                    $output .= '<url>'."\n".
                       '<loc>' .$e.'</loc>' ."\n".
                       '<lastmod>' . $this->datestamp . '</lastmod>' ."\n". 
                       '<changefreq>weekly</changefreq>' ."\n".
                       '<priority>0.7</priority>'."\n".
                       '</url>'; 
               }
               // 
             }                     
           } 
        }
      }       
      
		  return $output;
	}
  
  
  
   // From BRAINYFILTER add-on
   // 
   private function _applySettings(&$filters, $type, $settings)
    {
        if (!is_array($filters) || !count($filters) || !isset($settings[$type])) {
            return;
        }
        $secSettings = $settings[$type];
        // print_r($secSettings);
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
    
     private function _getSettings($layoutId)
    {
        $bfSettings = array();
        if ($this->config->get('brainyfilter_layout_basic')) {
            $bfSettings['basic'] = $this->config->get('brainyfilter_layout_basic');
        }
        $i = 0;
        while ($set = $this->config->get('brainyfilter_layout_' . $i)) {
            $bfSettings[$i] = $set;
            $i ++;
        }
        // echo '<pre>'; print_r($bfSettings); echo '</pre>';
        $settings   = self::_arrayReplaceRecursive($bfSettings['basic'], $bfSettings[$layoutId]);
        
        return $settings;
    }
    
    private function _getLayoutToCategory() {
        
       
        $cattable=array();
        $i = 0;
        while ($set = $this->config->get('brainyfilter_layout_' . $i)) {
            if ($set['layout_enabled']) {
            
              foreach ($set['categories'] as $key=>$onecat) {
                  // echo $key,'=>',$onecat;
                  if ($onecat==1) {
                     $cattable[$key]=$i;  
                  }  
              }
            }           
            
            $i ++;
        }
        return $cattable;
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

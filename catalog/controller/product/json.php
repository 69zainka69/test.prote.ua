<?php
class ControllerProductJson extends Controller {
    public function index() {
        $this->language->load('product/json');

        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        $this->load->model('tool/image');
        // $results1 = $this->model_catalog_category->getCategoriesByFilter($filter_data);
        if (isset($this->request->get['search'])) {
            $search = $this->request->get['search'];
            $searches_data = $this->request->get['search']; 
        } else {
            $search = '';
        }
       
        if (isset($this->request->get['langid'])) $this->config->set('config_language_id', $this->request->get['langid']);

        if (isset($this->request->get['search'])) {
            $filter_data = array(
                'filter_name'         => $search,
                'langid'              => $this->request->get['langid'],
                'start'               => 0,
                'limit'               => 4
            );

            //$results = $this->model_catalog_product->getProductsByFilter($filter_data);
            $results = $this->model_catalog_product->getProductsSearchFullText($filter_data);

            $filter_data = array(
                'filter_name'         => $search,
                'langid'              => $this->request->get['langid']
            );

            //$resultscat = $this->model_catalog_category->getCategoriesByFilter($filter_data);
            $resultscat = $this->model_catalog_category->getCategoriesSearchFullText($filter_data);

            // print_r($results1);
        } else {
            $results = array();
        }

        $data['categories'] = array();

        foreach ($resultscat as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'],70,70);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png',70,70);
            }

            // Шаблоны для выделения поисковых слов
            $searchlist=explode(' ', trim($search));
            $searchpatterns=array();
            foreach ($searchlist as $searchword) {
               $searchpatterns[]='/('. $searchword .')/iu';
            }

            $href= $this->url->link('product/search', 'category_id=' . $result['category_id'].'&search='.$search);
            //if ($this->request->get['langid']==2) $href=str_replace('prote.ua/', 'prote.ua/ua/', $href);

            $data['categories'][] = array(
                'product_id'  => $result['category_id'],
                'thumb'       => $image,
                //'name'        => preg_replace($searchpatterns, '<strong class="search-excerpt">\0</strong>', $result['name']),
                'name'        => $result['name'].' ('.$result['count'].')',
                'nametitle'        => $result['name'],
                'price'       => 0,
                'special'     => 0,
                'href'        =>  $href
            );
        }

        foreach ($results as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'],70,70);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png',70,70);
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }

            if ((float)$result['special']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $special = false;
            }

         

            $href= $this->url->link('product/product', 'product_id=' . $result['product_id']);
            //if ($this->request->get['langid']==2) $href=str_replace('prote.ua/', 'prote.ua/ua/', $href);

       

            $data['products'][] = array(
                'product_id'  => $result['product_id'],
                'thumb'       => $image,
                //'name'        => preg_replace($searchpatterns, '<strong class="search-excerpt">\0</strong>', $result['name']),
                'name'        => $result['name'],
                'nametitle'        => $result['name'],
                'price'       => $price,
                'special'     => $special,
                'href'        =>  $href
            );
        }

        $products_html ='';
        if($data['products']){

            foreach ($data['products'] as $key => $product) {

                $products_html .= '<div class="item">';
                $products_html .= '<div class="image"><a href="'.$product['href'].'" alt="'.$product['nametitle'].'" title="'.$product['nametitle'].'"><img src="'.$product['thumb'].'"></a></div>';
                $products_html .= '<div class="text"><div class="name"><a href="'.$product['href'].'" alt="'.$product['nametitle'].'" title="'.$product['nametitle'].'">'.$product['name'].'</a>';
                if($product['price']){
                    $products_html .= '<div class="price">';
                    if($product['special']) {
                        $products_html .= '<span class="old-price">'.$product['price'].'</span> <span class="new-price">'.$product['special'].'</span>';
                    } else {
                        $products_html .= '<span class="price">'.$product['price'].'</span>';
                    }
                    $products_html .= '</div>';
                }
                $products_html .= '</div></div></div>';
            }

        }

        $categories_html = '';
        if($data['categories']){
            $categories_html .= '<div class="title">'.$this->language->get('text_categories').'</div>';
            foreach ($data['categories'] as $key => $category) {

                if($searches_data == "h-tone" || $searches_data == "h tone" || $searches_data == "htone" || $searches_data == "H tone" || $searches_data == "Htone" || $searches_data == "H-tone"){
                 if($category['nametitle'] != "Картриджи лазерные" && $category['nametitle'] && "Тонер для заправки картриджей" && $category['nametitle'] != "Картриджі лазерні" && $category['nametitle'] != "Тонер для заправки картриджів"){
                    $categories_html .= '<div class="item">';
                    $categories_html .= '<div class="text"><div class="name">
                    <a href="'.$category['href'].'" alt="'.$category['nametitle'].'" title="'.$category['nametitle'].'">'.$category['name'].'</a>';
                    $categories_html .= '</div></div></div>';
                 }

             }else{
                $categories_html .= '<div class="item">';
                $categories_html .= '<div class="text"><div class="name">
                <a href="'.$category['href'].'" alt="'.$category['nametitle'].'" title="'.$category['nametitle'].'">'.$category['name'].'</a>';
                $categories_html .= '</div></div></div>';
             }

     
            }
            $categories_html .= '<div class="allres"><a href="search/?search='.$search.'">'.$this->language->get('text_all_results').'</a></div>';
        }

        if ($categories_html) {
            $html = '<div class="search_result">';
            $html .= '<div class="result_categories">'.$categories_html.'</div>';
            $html .= '<div class="result_products">'.$products_html.'</div>';
            $html .= '</div>';
        } else {
            $html = '<div class="search_result"><span class="result_not_found">'.$this->language->get('text_not_found').'</span></div>';
        }

        $json['html'] = $html;
        $json['search'] = $search;
        $json['count'] = count($data['products']);

        header('Content-Type: application/json');
        header('Content-Type: text/html; charset=utf-8');
        echo json_encode($json);

    }
}

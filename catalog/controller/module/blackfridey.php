<?php
class ControllerModuleBlackfridey extends Controller {

	public function index() {

    	$this->load->model('extension/news');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$this->language->load('module/blackfridey');
		$data['heading_title1'] = $this->language->get('heading_title1');
		$data['text_addcart1'] = $this->language->get('text_addcart1');


		$news_id = 41;

 		$forse = 0;
		$news = $this->model_extension_news->getNews($news_id,$forse);
		if(!$news)return;

		$this->load->language('module/blackfridey');
		if ($news) {
			$related_prod_id = $this->model_extension_news->getNewsRelatedProducts($news_id);

            foreach ($related_prod_id as $key => $prod_id) {

            	$result = $this->model_catalog_product->getProduct($prod_id['product_id']);
            	if(empty($result))continue;

            	//if ($result['image'] && file_exists('/var/www/prote.com.ua/image/' . $result['image'])) {
                if ($this->model_tool_image->isImageExists($result['image'])) {
	                $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
	            } else {
	                $image = $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
	            }

	            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
	                    //$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
	                    $price = (int)$this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')).' ₴';
	            } else {
	                    $price = false;
	            }

	            if ((float)$result['special']) {
	                    //$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
	                    $special = (int)$this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')).' ₴';
	            } else {
	                    $special = false;
	            }
	            //vdump($result['special']);
	            //$special = 16999 .' ₴';

	            if ($this->config->get('config_tax')) {
	                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
	            } else {
	                    $tax = false;
	            }

	            if ($this->config->get('config_review_status')) {
	                    $rating = (int)$result['rating'];
	            } else {
	                    $rating = false;
	            }

	            // Акции!
	            $action=array();
	            if ($result['news']) {
	                $newslist=  explode(',', $result['news']);
	                foreach ($newslist as $n) {
	                    $atcion_news = $this->model_extension_news->getNews($n);
	                    if($atcion_news){
	                        if (is_numeric($n)) $action[]=$atcion_news;
	                    }

	                }
	            }
	            	//MOU-LOG-M100-USB-GR
	            //$category_info = $this->model_catalog_category->getCategory($result['category']);

	            //$data['products'][$result['category']][] = array(
	            $ttt = 'text_'.$result["mpn"];
	            //$ttt = $this->language->get($ttt);
	            //echo $ttt;
	            $data['products'][] = array(
	                'product_id'  => $result['product_id'],
	                'thumb'       => $image,
	                'mpn'       => $result['mpn'],
	                //'category_name'        => $category_info['name'],
	                //'name'        => htmlspecialchars($result['name']),
	                'name'        => $this->language->get($ttt),
	                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
	                'price'       => $price,
	                'special'     => $special,
	                'tax'         => $tax,
	                'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
	                'rating'      => $result['rating'],
	                'ifexist'     => $result['ifexist'],
	                'quantity'    => $result['quantity'],
	                'tag'         => htmlspecialchars($result['tag']),
	                'jan'         => $result['jan'],
	                'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id']),
	                'action'      => $action

	            );

            }
        }
        //vdump( $data['products']);

    	//$this->response->setOutput($this->load->view('default/template/module/blackfridey.tpl', $data));
    	return $this->load->view('default/template/module/blackfridey.tpl', $data);
    	//echo  $this->load->view('default/template/module/blackfridey.tpl', $data);

    }
}
<?php
class ControllerInformationWorkers extends Controller {
	public function index() {
		$this->load->language('information/workers');

		//$this->load->model('catalog/workers');

		$data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
              'text' => $this->language->get('text_home'),
              'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/workers')
        );

		if (isset($this->request->get['workers_id'])) {
			$workers_id = (int)$this->request->get['workers_id'];
		} else {
			$workers_id = false;
		}

    $data['send_button'] = $this->language->get('send_button');

    $data['text_image'] = $this->language->get('text_image');
    $data['text_model'] = $this->language->get('text_model');
    $data['text_name'] = $this->language->get('text_name');
    $data['text_price'] = $this->language->get('text_price');
    $data['text_quantity'] = $this->language->get('text_quantity');
    $data['text_total'] = $this->language->get('text_total');

		if(!$workers_id){

        $this->document->setTitle($this->language->get('meta_title'));
        $this->document->setDescription($this->language->get('meta_description'));

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_1'] = $this->language->get('text_1');
        $data['text_2'] = $this->language->get('text_2');
        $data['text_3'] = $this->language->get('text_3');
        $data['text_ul'] = $this->language->get('text_ul');


         $this->load->language('information/solutions');
        $data['langurl']=$langurl=($this->language->get('code')=='uk'?'/ua':'');
        $data['text_slog'] = sprintf($this->language->get('text_slog'),$langurl,$langurl);


        /* тянем с readycart */
        $this->load->language('information/readycart');
        $data['text_title1'] = $this->language->get('text_title1');
        $data['text_title2'] = $this->language->get('text_title2');
        $data['text_text1_1'] = $this->language->get('text_text1_1');
        $data['text_text2_1'] = $this->language->get('text_text2_1');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('default/template/information/workers/workers_list.tpl', $data));
    } else {

       /* тянем с readycart */
        $this->load->language('information/readycart');
        $data['text_title1'] = $this->language->get('text_title1');
        $data['text_title2'] = $this->language->get('text_title2');
        $data['text_text1_1'] = $this->language->get('text_text1_1');
        $data['text_text2_1'] = $this->language->get('text_text2_1');



        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->load->model('information/workers');

        //212 213 214
        //echo $this->language->get('text_quant1');

        if($workers_id==212){
          $data['text_quant'] = $this->language->get('text_quant1');
        }elseif($workers_id==213){
          $data['text_quant'] = $this->language->get('text_quant2');
        }elseif($workers_id==214){
          $data['text_quant'] = $this->language->get('text_quant3');
        }

        $workers = $this->model_information_workers->getWorkers($workers_id);

        if($workers){


          if($workers['meta_h1']){
            $data['heading_title'] = $workers['meta_h1'];
          } else {
            $data['heading_title'] = $workers['name'];
          }

          $this->document->setTitle($workers['meta_title']);
          $this->document->setDescription($workers['meta_description']);

          $data['breadcrumbs'][] = array(
              'text' => $workers['name'],
              'href' => $this->url->link('information/workers','workers_id='.$workers_id)
          );

          $workers['description'] = html_entity_decode($workers['description'], ENT_QUOTES, 'UTF-8');

          if(isset($workers['products'])){
            $totals=0;
            $this->load->model('catalog/product');
            $this->load->model('tool/image');
            foreach ($workers['products'] as $key => $product) {

              $product_info = $this->model_catalog_product->getProduct($product['product_id']);

              if ($this->model_tool_image->isImageExists($product_info['image'])) {
                  $image = $this->model_tool_image->resize($product_info['image'], 85, 85);
              } else {
                  $image = $this->model_tool_image->resize('no-photo-img.png', 85, 85);
              }

              if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                  $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
              } else {
                  $price = false;
              }
              if ((float)$product_info['special']) {
                  $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
              } else {
                  $special = false;
              }

              $total = (int)$product['quantity']*$product_info['price'];
              $total = $this->currency->format($this->tax->calculate($total, $product_info['tax_class_id'], $this->config->get('config_tax')));
              $totals += $product['quantity']*$product_info['price'];

              $workers['products'][$key] =array(
                'product_id'  =>  $product_info['product_id'],
                'name'  =>  $product_info['name'],
                'model'  =>  $product_info['model'],
                'sku'  =>  $product_info['sku'],
                'quantity'  =>  $product['quantity'],
                'image'  =>  $image,
                'price'  =>  $price,
                'special'  =>  $special,
                'price_float'  => round($product_info['price'],2),
                'total'  =>  $total,
                'href'  =>  $this->url->link('product/product', 'product_id=' . $product['product_id'])
              );
            }
          }

          $data['totals'] = $this->currency->format($this->tax->calculate($totals, $product_info['tax_class_id'], $this->config->get('config_tax')));
          $data['workers'] = $workers;

        } else {
            // error
            $not_found =true;
        }

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('default/template/information/workers/workers_form.tpl', $data));
		}

    if(isset($not_found)){

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/workers', 'workers_id=' . $workers_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');
			$data['text_error'] = $this->language->get('text_error');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['continue'] = $this->url->link('common/home');
			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));

		}
	}

}
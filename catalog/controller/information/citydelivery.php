<?php

class ControllerInformationCitydelivery extends Controller {
    public function index() {

        $this->load->model('localisation/zone');
        $data['cityes']= $this->model_localisation_zone->getZonesByCountryId(220);

        foreach ($data['cityes'] as $key => $city){
            $data['cityes'][$key]['href'] =$this->url->link('information/citydelivery', 'information_id=6&city=' . $city['zone_id']);
        }

        $h1 = '';
        $city_id=0;
        $description='';
        $title='';
        if(isset($this->request->get['city'])){
            //$cityInfo=$this->model_localisation_zone->getZone($this->request->get['city']);
            $cityDescription=$this->model_localisation_zone->getZoneDescription($this->request->get['city']);

            if($cityDescription['meta_h1']){
                $h1= $cityDescription['meta_h1'];
            } else {
                $h1= $cityDescription['name'];
            }

            $description= $cityDescription['description'];
            $city_id = $this->request->get['city'];
            $this->document->setTitle($cityDescription['meta_title']);

            if($cityDescription['meta_description']){
                $this->document->setDescription($cityDescription['meta_description']);
            }

        }
        $data['heading_title']=$h1;
        $this->document->addLink($this->url->link('information/citydelivery', 'information_id=6&city=' . $city_id), 'canonical');
        //vdump($data['heading_title']);

        $this->load->language('information/citydelivery');
        $data['delivery_more_city'] = $this->language->get('delivery_more_city');
        $data['delivery_text_title'] = $this->language->get('delivery_text_title');
        $data['delivery_text'] = $this->language->get('delivery_text');

        $this->load->language('information/html/delivery');

        $data['button_more'] = $this->language->get('button_more');
        $data['text_nova_poshta_tite'] = $this->language->get('text_nova_poshta_tite');
        // $data['text_intaim_tite'] = $this->language->get('text_intaim_tite');
        $data['text_justin_tite'] = $this->language->get('text_justin_tite');
        $data['text_ukrposhta_tite'] = $this->language->get('text_ukrposhta_tite');
        $data['text_nichnyy_ekspres_tite'] = $this->language->get('text_nichnyy_ekspres_tite');
        $data['text_delivery_title1'] = $this->language->get('text_delivery_title1');
        $data['text_delivery_title2'] = $this->language->get('text_delivery_title2');
        $data['text_delivery_title3'] = $this->language->get('text_delivery_title3');

        ////////////////////////////////////////////////////

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
                'text' => 'Доставка по Украине',
                'href' => $this->url->link('information/information', 'information_id=6')
        );

        $data['breadcrumbs'][] = array(
                'text' => $h1,
                //'href' => $this->url->link('information/contact')
                'href' => false
        );





        //$data['description']=$text;
        $data['description'] = html_entity_decode($description, ENT_QUOTES, 'UTF-8');

        $data['button_delivery'] = $this->url->link('information/information', 'information_id=6');

        //$this->document->setTitle($h1 .' '. str_replace(array('{CITY}'), array($cityname), $res['meta_title']));
        //$this->document->setTitle($h1 .' '. str_replace(array('{CITY}'), array($cityname), $res['meta_title']));
        /*$this->document->setDescription(str_replace(array('{CITY}'), array($cityname), $res['meta_description']));
        $this->document->setKeywords(str_replace(array('{CITY}'), array($cityname), $res['meta_keywords']));*/

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('default/template/information/citydelivery_new.tpl', $data));


    }
}


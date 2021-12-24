<?php

    class ControllerDQuickcheckoutShippingMethod extends Controller {

        public function index($config) {

            $this->load->model('d_quickcheckout/method');
            $this->load->model('d_quickcheckout/address');
            $this->load->model('module/d_quickcheckout');
            $this->model_module_d_quickcheckout->logWrite('controller:: shipping_method/index');

            if (!$config['general']['compress']) {
                $this->document->addScript('catalog/view/javascript/d_quickcheckout/model/shipping_method.js');
                $this->document->addScript('catalog/view/javascript/d_quickcheckout/view/shipping_method.js');
            }

            $data['col'] = $config['account']['guest']['shipping_method']['column'];
            $data['row'] = $config['account']['guest']['shipping_method']['row'];
            // $data['regions']=$this->model_d_quickcheckout_address->getNPRegions();

            $this->load->language('checkout/checkout');
            $data['city_shipping_address'] = $this->language->get('city_shipping_address');
            $data['city2_shipping_address'] = $this->language->get('city2_shipping_address');
            $data['text_filter_np_city'] = $this->language->get('text_filter_np_city');
            $data['text_filter_just_city'] = $this->language->get('text_filter_np_city');
            $data['text_filter_meest_city'] = $this->language->get('text_filter_np_city');
            $data['warehouse_shipping_address'] = $this->language->get('warehouse_shipping_address');
            $data['warehouse2_shipping_address'] = $this->language->get('warehouse2_shipping_address');

            $data['text_warning_title'] = $this->language->get('text_warning_title');
            $data['text_warning_body'] = $this->language->get('text_warning_body');

            $this->prepare([]);
            $json['account'] = $this->session->data['account'];
            $json['shipping_methods'] = $this->session->data['shipping_methods'];
            $json['shipping_method'] = $this->session->data['shipping_method'];
            $json['show_shipping_method'] = $this->model_d_quickcheckout_method->shippingRequired();
            if (empty($this->session->data['shipping_methods'])) {
                $json['shipping_error'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
            } else {
                $json['shipping_error'] = '';
            }
            $data['json'] = json_encode($json);

            if(VERSION >= '2.2.0.0'){
                $template = 'd_quickcheckout/shipping_method';
            }elseif (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/d_quickcheckout/shipping_method.tpl')) {
                $template = $this->config->get('config_template') . '/template/d_quickcheckout/shipping_method.tpl';
            } else {
                $template = 'default/template/d_quickcheckout/shipping_method.tpl';
            }

            return $this->load->view($template, $data);
        }

        public function update() {
            $this->load->model('d_quickcheckout/order');
            $this->load->model('module/d_quickcheckout');

            $json = array();

            $json = $this->prepare($json);

            //payment method - for xshipping (optimization needed)
            $json = $this->load->controller('d_quickcheckout/payment_method/prepare', $json);

            $totals = array();
            $taxes = $this->cart->getTaxes();
            $total = 0;

            $total_data = array(
                'totals' => &$totals,
                'taxes'  => &$taxes,
                'total'  => &$total
            );

            $json['totals'] = $this->session->data['totals'] = $this->model_d_quickcheckout_order->getTotals($total_data);
            $json['total'] = $this->model_d_quickcheckout_order->getCartTotal($total);
            $json['order_id'] = $this->session->data['order_id'] = $this->load->controller('d_quickcheckout/confirm/updateOrder');

            //payment
            $json = $this->load->controller('d_quickcheckout/payment/prepare', $json);

            //statistic
            $statistic = array(
                'update' => array(
                    'shipping_method' => 1
                )
            );




            $this->model_module_d_quickcheckout->updateStatistic($statistic);

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }

         public function prepareuser($json) {

            $this->log->write('=== prepareuser start === ');
            $this->log->write($this->request->post);
            $this->log->write('=== prepareuser end === ');


            $this->load->model('module/d_quickcheckout');
            $this->load->model('d_quickcheckout/method');
            $this->load->model('d_quickcheckout/address');
            $this->load->model('d_quickcheckout/order');

            $this->session->data['shipping_methods'] = $this->model_d_quickcheckout_method->getShippingMethods($this->model_d_quickcheckout_address->paymentOrShippingAddress());

            if (isset($this->request->post['shipping_method'])) {
                $shipping = explode('.', $this->request->post['shipping_method']);
                $this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
            }

            // Пользователь указал адрес для адресной доставки
            if (isset($this->request->post['flat_address'])) {

                $flat_address = $this->request->post['flat_address'];
                $this->session->data['shipping_method']['flat_address'] = $flat_address;


            }

            // Пользователь указал адрес для адресной укрпочты
            if (isset($this->request->post['ukrpost_address'])) {

                $ukrpost_address = $this->request->post['ukrpost_address'];
                $this->session->data['shipping_method']['ukrpost_address'] = $ukrpost_address;

            }

            // ночной єкспресс free.free
            if (isset($this->request->post['free_address'])) {

                $free_address = $this->request->post['free_address'];
                $this->session->data['shipping_method']['free_address'] = $free_address;
            }
         }

        public function prepare($json) {
            $this->load->model('module/d_quickcheckout');
            $this->load->model('d_quickcheckout/method');
            $this->load->model('d_quickcheckout/address');
            $this->load->model('d_quickcheckout/order');

            $this->session->data['shipping_methods'] = $this->model_d_quickcheckout_method->getShippingMethods($this->model_d_quickcheckout_address->paymentOrShippingAddress());

            if (isset($this->request->post['shipping_method'])) {
                $shipping = explode('.', $this->request->post['shipping_method']);
                $this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
            }

            // Пользователь указал адрес для адресной доставки
            if (isset($this->request->post['flat_address'])) {

                $flat_address = $this->request->post['flat_address'];
                $this->session->data['shipping_method']['flat_address'] = $flat_address;


            }

            // Пользователь указал адрес для адресной укрпочты
            if (isset($this->request->post['ukrpost_address'])) {

                $ukrpost_address = $this->request->post['ukrpost_address'];
                $this->session->data['shipping_method']['ukrpost_address'] = $ukrpost_address;
            }
            // ночной єкспресс free.free
            if (isset($this->request->post['free_address'])) {

                $free_address = $this->request->post['free_address'];
                $this->session->data['shipping_method']['free_address'] = $free_address;
            }

            // Список областей
           /* $npregions=$this->model_d_quickcheckout_address->getNPRegions();*/
            $npregionselect='';
            $npcitysselect='';
            $npwhselect='';
            /*foreach ($npregions as $npregion) {
              $npregionselect .= "<option value='" . $justregion['id'] ."'>" . $justregion['name_1'] . "</option>\n";
            }*/
            //             $this->session->data['shipping_method']['npwhselect']='';
            //             $this->session->data['shipping_method']['npcitysselect']='';


            $npfullpath = array();

            $np_region ='';
            if (isset($this->request->post['np_region'])) {
                $np_region = $this->request->post['np_region'];
            }

                //Список областей
                $npregions=$this->model_d_quickcheckout_address->getNPRegions();

               foreach ($npregions as $npregion) {
                  $npregionselect .= "<option value='" . $npregion['id'] ."'";
                  if ($npregion['id']==$np_region) {
                     $npfullpath[] = $npregion['name_1'] . ' обл.';
                     $npregionselect .= ' selected';
                  }
                  $npregionselect .= ">" . $npregion['name_1'] . "</option>\n";
               }



                if (isset($this->request->post['np_city'])) {
                    $np_city = $this->request->post['np_city'];
                    $this->session->data['shipping_m']['np_city'] = $np_city;
                }  elseif (isset($this->session->data['shipping_m']['np_city'])) {
                    $np_city= $this->session->data['shipping_m']['np_city'];
                }  else {
                    $np_city = '00000000000000';
                }



                //$np_city = $this->request->post['np_city'];
                // Список населенных пунктов области
                $npcitys=$this->model_d_quickcheckout_address->getNPCities($np_region);



                $npcitysselect ='';
                $npcity_selected ='';

                $lang = $this->language->get('code');
                $lang = ($lang == 'uk') ? 'uk' : 'ru';
           
            
                if($np_city === '00000000000000') {
                    if($lang === 'uk') {
                        $npcity_selected = urldecode($_COOKIE['city_UA']);
                    } elseif($lang === 'ru') {
                        $npcity_selected = urldecode($_COOKIE['city_RU']);
                    }

                    $np_city = $this->model_d_quickcheckout_address->findCityByName($npcity_selected)->row['id'];
                    $this->session->data['np_city'] = $np_city;
                }
                
                foreach ($npcitys as $npcity) {
                   $npcitysselect .= "<option value='" . $npcity['id'] . "'";
                   if ($npcity['id']==$np_city) {
                       $npfullpath[] = $npcity['name'];
                       //$npfullpath[] = $npcity['name_1'];
                       $npcitysselect .= ' selected';
                       $npcity_selected = $npcity['name'];
                   }
                   $npcitysselect .= ">" . $npcity['name'] ."</option>\n";

                }

                // $this->session->data['shipping_method']['np_region'] = $np_region;




                //if (isset($this->request->post['np_city'])) {
                if (isset($np_city)) {
                    //$np_city = $this->request->post['np_city'];

                     /*if (isset($this->request->post['np_warehouse'])) {
                        $np_warehouse = $this->request->post['np_warehouse'];
                     }*/

                    if (isset($this->request->post['np_warehouse'])) {
                        $np_warehouse = $this->request->post['np_warehouse'];
                        $this->session->data['shipping_m']['np_warehouse'] = $np_warehouse;
                    }  elseif (isset($this->session->data['shipping_m']['np_warehouse'])) {
                        $np_warehouse = $this->session->data['shipping_m']['np_warehouse'];
                    }  else {
                        $np_warehouse = '00000000000000';
                    }
                    // Список складов
                    $npwh=$this->model_d_quickcheckout_address->getNPWarehouses($np_city);
                    if($npwh){
                        foreach ($npwh as $npwhi) {
                           $npwhselect .= "<option value='" . $npwhi['id'] ."'";
                           if ($npwhi['id']==$np_warehouse) {
                               $npfullpath[] = $npwhi['name'];
                               //$npfullpath[] = $npwhi['name'];
                               $npwhselect .=  ' selected';
                           }
                           $npwhselect .= ">" . $npwhi['name'] . "</option>\n";
                        }
                    }

                }

             //}









            /**********************
             * ********************************
             * **********************************
             * JUSTIN
             * **********************************
             * *************************************
             */
// Список областей
           /* $npregions=$this->model_d_quickcheckout_address->getNPRegions();*/
           $justregionselect='';
           $justcitysselect='';
           $justwhselect='';
           /*foreach ($npregions as $npregion) {
             $justregionselect .= "<option value='" . $npregion['id'] ."'>" . $npregion['name_1'] . "</option>\n";
           }*/
           //             $this->session->data['shipping_method']['justwhselect']='';
           //             $this->session->data['shipping_method']['justcitysselect']='';


           $justfullpath = array();

           $just_region ='';
           if (isset($this->request->post['just_region'])) {
               $just_region = $this->request->post['just_region'];
           }

               //Список областей
               $justregions=$this->model_d_quickcheckout_address->getJUSTRegions();

              foreach ($justregions as $justregion) {
                 $justregionselect .= "<option value='" . $justregion['id'] ."'";
                 if ($justregion['id']==$just_region) {
                    $justfullpath[] = $justregion['name_1'] . ' обл.';
                    $justregionselect .= ' selected';
                 }
                 $justregionselect .= ">" . $justregion['name_1'] . "</option>\n";
              }



               if (isset($this->request->post['just_city'])) {
                   $just_city = $this->request->post['just_city'];
                   $this->session->data['shipping_m']['just_city'] = $just_city;
               }  elseif (isset($this->session->data['shipping_m']['just_city'])) {
                   $just_city= $this->session->data['shipping_m']['just_city'];
               }  else {
                   $just_city = '00000000000000';
               }



               //$np_city = $this->request->post['np_city'];
               // Список населенных пунктов области
               $justcitys=$this->model_d_quickcheckout_address->getJUSTCities($just_region);



               $justcitysselect ='';
               $justcity_selected ='';

               foreach ($justcitys as $justcity) {
                  $justcitysselect .= "<option value='" . $justcity['id'] . "'";
                  if ($justcity['id']==$just_city) {
                      $justfullpath[] = $justcity['name'];
                      //$justfullpath[] = $justcity['name_1'];
                      $justcitysselect .= ' selected';
                      $justcity_selected = $justcity['name'];
                  }
                  $justcitysselect .= ">" . $justcity['name'] ."</option>\n";

               }

               // $this->session->data['shipping_method']['just_region'] = $just_region;




               //if (isset($this->request->post['np_city'])) {
               if (isset($just_city)) {
                   //$np_city = $this->request->post['np_city'];

                    /*if (isset($this->request->post['np_warehouse'])) {
                       $np_warehouse = $this->request->post['np_warehouse'];
                    }*/

                   if (isset($this->request->post['just_warehouse'])) {
                       $just_warehouse = $this->request->post['just_warehouse'];
                       $this->session->data['shipping_m']['just_warehouse'] = $just_warehouse;
                   }  elseif (isset($this->session->data['shipping_m']['just_warehouse'])) {
                       $just_warehouse = $this->session->data['shipping_m']['just_warehouse'];
                   }  else {
                       $just_warehouse = '00000000000000';
                   }
                   // Список складов
                   $justwh=$this->model_d_quickcheckout_address->getJUSTWarehouses($just_city);
                   if($justwh){
                       foreach ($justwh as $justwhi) {
                          $justwhselect .= "<option value='" . $justwhi['id'] ."'";
                          if ($justwhi['id']==$just_warehouse) {
                              $justfullpath[] = $justwhi['name'];
                              //$justfullpath[] = $npwhi['name'];
                              $justwhselect .=  ' selected';
                          }
                          $justwhselect .= ">" . $justwhi['name'] . "</option>\n";
                       }
                   }

               }

            //}

            /**********************
             * ********************************
             * **********************************
             * JUSTIN
             * **********************************
             * *************************************
             */
            /**********************
             * ********************************
             * **********************************
             * MEEST
             * **********************************
             * *************************************
             */
// Список областей
           /* $npregions=$this->model_d_quickcheckout_address->getNPRegions();*/
           $meestregionselect='';
           $meestcitysselect='';
           $meestwhselect='';
           /*foreach ($npregions as $npregion) {
             $justregionselect .= "<option value='" . $npregion['id'] ."'>" . $npregion['name_1'] . "</option>\n";
           }*/
           //             $this->session->data['shipping_method']['justwhselect']='';
           //             $this->session->data['shipping_method']['justcitysselect']='';


           $meestfullpath = array();

           $meest_region ='';
           if (isset($this->request->post['meest_region'])) {
               $meest_region = $this->request->post['meest_region'];
           }

               //Список областей
               $meestregions=$this->model_d_quickcheckout_address->getMEESTRegions();

              foreach ($meestregions as $meestregion) {
                 $meestregionselect .= "<option value='" . $meestregion['id'] ."'";
                 if ($meestregion['id']==$meest_region) {
                    $meestfullpath[] = $meestregion['name_1'] . ' обл.';
                    $meestregionselect .= ' selected';
                 }
                 $meestregionselect .= ">" . $meestregion['name_1'] . "</option>\n";
              }



               if (isset($this->request->post['meest_city'])) {
                   $meest_city = $this->request->post['meest_city'];
                   $this->session->data['shipping_m']['meest_city'] = $meest_city;
               }  elseif (isset($this->session->data['shipping_m']['meest_city'])) {
                   $meest_city= $this->session->data['shipping_m']['meest_city'];
               }  else {
                   $meest_city = '00000000000000';
               }



               //$np_city = $this->request->post['np_city'];
               // Список населенных пунктов области
               $meestcitys=$this->model_d_quickcheckout_address->getMEESTCities($meest_region);



               $meestcitysselect ='';
               $meestcity_selected ='';

               foreach ($meestcitys as $meestcity) {
                  $meestcitysselect .= "<option value='" . $meestcity['id'] . "'";
                  if ($meestcity['id']==$meest_city) {
                      $meestfullpath[] = $meestcity['name'];
                      //$justfullpath[] = $justcity['name_1'];
                      $meestcitysselect .= ' selected';
                      $meestcity_selected = $meestcity['name'];
                  }
                  $meestcitysselect .= ">" . $meestcity['name'] ."</option>\n";

               }

               // $this->session->data['shipping_method']['just_region'] = $just_region;




               //if (isset($this->request->post['np_city'])) {
               if (isset($meest_city)) {
                   //$np_city = $this->request->post['np_city'];

                    /*if (isset($this->request->post['np_warehouse'])) {
                       $np_warehouse = $this->request->post['np_warehouse'];
                    }*/

                   if (isset($this->request->post['meest_warehouse'])) {
                       $meest_warehouse = $this->request->post['meest_warehouse'];
                       $this->session->data['shipping_m']['meest_warehouse'] = $meest_warehouse;
                   }  elseif (isset($this->session->data['shipping_m']['meest_warehouse'])) {
                       $meest_warehouse = $this->session->data['shipping_m']['meest_warehouse'];
                   }  else {
                       $meest_warehouse = '00000000000000';
                   }
                   // Список складов
                   $meestwh=$this->model_d_quickcheckout_address->getMEESTWarehouses($meest_city);
                   if($meestwh){
                       foreach ($meestwh as $meestwhi) {
                          $meestwhselect .= "<option value='" . $meestwhi['id'] ."'";
                          if ($meestwhi['id']==$meest_warehouse) {
                              $meestfullpath[] = $meestwhi['name'];
                              //$justfullpath[] = $npwhi['name'];
                              $meestwhselect .=  ' selected';
                          }
                          $meestwhselect .= ">" . $meestwhi['name'] . "</option>\n";
                       }
                   }

               }

            //}

            /**********************
             * ********************************
             * **********************************
             * MEEST
             * **********************************
             * *************************************
             */

            // Список областей для ИНТАЙМ
             /*$inregions=$this->model_d_quickcheckout_address->getINRegions('ru');
             $inregionselect='';
            $incitysselect='';
            $inwhselect='';
             foreach ($inregions as $inregion) {
                $inregionselect .= "<option value='" . $inregion['id'] ."'>" . $inregion['name'] . "</option>\n";
             }*/

            $infullpath = array();

            if (isset($this->request->post['in_region'])) {
                 $in_region = $this->request->post['in_region'];
                 $this->session->data['shipping_m']['in_region'] = $in_region;
            }  elseif (isset($this->session->data['shipping_m']['in_region'])) {
                $in_region = $this->session->data['shipping_m']['in_region'];
            } else {

                $in_region ='';
            }

            // if (isset($this->request->post['in_region'])) {
                 //$in_region = $this->request->post['in_region'];

                // Список областей
                 $inregions=$this->model_d_quickcheckout_address->getNPRegions();
                 $inregionselect ='';
               foreach ($inregions as $inregion) {
                  $inregionselect .= "<option value='" . $inregion['id'] ."'";
                  if ($inregion['id']==$in_region) {
                     //$infullpath[] = $inregion['name'] . ' обл.';
                     $infullpath[] = $inregion['name_1'] . ' обл.';
                     $inregionselect .= ' selected';
                  }
                  $inregionselect .= ">" . $inregion['name_1'] . "</option>\n";
               }

                if (isset($this->request->post['in_city'])) {
                    $in_city = $this->request->post['in_city'];
                    $this->session->data['shipping_m']['in_city'] = $in_city;
                }  elseif (isset($this->session->data['shipping_m']['in_city'])) {
                    $in_city = $this->session->data['shipping_m']['in_city'];
                }  else {
                    $in_city = '';
                }

                // Список населенных пунктов области
                $incitys = array();
                //if($in_region){
                //$incitys = $this->cache->get('getINCities' . $langcode . $_SERVER['HTTPS']);

                $incitys=$this->model_d_quickcheckout_address->getINCities($in_region, 'Ru');

                //}
                $incity_selected='';
                $incitysselect='';
                foreach ($incitys as $incity) {
                   $incitysselect .= "<option value='" . $incity['id'] . "'";

                   if ($incity['id']==$in_city) {
                       $infullpath[] = $incity['name'];
                       $incity_selected = $incity['name'];
                       $incitysselect .= ' selected';
                   }
                   $incitysselect .= ">" . $incity['name'] ."</option>\n";
                }


                $inwhselect ='';
                if ($in_city) {

                    if (isset($this->request->post['in_warehouse'])) {
                        $in_warehouse = $this->request->post['in_warehouse'];
                        $this->session->data['shipping_m']['in_warehouse'] = $in_warehouse;
                    }  elseif (isset($this->session->data['shipping_m']['in_warehouse'])) {
                        $in_warehouse = $this->session->data['shipping_m']['in_warehouse'];

                    }  else {
                        $in_warehouse = '00000000000000';
                    }

                    // Список складов
                    $inwh=$this->model_d_quickcheckout_address->getINWarehouses($in_city, 'ru');


                    foreach ($inwh as $inwhi) {
                       $inwhselect .= "<option value='" . $inwhi['id'] ."'";
                       if ($inwhi['id']==$in_warehouse) {
                           $infullpath[] = $inwhi['name'];
                           $inwhselect .=  ' selected';
                       }
                       $inwhselect .= ">" . $inwhi['name'] . ': '.$inwhi['address']. "</option>\n";
                    }

                }


                 //$this->session->data['shipping_method']['npregionsselect'] = $npregionsselect;
            // }
            //$npregionselect ='';
            //$inregionselect ='';

            $this->session->data['shipping_method']['npregionselect'] = $npregionselect;
            $this->session->data['shipping_method']['npwhselect'] = $npwhselect;
            $this->session->data['shipping_method']['npcitysselect'] = $npcitysselect;
            $this->session->data['shipping_method']['npcity_selected'] = $npcity_selected;
            $this->session->data['shipping_method']['npfullpath'] = implode(',', $npfullpath);

            $this->session->data['shipping_method']['justregionselect'] = $justregionselect;
            $this->session->data['shipping_method']['justwhselect'] = $justwhselect;
            $this->session->data['shipping_method']['justcitysselect'] = $justcitysselect;
            $this->session->data['shipping_method']['justcity_selected'] = $justcity_selected;
            $this->session->data['shipping_method']['justfullpath'] = implode(',', $justfullpath);

            $this->session->data['shipping_method']['meestregionselect'] = $meestregionselect;
            $this->session->data['shipping_method']['meestwhselect'] = $meestwhselect;
            $this->session->data['shipping_method']['meestcitysselect'] = $meestcitysselect;
            $this->session->data['shipping_method']['meestcity_selected'] = $meestcity_selected;
            $this->session->data['shipping_method']['meestfullpath'] = implode(',', $meestfullpath);

            $this->session->data['shipping_method']['inregionselect'] = $inregionselect;
            $this->session->data['shipping_method']['inwhselect'] = $inwhselect;
            $this->session->data['shipping_method']['incitysselect'] = $incitysselect;
            $this->session->data['shipping_method']['incity_selected'] = $incity_selected;
            $this->session->data['shipping_method']['infullpath'] = implode(',', $infullpath);



            if (isset($this->session->data['shipping_method']['code'])) {
                if (!$this->model_module_d_quickcheckout->in_array_multi($this->session->data['shipping_method']['code'], $this->session->data['shipping_methods'])) {
                    $this->session->data['shipping_method'] = $this->model_d_quickcheckout_method->getFirstShippingMethod();
                } else {
                    $shipping = explode('.', $this->session->data['shipping_method']['code']);
                    $this->session->data['shipping_method'] = array_merge($this->session->data['shipping_method'], $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]]);
                }
            }

            if (empty($this->session->data['shipping_method']['code'])) {
                $this->session->data['shipping_method'] = $this->model_d_quickcheckout_method->getFirstShippingMethod();
            }
            //vdump($this->model_d_quickcheckout_method->getFirstShippingMethod());
            //vdump($this->session->data['shipping_method']);
            //$this->session->data['shipping_method'] = '';
            // $this->session->data['shipping_method']['address']='ул.Автозаводская';
            // $this->session->data['shipping_method']['title'] .= 'ул.Автозаводская';


            $json['show_shipping_method'] = $this->model_d_quickcheckout_method->shippingRequired();
            $json['shipping_methods'] = $this->session->data['shipping_methods'];
            //

            if (empty($this->session->data['shipping_methods'])) {
                 $this->load->language('checkout/checkout');
                $json['shipping_error'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
            } else {
                $json['shipping_error'] = '';
            }

            $json['show_confirm'] = $this->model_d_quickcheckout_order->showConfirm();

            $json['shipping_method'] = $this->session->data['shipping_method'];
            // $json['shipping_method']['title'] .= '= Адрес =';

            $this->model_module_d_quickcheckout->logWrite('Controller:: shipping_method/prepare. shipping_methods = ' . json_encode($json['shipping_methods']) . ' shipping_method = ' . json_encode($json['shipping_method']));
            return $json;
        }

      public function autocomplete(){

        $filter_city=false;
        $json = array();
        if(isset($this->request->get['filter_np_city'])){

          $this->load->model('d_quickcheckout/address');

          $filter_city = $this->request->get['filter_np_city'];

          //$json['filter_np_city'] = $filter_np_city;
          //$json['np_cityes'] = $this->model_d_quickcheckout_address->getNPCitiesAutocomplete($filter_np_city);
          $json = $this->model_d_quickcheckout_address->getNPCitiesAutocomplete($filter_city);

        }
        if(isset($this->request->get['filter_just_city'])){

            $this->load->model('d_quickcheckout/address');
  
            $filter_city = $this->request->get['filter_just_city'];
  
            //$json['filter_np_city'] = $filter_np_city;
            //$json['np_cityes'] = $this->model_d_quickcheckout_address->getNPCitiesAutocomplete($filter_np_city);
            $json = $this->model_d_quickcheckout_address->getJUSTCitiesAutocomplete($filter_city);
  
          }

        
        if(isset($this->request->get['filter_meest_city'])){

            $this->load->model('d_quickcheckout/address');
  
            $filter_city = $this->request->get['filter_meest_city'];
  
            //$json['filter_np_city'] = $filter_np_city;
            //$json['np_cityes'] = $this->model_d_quickcheckout_address->getNPCitiesAutocomplete($filter_np_city);
            $json = $this->model_d_quickcheckout_address->getMEESTCitiesAutocomplete($filter_city);
  
          }


        if(isset($this->request->get['filter_in_city'])){

          $this->load->model('d_quickcheckout/address');

          $filter_city = $this->request->get['filter_in_city'];

          //$json['filter_np_city'] = $filter_np_city;
          //$json['np_cityes'] = $this->model_d_quickcheckout_address->getNPCitiesAutocomplete($filter_np_city);
          $json = $this->model_d_quickcheckout_address->getINCitiesAutocomplete($filter_city);

        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

      }

    }

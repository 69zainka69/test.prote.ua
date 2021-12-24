<?php

/**
 * Opencart module: Order callback
 * For Opencart 1.5.x version
 *
 * @copyright Instup.com
 * @author LIAL (dev@instup.com)
 * @vesrion 1.0
 *
 */
class ControllerModuleOrdercallback extends Controller
{
    public function index() {

        $json = array();
        $this->language->load('module/ordercallback');



        $comment = $name = '';
        $data['text_quantity1'] = '';
        if ($this->config->get('ordercallback_use_module')) {
            $data['text_quantity'] = $this->language->get('text_quantity');
            $data = $this->request->post;

            /*
            $data['ordercallback-phone'] = str_replace('_','',$data['ordercallback-phone']);

                //if (isset($data['ordercallback-phone']) && !empty($data['ordercallback-phone']) && mb_strlen($data['ordercallback-phone']) != 18) {
                if (isset($data['ordercallback-phone']) && !empty($data['ordercallback-phone']) ) {

                  /*  $data['ordercallback-phone'] = '';
                    $phone = false;
                }
                */
            if (isset($data['ordercallback-phone']) && !empty($data['ordercallback-phone'])) {
                $phone = $data['ordercallback-phone'];
                if (isset($data['ordercallback-qtyset'])) {
                    $qty =   $data['ordercallback-qtyset'];
                } else {
                    $qty = 1;
                }
                $subject = $this->language->get('ordercallback_email_subject_order');
                if (isset($data['ordercallback-name']) && !empty($data['ordercallback-name'])) {
                    $name = $data['ordercallback-name'];
                }

            } else if (isset($data['callback-phone']) && !empty($data['callback-phone'])) {
                $phone = $data['callback-phone'];
                $subject = $this->language->get('ordercallback_email_subject_call');
                if (isset($data['callback-name']) && !empty($data['callback-name'])) {
                    $name = $data['callback-name'];
                }

            }
            if (isset($data['ordercallback-comment']) && !empty($data['ordercallback-comment'])) {
                $comment = $data['ordercallback-comment'];
            }

            if($phone) {

                if ($this->config->get('ordercallback_send_notification_to_email')) {

                    $message = '';

                    if ($this->config->get('ordercallback_email_text')) {
                        $message .= $this->config->get('ordercallback_email_text') . "\n\n";
                    }

                    $message = str_replace('{phone}', $phone,
                        str_replace('{name}', $name,
                        str_replace('e-mail: {email}', '',
                        str_replace('{comment}', $comment, $message))));

                    if (isset($data['ordercallback-product']) && !empty($data['ordercallback-product'])) {
                        $message .= "\n" . $this->language->get('modal_field_product') . ': ' . $data['ordercallback-product'];
                        $message .= "\n" . "Количество" . ': ' . $qty;
                    }

                    try {
                        $mail = new Mail();
                        $mail->protocol = $this->config->get('config_mail_protocol');
                        $mail->parameter = $this->config->get('config_mail_parameter');
                        $mail->hostname = $this->config->get('config_smtp_host');
                        $mail->username = $this->config->get('config_smtp_username');
                        $mail->password = $this->config->get('config_smtp_password');
                        $mail->port = $this->config->get('config_smtp_port');
                        $mail->timeout = $this->config->get('config_smtp_timeout');
                        $mail->setTo($this->config->get('config_email'));
                        $mail->setFrom($this->config->get('config_email'));
                        
                        $mail->setSender($this->config->get('config_name'));
                        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
                        $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
                        $mail->send();

                        if ($this->config->get('config_alert_emails')) {
                            $emails = explode(',', $this->config->get('config_alert_emails'));
                            foreach ($emails as $email) {
                                $mail->setTo(trim($email));
                                $mail->send();
                                $json['email'][] = $email;
                            }
                        }

                        if ($this->config->get('module_works_as') == 'call') {
                            $json['success'] = $this->language->get('message_success_call');
                        } else {
                            $json['success'] = $this->language->get('message_success_order');
                        }

                        /////////////////////////////////////////////////////////
                        // gdemon 21.11.2019
                        // создание заказа в аксапте
                        $customer =array();

                        $customer['name'] = $name;
                        $customer['email'] = '';
                        $customer['phone'] = $phone;
                        $customer['address'] = '';
                        $OrderLines = array();
                         if (isset($data['ordercallback-product']) && !empty($data['ordercallback-product']) && isset($data['ordercallback-product_id']) && !empty($data['ordercallback-product_id'])) {

                            $this->load->model('catalog/product');
                            $product_info = $this->model_catalog_product->getProduct($data['ordercallback-product_id']);

                            if($product_info){
                                $OrderLines[] = array(
                                    'ID'  =>  $product_info['mpn'],
                                    'OrderQty'  => $qty,
                                    'Price'  =>  ($product_info['special'])?$product_info['special']:$product_info['price'],
                                    'CommentLine'  =>  ''
                                );

                                $DeliveryMethod = 4; // VM, 13.04.2021 Просьба изменить значение по умолчанию 

                                $order = array();
                                $order['CustPaymMode'] = 'Уточните способ оплаты';
                                $order['DoNotCallBack'] = '';
                                $order['DeliveryMethod'] = $DeliveryMethod;//$data['payment_method'];
                                $order['DeliveryRegion'] = '';
                                $order['DeliveryState'] = '';
                                $order['DeliveryCity'] = '';
                                $order['DeliveryNumber'] = '';
                                $order['DeliveryStreet'] = '';
                                $order['DeliveryHouse'] = '';
                                $order['DeliveryFlat'] = '';
                                $order['OrderLines'] = $OrderLines;
                                $order['Comment'] = ($comment)?'Заказ в 1 клік! ['.$comment.']':'Заказ в 1 клік!';
                                $this->load->model('checkout/axapta');
                                $this->model_checkout_axapta->addOrder($customer,$order);
                            }


                        }
                        /////////////////////////////////////////////////////////

                    } catch (Exception $e) {
                        $json['error'] = $e->getMessage();
                    }
                }
            } else {
                $json['error'] = $this->language->get('message_phone_required');
            }
        } else {
            $json['error'] = $this->language->get('message_module_disabled');
        }

        $this->response->setOutput(json_encode($json));
    }
}

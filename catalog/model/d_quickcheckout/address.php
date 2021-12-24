<?php

    /*
     * 	location: admin/model
     */

    class ModelDQuickcheckoutAddress extends Model {
        /*
         * 	This is a Opencart Hack to update the Tax Address, because in opencart
         * 	the addresses are set in system/library/tax.php in _construct before the
         * 	session is changed. Therefore the tax address is not correctly set and
         * 	requires us to reset it according to the new session.
         */

        public function getCustomerGroups() {
            $result = array();
            if (is_array($this->config->get('config_customer_group_display'))) {

                $this->load->model('account/customer_group');
                $customer_groups = $this->model_account_customer_group->getCustomerGroups();

                foreach ($customer_groups as $customer_group) {

                    //customer_group_id
                    $customer_group['value'] = $customer_group['customer_group_id'];

                    //name
                    $customer_group['title'] = $customer_group['name'];

                    if (in_array($customer_group['value'], $this->config->get('config_customer_group_display'))) {
                        $result[] = $customer_group;
                    }
                }
            }

            return $result;
        }

        public function updateTaxAddress() {
            // @TODO Undefined Function
            // $this->tax->clearRates();

            $address = $this->paymentOrShippingAddress();
            $this->tax->setShippingAddress($address['country_id'], $address['zone_id']);
            // $this->tax->setPaymentAddress($address['country_id'], $address['zone_id']);
            $this->tax->setPaymentAddress($this->session->data['payment_address']['country_id'], $this->session->data['payment_address']['zone_id']);
            $this->tax->setStoreAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));
        }

        public function paymentOrShippingAddress() {

            $address = $this->session->data['shipping_address'];
            if (isset($this->session->data['payment_address']['shipping_address']) && $this->session->data['payment_address']['shipping_address']) {
                $address = $this->session->data['payment_address'];
            }

            $address['country_id']='220';
            $address['zone_id']='3491';
            $address['address_id']=1;

            // print_r($this->session->data);
            // print_r($address);
            // $this->session->data['shipping_address']= $address;
            // $this->session->data['payment_address']= $address;
            return $address;
        }

        public function showShippingAddress() {
            if (!$this->session->data['d_quickcheckout']['account'][$this->session->data['account']]['shipping_address']['display']) {
                return false;
            }
            if (!$this->cart->hasShipping()) {
                return false;
            }

            if ($this->session->data['d_quickcheckout']['account'][$this->session->data['account']]['shipping_address']['require']) {
                return true;
            }

            if (isset($this->session->data['payment_address']['shipping_address']) && $this->session->data['payment_address']['shipping_address'] && !$this->customer->isLogged()) {

                return false;
            }

            if (isset($this->session->data['payment_address']['shipping_address']) && $this->session->data['payment_address']['shipping_address'] && $this->customer->isLogged() && $this->session->data['payment_address']['address_id'] == 'new') {

                return false;
            }

            return true;
        }

        public function getPaymentAddressCountryId() {
            if (isset($this->session->data['payment_address']) && isset($this->session->data['payment_address']['country_id'])) {
                return $this->session->data['payment_address']['country_id'];
            }

            return $this->config->get('config_country_id');
        }

        public function getShippingAddressCountryId() {
            if (isset($this->session->data['shipping_address']) && isset($this->session->data['shipping_address']['country_id'])) {
                return $this->session->data['shipping_address']['country_id'];
            }

            return $this->config->get('config_country_id');
        }

        /*
         * 	Country and Zones
         */

        public function getCountries() {
            $this->load->model('localisation/country');
            $countries = $this->model_localisation_country->getCountries();
            $options = array();
            foreach ($countries as $country) {
                $country['value'] = $country['country_id'];
                unset($country['country_id']);
                $options[] = $country;
            }
            return $options;
        }

        public function getZonesByCountryId($country_id) {
            $this->load->model('localisation/zone');
            $zones = $this->model_localisation_zone->getZonesByCountryId($country_id);
            $options = array();
            foreach ($zones as $zone) {
                $zone['value'] = $zone['zone_id'];
                unset($zone['zone_id']);
                $options[] = $zone;
            }
            return $options;
        }

        public function getCountryInfo($country_id) {
            $this->load->model('localisation/country');
            return $this->model_localisation_country->getCountry($country_id);
        }

        public function getZoneInfo($zone_id) {
            $this->load->model('localisation/zone');
            return $this->model_localisation_zone->getZone($zone_id);
        }

        public function compareAddress($new_address, $old_address) {

            if ($new_address['country_id'] !== $old_address['country_id']) {
                $country_info = $this->getCountryInfo($new_address['country_id']);
                if ($country_info) {
                    $new_address['country'] = $country_info['name'];
                    $new_address['iso_code_2'] = $country_info['iso_code_2'];
                    $new_address['iso_code_3'] = $country_info['iso_code_3'];
                    $new_address['zone_id'] = 0;

                    if (!empty($country_info['address_format'])) {
                        $new_address['address_format'] = $country_info['address_format'];
                    } else {
                        $new_address['address_format'] = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
                    }
                } else {
                    $new_address['country'] = '';
                    $new_address['iso_code_2'] = '';
                    $new_address['iso_code_3'] = '';
                    $new_address['address_format'] = '';
                    $new_address['zone_id'] = 0;
                }
            }


            if ($new_address['zone_id'] !== $old_address['zone_id']) {
                $zone_info = $this->getZoneInfo($new_address['zone_id']);
                if ($zone_info) {
                    $new_address['zone'] = $zone_info['name'];
                    $new_address['zone_code'] = $zone_info['code'];
                } else {
                    $new_address['zone'] = '';
                    $new_address['zone_code'] = '';
                }
            }

            return $new_address;
        }

        public function prepareAddress($address) {

            $country_info = $this->getCountryInfo($address['country_id']);
            if ($country_info) {
                $address['country'] = $country_info['name'];
                $address['iso_code_2'] = $country_info['iso_code_2'];
                $address['iso_code_3'] = $country_info['iso_code_3'];

                if (!empty($country_info['address_format'])) {
                    $address['address_format'] = $country_info['address_format'];
                } else {
                    $address['address_format'] = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
                }
            } else {
                $address['country'] = '';
                $address['iso_code_2'] = '';
                $address['iso_code_3'] = '';
                $address['address_format'] = '';
            }

            if (!isset($address['zone_id'])) {
                $address['zone_id'] = 0;
            }
            $zone_info = $this->getZoneInfo($address['zone_id']);
            if ($zone_info) {
                $address['zone'] = $zone_info['name'];
                $address['zone_code'] = $zone_info['code'];
            } else {
                $address['zone'] = '';
                $address['zone_code'] = '';
            }

            return $address;
        }

        public function getAddress($address_id) {
            $this->load->model('account/address');
            $address = $this->model_account_address->getAddress($address_id);

            if (!empty($address) && empty($address['address_format'])) {
                $address['address_format'] = '{firstname} {lastname}' . '{company}' . "\n" . '{address_1}' . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
            }

            return $address;
        }

        public function getAddresses() {

            $this->load->model('account/address');
            $addresses = $this->model_account_address->getAddresses();
            foreach ($addresses as $key => $address) {
                if (!empty($address) && empty($address['address_format'])) {
                    $addresses[$key]['address_format'] = '{firstname} {lastname}' . '{company}' . "\n" . '{address_1}' . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
                }
            }
            return $addresses;
        }

        public function getNPRegions() {
            $cacheKey = 'Address_getNPRegions';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data==null) {
                $query = $this->db->query("SELECT * from np_regions order by name_1");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'np_ref' => $result['np_ref'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            return $data;
        }

        public function findCityByName($name)
        {
            return $this->db->query("SELECT * from np_citys WHERE name_1 = '$name' OR name_2 = '$name' LIMIT 1");
        }

        public function getNPCities($regId = null) {
            $cacheKey = 'Address_getNPCities';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data==null) {
                $query = $this->db->query("SELECT * from np_citys order by name_1");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'name_2' => $result['name_2'],
                            'region_id' => $result['region_id'],
                            'show' => $result['show'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            if ($regId) {
                foreach ($data as $key => $city) {
                    if ($city['region_id'] != $regId) {
                        unset($data[ $key ]);
                    }
                }
            }

            $lang = $this->config->get('config_language_id') == 1 ? 2 : 1;
            foreach ($data as $key => $city) {
                $data[ $key ]['name'] = $city['name_'.$lang];
            }

            return $data;
        }
      

        protected function isAutocompleteMatched($needle, $haystackArray) {
            if (!is_array($haystackArray)) {
                $haystackArray = [ $haystackArray ];
            }

            $needle = trim(mb_strtolower($needle));
            foreach ($haystackArray as $haystack) {
                $haystack = trim(mb_strtolower($haystack));
                if (mb_strpos($haystack, $needle) === 0) {
                    return true;
                }
            }

            return false;
        }

        public function getNPCitiesAutocomplete($filter_np_city, $orderColumnUa = true) {
            $cities = $this->getNPCities(null, $orderColumnUa);
            $autocompleteLimit = 10;

            $filteredCities = [];
            foreach ($cities as $city) {
                $isMatched = $this->isAutocompleteMatched($filter_np_city, [ $city['name_1'], $city['name_2'] ]);
                if ($isMatched && $city['show'] == 1) {
                    if ($filter_np_city === $city['name_1'] || $filter_np_city === $city['name_2']) {
                        $filteredCities[0] = $city;
                    }
                    $filteredCities[] = $city;
                }

                if (count($filteredCities) >= $autocompleteLimit) {
                    break;
                }
            }

            return $filteredCities;
        }

        public function getNPWarehouses($cityId) {
            $cacheKey = 'Address_getNPWarehouses_'.$cityId;

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from np_wh where city_id='".$cityId."' order by `number`");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'name_2' => $result['name_2'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            $lang = $this->config->get('config_language_id') == 1 ? 2 : 1;
          
            foreach ($data as &$warehouse) {
                $warehouse['name'] = $warehouse['name_'.$lang];
            }

            return $data;
        }

        public function getWarehouseById($id) {
            $sql = "SELECT * FROM np_wh WHERE id = '".(int)$id."'";
            $res = $this->db->query($sql);
            return $res->row;

        }


        /*
**************************
****************************
****************************
***************************
justin
**************************
******************************
******************************
******************************
        */
       
        public function getJUSTRegions() {
            $cacheKey = 'Address_getJUSTRegions';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data === null) {
                $query = $this->db->query("SELECT * from just_regions order by name_1");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'just_ref' => $result['just_ref'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            return $data;
        }

        public function getJUSTCities($regId = null) {
            $cacheKey = 'Address_getJUSTCities';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from just_citys order by name_1");
                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'name_2' => $result['name_2'],
                            'region_id' => $result['region_id'],
                            'show' => $result['show'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            if ($regId) {
                foreach ($data as $key => $city) {
                    if ($city['region_id'] != $regId) {
                        unset($data[ $key ]);
                    }
                }
            }

            $lang = $this->config->get('config_language_id') == 1 ? 2 : 1;
            foreach ($data as $key => $city) {
                $data[ $key ]['name'] = $city['name_'.$lang];
            }

            return $data;
        }


        public function getJUSTCitiesAutocomplete($filter_just_city) {
            $cities = $this->getJUSTCities();
            $autocompleteLimit = 10;

            $filteredCities = [];
            foreach ($cities as $city) {
                $isMatched = $this->isAutocompleteMatched($filter_just_city, [ $city['name_1'], $city['name_2'] ]);
                if ($isMatched && $city['show'] == 1) {
                    $filteredCities[] = $city;
                }

                if (count($filteredCities) >= $autocompleteLimit) {
                    break;
                }
            }

            return $filteredCities;
        }

        public function getJUSTWarehouses($cityId) {
            $cacheKey = 'Address_getJUSTWarehouses_'.$cityId;

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from just_wh where city_id='".$cityId."' order by `id`");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'name_2' => $result['name_2'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            $lang = $this->config->get('config_language_id') == 1 ? 2 : 1;
            foreach ($data as &$warehouse) {
                $warehouse['name'] = $warehouse['name_'.$lang];
            }

            return $data;
        }

        public function getWarehousejustById($id) {
            $sql = "SELECT * FROM just_wh WHERE id = '".(int)$id."'";
            $res = $this->db->query($sql);
            return $res->row;

        }

        /*
        ********************************
        *********************************
        *********************************
        **********************************
        ENDJUSTIN
        ********************************
        **********************************
        **********************************
        START MEEST**********************************
        START MEEST
        */

        public function getMEESTRegions() {
            $cacheKey = 'Address_getMEESTRegions';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from meest_regions order by name_1");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'meest_ref' => $result['meest_ref'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            return $data;
        }

        public function getMEESTCities($regId = null) {
            $cacheKey = 'Address_getMEESTCities';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from meest_citys order by name_1");
                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'name_2' => $result['name_2'],
                            'region_id' => $result['region_id'],
                            'show' => $result['show'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            if ($regId) {
                foreach ($data as $key => $city) {
                    if ($city['region_id'] != $regId) {
                        unset($data[ $key ]);
                    }
                }
            }

            $lang = $this->config->get('config_language_id') == 1 ? 2 : 1;
            foreach ($data as $key => $city) {
                $data[ $key ]['name'] = $city['name_'.$lang];
            }

            return $data;
        }


        public function getMEESTCitiesAutocomplete($filter_meest_city) {
            $cities = $this->getMEESTCities();
            $autocompleteLimit = 10;

            $filteredCities = [];
            foreach ($cities as $city) {
                $isMatched = $this->isAutocompleteMatched($filter_meest_city, [ $city['name_1'], $city['name_2'] ]);
                if ($isMatched && $city['show'] == 1) {
                    $filteredCities[] = $city;
                }

                if (count($filteredCities) >= $autocompleteLimit) {
                    break;
                }
            }

            return $filteredCities;
        }

        public function getMEESTWarehouses($cityId) {
            $cacheKey = 'Address_getMeestWarehouses_'.$cityId;

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from meest_wh where city_id='".$cityId."' order by `id`");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name_1' => $result['name_1'],
                            'name_2' => $result['name_2'],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            $lang = $this->config->get('config_language_id') == 1 ? 2 : 1;
            foreach ($data as &$warehouse) {
                $warehouse['name'] = $warehouse['name_'.$lang];
            }

            return $data;
        }

        public function getWarehousemeestById($id) {
            $sql = "SELECT * FROM meest_wh WHERE id = '".(int)$id."'";
            $res = $this->db->query($sql);
            return $res->row;

        }







        /*
  ********************************
        *********************************
        *********************************
        **********************************
        END MEEST
        ********************************
        **********************************
        **********************************

        */

        public function getINRegions($langcode) {
            $query = $this->db->query("SELECT * from in_areas order by name_" . $langcode);

            $data = array();
    		if ($query->num_rows) {
                foreach ($query->rows as $result) {
                    $data[] = array(
                        'id' => $result['id'],
          				'name' => $result['name_'.$langcode],
    		        );
                }

                return $data;
    		} else {
    			return false;
    		}
        }

        public function getINCities($regId = null, $langcode = null) {
            $cacheKey = 'Address_getINCities';

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("
                    SELECT *, (select count(*) from in_branches b where b.locality_id=a.Id ) cnt
                    from in_localities a
                    having cnt > 0
                    order by Locality_Name_Ru
                ");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['Id'],
                            'name_Ru' => $result['Locality_Name_Ru'],
                            'name_Ua' => $result['Locality_Name_Ua'],
                            'Area_Id' => $result['Area_Id']
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            if ($regId) {
                foreach ($data as $key => $city) {
                    if ($city['Area_Id'] != $regId) {
                        unset($data[ $key ]);
                    }
                }
            }

            if (!$langcode) {
                $langcode = $this->config->get('config_language_id') == 1 ? 'Ru' : 'Ua';
            }
            foreach ($data as $key => $city) {
                $data[ $key ]['name'] = $city['name_'.$langcode];
            }

            return $data;
        }

        public function getINCitiesAutocomplete($filter_in_city) {
            $cities = $this->getINCities();
            $autocompleteLimit = 10;

            $filteredCities = [];
            foreach ($cities as $city) {
                $isMatched = $this->isAutocompleteMatched($filter_in_city, [ $city['name_Ru'], $city['name_Ua'] ]);
                if ($isMatched) {
                    $filteredCities[] = $city;
                }

                if (count($filteredCities) >= $autocompleteLimit) {
                    break;
                }
            }

            return $filteredCities;
        }

        public function getINWarehouses($cityId, $langcode) {
            if (!$langcode) {
                $langcode = 'ru';
            }

            $cacheKey = 'Address_getINWarehouses_'.$cityId.'_'.$langcode;

            $data = $this->cache->get($cacheKey);
            if ($data === false || $data == null) {
                $query = $this->db->query("SELECT * from in_branches where locality_id='".$cityId."' order by `number`");

                $data = array();
                if ($query->num_rows) {
                    foreach ($query->rows as $result) {
                        $data[] = array(
                            'id' => $result['id'],
                            'name' => $result['name_'.$langcode],
                            'address' => $result['address_'.$langcode],
                        );
                    }
                }

                $this->cache->set($cacheKey, $data);
            }

            return $data;
        }

    }

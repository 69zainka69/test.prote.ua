<?php

class ControllerInformationCity extends Controller
{

    public function index()
    {
        if (!defined('CITY_UA')) define('CITY_UA', [
            'Дніпро', 'Житомир', 'Запоріжжя', 'Івано-Франківськ', 'Ізмаїл', 'Київ', 'Вінниця', 'Краматорськ',
            'Кропивницький', 'Луцьк', 'Львів', 'Миколаїв', 'Одеса', 'Полтава', 'Рівне', 'Суми',
            'Тернопіль', 'Ужгород', 'Харків', 'Херсон', 'Хмельницький', 'Черкаси', 'Чернівці', 'Чернігів'
        ]);
        if (!defined('CITY_RU'))
        define('CITY_RU', [
            'Днепр', 'Житомир', 'Запорожье', 'Ивано-Франковск', 'Измаил', 'Киев', 'Винница', 'Краматорск',
            'Кропивницкий', 'Луцк', 'Львов', 'Николаев', 'Одесса', 'Полтава', 'Ровно', 'Сумы',
            'Тернополь', 'Ужгород', 'Харьков', 'Херсон', 'Хмельницкий', 'Черкассы', 'Черновцы', 'Чернигов'
        ]);

        $lang = $this->language->get('code');
        $lang = ($lang === 'uk') ? 'UA' : 'RU';

        $data['default_citys'] = ($lang == 'UA') ? CITY_UA : CITY_RU;

        $this->load->model('d_quickcheckout/address');
        $this->load->language('information/city');

        $data['text_select_city'] = $this->language->get('text_select_city');
        $data['text_not_found_city'] = $this->language->get('text_not_found_city');
        $data['placeholder_city'] = $this->language->get('placeholder_city');

        $citys = $this->model_d_quickcheckout_address->getNPCities();
        $data['lang'] = $lang;

        foreach ($citys as &$city) {
            $city = ($lang == 'UA') ? $city['name_1'] : $city['name_2'];
        }
        $data['citys'] = $citys;

        return $this->load->view('/default/template/information/city.tpl', $data);
    }

    public function autocomplete()
    {
        $filter_city = false;
        $json = [];
        $lang = $this->language->get('code');
        $lang = ($lang == 'uk') ? 'UA' : 'RU';

        if (isset($this->request->get['filter_city'])) {
            $this->load->model('d_quickcheckout/address');

            $filter_city = $this->request->get['filter_city'];
            $orderColumn = ($lang === 'UA') ? true : false; 
            $citys = $this->model_d_quickcheckout_address->getNPCitiesAutocomplete($filter_city, $orderColumn);

            $json = $citys;
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }


    public function saveGeoData()
    {
        $coords = $this->request->get['coords'];
        $lang = $this->language->get('code');
        $lang = ($lang == 'uk') ? 'uk' : 'ru';

        $coords = explode(',', $coords);
        $coords[0] = number_format($coords[0], 2, ".", "");
        $coords[1] = number_format($coords[1], 2, ".", "");
        $coords = implode(',', $coords);

        $this->load->model('geolocation/cache');
        $this->load->model('geolocation/city');

        $cityGoogleRes = $this->model_geolocation_cache->get($coords)->row['data'];

        if ($coords && !$cityGoogleRes) {
            $res = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$coords&key=".GOOGLE_GEOCODING_KEY."&language=$lang");
            $res = json_decode($res);
            $city = [];
            if (count($res->results) > 0) {
                foreach ($res->results as $location) {
                    foreach ($location->address_components as $addres) {
                        if ($addres->types) {
                            foreach ($addres->types as $type) {
                                if ($type === 'locality') {
                                    $cityGoogleRes = $addres->short_name;
                                }
                            }
                        }
                    }
                }
            }



            $this->model_geolocation_cache->set($coords, $cityGoogleRes, 20);
        }

        $bounding = $this->model_geolocation_city->closestCities($coords, $cityGoogleRes);
        foreach ($bounding->rows as $cityNP) {
            if ($cityGoogleRes === $cityNP['nameUa'] || $cityGoogleRes === $cityNP['nameRu']) {
                $city[0] = ['ru' =>  $cityNP['nameRu'], 'ua' => $cityNP['nameUa']];
                break;
            } else {
                $city[] = ['ru' =>  $cityNP['nameRu'], 'ua' => $cityNP['nameUa']];
            }
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($city[0]));
    }
}

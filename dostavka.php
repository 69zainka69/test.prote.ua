<?php


/*
$ip = $_SERVER['REMOTE_ADDR']; 
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip.'?lang=ru'));
$ip = $_SERVER['REMOTE_ADDR']; 
    $querys = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip.'?lang=ua'));
*/
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strpos($url, 'prote.ua/ua/') !== false) {
  $osnovharakteristic = "Основні характеристики";
  $otherharakteristic = "Інші характеристики";
  $allharakter = "Всі характеристики  >>";
  $znijka = "знижка";
  $cinas = "Ціна";
  $block_act = "Вигідні пропозиції з цим товаром";
  $ymovakc = "Умови акції";
  $imgfreedel = 'image/ico/favicon_prote_16x16.svg';
  $imgfreedeliv ='image/ico/deliv.svg';
  $symistbfp = "Сумісність з БФП:";
  $symiststrym = "Сумісність з струменевими принтерами:";
    $symista = "Сумісність";
    $oplcart = "Оплата <br>карткою";
    $oplbezgot = "Безготівковий<br> розрахунок";
    $oplgot = "Оплата <br> готівкою";
    $dosttext = "Готівкою при отриманні, за безготівковим розрахунком для юридичних осіб з ПДВ, за безготівковим розрахунком для держосіб з ПДВ і Договором, терміналами ПриватБанку, за допомогою платіжних систем Visa/ Mastercard, Privat24, LiqPay та іншими";
    $etenshin = "* Дата надходження є приблизною, точний день буде вказано на сайті перевізника";
    $stoimost = "Вартість доставки";
    $primernopribude = "Орієнтовна дата <br>надходження*";
    $dateotp = "Дата<br> відвантаження";
    $typeperevoz = "Тип доставки / Назва перевізника";
    $actdeliver = 'Безкоштовна доставка по Україні для попередньо сплачених замовлень на суму від 499,00 грн. <br><br><span class="yslovdel">Умови акції</span>';
    $besplatka = "Безкоштовно";
    $tarperevoz = 'За тарифами перевізника';
    $viddilnich = 'Відділення “Нічний експрес”';
    $vidilmeest = 'Відділення “Meest”';
    $vidjust = 'Відділення “Justin”';
    $vidurkp = 'Відділення “Укрпошта”';
    $vidnp = 'Відділення “Нова пошта”';
    $kyrkyiv = "Кур'єром по Києву";
    $samos = "Самовивіз";
    $today = "Сьогодні";
    $zavtra = "Завтра";
    $ponedilok = "Понеділок";
    $vivtorok = "Вівторок";
    $sereda = "Середа";
    $patnica = "П'ятниця";
    $attwoday = "Через два дні";
    $atthreeday = "Через три дні";
    $gorods = $querys['city'];
    $obmin = "Обмін або повернення товару упродовж 14 днів";
    $dostav= "Доставка до міста:  ";
    $langs="2";
    $komplect = "Купити комплект з 2 товарів";
}
else {
  $osnovharakteristic = "Основные характеристики";
  $otherharakteristic = "Другие характеристики";
  $allharakter = "Все характеристики  >>";
  $komplect = "Купить комплект из 2 товаров";
  $znijka = "скидка";
  $cinas = "Цена";
  $block_act = "Выгодные предложения по этим товаром";
  $ymovakc = "Условия акции";
  $imgfreedeliv ='image/ico/action/free-delivery-action.svg';
  $imgfreedel = 'image/ico/favicon_prote_16x16.svg';
  $symistbfp = "Совместимость со струйными МФУ:";
  $symiststrym = "Совместимость со струйными принтерами:";
  $symista = "Совместимость";
  $oplcart = "Оплата<br> картой";
  $oplbezgot = "Безналичный <br>расчет";
  $oplgot = "Оплата <br>наличными";
  $dosttext = "Наличными при получении, по безналичному расчету для юридических лиц с НДС, по безналичному расчету для гослиц с НДС и Договором, терминалами ПриватБанка, с помощью платежных систем Visa / Mastercard, Privat24, LiqPay и другими";
  $etenshin = "* Дата поступления приблизительна, точный день будет указано на сайте перевозчика";
  $stoimost = "Стоимость доставки";
  $primernopribude = "Ориентировочная дата <br>поступления*";
  $dateotp = "Дата<br> отгрузки";
  $typeperevoz = "Тип доставки / Название перевозчика";
  $actdeliver = 'Бесплатная доставка по Украине для предварительно оплаченных заказов на сумму от 499,00 грн. <br><br><span class="yslovdel">Условия акции</span>';
  $besplatka = "Бесплатно";
  $tarperevoz = 'По тарифам перевозчика';
  $viddilnich = 'Отделение “Ночной Экспресс”';
  $vidilmeest = 'Отделение “Meest”';
  $vidjust = 'Отделение “Justin”';
  $vidurkp = 'Отделение “Укрпочта”';
  $vidnp = 'Отделение “Новая почта”';
  $kyrkyiv = "Курьером по Киеву";
  $samos = "Самовывоз";
  $today = "Сегодня";
  $zavtra = "Завтра";
    $ponedilok = "Понедельник";
    $vivtorok = "Вторник";
    $sereda = "Среда";
    $patnica = "Пятниця";
    $attwoday = "Через два дня";
    $atthreeday = "Через три дня";
    $gorods = $query['city'];
    $obmin = "Обмен или возврат товара в течении 14 дней";
    $dostav= "Доставка в город:  ";
    $langs="1";
  }


$time_start = microtime(true);
ini_set("memory_limit","512M");
ini_set('max_execution_time', 600003);
require_once('/var/www/prote/data/www/test.prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}
$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");
date_default_timezone_set('Europe/Kiev');
$Date = date('H:i:s', time());
$n = date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));
$sql = "SELECT * FROM `oc_product` WHERE `product_id` = $product_id";
$result = $dbcnx->query($sql);
foreach($result as $ress){
$extavail = $ress['extavail'];
$DlvDays = $ress['delivery_days'];
$ava = $ress['quantity'];
if($ava!=0){
$avail = 1;
}
else{
  $avail = 0;
}
//var_dump($avail);
//exit();
$extdlvdays = $ress['extdlvdays'];
}
$zaraz = date('d.m.Y', strtotime($Date. ' + 0 days'));
$oneday = date('d.m.Y', strtotime($Date. ' + 1 days'));
$zavtras = $oneday;
$threeday = date('d.m.Y', strtotime($Date. ' + 3 days'));
$twoday = date('d.m.Y', strtotime($Date. ' + 2 days'));
$fourday = date('d.m.Y', strtotime($Date. ' + 4 days'));
$fiveday = date('d.m.Y', strtotime($Date. ' + 5 days'));


$times = explode(":", $Date);
$chas=$times[0];
$mins=$times[1]; 

if($n!=0 && $n!=7){
  $den = "1"; //РАБОЧИЙ ДЕНЬ
}
else{
  $den = 0; //ВЫХОДНОЙ
}



if($n>6 && $n<7){
  $pn = date('d.m.Y', strtotime($Date. ' + 2 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 1 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 10 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 11 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 6 days'));

  $pn2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $sr2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 2 days'));
}
if($n<1){
  $pn = date('d.m.Y', strtotime($Date. ' + 1 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 2 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 0 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 10 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 11 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 0 days'));

  $pn2 = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $sr2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
}
if($n>0 && $n<2){
  $pn = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 1 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 2 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 6 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 10 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 11 days'));

  $pn2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $sr2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
}
if($n>1 && $n<3){
  $pn = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 1 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 2 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 5 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 11 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 10 days'));

  
  $pn2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 7 days'));
}
if($n>2 && $n<4){
  $pn = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 1 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 2 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 4 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 10 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 11 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 9 days'));

  $pn2 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $sr2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
}
if($n>3 && $n<5){
  $pn = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 1 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 2 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 3 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 10 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 11 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 8 days'));

  $pn2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 7 days'));
  $sr2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
}
if($n>4 && $n<6){
  $pn = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $vt = date('d.m.Y', strtotime($Date. ' + 4 days'));
  $sr = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $cht = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $pt = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $syb = date('d.m.Y', strtotime($Date. ' + 1 days'));
  $vs = date('d.m.Y', strtotime($Date. ' + 2 days'));

  $pn5 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $vt5 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $sr5 = date('d.m.Y', strtotime($Date. ' + 10 days'));
  $cht5 = date('d.m.Y', strtotime($Date. ' + 11 days'));
  $pt5 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $syb5 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $vs5 = date('d.m.Y', strtotime($Date. ' + 7 days'));

  $pn2 = date('d.m.Y', strtotime($Date. ' + 5 days'));
  $vt2 = date('d.m.Y', strtotime($Date. ' + 6 days'));
  $sr2 = date('d.m.Y', strtotime($Date. ' + 9 days'));
  $cht2 = date('d.m.Y', strtotime($Date. ' + 8 days'));
  $pt2 = date('d.m.Y', strtotime($Date. ' + 0 days'));
  $syb2 = date('d.m.Y', strtotime($Date. ' + 3 days'));
  $vs2 = date('d.m.Y', strtotime($Date. ' + 4 days'));
}


if($den<1){

if($avail<1 && $DlvDays>2){
            $nichotp = $sereda;
            $nichpolych = $sr2;
          }
if($avail>0 && $DlvDays>2 ){
$samosotpr=$ponedilok;
$samospolych=$pn;
 }
if($avail<1 && $DlvDays>2 ){
$samosotpr=$sereda;
$samospolych=$sr;
 }
if($avail>0 && $DlvDays<1){
$samosotpr=$ponedilok;
$samospolych=$pn;
$kyrotp = $ponedilok;
$kypolych = $pn;
}
if($avail<1 && $DlvDays>2){
$kyrotp = $sereda;
$kypolych = $sr;
}
if($avail>0 && $DlvDays>2){
$kyrotp = $ponedilok;
$kypolych = $pn;
}
if($avail<1 && $DlvDays>0 && $DlvDays<2){
$kyrotp = $vivtorok;
$kypolych = $vt;
}
 if($avail<1 && $DlvDays>0 && $DlvDays<2){
                $samosotpr=$vivtorok;
                $samospolych=$vt;
                                      }
if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                $samosotpr=$sereda;
                $samospolych=$sr;
                                            }

if($avail>0 && $DlvDays<1){
            $nichotp = $ponedilok;
            $nichpolych = $pn2;
          }
if($avail>0 && $DlvDays>2){
            $nichotp = $ponedilok;
            $nichpolych = $pn2;
          }
if($avail<1 && $DlvDays>0 && $DlvDays<3){
            $nichotp = $vivtorok;
            $nichpolych = $vt2;
          }
if($extavail>0 && $extdlvdays>1){
            $nichotp = $sereda;
            $nichpolych = $sr2;
          }
}


if($den>0){

    if($chas>14 && $chas<16){
      if($mins<30){

          if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
            $nichotp = $attwoday;
            $nichpolych = $fourday;
          }


          if($avail<1 && $DlvDays>0 && $DlvDays<2){
            $nichotp = $zavtra;
            $nichpolych = $threeday;
          }
          if($avail>0 && $DlvDays>2){
            $nichotp = $today;
            $nichpolych = $twoday;
          }
          if($avail<1 && $DlvDays>2){
            $nichotp = $attwoday;
            $nichpolych = $fourday;
          }

          if($avail>0 && $DlvDays<1){
            $nichotp = $today;
            $nichpolych = $twoday;
          }
      }
      if($mins>30){
        if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
            $nichotp = $atthreeday;
            $nichpolych = $fiveday;
          }
         if($avail<1 && $DlvDays>0 && $DlvDays<2){
            $nichotp = $attwoday;
            $nichpolych = $fourday;
          }
          if($avail>0 && $DlvDays>2){
            $nichotp = $zavtra;
            $nichpolych = $threeday;
          }
          if($avail<1 && $DlvDays>2){
            $nichotp = $atthreeday;
            $nichpolych = $fiveday;
          }
          if($avail>0 && $DlvDays<1){
            $nichotp = $zavtra;
            $nichpolych = $threeday;
          }
      }
    }
    if($chas<15){
      if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
            $nichotp = $attwoday;
            $nichpolych = $fourday;
          }
       if($avail<1 && $DlvDays>0 && $DlvDays<3){
            $nichotp = $zavtra;
            $nichpolych = $threeday;
          }
      if($avail>0 && $DlvDays>2){
            $nichotp = $today;
            $nichpolych = $twoday;
          }
      if($avail<1 && $DlvDays>2){
            $nichotp = $attwoday;
            $nichpolych = $fourday;
          }
      if($avail>0 && $DlvDays<1){
            $nichotp = $today;
            $nichpolych = $twoday;
          }
    }
    if($chas>15){

          if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
            $nichotp = $atthreeday;
            $nichpolych = $fiveday;
          }
          if($avail<1 && $DlvDays>0 && $DlvDays<3){
            $nichotp = $attwoday;
            $nichpolych = $fourday;
          }
          if($avail>0 && $DlvDays>2){
            $nichotp = $zavtra;
            $nichpolych = $threeday;
          }
          if($avail<1 && $DlvDays>2){
            $nichotp = $atthreeday;
            $nichpolych = $fiveday;
          }
          if($avail>0 && $DlvDays<1){
            $nichotp = $zavtra;
            $nichpolych = $threeday;
          }
    }



    if($chas>10 && $chas<12){
        if($mins>30){
            if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                $samosotpr=$atthreeday;
                $samospolych=$threeday;
                                            }
            if($avail<1 && $DlvDays>0 && $DlvDays<3){
                $samosotpr=$attwoday;
                $samospolych=$twoday;
                                      }
            if($avail>0 && $DlvDays>2){
                $samosotpr=$zavtra;
                $samospolych=$zavtras;
                                      }
            if($avail>0 && $DlvDays<1){
                $samosotpr=$zavtra;
                $samospolych=$oneday;
                                      }
            if($avail<1 && $DlvDays>2){
                $samosotpr=$atthreeday;
                $samospolych=$threeday;
                                      }
                    }
  
        if($mins<30){
            if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                $samosotpr=$twoday;
                $samospolych=$twoday;
                                      }
            if($avail<1 && $DlvDays>2){
                $samosotpr=$twoday;
                $samospolych=$twoday;
                                      }
            if($avail<1 && $DlvDays>0 && $DlvDays<3){
                $samosotpr=$zavtra;
                $samospolych=$zavtras;
                                      }
            if($avail>0 && $DlvDays>2){
                $samosotpr=$today;
                $samospolych=$zaraz;
                                      }
            if($avail>0 && $DlvDays<1){
                $samosotpr=$today;
                $samospolych=$zaraz;
                                      }
                    }

                  }


    if($chas<11){
      if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                $samosotpr=$twoday;
                $samospolych=$twoday; 
                                      }
      if($avail<1 && $DlvDays>0 && $DlvDays<3){
          $samosotpr=$zavtra;
          $samospolych=$zavtra;
                                }
        if($avail>0 && $DlvDays>2){
            $samosotpr=$today;
            $samospolych=$zaraz;
                                  }
        if($avail>0 && $DlvDays<1){
            $samosotpr=$today;
            $samospolych=$zaraz;
                              }
        if($avail<1 && $DlvDays>2){
            $samosotpr=$attwoday;
            $samospolych=$twoday;
                              }
}





    if($chas>11){
        if($avail>0 && $DlvDays>2){
            $samosotpr=$zavtra;
            $samospolych=$zavtras;
                                  }
        if($avail<1 && $DlvDays>0 && $DlvDays<3){
            $samosotpr=$attwoday;
            $samospolych=$twoday;
                                  }
        if($avail<1 && $DlvDays>2){
            $samosotpr=$atthreeday;
            $samospolych=$threeday;
                                  }
        if($avail>0 && $DlvDays<1){
            $samosotpr=$zavtra;
            $samospolych=$oneday;
                                  }
}




if($chas>9 && $chas<11){


  if($mins<30){
    if($avail>0 && $DlvDays<1){
        $kyrotp = $today;
        $kypolych = $zaraz;
                              }
    if($avail<1 && $DlvDays>2){
        $kyrotp = $attwoday;
        $kypolych = $twoday;
                              }
    if($avail>0 && $DlvDays>2){
        $kyrotp = $today;
        $kypolych = $zaraz;
                              }
    if($avail<1 && $DlvDays>0 && $DlvDays<3){
        $kyrotp = $zavtra;
        $kypolych = $oneday;
                              }
              }

  if($mins>30){
    if($avail>0 && $DlvDays<1){
        $kyrotp = $zavtra;
        $kypolych = $oneday;
                              }
    if($avail<1 && $DlvDays>2){
        $kyrotp = $threeday;
        $kypolych = $threeday;
                              }
    if($avail>0 && $DlvDays>2){
        $kyrotp = $zavtra;
        $kypolych = $oneday;
                              }
if($avail<1 && $DlvDays>0 && $DlvDays<3){
        $kyrotp = $attwoday;
        $kypolych = $twoday;
}}
}



if($chas>10){
    if($avail>0 && $DlvDays<1){
        $kyrotp = $zavtra;
        $kypolych = $oneday;
                              }
    if($avail<1 && $DlvDays>2){
        $kyrotp = $atthreeday;
        $kypolych = $threeday;
                              }
    if($avail>0 && $DlvDays>2){
        $kyrotp = $zavtra;
        $kypolych = $oneday;
                              }
    if($avail<1 && $DlvDays>0 && $DlvDays<3){
        $kyrotp = $attwoday;
        $kypolych = $twoday;
}}


if($chas<10){
    if($avail>0 && $DlvDays<1){
        $kyrotp = $today;
        $kypolych = $zaraz;
                              }
    if($avail<1 && $DlvDays>2){
        $kyrotp = $attwoday;
        $kypolych = $twoday;
                              }
    if($avail>0 && $DlvDays>2){
        $kyrotp = $today;
        $kypolych = $zaraz;
                              }
    if($avail<1 && $DlvDays=1){
        $kyrotp = $zavtra;
        $kypolych = $oneday;
}}
}
if ($n>5 && $n<7 || $n<1 || $n>0 && $n<2){


              if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                    $ukrotp = $patnica;
                    $ukrpolych = $pt5;
              }
              if($avail<1 && $DlvDays>0 && $DlvDays<3){
                    $ukrotp = $vivtorok;
                    $ukrpolych = $vt5;
              }
              if($avail>0 && $DlvDays<1){
                    $ukrotp = $vivtorok;
                    $ukrpolych = $vt5;
              }
              if($avail>0 && $DlvDays>2){
                    $ukrotp = $vivtorok;
                    $ukrpolych = $vt5;
              }

}
if($n>2 && $n<4 || $n>3 && $n<5){

      if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                    $ukrotp = $vivtorok;
                    $ukrpolych = $vt5;
              }
     if($DlvDays!=0 && $DlvDays!=3 && $avail<1){
                    $ukrotp = $patnica;
                    $ukrpolych = $pt5;
}


  if($DlvDays!=1 && $DlvDays!=3 && $avail>0){
                    $ukrotp = $patnica;
                    $ukrpolych = $pt5;
}
if($DlvDays!=1 && $DlvDays!=0 && $avail>0){
                    $ukrotp = $patnica;
                    $ukrpolych = $pt5;
}
}

if ($n>1 && $n<3 || $n>4 && $n<6){


               if($chas<9){
                    if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                        $ukrotp = $patnica."/".$vivtorok;
                        $ukrpolych = $pt5."/".$vt5;
                                                    }
                   if($avail>0 && $DlvDays<1){
                        $ukrotp = $vivtorok."/".$patnica;
                        $ukrpolych = $vt5."/".$pt5;
                                              }

            
                   if($avail<1 && $DlvDays>0 && $DlvDays<3){
                        $ukrotp = $patnica."/".$vivtorok;
                        $ukrpolych = $pt5."/".$vt5;
                                              }


                if($avail<1 && $DlvDays>2){
                        $ukrotp = $patnica."/".$vivtorok;
                        $ukrpolych = $pt5."/".$vt5;
                                              }
                if($avail>0 && $DlvDays>2){
                        $ukrotp = $vivtorok."/".$patnica;
                        $ukrpolych = $vt5."/".$pt5;
                                              }
              }
              if($chas>8 && $n<10){
                  if($mins<30 && $extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                        $ukrotp = $patnica."/".$vivtorok;
                        $ukrpolych = $pt5."/".$vt5;
                                                    }
                   if($mins<30 && $avail>0 && $DlvDays<1){
                        $ukrotp = $vivtorok."/".$patnica;
                        $ukrpolych = $vt5."/".$pt5;
                                              }
                    if($mins<30 && $avail>0 && $DlvDays>2){
                        $ukrotp = $vivtorok."/".$patnica;
                        $ukrpolych = $vt5."/".$pt5;
                                              }
                    if($mins<30 && $avail<1 && $DlvDays>2){
                        $ukrotp = $patnica."/".$vivtorok;
                        $ukrpolych = $pt5."/".$vt5;
                                              }
                     if($mins<30 && $avail<1 && $DlvDays>0 && $DlvDays<3){
                        $ukrotp = $patnica."/".$vivtorok;
                        $ukrpolych = $pt5."/".$vt5;
                                              }
              }

}
if($n>1 && $n<3){
  if($chas>8 && $n<10){

                    if($mins>30 && $extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }

                   if($mins>30 && $avail>0 && $DlvDays<1){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }

                    if($mins>30 && $avail<1 && $DlvDays>0 && $DlvDays<3){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }

                  if($mins>30 && $avail<1 && $DlvDays>2){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
                  if($mins>30 && $avail>0 && $DlvDays>2){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
              }
  if($chas>9){

                  if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
                if($avail>0 && $DlvDays<1){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
                if($avail<1 && $DlvDays>2){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
                                            
                if($avail>0 && $DlvDays>2){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
                if($avail<1 && $DlvDays>0 && $DlvDays<3){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
              }
}

if($n>4 && $n<6){
if($chas>8 && $n<10){

                    if($mins>30 && $extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                    $ukrotp = $vivtorok;
                    $ukrpolych = $vt5;
              }
                   if($mins>30 && $avail>0 && $DlvDays<1){
                        $ukrotp = $vivtorok;
                        $ukrpolych = $vt5;
                                              }
                     if($mins>30 && $avail>0 && $DlvDays>2){
                        $ukrotp = $vivtorok;
                        $ukrpolych = $vt5;
                                              }
                    if($mins>30 && $avail<1 && $DlvDays>2){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
              }
  if($chas>9){
                if($extavail>0 && $extdlvdays>1 && $extdlvdays<3){
                    $ukrotp = $vivtorok;
                    $ukrpolych = $vt5;
              }
                if($avail>0 && $DlvDays<1){
                        $ukrotp = $vivtorok;
                        $ukrpolych = $vt5;
                                              }
                if($avail<1 && $DlvDays>2){
                        $ukrotp = $patnica;
                        $ukrpolych = $pt5;
                                              }
                if($avail>0 && $DlvDays>2){
                        $ukrotp = $vivtorok;
                        $ukrpolych = $ме5;
                                              }
              }
}
if($n>5 && $n<7 || $n<1 || $n>0 && $n<2 ){
      if($avail<1 && $DlvDays>2){
        $ukrotp = $patnica;
        $ukrpolych = $pt5;
      }
}

if($n>2 && $n<4 || $n>3 && $n<5){
  if($avail<1 && $DlvDays>2){
        $ukrotp = $vivtorok;
        $ukrpolych = $vt5;
      }
}
$sql = "SELECT * FROM `oc_product_to_category` WHERE `product_id` = $product_id";
$querys = $dbcnx->query($sql);
foreach($querys as $ress){
  $catid=$ress['category_id'];
}
$YesCat = "false";
$ArEpson = [
  0=> "22",
  1=> "31",
  2=> "24",
  3=> "21",
  4=> "41",
  5=> "42",
  6=> "81",
  7=> "89"
];
$ArCanon = [
  0=> "22",
  1=> "31",
  2=> "24",
  3=> "21",
  4=> "41",
  5=> "42",
  6=> "81",
  7=> "89"
];

if (in_array($catid, $ArEpson, true)) {
   $YesCat = "true";
}

/*  ДОСТАЕМ СОРТИРОВКУ АТРИБУТОВ У ДАННОГО ТОВАРА*/

/*
$sql = "SELECT * FROM `oc_product_to_category` WHERE `product_id` = $product_id";
$result = $dbcnx->query($sql);


foreach($result as $ress){
    $catid=$ress['category_id'];
}

$sql = "SELECT * FROM `attrincatgroup` WHERE `idcat` = $catid AND `view` = 1 ORDER BY `attrincatgroup`.`sort` ASC";
$resultinger = $dbcnx->query($sql);

foreach($resultinger as $re){
    $name=$re['nameattr'];
    $sort=$re['sort'];
    $firstattrib[$name]=array("$name", "$sort");
}

$sql = "SELECT * FROM `attrincatgroup` WHERE `idcat` = $catid AND `view` = 0 ORDER BY `attrincatgroup`.`sort` ASC";
$resulting = $dbcnx->query($sql);

foreach($resulting as $resp){
  $name=$resp['nameattr'];
  $sort=$resp['sort'];
  $otherattrib[$name]=array("$name", "$sort");
}


*/











?>
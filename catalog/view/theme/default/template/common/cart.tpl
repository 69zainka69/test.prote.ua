<?php
$sesid = htmlspecialchars($_COOKIE["PHPSESSID"]);
$conte = 0;
$tot = 0;
$qtv = 0;
$dareno = 0;
require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}
$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");
$sql = "SELECT * FROM `basket` WHERE `session` LIKE '$sesid' AND `skidka` = 1";
$resultcoun = $dbcnx->query($sql);
foreach($resultcoun as $resetst){
  $dareno = $dareno + $resetst['count'];
}
if($dareno>0){
setcookie("skidka", "ON");
$sql = "SELECT total_price, count  FROM `basket` WHERE `session` LIKE '$sesid'";
$result = $dbcnx->query($sql);
foreach($result as $ress){
$tot = $tot+$ress['total_price'];
$qtv = $qtv + $ress['count'];
} ?>

<div id="cart" class="btn-group btn-block header__cart">
  <div id="cart-total"><div class="header__cart-count count fet"><div class="header__cart-svg svg"><svg width="36" height="31" viewBox="0 0 36 31" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.99477 27.4231C2.99477 29.4103 4.58617 31 6.57542 31C8.56467 31 10.1561 29.4103 10.1561 27.4231C10.1561 27.0256 10.0765 26.6282 9.99693 26.3103H19.8403C19.6812 26.7077 19.6812 27.0256 19.6812 27.4231C19.6812 29.4103 21.2726 31 23.2618 31C25.2511 31 26.8425 29.4103 26.8425 27.4231C26.8425 27.0256 26.7629 26.6282 26.6833 26.3103H27.1608C29.15 26.3103 30.821 24.7205 30.821 22.6538C30.821 21.2231 29.9457 19.9513 28.6726 19.3154L30.1048 6.12051C30.264 3.97436 32.0145 2.38462 34.1629 2.38462C34.7995 2.38462 35.3565 1.90769 35.3565 1.19231C35.3565 0.55641 34.7995 0 34.1629 0C30.821 0 28.036 2.4641 27.6382 5.72308L26.2059 18.9179H7.54773L7.54096 18.9179C6.42697 18.9179 5.47212 18.1231 5.15383 17.0102L3.46554 8.98239H26.5067V6.59296H2.01629C1.93612 6.58555 1.85477 6.58539 1.77326 6.59296H0.19873V8.98239H0.984406L2.84628 17.5666C3.085 18.6795 3.72156 19.6333 4.51727 20.2692C5.32485 20.9293 6.2679 21.251 7.28394 21.2968C7.321 21.3006 7.35844 21.3026 7.39616 21.3026H27.0016C27.6382 21.3026 28.1952 21.859 28.1952 22.4949C28.1952 23.1308 27.6382 23.6872 27.0016 23.6872H6.49585C4.58617 23.8462 2.99477 25.4359 2.99477 27.4231ZM21.9887 27.4231C21.9887 26.7872 22.4661 26.3103 23.1027 26.3103C23.7392 26.3103 24.2167 26.7872 24.2167 27.4231C24.2167 28.059 23.8188 28.6154 23.1823 28.6154C22.5457 28.6154 21.9887 28.059 21.9887 27.4231ZM5.46144 27.4231C5.46144 26.7872 5.93886 26.3103 6.57542 26.3103C7.21198 26.3103 7.6894 26.7872 7.6894 27.4231C7.6894 28.059 7.21198 28.6154 6.57542 28.6154C5.93886 28.6154 5.46144 28.059 5.46144 27.4231Z" fill="white"></path>
</svg>
</div><span class="cart-total__count"><?php echo $qtv; ?></span></div><div class="header__amount">Корзина<br><?php echo $tot; ?> грн.</div></div>
</div>





<?php }  else {  ?>
<div id="cart" class="btn-group btn-block header__cart">
  <div id="cart-total"><?php echo $text_items; ?></div>
</div>
<?php } ?>
<?php
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ($url == "https://prote.ua/search/?search=E3340"){
  header("HTTP/1.1 301 Moved Permanently"); 
  header('Location: https://prote.ua/search/?search=E3340&limit=500');
exit;
}
if ($url == "https://prote.ua/search/?category_id=22&sub_category=true&search=E3340"){
  header("HTTP/1.1 301 Moved Permanently"); 
  header('Location: https://prote.ua/search/?category_id=22&sub_category=true&search=E3340&limit=500');
exit;
}
 ?>
<div id="searchp" class="input-group searchp">
  <input id="searchp-input" type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_search; ?>" aria-label="<?php echo $text_search; ?>" class="form-control input-lg search-autocomplete grey header__search-input" />
  <span class="input-group-btn header__search-block">
    <button type="button" aria-label="<?php echo $text_search; ?>" id='search-btn1' class="btn btn-default btn-lg">
        <span class="svg header__search-icon"><?php echo file_get_contents(DIR_IMAGE.'/ico/search-icon.svg');?></span>
    </button>
  </span>
</div>

<div id="result-search-autocomplete" class="result-search-autocomplete">
	<div class="show-result" id="show-result">
	</div>
</div>
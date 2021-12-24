<style>
.search_block{color:#999999;font-size:28px;padding-bottom:6%;position:relative;margin-bottom:5  %;}
.search_block .text{margin-bottom:35px;text-align:center;}
/*.search_block:after{content:'';position:absolute;width:50%;height:1px;left:25%;bottom:0;border-bottom:1px solid #f8f7f8}*/
.search_404{padding:0 8%;}
#search404{width: 100%;position: relative;min-width:100%;position:relative;}
#search404 input {line-height:25px;padding: 0 9px;display: block;width: 100%;font-size:11px;border:1px solid #e3e9ef;border-top:1px solid #abadb3;}
#search404 .input-group-btn{position:absolute;right:1px;top:1px;}
#search-btn404{background:#fff;}
.text_form{color:#999999;font-size:28px;margin-bottom:8%;}
.content404 .form, .content-search .form{width:250px;padding-top:5px;}
.forma{display:flex;justify-content:space-between;max-width:473px;margin:auto;}
.left-block .txt{font-family:'Trebuchet MS';font-size:15px;color:#636363;padding-top:25px;}
.button:hover{font-family:'Open Sans',sans-serif;}
.buttons{text-align:center;}
.form button{margin-top:16px;}
@media (max-width: 576px) {
.forma{flex-direction:column;align-items:center;}
.left-block{text-align:center;}
}	
</style>
  <div class="search_block text-center">
    <div class="text"><?php echo $text_search1; ?></div>
    <div class="search_404">
      <div id="search404" class="input-group searchp">
        <input type="text" name="search" value="" placeholder="<?php echo $text_search; ?>" class="form-control input-lg search-autocomplete grey" />
        <span class="input-group-btn">
          <button type="button" id='search-btn404' class="btn btn-default btn-lg">
              <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/00-magn-glass.svg');?></span>
          </button>
        </span>
      </div>
    </div>
  </div>
  
  <div class="text_form text-center">
    <?php echo $text_form; ?>
  </div>
  <div class="forma">
    <div class="left-block ">
      <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/404/povid-perezv.svg');?></div>
      <div class="txt text-center"><?php echo $text_send; ?></div>
    </div>
    <div class="form">
      <form id="callback404" action="/send" name="form-callback" class="callback-form form send">
        <label><input type="hidden" name="title" value="Ничего не найдено"></label>
        <label><input type="hidden" name="validate" value="tel,name,email"></label>
        <label><input type="tel" name="tel" placeholder="Телефон" required></label>
        <label><input type="text" name="name" placeholder="Ваше им'я" required></label>
        <label><input type="email" name="email" placeholder="E-mail" required=""></label>
        <textarea name="comment" cols="30" rows="5" class="textarea" placeholder="Наименование товара"></textarea>
        <div class="buttons">
          <button class="buttonb" type="submit" data-title="Prote.ua Cтраница 404 - Обратная связь" onclick="$('input[name=\'title\']').val($(this).data('title'));"><?php echo $text_send_message; ?></button>
          <button class="button" type="submit" data-title="Prote.ua Cтраница 404 - Перезвоните" onclick="$('input[name=\'title\']').val($(this).data('title'));"><?php echo $text_send_callback; ?></button>
        </div>
      </form>
    </div>
  </div>

<script>
$('#search404 input[name=\'search\']').parent().find('button').on('click', function() {
    url = $('base').attr('href') + 'index.php?route=product/search';
    var value = $('#search404 input[name=\'search\']').val();
    if (value) {url += '&search=' + encodeURIComponent(value);}
    location = url;
  });
  $('#search404 input[name=\'search\']').on('keydown', function(e) {
    if (e.keyCode == 13) {$('#search404 input[name=\'search\']').parent().find('button').trigger('click');}
  });
</script>

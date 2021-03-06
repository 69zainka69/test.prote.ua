<?php echo $header; ?>
<div class="container">
  <ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
    <?php $k=0; foreach ($breadcrumbs as $breadcrumb) { ?>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <?php if ($k<count($breadcrumbs)-1) { ?> 
           <a itemprop="item" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="name"><?php echo $breadcrumb['text']; ?></span></a>
        <?php } else { ?>          
          <a itemprop="item" onclick="return false;" href="<?php echo $breadcrumb['href']; ?>" style="cursor:default;">
              <span itemprop="name" id="lastbreadcrumb"><?php echo $breadcrumb['text']; ?></span>
            </a>
        <?php } ?>
          <meta itemprop="position" content="<?=++$k?>">
    </li>
    <?php } ?>
  </ul>
  <div class="row">
    
<style>

h1, .h1{color:#00adee;font-size:24px;font-weight:normal;padding-left:15px;margin-bottom:20px;}
.h1{padding:0;line-height:36px;}
.preorder .dflex{flex-wrap:wrap;padding-top:30px;justify-content: center;}
.preorder .item{width:25%;text-align:center;padding:26px 15px 70px;margin-bottom:20px;border-bottom:1px solid #f8f7f8;}
.preorder .descr{color:#636363;font-family:'Trebuchet MS';font-size:15px;line-height:23px;padding:14px 0 0 16px;}

.preorder .dflex .title{color:#636363;font-family:'Trebuchet MS';font-size:15px;padding:15px 15px 0;margin-bottom:26px;line-height:23px;}
.preorder a{color:#00aeef;}
.preorder a:hover{color:#fd9710;}
.preorder .button{font-family:'Trebuchet MS';font-size:15px;color:#fd9710;text-align:left;background:none;border-radius: 5px;border:2px solid #fd9710;width: 100%;padding:9px 15px 9px 45px;position: relative;line-height: 40px;text-align: center;}
.preorder textarea{margin-bottom: 20px;}
.preorder .button:hover{border-color:#00aff2;color:#00aff2;}
.preorder .button svg{position: absolute;left:15px;}
.preorder .button:hover svg path{fill:#00aff2;}
.preorder .button:hover svg polygon{fill:#00aff2;}
.preorder .item.col_2{padding:32px 17px 20px;flex-direction: column;width:50%;display:flex;align-content:center;justify-content:center;text-align:left;border:none;padding-bottom:0;}
.item.col_2 .r{display:flex;align-items: center;}
.preorder .col_2 .svg{padding-right:13px;}
.preorder .col_2 .title{font-size:24px;color:#00adee;font-family: 'Open Sans',sans-serif;}
.preorder .col_2+.col_2{padding-left:30px;}
.preorder .col_2+.col_2 .title{color:#fd9710;}
.preorder .col_2 .text{padding-top:10px;font-family:'Trebuchet MS';font-size:15px;color:#636363;line-height:23px;}

@media (max-width: 1299px){.preorder .dflex .item{width:33%;}}
@media (max-width: 992px){.preorder .dflex .item{width:50%;}.preorder .button{line-height:40px;}}
@media (max-width: 768px) {/*540*/.preorder .button{line-height:20px;}.readycart .dflex .item.col_2{width:100%;}}
@media (max-width: 576px) {/*320*/.preorder .dflex .item{width:100%;}.preorder .button{line-height:40px;}.readycart .col_2 .title{font-size:20px;}}
</style>

    <div id="content" class="preorder">
      <h1><?php echo $heading_title; ?></h1>

        <div class="descr">
          <?php echo $text_text0; ?>
        </div>
        <div class="dflex">
          
          <div class="item">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/preorder/povidomlennia.svg');?></div>
            <div class="title"><?php echo $text_item1; ?></div>
            <div class="form">
              <form id="modal-callback1" action="/send" name="form-callback-modal" class="callback-form form send">
                <label><input type="hidden" name="title" value="<?php echo $heading_title; ?>"></label>
                <label><input type="hidden" name="validate" value="tel,name"></label>
                <label><input type="tel" name="tel" placeholder="<?php echo $entry_tel; ?>" required></label>
                <label><input type="text" name="name" placeholder="<?php echo $entry_name; ?>" required></label>
                <label><input type="email" name="email" placeholder="<?php echo $entry_email; ?>" required=""></label>
                <textarea name="comment" cols="30" rows="5" class="textarea" placeholder="<?php echo $entry_product; ?>"></textarea>
                <div class="buttons">
                  <button class="buttonb" type="submit"><?php echo $button_submit; ?></button>
                </div>
              </form>
            </div>
          </div>
          <div class="item">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/preorder/email.svg');?></div>
            <div class="title"><?php echo $text_item2; ?></div>
            <div class="buttons">
              <button type="button" class="button btn-modal" data-modal="modal-readycart"><?php echo file_get_contents(DIR_IMAGE.'/ico/preorder/xls_orange.svg');?><span><?php echo $text_button; ?></span></button>
              <input type="hidden" name="file" value="" />
            </div>
          </div>
        </div>
        <div class="dflex">
          <div class="item col_2">
            <div class="r">
              <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-contact.svg');?></div>
              <div class="title"><?php echo $text_title1; ?></div>
            </div>
            <div class="text"><?php echo $text_text1_1; ?></div>
          </div>
          <div class="item col_2">
            <div class="r">
              <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-otziv.svg');?></div>
              <div class="title"><?php echo $text_title2; ?></div>
            </div>
            <div class="text"><?php echo $text_text2_1; ?></div>
          </div>          
          
        </div>

<style>
          .modal-readycart .modal-body{width:300px;}
          .modal-readycart .button{font-size: 14px;padding: 9px 5px 9px 55px;}
          .button polygon, .button  path{fill:#fd9710;}
          .modal-readycart .button:hover svg path{fill:#00aff2;}
          /*#fd9710*/
        </style>
         <div class="modal modal-form modal-readycart">
            <div class="body">
              <div class="modal-overlay"></div>
              <div class="modal-body">
                <div class="modal-close">+</div>
                <form id="modal-readycart" method="post" name="form-readycart-modal" class="readycart-form form send">
                  <div class="modal__title"><?php echo $heading_title; ?></div>
                  <input type="hidden" name="title" value="<?php echo $heading_title; ?>">
                  <input type="hidden" name="validate" value="tel,name">
                  <label><input type="tel" name="tel" placeholder="<?php echo $modal_tel; ?>" required></label>
                  <label><input type="text" name="name" placeholder="<?php echo $modal_name; ?>" required></label>
                  <label><input type="text" name="email" placeholder="<?php echo $modal_email; ?>" required></label>
                  <textarea name="comment" cols="30" rows="5" class="textarea" placeholder="<?php echo $modal_info; ?>"></textarea>
                  <div>
                    <button type="button" id="button-upload" data-loading-text="????????????????..." data-original-text="<?php echo $text_button; ?>" class="button"><?php echo file_get_contents(DIR_IMAGE.'/ico/readycart/xls-icon.svg');?><span><?php echo $text_button; ?></span></button>
                    <input type="hidden" name="file" value="" />
                  </div>
                  <div class="buttons">
                    <div class="info"><?php echo $modal_time; ?></div>
                    <button class="btn" type="submit" data-id="modal-readycart"><?php echo $button_submit; ?></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      
      </div>

  </div>
</div>

<script>
var lang='';
language = jQuery('html').attr('lang');
if(language=='uk'){lang='&lang=ua';}
$('button[id^=\'button-upload\']').on('click', function() {
  var node = this;
  $('.text-danger').remove();
  $('#form-upload').remove();
  $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
  $('#form-upload input[name=\'file\']').trigger('click');
  if (typeof timer != 'undefined') {clearInterval(timer);}

  timer = setInterval(function() {
    if ($('#form-upload input[name=\'file\']').val() != '') {
      clearInterval(timer);
      $.ajax({
        url: 'index.php?route=tool/upload'+lang,
        type: 'post',
        dataType: 'json',
        data: new FormData($('#form-upload')[0]),
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $(node).fadeOut(300, function(){$(node).find('span').text($(node).attr('data-loading-text'))});
          $(node).fadeIn(300);
        },
        complete: function() {},
        success: function(json) {
          $('.text-danger').remove();
          if (json['error']) {
            $(node).fadeOut(300, function(){$(node).find('span').text($(node).attr('data-original-text'))});
            $(node).fadeIn(300);
            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
          }
          if (json['success']) {
            $(node).fadeOut(300, function(){$(node).find('span').text(json['success'])});
            $(node).fadeIn(300);
            $(node).parent().find('input').val(json['code']);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }
  }, 500);
});
</script> 
<?php echo $footer; ?>

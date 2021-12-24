<div class="m <?php echo ($route !== 'common/home') ? 'm--fixed' : ''; ?>">
  <ul class="open aim general-menu">
  <?php foreach ($catalogmenu_new as $key => $category){?>
  <li class="has-sub general-menu__li mainli<?php if($key==0)echo ' opens1 active1';?>" data-id="<?php echo $key; ?>">
      <a class="general-menu__link" href="<?php echo $category['href']; ?>">
        <?php if ($category['thumb']) { ?><div class="general-menu__icon-block"><img class="general-menu__icon" alt="img-menu" src="<?php echo '/image/' . $category['thumb']; ?>" /></div><?php } ?>
        <span class="general-menu__general-category"><?php echo $category['name']; ?></span>
      <div class="general-menu__ico-arrow"></div>
      </a>
      <?php if($category['children']){?>
      <div class="subnav castom-m" style="display: none;">
      <?php foreach (array_chunk($category['children'], 11) as $categorychildren){?>
        <ul class="general-menu__sub-nav <?=$category['class']?>">
           <?php foreach ($categorychildren as $children){?>
               <div class="general-menu__category-block has-sub">
               <a class="general-menu__cat-name general-menu__def-link" href="<?php echo $children['href']; ?>"<?php if($children['href']=='/'){?> class="general-menu__category-link noactive" onclick="return false"<?php } ?>><?php echo $children['name']; ?></a>
                <?php if(isset($children['children']) && !empty($children['children'])){?>
                  <?php foreach (array_chunk($children['children'], 11) as $categorychild2){?>
                  <ul>
                      <?php foreach ($categorychild2 as $child2){?>
                          <li class="general-menu__def-link"><a href="<?php echo $child2['href']; ?>"><?php echo $child2['name']; ?></a></li>
                      <?php } ?>
                  </ul> 
                  <?php } ?>
                  <?php } ?></div>
           <?php } ?>
          <?php if((int)$category['catmenu_id'] === 1) { ?>
           <div class="general-menu__brands general-menu__brands--rashodnyie-materialyi">
            <a href="<?=$langurl;?>/paper-materials/photo-paper/f1-barva/"><img class="general-menu__brand-ico" alt="barva-logo" src="image/brands/barva-logo.svg"></a>
            <a href="<?=$langurl;?>/paper-materials/konverti/f4949-kuvert/"><img class="general-menu__brand-ico" alt="kuvert-logo" src="image/brands/kuvert-logo.svg"></a>
            <a href="<?=$langurl;?>/paper-materials/office-paper/f1-xerox/"><img class="general-menu__brand-ico" alt="xerox-logo" src="image/brands/xerox-logo.svg"></a>
            <a href="<?=$langurl;?>/paper-materials/memo-blocks/f4949-buromax/"><img class="general-menu__brand-ico" alt="buromax-logo" src="image/brands/buromax-logo.svg"></a>
            <a href="<?=$langurl;?>/paper-materials/office-paper/f1-berga/"><img class="general-menu__brand-ico" alt="berga-icon" src="image/brands/berga-icon.svg"></a>
            <a href="<?=$langurl;?>/paper-materials/office-paper/f1-zoom/"><img class="general-menu__brand-ico" alt="zoom-icon" src="image/brands/zoom-icon.svg"></a></div>
          <?php } else if ((int)$category['catmenu_id'] === 845) {?>
            <div class="general-menu__brands general-menu__brands--rashodnyie-materialyi">
              <a href="<?=$langurl;?>/stationery/doski-flipcharty/f1-buromax/"><img class="general-menu__brand-ico" alt="buromax-logo" src="image/brands/buromax-logo.svg"></a>
              <a href="<?=$langurl;?>/stationery/doski-flipcharty/f1-2h3/"><img class="general-menu__brand-ico" alt="2-3-logo" src="image/brands/2-3-logo.svg"></a></div>
            <?php } else if ((int)$category['catmenu_id'] === 5) {?>
              <div class="general-menu__brands general-menu__brands--rashodnyie-materialyi">
                <a href="<?=$langurl;?>/buromax/"><img class="general-menu__brand-ico" alt="buromax-logo" src="image/brands/buromax-logo.svg"></a>
                <a href="<?=$langurl;?>/maped/"><img class="general-menu__brand-ico" alt="maped.svg" src="image/brands/maped.svg"></a></div>
              <?php } ?>
        </ul>
  <?php } ?>
</div>
      <?php } ?>
  </li>
  <?php } ?>
  </ul></div>
  <div class="dark-layer"></div>
  <div class="header-m">
    <div class="header-m__top">
       <div class="header-m__hamburger">
        <div class="header-m__hamburger-icon"><?php echo file_get_contents(DIR_IMAGE.'/ico/menu_blue.svg');?></div>
        <div class="header-m__hamburger-title">Каталог товара</div></div>
      <div class="header-m__logo">
        <?php if ($route !=='common/home'){ ?>
          <a href="/" alt="prote.ua">
            <img data-src="/image/ico/logo-dark.svg" title="prote.ua" class="lazy" alt="prote.ua"/>
          </a>
        <?php } else { ?>
          <img data-src="/image/ico/logo-dark.svg" title="prote.ua" class="lazy" alt="prote.ua"/>
        <?php } ?>
      </div>
      <div class="header-m__lang">
        <?php $current_url=$_SERVER['REQUEST_URI'];
                 if ($lang=='uk'){
                     $current_url=str_replace('/ua/','/',$current_url); ?>
                     <a href="<?php echo '/ua' . $current_url;  ?>" class="header-m__lang-ua header-m__lang--active"  title="UA">УКР</a>
                    <a href="<?php echo '/ru' . $current_url; ?>" class="header-m__lang-ru" title="RU">РУС</a>
                 <?php } else {
                     $current_url='/ua'.$current_url; ?>
                     <a href="<?php echo '/ua' . $current_url; ?>" class="header-m__lang-ua" title="UA">УКР</a>
                    <a href="<?php echo '/ru' . $current_url; ?>" class="header-m__lang-ru header-m__lang--active"  title="RU">РУС</a>
                 <?php } ?>
        </div>
      <div class="header-m__close"></div></div>
    <div class="header-m__content">
    <div class="header-m__general-menu">
      <a href="/" class="m-menu__link m-menu__link--home"><?php echo $text_home; ?></a>
      <button class="m-menu__link m-menu__link--catalog"><?php echo $text_category_mobile; ?></button>
      <a href="/delivery.html" class="m-menu__link m-menu__link--delivery"><?php echo $text_delivery; ?></a>
      <a href="/payment.html" class="m-menu__link m-menu__link--payment"><?php echo $text_pay; ?></a>
      <?php if (!$logged) { ?>
        <button class="m-menu__link m-menu__link--signin"><?php echo $text_signin; ?></button>
        <?php } else { ?>
          <a href="/my-account" class="m-menu__link m-menu__link--profile"><?php echo $text_profile; ?></a>
        <?php } ?>
      <div class="m-menu__city">
        <div class="m-menu__link m-menu__link--city">
          <img class="m-menu__city-ico lazy" data-src="/catalog/view/theme/default/image/icons/place.svg">
          <div class="m-menu__city-block">
            <span class="m-menu__select-city"><?php echo $text_city_select_mobile; ?>: </span>
            <button class="m-menu__city-name" data-city><?php echo $text_select_city_mobile; ?></button>
          </div>
        </div>
        </div>
    <div class="phones-block">
      <div class="phones-block__number phones-block__number--active">044 379 09 62</div>
      <div class="phones-block__number">050 469 95 75</div>
      <div class="phones-block__number">067 354 56 25</div>
      <div class="phones-block__description">
      <span class="phones-block__time">пн-пт: 9:00 - 20:00</span>
      <span class="phones-block__time">сб: 11:00 - 17:00</span></div></div>
    <button class="m-menu__link m-menu__link--callback"><?php echo $text_callback; ?></button>
    <form method="post" class="m-menu__form-callback m-menu__form-callback--hide" name="form-callback-m">
      <input name="tel" type="tel" class="m-menu__telephone" placeholder="+38(___)___-____" required="" autocomplete="off">
      <input type="hidden" name="validate" value="tel" autocomplete="off">
      <input type="hidden" name="g-recaptcha-response" >
      <button data-id="modal-callback" type="submit" class="m-menu__btn-call" ><?php echo $modal_btn_call; ?></button>
    </form>
    <script>
      $(function() {
      let lang = '';
      language = jQuery('html').attr('lang');
      if (language == 'uk') {
          lang = '&lang=ua';
      }
      $('.m-menu__form-callback').on('submit', function(e) {
          e.preventDefault();
          if($('.m-menu__telephone').val() != '') {
          let data = $(this).serialize();
          $('.m-menu__telephone').removeClass('m-menu__telephone--invalid');
          $.ajax({
              url: 'index.php?route=information/callback' + lang,
              type: 'post',
              data: data,
              dataType: 'json',
              success: function(json) {
                  if (json['success']) {
                      $('.m-menu__btn-call').addClass('m-menu__btn-call--sended').prop('disabled', true);
                      $('.menu__telephone').addClass('menu__telephone--sended');
                  } else if (json['error']) {
                      if (json['error']['tel']) {
                        $('.m-menu__telephone').addClass('menu__telephone--invalid');
                      }
                  }
              }
          });
        } else {
          $('.m-menu__telephone').addClass('m-menu__telephone--invalid');
      }
      });
      $('.m-menu__telephone').on('keyup focusout', function() {
        let item = $(this),
        value = item.val();
        if (value != '+38(___)___-____') {
            $(this).removeClass('m-menu__telephone--invalid');
        } else {
            $(this).addClass('m-menu__telephone--invalid');
        }
      });
      $('.m-menu__link--callback').on('click', function() {
          $('.m-menu__form-callback').slideToggle('m-menu__form-callback--hide');
          $('.m-menu__btn-call').removeClass('m-menu__btn-call--sended').prop('disabled', false);
          $('.m-menu__telephone').val('');
          $('.m-menu__telephone').mask('+38(999)999-9999', {
              autoclear: false
          });
      });
  
      function fixMenuColumn() {
        if ($(window).width() < 1242) {
              return false;
          }
          
        let computedIdElement = [];
        $('.general-menu__li').mouseover(function(e) {
          if($(e.target).hasClass('computed')) {
            return;
          }
            let id = $(this).data('id');
            let subNav = $(this).first('.castom-m');
            let blocks = $(subNav).find('.general-menu__category-block');
            let maxHeight = 0;
            if (blocks.length == 4) {
                blocks.each(function() {
                    let height = $(this).outerHeight();
                    if (maxHeight < height) maxHeight = height;
                });
                let heightFirstColumn = $(blocks[0]).outerHeight();
                $(blocks[0]).css('margin-bottom', maxHeight - heightFirstColumn + 24);
                computedIdElement.push($(this).data('id'));
                $(e.target).addClass('computed');
            }
            maxHeight = 0;
        });
    }

    fixMenuColumn();
  });
    </script>
    </div>
    <div class="header-m__login-form">
      <?php echo $login_mobile_html; ?></div>
    <div class="header-m__catalog">
      <?php foreach ($catalogmenu_new as $key => $category){?>          
      <a href="<?php echo $category['href']; ?>">
      <div class="m-menu__category">
        <div class="m-menu__thumb"> <?php if ($category['thumb']) { ?> <img class="m-menu__icon lazy" alt="cat_menu" data-src="<?php echo '/image/' . $category['thumb']; ?>" /> <?php } ?></div>
        <div class="m-menu__category-title"><?php echo $category['name']; ?></div></div>
    </a>
    <?php } ?>
    </div></div></div>
  <?php if ($route=='common/home'){ ?>
  <div class="menu-cards">
      <div class="menu-cards__content scrolling-wrapper-flexbox">
        <?php foreach ($catalogmenu_new as $key => $category){?> 
        <a href="<?php echo $category['href']; ?>">
          <div class="menu-cards__card">
            <div class="menu-cards__thumb"> <?php if ($category['thumb']) { ?> <img alt="categori_menu" class="m-menu__icon" src="<?php echo '/image/' . $category['thumb']; ?>" /> <?php } ?></div>
            <div class="menu-cards__title"><?php echo $category['name']; ?></div></div>
        </a>
        <?php } ?>
      </div></div>
  <?php } ?>
    <div class="login-modal">
      <button class="login-modal__close"></button>
       <?php echo $login_modal_html; ?>
     </div>
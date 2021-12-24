<div id="bspinner-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-text-center"><img src="./image/spinner.gif" alt="Waiting..."/></div>
    </div>
</div>
<div id="basketinfo-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <p class="header uk-h2">
              <i class="fa fa-shopping-cart"></i>&nbsp;<?= $text_addedtobasket; ?>
            </p>
        </div>
        <form class="uk-form" id="basketinfo-form">
            <fieldset>
                <div class="row">
                <div id="basketinfo_image" class="col-sm-4">
                <? if (1 || isset($thumb)) { ?>
                <? if ($thumb=='') { $thumb = '/image/spinner.gif';}?>
                    <img id="basketinfo_thumb" src="<?= $thumb ?>" alt="Изображение товара">
                <? } ?>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-7">
                <p id="basketinfo_name" ><?= (isset($heading_title)) ? $heading_title : '' ?></p>
                <span id="basketinfo_qty"><b><?= (isset($minimum)) ? $minimum : '' ?> шт.</b></span>
                <div id="basketinfo_price" style="float: right;"><b><?= (isset($price)) ? $price : '' ?></b></div>
                </div>
                </div>
            </fieldset>
        </form>

        <div class="uk-modal-footer uk-text-right">
            <a href='/cart/' id="basketinfo-button-send" class="uk-button uk-button-primary"><?= $text_checkout; ?></a>
            
            <button id="basketinfo-button-close" type="button" class="uk-modal-close uk-button uk-button"><?= $text_continue; ?></button>
            
        </div>

    </div>
</div>
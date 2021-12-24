<?php echo $header; ?>
<?php echo $content_bottom; //featured ремоендуемые товары ?>
</div></div>
<style>
.store-reviews-stat__link-all--right:hover{
background: #dac702;
}
</style>
<?php echo $content_reviews; ?>
<div class="container">
    <div class="row">
        <div class="solutions__title">
            <?php echo $text_sol_title; ?>
            </div>
            </div>
        </div>
<div id="solutions" class="solutions">
            <div class="container">
    <div class="row">
        <div class="solutions__blocks">
    <div class="solutions__block solutions__block--blue">
        <div class="solutions__ico">
            <img width="95" height="95"   src="<?php echo 'image/ico/action_novinki.svg';?>">
            <a class="solutions__link solutions__link--1 solutions__link--blue" href="<?php echo $langurl; ?>/actions/">
                <?php echo $text_action; ?>
            </a>
        </div>
    </div>

    <div class="solutions__block">
        <div class="solutions__ico">
         <img width="95" height="95"   src="<?php echo 'image/ico/gotovie_koshik.svg';?>">
            <a class="solutions__link solutions__link--2" href="<?php echo $langurl; ?>/readycart/">
                <?php echo $text_readybasket; ?>
            </a>
        </div>
    </div>
    <div class="solutions__block solutions__block--yellow">
        <div class="solutions__ico">
        <img width="95" height="95"   src="<?php echo 'image/ico/tovari_ykih_nemae.svg';?>">
            <a class="solutions__link solutions__link--3 solutions__link--yellow" href="<?php echo $langurl; ?>/preorder/">
                <?php echo $text_order; ?>
            </a>
        </div>
    </div>
    
    <div class="solutions__block solutions__block--blue">
        <div class="solutions__ico">
        <img width="95" height="95"   src="<?php echo 'image/ico/pidbir_materialiv.svg';?>">
            <a class="solutions__link solutions__link--4 solutions__link--blue" href="<?php echo $langurl; ?>/brands/">
                <?php echo $text_selection; ?>
            </a>
        </div>
    </div>
    <div class="solutions__block">
        <div class="solutions__ico">
        <img width="95" height="95"   src="<?php echo 'image/ico/gotovi_rihena.svg';?>">
            <a class="solutions__link solutions__link--5" href="<?php echo $langurl; ?>/gotovye-reshenija/">
                <?php echo $text_readysolutions; ?>
            </a>
        </div>
    </div>

    <div class="solutions__block solutions__block--yellow">
        <div class="solutions__ico">
         <img width="95" height="95"   src="<?php echo 'image/ico/zamovleny_tovariv.svg';?>">
            <a class="solutions__link solutions__link--6 solutions__link--yellow" href="<?php echo $langurl; ?>/workers/">
                <?php echo $text_orderbycount; ?>
            </a>
        </div>
    </div>
</div>
</div>
</div>
    </div>
    <div class="container">
        <div class="row">
    <?php echo $column_right; //featured ремоендуемые товары ?>
        </div>
    </div>
<div class="container infos__container">
            <div class="infos__title">
                <?php echo $text_sol_title_seo; ?>
                </div>
    <div id="infos" class="infos">
        <div class="content">
            <div class ="infos__blocks">
            <?php if(isset($mod['bestsellercat.34'])) echo $mod['bestsellercat.34']; ?>
            <?php if(isset($mod['bestsellercat.35'])) echo $mod['bestsellercat.35']; ?><?php //if(isset($mod['advantages.59'])) echo $mod['advantages.59']; ?>
            <div class="infos__col">
                <div class="infos__col-title infos__title--blue">
                    <?php echo $text_seo3_title; ?></div>
                <div class="text"><?php echo $text_seo3; ?></div>
            </div>
            <?/*
            <div class="infos__col">
                <div class="infos__col-title--yellow">
                    Все для струменевого друку</div>
                <div class="text"><?php echo $text_seo1; ?></div>
            </div>
            <div class="infos__col">
                <div class="title infos__col-title--dark">
                    Все для лазерного друку</div>
                <div class="text"><?php echo $text_seo2; ?></div>
            </div>
            
            */ ?>
        </div>
    </div>  

    <script>
$(function() {
    $(".infos__btn").click(function(e) {
	    $(this).closest(".text").children('.infos__full').toggleClass("infos__hide");
        $(this).toggleClass("infos__btn--open");
        let textStatusOpen = $(this).find('.infos__btn--text-open');
        let textStatusClose = $(this).find('.infos__btn--text-close');
        if(textStatusOpen.css('display') === 'none') {
            textStatusOpen.css("display", 'inline');
            textStatusClose.css("display", 'none');
        } else {
            textStatusOpen.css("display", 'none');
            textStatusClose.css("display", 'inline');
        }
    });
});
    </script>
    <?php //echo $column_right; ?>
</div>
  </div>
</div>
<?php echo $footer; ?>
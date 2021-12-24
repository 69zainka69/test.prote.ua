<?php echo $header; ?>
<style>
    @media only screen and (max-width: 320px) {
        .container {
            max-width: calc(100% - 10px);
        }
    }

    @media (min-width: 320px) and (max-width: 539px) {
        .store-reviews-stat {
            height: 490px;
        }
        .store-reviews-stat__content {
            flex-direction: column;
            align-items: center !important;
        }
        .store-reviews-stat__block {
            width: 280px;
        }
        .store-reviews-stat__title { 
            margin-top: 12px;
            margin-bottom: 18px !important;
        }
        .store-reviews-stat__content {
            padding-top: 37px !important;
            padding-left: 34px;
        }
        .store-reviews-stat__block-title {
            font-size: 15px !important;
            line-height: 20px !important;
        }
        .store-reviews-stat {
            margin-bottom: 44px !important;
        }
        .feedback__send {
            margin-top: 8px !important;
        }
        .feedback {
            height: auto !important;
            margin-bottom: -5px !important;
        }
        .feedback__criterion {
            margin-bottom: 26px !important;
        }
        .feedback__rating {
            width: 74px !important;
        }
        .feedback__stars {
             position: relative;
            left: 4px;
        }
        .modal-review__header {
            font-size: 25px !important;
            line-height: 21px !important;
            height: 110px !important;
        }
        .modal-review__description {
            margin-top: 23px !important;
        }
       .modal-review__stars, .rate-stars {
            width: 124px !important;
            position: relative;
            left: 13px;
       }
       .modal-review__planing-buy, .modal-review__group-checkbox {
            margin-left: 10px;
       }
       .modal-review__sex:nth-child(2) {
            margin-left: 63px !important;
       }
       .modal-review__submit {
            margin-bottom: 62px !important;
       }
       .modal-review__criterion-block {
            padding-left: 0px !important;
       }
       .modal-review__submit {
            margin-top: 18px !important;
            margin-bottom: 66px !important;
       }
    }

    @media (min-width: 720px) and (max-width: 995px) {
        .store-reviews-stat__content {
            padding-top: 0px;
            padding: 0px 40px 40px 40px;
            min-height: 290px !important    ;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .store-reviews-stat__title {
            margin-top: 21px !important;
            margin-bottom: 29px !important;
        }
        .store-reviews-stat__block-title {
            margin-bottom: 22px !important;
        }
        .store-reviews-stat__info-row {
            margin-top: 0px !important;
        }
        .store-reviews-stat__ratings {
            position: relative;
            top: 14px;
        }
        .store-reviews-stat__block--3 {
            left: 30px;
        }
        .feedback__send {
            margin-top: 11px !important;
            margin-bottom: 45px;
        }
        .feedback__criterion-block {
            margin-bottom: 21px !important;
        }
        .feedback__rating {
            position: relative;
            left: -9px;
        }
        .modal-review__submit {
            margin-bottom: 116px;   
        }
    }

    @media (min-width: 540px) and (max-width: 719px) {
        .store-reviews-stat__content {
            padding-top: 0px;
            padding: 0px 40px 40px 40px;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .store-reviews-stat__block {
            margin-bottom: 36px;
            margin: 0px;
            justify-content: center;
        }

        .store-reviews-stat__block--1 {
            order: 1;
            width: 50%;
        }

        .store-reviews-stat__block--2 {
            order: 3;
        }

        .store-reviews-stat__block--3 {
            order: 2;
            width: 50%;
            position: relative;
            top: 68px;
        }
        .store-reviews-stat__title {
            margin-top: 22px !important;
            margin-bottom: 28px !important;
        }
        .store-reviews-stat__content {
            padding: 0px 0px 47px 25px !important;
        }
        .store-reviews-stat__block-title {
            font-size: 15px;
            line-height: 20px;
        }
        .store-reviews-stat__block--1 {
            position: relative;
            top: 12px;
        }       
        .store-reviews-stat__block--3 {
            top: 73px !important;
        }
        .store-reviews-stat__info-row {
            margin-top: -5px !important;
        }
        .store-reviews-stat__ratings {
            position: relative;
            top: 8px;
        }
        .feedback__criterion-block {
            margin-bottom: 22px !important;
        }
        .feedback__send {
            margin-top: 10px !important;
        }
        .feedback__rating {
            position: relative;
            left: -8px;
        }
        .modal-review__submit {
            margin-bottom: 83px;
        }
    }

    @media (min-width: 996px) and (max-width: 1279px) {
        .store-reviews-stat__title {
            margin-top: 33px !important;
            margin-bottom: 28px !important;
            font-size: 24px !important;
            line-height: 16px !important;
        }
        .store-reviews-stat__content { 
            padding-top: 53px !important;
        }
        .store-reviews-stat__block-title {
            font-size: 15px;
            line-height: 20px;
        }
        .store-reviews-stat__full-stars svg, .store-reviews-stat__empty-stars svg {
            width: 31px !important;
            height: 41px !important;
        }
        .store-reviews-stat__ratings {
            bottom: 12px;
            right: 12px;
        }
        .feedback {
            padding-bottom: 26px;
        }
        .feedback__criterion {
            width: 115px !important;
        }
        .feedback__rating {
            position: relative;
            left: 3px;
        }
        .feedback__strong {
            margin-right: 3px !important;
        }
        .feedback__send {
            margin-top: 20px;
        }
    }

    @media (min-width: 1280px) and (max-width: 1919px) {
        .store-reviews-stat__title { 
            font-size: 24px !important;
            line-height: 16px;
            margin-bottom: 28px !important;
            padding-left: 0px;  
        }
        .store-reviews-stat {
            height: 230px !important;
        }
        .store-reviews-stat__content {
            padding-top: 41px;
        }
        .store-reviews-stat__ratings {
            margin: 0px;
            position: relative;
            bottom: 19px;
            left: 27px;
        }
        .feedback__send {
            margin-bottom: 33px;
        }
        .store-reviews-stat__ratings {
            width: 178px;
        }
    }

    @media (min-width: 1920px) {
        .feedback {
            padding: 26px 28px 26px 26px;
        }
        .feedback__stars {
            position: relative;
            left: 19px;
        }
        .feedback__send {
            height: 60px;
        }
        .feedback__rating {
            width: 100px !important;
            max-width: 100px;
            position: relative;
            left: 16px;
        }
        .feedback__strong {
            margin-right: 0px;
        }
        .store-reviews-stat {
            height: 230px !important;
        }
        .store-reviews-stat__stat-text {
            margin-top: 27px !important;
        }
        .store-reviews-stat__ratings {
            margin-top: 18px;
            width: 244px !important;
        }
        .store-reviews-stat__title {
            margin-bottom: 49px;
            font-size: 24px;
            margin-top: 31px;
            line-height: 16px;
        }
        .store-reviews-stat__comment-content {
            overflow: hidden;
            padding-top: 41px;
            max-height: 170px !important;
        }
        .store-reviews-stat__content {
            padding-top: 42px !important;
        }
        .store-reviews-stat__stat-description {
            padding-top: 36px !important;
            margin-right: 16px !important;
        }
        .store-reviews-stat__block-title {
            margin-bottom: 5px;
        }
        .store-reviews-stat__block-title {
            margin-bottom: 3px !important;
        }
        .modal-review {
            margin-bottom: 170px !important;
        }
        .modal-review__submit {
            margin-top: 25px !important ;
        }
    }
</style>
<div class="container">
    <div class="row">
        <ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
            <?php $k=0; foreach ($breadcrumbs as $breadcrumb) { ?>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <?php if ($k<count($breadcrumbs)-1) { ?>
                <a itemprop="item" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="name">
                        <?php echo $breadcrumb['text']; ?>
                    </span></a>
                <?php } else { ?>
                <a itemprop="item" onclick="return false;" href="<?php echo $breadcrumb['href']; ?>"
                    style="cursor:default;">
                    <span itemprop="name" id="lastbreadcrumb">
                        <?php echo $breadcrumb['text']; ?>
                    </span>
                </a>
                <?php } ?>
                <meta itemprop="position" content="<?=++$k?>">
            </li>
            <?php } ?>
        </ul>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="store-reviews-stat__title">
            <?php echo $text_reviews_about;?>
        </div>
    </div>
</div>

<div class="store-reviews-stat">
    <div class="container">
        <div class="row">
            <div class="store-reviews-stat__content">
                <div class="store-reviews-stat__block store-reviews-stat__block--1">
                    <div class="store-reviews-stat__block-title">
                        <?php echo $text_reviews_count; ?>
                    </div>
                    <div class="store-reviews-stat__info">
                        <div class="store-reviews-stat__stat-text">
                            0
                        </div>
                        <div class="store-reviews-stat__stat-description store-reviews-stat__stat-description--col1">
                            <?php echo $text_count_sended; ?>
                        </div>
                    </div>
                </div>
                <div class="store-reviews-stat__block store-reviews-stat__block--2">
                    <div class="store-reviews-stat__block-title">
                        <?php echo $text_recomendation; ?>
                    </div>
                    <div class="store-reviews-stat__info">
                        <div class="store-reviews-stat__stat-text">
                            0%
                        </div>
                        <div class="store-reviews-stat__stat-description store-reviews-stat__stat-description--col2">
                            <?php echo $text_count_planingbuy; ?>
                        </div>
                    </div>
                </div>
                <div class="store-reviews-stat__block store-reviews-stat__block--3">
                    <div class="store-reviews-stat__block-title">
                        <?php echo $text_service_rate; ?>
                    </div>
                    <div class="store-reviews-stat__info store-reviews-stat__info--column">
                        <div class="store-reviews-stat__info-row">
                            <div class="store-reviews-stat__stat-text">
                                <div id="service_rate">
                                    0
                                </div>/<span class="store-reviews-stat__stat-text--translucent">5,0</span>
                            </div>
                            <div
                                class="store-reviews-stat__stat-description store-reviews-stat__stat-description--col3">
                                <?php echo $text_mind; ?>
                            </div>
                        </div>
                        <div class="store-reviews-stat__info-row">
                            <div class="store-reviews-stat__ratings">
                                <div class="store-reviews-stat__empty-stars">
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/rating_star_empty.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/rating_star_empty.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/rating_star_empty.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/rating_star_empty.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/rating_star_empty.svg'); ?>
                                </div>
                                <div class="store-reviews-stat__full-stars" style="width:0%">
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/star_fill.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/star_fill.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/star_fill.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/star_fill.svg'); ?>
                                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/star_fill.svg'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        if (window.location.hash !== null) {
            $comment = $(window.location.hash);
            $comment.css('opacity', '25%');
            $comment.animate({ opacity: '100%' }, 1000);
        }
    });
</script>
<div class="container">
    <div class="review__history" id="review-history">
        <div class="review__column-left">
            <?php 
            $index = 0;
            foreach($ratings as $rating) { 
                $index++;
                $color = '';
              if ($index%2 === 0) {
                $color = 'review__comment--blue';
              } else if ($index%3 === 0) {
                $color = 'review__comment--gray';
              } else {
                $color = 'review__comment--pink';
              }
            ?>
            <div class="review__block review__comment <?php echo $color; ?>" id="<?php echo $rating['rate_id']; ?>">
                <div class="review__top">
                    <div class="review__stars-name-block">
                        <div class="review__stars">
                            <?php  
                            for($i = 0; $i < 5; $i++) {
                                if($i < floor($rating['service_rate'])) {
                                    echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star.svg');
                                } else {
                                    echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star_empty_border_none.svg');
                                }
                            }
                            ?>
                        </div>
                        <div class="review__name">
                            <?php echo $rating['customer_name'];?>,
                            <?php echo $rating['customer_city'];?>
                        </div>
                        <div class="review__time">
                            <?php echo strftime("%d %B %G", strtotime($rating['date_added']));?>
                        </div>
                    </div>
                </div>
                <div class="review__message">
                    <?php echo $rating['comment']; ?>
                </div>
            </div>
            <?php if(isset($rating_answers[$rating['rate_id']]) && $rating_answers[$rating['rate_id']] != ''){ ?>
            <div class="review__column-right">
                <div class="answer">
                    <div class="answer__manager">
                        <?php if(isset($ratings_home['customer_sex'])){
                        
                        if($ratings_home['customer_sex'] === 'famale') { ?>
                        <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/manager-w.svg'); ?>
                        <? }} else { ?>
                        <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/manager-m.svg'); ?>
                        <?php } ?>
                    </div>
                    <div class="answer__block">
                        <div class="answer__message">
                            <?php echo nl2br($rating_answers[$rating['rate_id']]['comment']); ?>
                        </div>
                        <div class="answer__footer">
                            <div class="answer__name">
                                <?php echo ($rating_answers[$rating['rate_id']]['firstname']); ?>,
                                <?php echo $title_manager;?>
                            </div>
                            <div class="answer__time">
                                <?php echo strftime("%d %B %G", strtotime($rating_answers[$rating['rate_id']]['date'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php } ?>
        </div>
        <div class="store-reviews-stat__column-right">
            <div class="feedback">
                <div class="feedback__criterion-block">
                    <div class="feedback__criterion">
                        <?php echo $title_service; ?>:
                    </div>
                    <div class="feedback__stars">
                        <?php  
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < floor($general['summ']['service'])) {
                                echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star.svg');
                            } else {
                                echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star_empty.svg');
                            }
                        }
                        ?>
                    </div>
                    <div class="feedback__rating">
                        <span class="feedback__strong">
                            <?php echo str_replace(",",".", sprintf('%.1f', str_replace(",",".", $general['summ']['service'])));?>
                        </span>/<span class="feedback__thin">5.00</span>
                    </div>
                </div>
                <div class="feedback__criterion-block">
                    <div class="feedback__criterion">
                        <?php echo $title_delivery ?>:
                    </div>
                    <div class="feedback__stars">
                        <?php  
                        for($i = 0; $i < 5; $i++) {
                            if($i < floor($general['summ']['delivery'])) {
                                echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star.svg');
                            } else {
                                echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star_empty.svg');
                            }
                        }
                        ?>
                    </div>
                    <div class="feedback__rating">
                        <span class="feedback__strong">
                            <?php echo str_replace(",",".", sprintf('%.1f', str_replace(",",".", $general['summ']['delivery'])));?>
                        </span>/<span class="feedback__thin">5.00</span>
                    </div>
                </div>
                <div class="feedback__criterion-block">
                    <div class="feedback__criterion">
                        <?php echo $title_product; ?>:
                    </div>
                    <div class="feedback__stars">
                        <?php  
                        for($i = 0; $i < 5; $i++) {
                            if($i < floor($general['summ']['goods'])) {
                                echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star.svg');
                            } else {
                                echo file_get_contents(DIR_ROOT . 'catalog/view/theme/default/image/icons/star_empty.svg');
                            }
                        }
                        ?>
                    </div>
                    <div class="feedback__rating">
                        <span class="feedback__strong">
                            <?php echo str_replace(",",".",sprintf('%.1f', str_replace(",",".", $general['summ']['goods'])));?>
                        </span>/<span class="feedback__thin">5.00</span>
                    </div>
                </div>
                <button class="feedback__send">
                    <?php echo $title_leavereview; ?>
                </button>
            </div>
        </div>
    </div>
    <?php if($total > 9) { ?>
    <button class="review__more">
        <?php echo $title_more; ?>
    </button>
    <?php } ?>
</div>

<style>
    <?php echo file_get_contents(DIR_APPLICATION.'view/theme/default/stylesheet/remodal/remodal.css');
    ?><?php echo file_get_contents(DIR_APPLICATION.'view/theme/default/stylesheet/remodal/remodal-default-theme.css');
    ?><?php echo file_get_contents(DIR_APPLICATION.' view/theme/default/stylesheet/shop_rate.css');
    ?>
</style>
<script src="../catalog/view/javascript/jquery/remodal/remodal.min.js"></script>
<?php require_once(DIR_APPLICATION . 'view/js/modal/rewiew.tpl'); ?>
</div>

<script>
    $(function () {

        function scrollToForm() {
            $(".feedback__send").click(function () {
                $('html, body').animate({
                    scrollTop: $(".modal-review").offset().top
                }, 1000);
            });
        }
        scrollToForm();
        function animateNumbers(element, value, style = false) {

            if (style) {
                $(element).css('width', 0);
                $(element).animate({
                    width: value + '%'
                }, { duration: 1000 });
                return;
            }
            let needAddProcent = false;
            if ($(element).text().match('%')) {
                $(element).html($(element).html().replace('%', ''))
                needAddProcent = true;
            }
            $(element).prop('Counter', 0).animate({
                Counter: value
            }, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                    if (needAddProcent) {
                        $(element).text(Math.ceil(now) + '%');
                    } else {
                        $(element).text(Math.ceil(now));
                    }

                }
            });
        };
        animateNumbers($('.store-reviews-stat__stat-text')[0], "<?php echo $total;?>");
        animateNumbers($('.store-reviews-stat__stat-text')[1], (isNaN("<?php echo $planing_buy?>")) ? '0%' : "<?php echo $planing_buy?>");
        $('#service_rate').text("<?php echo sprintf('%.1f', str_replace(",",".", $general['summ']['service'])); ?>");
        animateNumbers($('.store-reviews-stat__full-stars'), "<?php echo $data['general']['summ_perc']['service'];?>", true);
    });

    let page = 2;
    $('.review__more').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: `/otzivi/?ajax=1&page=${page}`,
            type: 'get',
            beforeSend: function () {
            },
            complete: function () {
            },
            success: function (json) {
                page++;
                $('.review__column-left').append(json);
                if (+$('.store-reviews-stat__block--1 .store-reviews-stat__stat-text').text() === +$('.review__comment').length) {
                    $('.review__more').remove();
                }
                $('.success, .error').remove();
                if (json['error']) {
                    if (json['error']['name']) {
                        $('#form-review input[name="name"]').after('<div class="error">' + json['error']['name'] + '</div>');
                    }
                    if (json['error']['text']) {
                        $('#form-review textarea[name="text"]').after('<div class="error">' + json['error']['text'] + '</div>');
                    }
                    if (json['error']['rating']) {
                        $('#form-review .ratingg').after('<div class="error">' + json['error']['rating'] + '</div>');
                    }
                }

                if (json['success']) {
                    $('#form-review').after('<div class="success">' + json['success'] + '</div>');
                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
                return false;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

</script>
<?php echo $column_right; ?>
</div>
</div>
<?php echo $footer; ?>
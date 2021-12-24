<style>
    .reviews-home .swiper-pagination-bullet {
        background: #fff;
        opacity: 1;
        margin: 0px 8px !important;
    }
    .reviews-home .swiper-pagination-bullet:last-child {
        margin-right: 0px !important;
    }
    .reviews-home .swiper-pagination-bullet:first-child {
        margin-left: 0px !important;
    }
    .reviews-home .swiper-pagination-bullet-active {
        background: #00AFF2;
        opacity: 1;
    }

    .store-reviews-stat__info--column {
        flex-direction: column;
    }

    .store-reviews-stat__stat-description--hide {
        display: none;
    }

    .store-reviews-stat {
        margin-bottom: 0px !important;
    }

    .store-reviews-stat__ratings {
        width: max-content !important;
    }

    .store-reviews-stat__link-all--right,
    .store-reviews-stat__link-all--bottom {
        display: flex;
        width: 180px;
        height: 60px;
        background: #FDE700;
        border-radius: 3px;
        font-family: Trebuchet MS;
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        text-align: center;
        color: #333333;
        align-items: center;
        justify-content: center;
        align-self: center;
    }
    .store-reviews-stat__link-all--bottom:hover, .store-reviews-stat__link-all--right:hover {
        color: inherit;
    }
    .store-reviews-stat__block--4 {
        margin-top: 42px;
    }
    .store-reviews-stat__block:nth-child(1) {
        width: auto;
    }

    .store-reviews-stat__block--3 {
        flex-direction: row;
        justify-content: right;
    }

    .row .store-reviews-stat__link-all {
        display: none;
    }

    .store-reviews-stat__full-stars svg,
    .store-reviews-stat__empty-stars svg {
        width: 33px;
        height: 33px;
    }
    @media (min-width: 1280px) {
        .store-reviews-stat__block--4 {
            height: 60px;
            margin-top: 48px;
        }

        .store-reviews-stat__stat-description--col3 {
            width: 86px;
        }
    }

    @media (min-width: 996px) and (max-width: 1279px) {
        .store-reviews-stat__title {
            font-size: 18px;
            line-height: 25px;
            margin-bottom: 22px;
            padding-left: 13px !important
        }
        .store-reviews-stat__stat-text {
            line-height: 30px;
        }
        .store-reviews-stat__content {
            padding: 52px 36px 41px 38px !important;
        }
        .store-reviews-stat__block--4 {
            height: 44px;
            margin-top: 42px;
        }

        .store-reviews-stat__link-all--right {
            width: 128px;
            height: 44px;
            font-size: 15px;
        }
    }

    @media (min-width: 720px) and (max-width: 995px) {
        .store-reviews-stat__title {
            font-size: 18px;
            line-height: 25px;
            margin-bottom: 23px;
            padding-left: 12px;
        }
        .store-reviews-stat__stat-text {
            line-height: 30px;
        }
        .store-reviews-stat__stat-description--hide {
            width: auto;
            display: flex !important;
        }
        .store-reviews-stat__stat-description {
            margin-top: 11px;
        }
        .store-reviews-stat__stat-description--col3 {
            margin-top: -3px;
        }
        .store-reviews-stat__content {
            flex-direction: row;
            flex-wrap: initial;
            padding: 51px 21px 45px 29px;
        }
        .store-reviews-stat__block {
            margin-bottom: 36px;
            margin: 0px;
            justify-content: center;
        }
        .store-reviews-stat__block--1 {
            order: initial;
            width: initial;
        }

        .store-reviews-stat__block--2 {
            order: initial;
        }

        .store-reviews-stat__block--3 {
            order: initial;
            width: initial;
            position: initial;
            top: initial;
        }

        .store-reviews-stat__block--4 {
            height: 44px;
            margin-top: 18px;
        }

        .store-reviews-stat__stat-description--col3 {
            display: none;
        }

        .store-reviews-stat__block-title {
            font-size: 15px;
            margin: 0px;
            height: 40px;
            margin-bottom: 17px;
        }

        .store-reviews-stat__block:nth-child(1) {
            width: auto;
        }

        .store-reviews-stat__block:nth-child(2) {
            width: auto !important;
        }

        .store-reviews-stat__block--1>.store-reviews-stat__block-title {
            width: 72px;
        }

        .store-reviews-stat__block--2>.store-reviews-stat__block-title {
            width: 180px;
        }

        .store-reviews-stat__block {
            align-self: flex-start;
        }

        .store-reviews-stat__info {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__col .store-reviews-stat__block:nth-child(2) {
            margin-top: 0px;
        }

        .store-reviews-stat__col {
            flex-direction: row;
        }

        .store-reviews-stat__info-row {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__full-stars svg,
        .store-reviews-stat__empty-stars svg {
            width: 24px;
        }

        .store-reviews-stat__link-all--right {
            margin: 0px;
            width: 104px;
            height: 62px;
            font-size: 15px;
            padding: 16px;
        }

        .store-reviews-stat__link-all--bottom {
            display: none;
        }

        .store-reviews-stat__block:nth-child(2) {
            justify-content: space-evenly;
            display: flex;
            width: 50%;
        }
    }

    @media (min-width: 540px) and (max-width: 719px) {
        .store-reviews-stat__title {
            font-size: 18px;
            line-height: 25px;
            margin-top: 10px;
            margin-bottom: 23px;
            padding-left: 12px;
        }
        .store-reviews-stat__stat-description--hide {
            width: auto;
            display: flex !important;
        }

        .store-reviews-stat__stat-description--col3 {
            display: none;
            margin-top: -3px !important;
        }

        .store-reviews-stat__block-title {
            font-size: 15px;
            margin: 0px;
            height: 40px;
            margin-bottom: 17px;
        }
        .store-reviews-stat__stat-description {
            line-height: 13px;
            margin-top: 11px;
        }
        .store-reviews-stat__link-all--right {
            display: none;
        }

        .store-reviews-stat__content {
            padding: 40px 21px 0px 28px;
        }
        .store-reviews-stat__stat-text {
            line-height: 30px;
        }
        .store-reviews-stat__block--1>.store-reviews-stat__block-title {
            width: 72px;
        }

        .store-reviews-stat__block--2>.store-reviews-stat__block-title {
            width: 180px;
        }

        .store-reviews-stat__block {
            align-self: flex-start;
        }

        .store-reviews-stat__info {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__col .store-reviews-stat__block:nth-child(2) {
            margin-top: 0px;
        }

        .store-reviews-stat__col {
            flex-direction: row;
            width: 312px;
        }

        .store-reviews-stat__info-row {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__full-stars svg,
        .store-reviews-stat__empty-stars svg {
            width: 24px;
        }

        .store-reviews-stat__block--3>.store-reviews-stat__link-all--right {
            margin: 0px;
            width: 104px;
            height: 62px;
            font-size: 15px;
            padding: 16px;
            display: none;
        }

        .store-reviews-stat__block:nth-child(2) {
            justify-content: space-evenly;
            display: flex;
        }

        .store-reviews-stat__link-all--bottom {
            display: flex;
            width: 454px;
            margin-top: -17px !important;
            height: 42px;
            margin: 0 auto;
            margin-bottom: 0px;
            margin-bottom: 15px;
            font-size: 15px;
            line-height: 17px;
        }
    }

    @media (min-width: 320px) and (max-width: 539px) {
        .store-reviews-stat__stat-text {
            line-height: 30px
        }
        .store-reviews-stat__stat-description {
            margin-top: 11px;
            line-height: 13px;
        }
        .store-reviews-stat__content {
            padding-left: 10px;
            padding-right: 14px;
            padding-bottom: 8px;
        }
        .store-reviews-stat__stat-description--col3 {
            margin-top: -5px !important;
        }
        .reviews-home__read {
            margin-top: 66px;
        }
        .reviews-home__pearson {
            left: 13px;
        }
        .reviews-home__comment-content {
            width: 100%;
            max-height: 72px;
            overflow: hidden;
        }
        .store-reviews-stat__block--4 {
            position: relative;
            left: 9px;
            top: 6px;
        }
        .store-reviews-stat__block:nth-child(2) {
            width: 160px !important;
        }
        .store-reviews-stat__link-all--right {
            padding: 0px 14px
        }
        .reviews-home__comment-block {
            padding: 20px 20px 20px 28px;
        }

        .store-reviews-stat__block-title {
            font-size: 15px;
            margin: 0px;
            height: 40px;
            margin-bottom: 17px;
        }

        .store-reviews-stat__block--4 {
            order: 4;
            justify-content: right;
            align-self: flex-end;
            width: auto !important;
        }
        .store-reviews-stat__link-all--right {
            order: 4;
            width: 102px;
            height: 50px;
            font-size: 15px;
            margin-left: auto;
        }

        .store-reviews-stat__stat-description--hide {
            width: auto;
            display: flex !important;
        }

        .store-reviews-stat__stat-description--col3 {
            display: none;
        }

        .store-reviews-stat__block {
            width: 50%;
        }

        .store-reviews-stat__block:nth-child(1) {
            width: auto;
        }

        .store-reviews-stat__block:nth-child(2) {
            order: 3;
        }

        .store-reviews-stat__link-all--bottom {
            display: none !important;
        }

        .store-reviews-stat__block--1>.store-reviews-stat__block-title {
            width: 72px;
        }

        .store-reviews-stat__block--2>.store-reviews-stat__block-title {
            width: 180px;
        }

        .store-reviews-stat__info {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__col .store-reviews-stat__block:nth-child(2) {
            margin-top: 0px;
        }

        .store-reviews-stat__col {
            flex-direction: row;
            width: 312px;
        }

        .store-reviews-stat__info-row {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__full-stars svg,
        .store-reviews-stat__empty-stars svg {
            width: 24px;
        }

        .store-reviews-stat__block--3>.store-reviews-stat__link-all--right {
            margin: 0px;
            width: 104px;
            height: 62px;
            font-size: 15px;
            padding: 16px;
            display: none;
        }

        .store-reviews-stat__block:nth-child(2) {
            justify-content: space-evenly;
            display: flex;
            width: 50%;
        }

        .store-reviews-stat__link-all--bottom {
            display: flex;
            width: 100%;
            height: 42px;
            margin: 0 auto;
            margin-bottom: 0px;
            margin-bottom: 15px;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="store-reviews-stat__title">
            <?php echo $text_reviews_about;?>
        </div>
    </div>
</div>

<div class="store-reviews-stat reviews-stat-home">
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
                                <div
                                    class="store-reviews-stat__stat-description store-reviews-stat__stat-description--col3 store-reviews-stat__stat-description--hide">
                                    <?php echo $text_mind; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="store-reviews-stat__block store-reviews-stat__block--3">
                    <div class="store-reviews-stat__info store-reviews-stat__info--column">
                        <div class="store-reviews-stat__block-title">
                            <?php echo $text_recomendation; ?>
                        </div>
                        <div class="store-reviews-stat__info">
                            <div class="store-reviews-stat__stat-text">
                                0%
                            </div>
                            <div
                                class="store-reviews-stat__stat-description store-reviews-stat__stat-description--col2">
                                <?php echo $text_count_planingbuy; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="store-reviews-stat__block store-reviews-stat__block--4">
                    <a href="/otzivi/" class="store-reviews-stat__link-all--right"><?php echo $text_all_ratings;?></a>
                </div>
            </div>
            <a href="/otzivi/" class="store-reviews-stat__link-all--bottom"><?php echo $text_all_ratings;?></a>
        </div>
    </div>
</div>

<!-- Slider main container -->
<div class="swiper-container reviews-home">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php  $index = 0;?>
        <?php for($j = 0; $j < ceil(count($ratings_home)/3); $j++) { ?>
        <div class="swiper-slide">
            <div class="container">
                <div class="row">
            <div class="reviews-home__group720">
                <?php 
                    for($i = 0; $i < 3; $i++) {
                        if($ratings_home[$index]['comment'] !== null) {

                ?>
                <div class="reviews-home__group">
                    <div class="reviews-home__comment-block">
                        <div class="reviews-home__comment-content">
                            <?php echo utf8_substr(strip_tags(html_entity_decode($ratings_home[$index]['comment'], ENT_QUOTES, 'UTF-8')), 0, 288) . '..' ;?>
                        </div>
                        <a href="/otzivi#<?php echo $ratings_home[$index]['rate_id']; ?>" class="reviews-home__read">
                            <?php echo $title_read_more; ?>
                        </a>
                    </div>
                    <div class="reviews-home__pearson">
                        <div class="reviews-home__gender">
                            <?php if($ratings_home[$index]['customer_sex'] === 'famale') { ?>
                            <img class="lazy" data-src="<?php echo '/image/icons/manager-w.svg'; ?>">
                            
                            <? } else { ?>
                            <img class="lazy" data-src=" <?php echo 'image/icons/manager-m.svg'; ?>">
                           
                            <?php } ?>
                        </div>
                        <div class="reviews-home__right-col">
                            <div class="reviews-home__name">
                                <?php echo $ratings_home[$index]['customer_name'];?>
                            </div>
                            <div class="reviews-home__publish-time">
                                <?php echo $ratings_home[$index]['date_added'];?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } $index++; } ?>
            </div>
        </div>
    </div>
        </div>
        <?php } ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination reviews-home__pagination"></div>
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
        animateNumbers($('.store-reviews-stat__stat-text')[2], (isNaN("<?php echo $planing_buy?>")) ? '0%' : "<?php echo $planing_buy?>");
        $('#service_rate').text("<?php echo sprintf('%.1f', str_replace(",",".", $general['summ']['service'])); ?>");
        animateNumbers($('.store-reviews-stat__full-stars'), "<?php echo $data['general']['summ_perc']['service'];?>", true);
    });

    let page = 1;
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
                console.log(json);

                page++;
                $('.review__more').before(json);
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
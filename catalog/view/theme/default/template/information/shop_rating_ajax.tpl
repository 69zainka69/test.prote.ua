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
    <div class="review__block review__comment <?php echo $color; ?>">
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
                <?php if($ratings_home['customer_sex'] === 'famale') { ?>
                    <?php echo file_get_contents(DIR_ROOT . '/catalog/view/theme/default/image/icons/manager-w.svg'); ?>
                <? } else { ?>
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
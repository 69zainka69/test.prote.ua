<svg style="display:none;height:0;width:0;">
    <style>
    .bf-attr-block-cont{overflow:hidden;}
    .bf-btn-reset1{color:#999;font-size:14px;font-family:'Trebuchet MS';cursor:pointer;white-space: nowrap;z-index: 2;}
    .bf-arrow:before{
    position:absolute;bottom:12px;right:5px;width:8px;height:8px;border-bottom:1px solid #333;border-right:1px solid #333;content:"";
    -webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg);
    -webkit-transition:border-color 0.2s ease;-moz-transition:border-color 0.2s ease;-ms-transition:border-color 0.2s ease;-o-transition:border-color 0.2s ease;transition:border-color 0.2s ease;
    -webkit-transition:all 400ms;   
    -moz-transition:all 400ms;
    -o-transition:all 400ms;
    transition:all 400ms;  
    }
    .bf-arrow.close:before{-webkit-transform:rotate(-135deg);-moz-transform:rotate(-135deg);-ms-transform:rotate(-135deg);-o-transform:rotate(-135deg);transform:rotate(-135deg);}
    .bf-panel-wrapper {position: relative;}
    .bf-sliding {overflow: hidden;display: block;}
    .bf-attr-header{font-size:16px;font-weight:bold;color:#333;font-family:'Trebuchet MS';padding:0 0 6px;border-bottom:1px solid #333;margin-top:5px;margin-bottom:21px;cursor:pointer;position:relative;}
    .bf-attr-filter label{display:block;line-height:23px;font-size:13px;padding:0 6px;cursor:pointer;color:#333;font-family:'Trebuchet MS';z-index: 5;position: relative;}
    .bf-hidden{display:none;}
    .bf-attr-block+.bf-attr-block{margin-top:15px;}
    .bf-attr-filter input[type="checkbox"], .bf-attr-filter input[type="radio"] {display:none;}
    .bf-attr-filter.checked{background:#bee9f9;position:relative;}
    .bf-attr-filter.checked:after,.bf-attr-filter.checked:before,
    .sel_filers .value:after,.sel_filers .value:before{content:"";position:absolute;right:0;top:11px;width:12px;height:1px;background-color:rgba(51,51,51,1);transition:all .2s linear}
    .bf-attr-filter.checked:after,.sel_filers .value:after{transform:translate(-50%,-50%) rotate(45deg)}
    .bf-attr-filter.checked:before,.sel_filers .value:before{transform:translate(-50%,-50%) rotate(-45deg)}
    .bf-attr-filter.checked:after{z-index:1}
    .bf-c-3{color:#999;padding-left:10px;}
    .bf-price-container input{border:1px solid #cfeffb;font-size:13px;color:#999;width:46%;text-align:center;}
    .bf-price-container .bf-range-max{float:right;}
    #res_filter{font-family:'Trebuchet MS';margin-bottom:30px;padding-left:23px;padding-top:5px;}
    #res_filter .boxtitle{color:#999;margin-bottom:5px;}
    .filter_result{display:flex;justify-content:space-between;}
    .sel_filers{display:inline-block;line-height:22px;color:#cbcbcb;margin:0 22px 5px 0;}
    .sel_filers .value{background:#bee9f9;margin-left:7px;padding:0 40px 0 14px;color:#333;font-size:13px;position:relative;cursor:pointer;}
    .sel_filers span{display:inline-block;}
    .bf-buttonclear-box{display:none;}
    .bf-sliding-show{cursor:pointer;font-family:'Trebuchet MS';color: #00adee;margin:5px 0 8px;}
    .bf-disabled{display:none;}
    @media (max-width:1279px){
    #res_filter .boxtitle{color:#FD9710;font-size:20px;margin:12px 0;}
    .bf-btn-reset1{color:#FD9710;font-size:20px;position:relative;padding:2px 0 3px 40px;margin:25px 0 5px;}
    .bf-btn-reset1:hover{color:#FD9710;}
    .bf-btn-reset1 span{display:none;}
    .bf-btn-reset1:before{content:'';position:absolute;left:0;top:0;width:25px;height:25px;border:3px solid #FD9710; border-radius: 50%;}
    .bf-btn-reset1:after{content:'';position:absolute;left:2px;top:10px;width:22px;height:3px;background:#FD9710;transform:rotate(-45deg)}
    #res_filter{margin-bottom:10px;}
    }
    
    </style>
    </svg>
    
    <?php $isResponsive=false; ?>
    <?php $responsivePos=false; ?>
    
    <?php 
    
    
    if (count($filters)) : ?>
    
    <div class="bf-panel-wrapper<?php if($isResponsive) : ?> bf-responsive<?php endif; ?> <?php echo $responsivePos; ?> bf-layout-id-<?php echo $layout_id;?>">
        <div class="filter_close"><?php echo $filter_close; ?></div>
        <div class="modal-filter__close"></div>
        <div class="bf-btn-show"></div>
        <a class="bf-btn-reset" onclick="BrainyFilter.reset();"></a>
        <div class="box bf-check-position">
            <? /* <!-- div class="box-heading"><?php echo $lang_block_title; ?><?php if ($isHorizontal) : ?><a class="bf-toggle-filter-arrow"></a><input type="reset" class="bf-buttonclear" onclick="BrainyFilter.reset();" value="<?php echo $reset; ?>" /><?php endif; ?></div --> */  ?>
            <div class="brainyfilter-panel box-content <?php if ($settings['submission']['hide_panel']) : ?>bf-hide-panel<?php endif; ?>">
                <form class="bf-form 
                        <?php if ($settings['behaviour']['product_count']) : ?> bf-with-counts<?php endif; ?> 
                        <?php if ($sliding) : ?> bf-with-sliding<?php endif; ?>
                        <?php if ($settings['submission']['submit_type'] === 'button' && $settings['submission']['submit_button_type'] === 'float') : ?> bf-with-float-btn<?php endif; ?>
                        <?php if ($limit_height) : ?> bf-with-height-limit<?php endif; ?>"
                      data-height-limit="<?php echo $limit_height_opts; ?>"
                      data-visible-items="<?php //echo $slidingOpts; ?>"
                      data-hide-items="<?php echo $slidingMin; ?>"
                      data-submit-type="<?php echo $settings['submission']['submit_type']; ?>"
                      data-submit-delay="<?php echo (int)$settings['submission']['submit_delay_time']; ?>"
                      data-resp-max-width="<?php echo (int)$settings['style']['responsive']['max_width']; ?>"
                      data-resp-collapse="<?php echo (int)$settings['style']['responsive']['collapsed']; ?>"
                      data-resp-max-scr-width ="<?php echo (int)$settings['style']['responsive']['max_screen_width']; ?>"
                      method="get" action="index.php">
                    <?php if ($currentRoute === 'product/search') : ?>
                    <input type="hidden" name="route" value="product/search" />
                    <?php else : ?>
                    <input type="hidden" name="route" value="product/category" />
                    <?php endif; ?>
                    <?php if ($currentPath) : ?>
                    <input type="hidden" name="path" value="<?php echo $currentPath; ?>" />
                    <?php endif; ?>
                    <?php if ($manufacturerId) : ?>
                    <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturerId; ?>" />
                    <?php endif; ?>
    
                    <?php foreach ($filters as $i => $section) : ?>
                            
                        <?php if ($section['type'] == 'price') : ?>
                            <?php $sliderType = $section['control'] === 'slider_lbl_inp' ? 3 : ($section['control'] === 'slider_lbl' ? 2 : 1); ?>
                            <?php $inputType  = in_array($sliderType, array(1, 3)) ? 'text' : 'hidden'; ?>
                            <div class="bf-attr-block bf-price-filter">
                            <div class="bf-attr-header<?php if ($section['collapsed']) : ?> bf-collapse<?php endif; ?><?php if (!$i) : ?> bf-w-line<?php endif; ?>">
                                <?php echo $lang_price; ?><span class="bf-arrow">&nbsp;</span>
                            </div>
                            <div class="bf-attr-block-cont">
                                <div class="bf-price-container box-content bf-attr-filter">
                                    <?php if (in_array($sliderType, array(1, 3))) : ?>
                                    <div class="bf-cur-symb">
                                        <input type="hidden" name="symbol" data-symbol="<?php echo $currency_symbol; ?>"/>
                                        <?php /*<!-- <span class="bf-cur-symb-left"><?php echo $currency_symbol; ?></span> -->*/ ?>
                                        <input type="text" class="bf-range-min" name="bfp_price_min" data-symbol="<?php echo $currency_symbol; ?>" value="<?php echo $lowerlimit; ?>" maxlength="<?php echo strlen($upperlimit); ?>" size="4" /><!-- <span class="ndash">&#8211;</span> -->
                                        <?php /*<!-- <span class="bf-cur-symb-left"><?php echo $currency_symbol; ?></span> -->*/ ?>
                                        <input type="text" class="bf-range-max" name="bfp_price_max" value="<?php echo $upperlimit; ?>" maxlength="<?php echo strlen($upperlimit); ?>" size="4" /> 
                                    </div>
                                    <?php else : ?>
                                    <input type="hidden" class="bf-range-min" name="bfp_price_min" value="<?php echo $lowerlimit; ?>" />
                                    <input type="hidden" class="bf-range-max" name="bfp_price_max" value="<?php echo $upperlimit; ?>" /> 
                                    <?php endif; ?>
                                    <?php /*<!-- <div class="bf-price-slider-container <?php if($sliderType === 2 || $sliderType === 3): ?>bf-slider-with-labels<?php endif; ?>">
                                        <div class="bf-slider-range" data-slider-type="<?php echo $sliderType; ?>"></div>
                                    </div> -->*/ ?>
                                </div>
                            </div>
                            </div>
                    
                        <?php elseif ($section['type'] == 'search') : ?>
                    
                            <div class="bf-attr-block bf-keywords-filter">
                            <div class="bf-attr-header<?php if ($section['collapsed']) : ?> bf-collapse<?php endif; ?><?php if (!$i) : ?> bf-w-line<?php endif; ?>">
                                <?php echo $lang_search; ?><span class="bf-arrow">&nbsp;</span>
                            </div>
                            <div class="bf-attr-block-cont">
                                <div class="bf-search-container bf-attr-filter">
                                    <div>
                                        <input type="text" class="bf-search" name="bfp_search" value="<?php echo $bfSearch; ?>" /> 
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                        <?php elseif ($section['type'] == 'category') : ?>
                            
                            <div class="bf-attr-block">
                            <div class="bf-attr-header<?php if ($section['collapsed']) : ?> bf-collapse<?php endif; ?><?php if (!$i) : ?> bf-w-line<?php endif; ?>">
                                <?php echo $lang_categories; ?><span class="bf-arrow">&nbsp;</span>
                            </div>
                            <div class="bf-attr-block-cont">
                                <?php $groupUID = 'c0'; ?>
    
                                <?php if ($section['control'] == 'select') : ?>
                                <div class="bf-attr-filter bf-attr-<?php echo $groupUID; ?> bf-row">
                                    <div class="bf-cell">
                                        <select name="<?php echo "bfp_{$groupUID}"; ?>">
                                            <option value="" class="bf-default"><?php echo $default_value_select; ?></option>
                                            <?php foreach ($section['values'] as $cat) : $catId = $cat['id'] ?>
                                                <?php $isSelected = isset($selected[$groupUID]) && in_array($catId, $selected[$groupUID]); ?>
                                                <option value="<?php echo $catId; ?>" class="bf-attr-val" <?php if ($isSelected) : ?>selected="true"<?php endif; ?>>
                                                    <?php echo str_repeat('-', $cat['level']) . ' ' . $cat['name']; ?> 
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php else : ?>
                                    <?php foreach ($section['values'] as $cat) : $catId = $cat['id']; ?>
                                    <div class="bf-attr-filter bf-attr-<?php echo $groupUID; ?> bf-row">
                                        <span class="bf-cell bf-c-1">
                                            <input id="bf-attr-<?php echo $groupUID . '_' . $catId . '_' . $layout_id; ?>"
                                                   data-filterid="bf-attr-<?php echo $groupUID . '_' . $catId; ?>"
                                                   type="<?php echo $section['control']; ?>" 
                                                   name="<?php echo "bfp_{$groupUID}"; ?><?php if ($section['control'] === 'checkbox') { echo "_{$catId}"; } ?>"
                                                   value="<?php echo $catId; ?>" 
                                                   <?php if (isset($selected[$groupUID]) && in_array($catId, $selected[$groupUID])) : ?>checked<?php endif; ?> />
                                        </span>
                                        <span class="bf-cell bf-c-2 bf-cascade-<?php echo $cat['level']; ?>">
                                            <span class="bf-hidden bf-attr-val"><?php echo $catId; ?></span>
                                            <label for="bf-attr-<?php echo $groupUID . '_' . $catId . '_' . $layout_id; ?>">
                                                <?php echo $cat['name']; ?> 
                                            </label>
                                        </span>
                                        <span class="bf-cell bf-c-3">&nbsp;</span>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            </div>
                    
                        <?php else : ?>
                            
                            <?php $curGroupId = null; ?>
                            <?php foreach ($section['array'] as $groupId => $group) : ?>
                                <?php if (isset($group['group_id']) && $settings['behaviour']['attribute_groups']) : ?>
                                    <?php if ($curGroupId != $group['group_id']) : ?>
                                        <div class="bf-attr-group-header"><?php echo $group['group']; ?></div>
                                        <?php $curGroupId = $group['group_id']; ?>
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                                <?php $groupUID = substr($section['type'], 0, 1) . $groupId; ?>
                                <div class="bf-attr-block<?php if (in_array($group['type'], array('slider', 'slider_lbl', 'slider_lbl_inp'))) : ?> bf-slider<?php endif; ?>">
                                <div class="bf-attr-header<?php if ($section['collapsed']) : ?> bf-collapse<?php endif; ?><?php if (!$i) : ?> bf-w-line<?php endif; ?>">
                                    <?php echo $group['name']; ?><span class="bf-arrow">&nbsp;</span>
                                </div>
                                <div class="bf-attr-block-cont">
                                    <?php $group['type'] = isset($group['type']) ? $group['type'] : 'checkbox'; ?>
                                    
                                    <?php if ($group['type'] == 'select') : ?>
                                    
                                        <div class="bf-attr-filter bf-attr-<?php echo $groupUID; ?> bf-row">
                                            <div class="bf-cell">
                                                <select name="<?php echo "bfp_{$groupUID}"; ?>">
                                                    <option value="" class="bf-default"><?php echo $default_value_select; ?></option>
                                                    <?php foreach ($group['values'] as $value) : ?>
                                                        <?php $isSelected = isset($selected[$groupUID]) && in_array($value['id'], $selected[$groupUID]); ?>
                                                        <option value="<?php echo $value['id']; ?>" class="bf-attr-val" <?php if ($isSelected) : ?>selected="true"<?php endif; ?>><?php echo $value['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    
                                    <?php elseif (in_array($group['type'], array('slider', 'slider_lbl', 'slider_lbl_inp'))) : ?>
                                    
                                    <div class="bf-attr-filter bf-attr-<?php echo $groupUID; ?> bf-row">
                                        <div class="bf-cell">
                                            <div class="bf-slider-inputs">
                                                <?php $isMinSet = isset($selected[$groupUID]['min']);// && isset($group['values'][$selected[$groupUID]['min']]); ?>
                                                <?php $isMaxSet = isset($selected[$groupUID]['max']);// && isset($group['values'][$selected[$groupUID]['max']]); ?>
                                                <?php $sliderType = $group['type'] === 'slider_lbl_inp' ? 3 : ($group['type'] === 'slider_lbl' ? 2 : 1); ?>
                                                <input type="hidden" name="bfp_min_<?php echo $groupUID; ?>" value="<?php echo $isMinSet ? $selected[$groupUID]['min'] : 'na'; ?>" class="bf-attr-min-<?php echo $groupUID; ?>" data-min-limit="<?php echo $group['min']; ?>" />
                                                <input type="hidden" name="bfp_max_<?php echo $groupUID; ?>" value="<?php echo $isMaxSet ? $selected[$groupUID]['max'] : 'na'; ?>" class="bf-attr-max-<?php echo $groupUID; ?>" data-max-limit="<?php echo $group['max']; ?>" /> 
                                                <?php if ($group['type'] !== 'slider_lbl') : ?>
                                                <?php $minLbl = ''; $maxLbl = '';
                                                    if ($isMinSet) {
                                                        foreach ($group['values'] as $v) {
                                                            if ($v['s'] == $selected[$groupUID]['min']) {
                                                                $minLbl = $v['n'];
                                                                break;
                                                            }
                                                        } 
                                                    }
                                                    if ($isMaxSet) {
                                                        foreach ($group['values'] as $v) {
                                                            if ($v['s'] == $selected[$groupUID]['max']) {
                                                                $maxLbl = $v['n'];
                                                                break;
                                                            }
                                                        } 
                                                    }
                                                ?>
                                                <input type="text" name="" class="bf-slider-text-inp-min bf-slider-input" value="<?php echo $minLbl; ?>" placeholder="<?php echo $lang_empty_slider; ?>" />
                                                <span class="ndash">&#8211;</span>
                                                <input type="text" name="" class="bf-slider-text-inp-max bf-slider-input" value="<?php echo $maxLbl; ?>" placeholder="<?php echo $lang_empty_slider; ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="bf-slider-container-wrapper <?php if($sliderType === 2 || $sliderType === 3): ?>bf-slider-with-labels<?php endif; ?>">
                                                <div class="bf-slider-container" data-slider-group="<?php echo $groupUID; ?>" data-slider-type="<?php echo $sliderType; ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php elseif ($group['type'] === 'grid') : ?>
                                    
                                    <div class="bf-attr-filter bf-attr-<?php echo $groupUID; ?> bf-row">
                                        <div class="bf-grid">
                                            <?php foreach ($group['values'] as $value) : ?>
                                            <?php $valueId  = $value['id']; ?>
                                            <div class="bf-grid-item">
                                                <input id="bf-attr-<?php echo $groupUID . '_' . $valueId . '_' . $layout_id; ?>" class="bf-hidden"
                                                        data-filterid="bf-attr-<?php echo $groupUID . '_' . $valueId; ?>"
                                                        type="radio" 
                                                        name="<?php echo "bfp_{$groupUID}"; ?>"
                                                        value="<?php echo $valueId; ?>" 
                                                        <?php if (isset($selected[$groupUID]) && in_array($valueId, $selected[$groupUID])) : ?>checked<?php endif; ?> />
                                                <label for="bf-attr-<?php echo $groupUID . '_' . $valueId . '_' . $layout_id; ?>">
                                                    <img src="image/<?php echo $value['image'];?>" alt="<?php echo $value['name']; ?>" />
                                                </label>
                                                <span class="bf-hidden bf-attr-val"><?php echo $valueId; ?></span>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                    <?php else : ?>
                                    
                                        <?php foreach ($group['values'] as $value) : ?>
                                        <?php $valueId  = $value['id']; ?>
                                        <div class="bf-attr-filter bf-attr-<?php echo $groupUID; ?> bf-row<?php if (isset($selected[$groupUID]) && in_array($valueId, $selected[$groupUID])) : ?> checked<?php endif; ?>">
                                            <?php /*<!-- <span class="bf-cell bf-c-1"> -->*/ ?>
                                                <input id="bf-attr-<?php echo $groupUID . '_' . $valueId . '_' . $layout_id; ?>"
                                                       data-filterid="bf-attr-<?php echo $groupUID . '_' . $valueId; ?>"
                                                       type="<?php echo $group['type']; ?>" 
                                                       name="<?php echo "bfp_{$groupUID}"; ?><?php if ($group['type'] === 'checkbox') { echo "_{$valueId}"; } ?>"
                                                       value="<?php echo $valueId; ?>" 
                                                       <?php if (isset($selected[$groupUID]) && in_array($valueId, $selected[$groupUID])) : ?>checked<?php endif; ?> />
                                            <?php /*<!-- </span> -->*/ ?>
                                            <span class="bf-cell bf-c-2 <?php if ($section['type'] == 'rating') echo 'bf-rating-' . $valueId; ?>">
                                                <span class="bf-hidden bf-attr-val"><?php echo $valueId; ?></span>
                                                <label for="bf-attr-<?php echo $groupUID . '_' . $valueId . '_' . $layout_id; ?>">
                                                    <?php if ($section['type'] === 'option') : ?>
                                                        <?php if ($group['mode'] === 'img' || $group['mode'] === 'img_label') : ?>
                                                            <img src="image/<?php echo $value['image'];?>" alt="<?php echo $value['name']; ?>" />
                                                        <?php endif; ?>
                                                        <?php if ($group['mode'] === 'label' || $group['mode'] === 'img_label') : ?>
                                                            <?php echo $value['name']; ?>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <?php echo  $value['name']; ?> 
                                                    <?php endif; ?>
                                                    <span class="bf-cell bf-c-3">&nbsp;</span>
                                                </label>
    
                                            </span>
                                            
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                    <?php endforeach; ?>
                    <?php if ($settings['submission']['submit_type'] == 'button') : ?><div class="bf-buttonclear-box">
                             <input type="button" value="<?php echo $lang_submit; ?>" class="btn btn-primary bf-buttonsubmit" onclick="BrainyFilter.sendRequest(jQuery(this));BrainyFilter.loadingAnimation();return false;" <?php if ($settings['submission']['submit_button_type'] != 'fix' && $settings['submission']['submit_type'] != 'button' )  : ?>style="display:none;" <?php endif; ?> />
                       
                    </div><?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <script>
    var bfLang = {
        show_more : '<?php echo $lang_show_more; ?>',
        show_less : '<?php echo $lang_show_less; ?>'
    };
    $(document).ready(function() {
    
    if(window.innerWidth<=768){
        $('form.bf-form').data('visible-items',0);
    } else {
        $('form.bf-form').data('visible-items',4);
    }
    
    BrainyFilter.requestCount = BrainyFilter.requestCount || <?php echo $settings['behaviour']['product_count'] ? 'true' : 'false'; ?>;
    BrainyFilter.requestPrice = BrainyFilter.requestPrice || <?php echo $settings['behaviour']['sections']['price']['enabled'] ? 'true' : 'false'; ?>;
    BrainyFilter.min = BrainyFilter.min || <?php echo $priceMin; ?>;
    BrainyFilter.max = BrainyFilter.max || <?php echo $priceMax; ?>;
    BrainyFilter.lowerValue = BrainyFilter.lowerValue || <?php echo $lowerlimit; ?>; 
    BrainyFilter.higherValue = BrainyFilter.higherValue || <?php echo $upperlimit; ?>;
    BrainyFilter.currencySymb = BrainyFilter.currencySymb || '<?php echo $currency_symbol; ?>';
    BrainyFilter.hideEmpty = BrainyFilter.hideEmpty || <?php echo (int)$settings['behaviour']['hide_empty']; ?>;
    BrainyFilter.baseUrl = BrainyFilter.baseUrl || "<?php echo $base; ?>";
    BrainyFilter.currentRoute = BrainyFilter.currentRoute || "<?php echo $currentRoute; ?>";
    <?php if ($redirectToUrl) : ?>
    BrainyFilter.redirectTo = BrainyFilter.redirectTo || "<?php echo $redirectToUrl; ?>";
    <?php endif; ?>
    jQuery(function() {
        if (! BrainyFilter.isInitialized) {  
            BrainyFilter.isInitialized = true;
            if (typeof jQuery.fn.slider === 'undefined') {
                //jQuery.getScript('https://code.jquery.com/ui/1.11.2/jquery-ui.min.js', function(){
                //    jQuery('head').append('<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" type="text/css" />');
                //    jQuery.getScript('catalog/view/javascript/jquery.ui.touch-punch.min.js');
                    
                    BrainyFilter.init();
                //});
            } else {
                BrainyFilter.init();
            }
        }
    });
    BrainyFilter.sliderValues = BrainyFilter.sliderValues || {};
    <?php if (count($filters)) : ?>
    <?php foreach ($filters as $i => $section) : ?>
    <?php if (isset($section['array']) && count($section['array'])) : ?>
    <?php foreach ($section['array'] as $groupId => $group) : ?>
    <?php $groupUID = substr($section['type'], 0, 1) . $groupId; ?>
    <?php if (in_array($group['type'], array('slider', 'slider_lbl', 'slider_lbl_inp'))) : ?>
    BrainyFilter.sliderValues['<?php echo $groupUID; ?>'] = <?php echo json_encode($group['values']); ?>;
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    });
    </script>
    <?php endif; ?>
    
    <script>
    $(document).ready(function() {
        obj = $('.bf-attr-block');
        html ='';
        obj.each(function(index,element){
    
            obj_name = $(this).find('.bf-attr-header').text();
    
            if($(this).hasClass('bf-price-filter')){
                price_min = $(this).find('[name="bfp_price_min"]').val();
                price_max = $(this).find('[name="bfp_price_max"]').val();
                if(price_min!=<?php echo $priceMin; ?>||price_max!=<?php echo $priceMax; ?>){
                    symbol = $(this).find('[name="symbol"]').data('symbol');
                    attr_id= 'price';
                    html += '<div class="sel_filers"><span>'+obj_name+':</span><span class="value" data-click="'+attr_id+'">'+price_min+' '+symbol+' - '+price_max+' '+symbol+'</span></div>';
                }
            } else {
                obj_chk = $(this).find('.checked');
                obj_chk.each(function(index,element){
                    attr_value= $(this).find('label').text();
                    attr_id= $(this).find('label').attr('for');
                    html += '<div class="sel_filers"><span>'+obj_name+':</span><span class="value" data-click="'+attr_id+'">'+attr_value+'</span></div>';
                    
                });
            }
        });
        if(html){
            html_clear='<a class="bf-btn-reset1 catalog-filter__bf-btn-reset1         " onclick="$(\'.bf-btn-reset\').click();"><?php echo $button_clear; ?></a>';
            html='<div class="catalog-filter__boxtitle boxtitle"><?php echo $text_selected_filters ;?></div><div class="filter_result catalog-filter__filter-result"><div class="delected_filter">'+html+'</div>'+html_clear+'</div>';
        }
        $('#res_filter').html(html);
        $('#res_filter2').html(html);
        let filterBlocks = ['#res_filter', '#res_filter2'];
        filterBlocks.forEach((block) => {
        $(`${block} .sel_filers .value`).on('click',function() {
            id = $(this).data('click');
            if(id=='price'){
                $('[name="bfp_price_min"]').val(<?php echo $priceMin; ?>);
                $('[name="bfp_price_max"]').val(<?php echo $priceMax; ?>).change();
            } else {
                $('label[for="'+id+'"]').click();
            }
        });
    });

        /*BrainyFilter.expandBlock(v);
        alert('ok');*/
        //BrainyFilter.shrinkBlock(v, 0);
    });
    
    </script>
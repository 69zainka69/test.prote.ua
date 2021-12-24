<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#rates" aria-controls="home" role="tab" data-toggle="tab">
                    <i class="fa fa-star"></i>
                    <?php echo $rates_block_title;?>
                </a>
            </li>
            <!--<li role="presentation">
                <a href="#settings" aria-controls="profile" role="tab" data-toggle="tab">
                    <i class="fa fa-cogs"></i>
                    <?php echo $settings_block_title;?>
                </a>
            </li> -->
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="rates">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-star"></i> <?php echo $rates_block_title;?></h3>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-hover" style="min-width: 900px">
                            <thead>
                            <tr>
                                <th><?php echo $date ;?></th>
                                <th><?php echo $name ;?></th>
                                <th width="70px"><?php echo $title_service ;?></th>
                                <th width="70px"><?php echo $title_delivery ;?></th>
                                <th width="70px"><?php echo $title_goods ;?></th>
                                <th><?php echo $comment ;?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($ratings as $rating){ ?>
                                <tr>
                                    <td class="text-center"><?php echo date('d.m.y H:i', strtotime($rating['date_added']));?></td>
                                    <td class="">
                                        <div>
                                            <b class="<?php if(isset($rating['customer_id']) && $rating['customer_id'] != 0) echo 'text-primary';?>">
                                                <?php echo $rating['customer_name'];?>
                                            </b>
                                            <?php if(isset($rating_answers[$rating['rate_id']])){ ?>
                                            <span class="label label-success"><?php echo $answered; ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="rates_table_email"><?php echo $rating['customer_email'];?></div>
                                    </td>
                                    <td class="">
                                        <div class="rate-stars">
                                            <div class="rate-star <?php if($rating['service_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                            <div class="rate-star <?php if($rating['service_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                            <div class="rate-star <?php if($rating['service_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                            <div class="rate-star <?php if($rating['service_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                            <div class="rate-star <?php if($rating['service_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="rate-stars">
                                            <div class="rate-star <?php if($rating['delivery_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                            <div class="rate-star <?php if($rating['delivery_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                            <div class="rate-star <?php if($rating['delivery_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                            <div class="rate-star <?php if($rating['delivery_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                            <div class="rate-star <?php if($rating['delivery_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="rate-stars">
                                            <div class="rate-star <?php if($rating['goods_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                            <div class="rate-star <?php if($rating['goods_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                            <div class="rate-star <?php if($rating['goods_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                            <div class="rate-star <?php if($rating['goods_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                            <div class="rate-star <?php if($rating['goods_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                        </div>
                                    </td>
                                    <td class=""><?php echo utf8_substr(strip_tags(html_entity_decode($rating['comment'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..' ;?></td>
                                    <td class="">
                                        <?php if($rating['rate_status'] == 1){ ?>
                                        <button id="change_status-<?php echo $rating['rate_id']?>" class="btn btn-success change_status_button"><i class="fa fa-check-circle"></i></button>
                                        <?php }else{ ?>
                                        <button id="change_status-<?php echo $rating['rate_id']?>" class="btn btn-danger change_status_button"><i class="fa fa-times-circle"></i></button>
                                        <?php }?>
                                        &nbsp;&nbsp;
                                        <a data-original-title="Delete" href="<?php echo $delete_link.'&rating_id=' . $rating['rate_id']?>" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>

                                    <td>
                                        <a data-original-title="View" href="<?php echo $view_rate_link.'&rating_id=' . $rating['rate_id']?>" data-toggle="tooltip" title="" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>
                            <?php }?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
           <!-- <div role="tabpanel" class="tab-pane" id="settings">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-cogs"></i> <?php echo $settings_block_title;?></h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-shop_rate" class="">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-moderate"><?php echo $entry_moderate; ?></label><br>
                                            <i>(<?php echo $entry_moderate_desc; ?>)</i>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_moderate" value="1" <?php if ($shop_rating_moderate) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-authorized"><?php echo $entry_authorized; ?></label><br>
                                            <i>(<?php echo $entry_authorized_desc; ?>)</i>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_authorized" value="1" <?php if ($shop_rating_authorized) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-shop_rating"><?php echo $entry_summary; ?></label><br>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_summary" value="1" <?php if ($shop_rating_summary) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-shop_rating"><?php echo $entry_shop_rating; ?></label><br>
                                            <i>(<?php echo $entry_shop_rating_desc; ?>)</i>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_shop_rating" value="1" <?php if ($shop_rating_shop_rating) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-site_rating"><?php echo $entry_site_rating; ?></label><br>
                                            <i>(<?php echo $entry_site_rating_desc; ?>)</i>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_site_rating" value="1" <?php if ($shop_rating_site_rating) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-good_bad"><?php echo $entry_good_bad; ?></label>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_good_bad" value="1" <?php if ($shop_rating_good_bad) echo 'checked'; ?>>
                                        </td>
                                    </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <!--
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tbody>

                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_status; ?></label></td>
                                        <td>
                                            <select name="shop_rating_status" id="input-status" class="form-control">
                                                <?php if ($shop_rating_status) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="shop_rating_installed" value="<?php echo $installed; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_email; ?></label></td>
                                        <td>
                                            <input type="text" class="form-control" name="shop_rating_email" value="<?php echo $shop_rating_email; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_notify; ?></label></td>
                                        <td>
                                            <input type="checkbox" class="form-control" name="shop_rating_notify" <?php if ($shop_rating_notify) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_count; ?></label></td>
                                        <td>
                                            <input type="text" class="form-control" name="shop_rating_count" value="<?php echo $shop_rating_count; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-shop_rating_request_status"><?php echo $entry_request_mail_status; ?></label></td>
                                        <td>
                                            <select name="shop_rating_request_status" id="input-shop_rating_request_status" class="form-control">

                                                <?php if ($shop_rating_request_status == 0) { ?>
                                                    <option value="0" selected="selected"><?php echo $text_disabled_not_sent; ?></option>
                                                <?php } else { ?>
                                                <option value="0"><?php echo $text_disabled_not_sent; ?></option>
                                                <?php } ?>

                                                <?php foreach ($order_statuses as $order_status) { ?>
                                                <?php if ($order_status['order_status_id'] == $shop_rating_request_status) { ?>
                                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                                <?php } ?>
                                                <?php } ?>

                                            </select>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                                <table id="custom-types" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Дополнительные типы оценок</th>
                                    </tr>
                                    <tr>
                                        <th>Заголовок</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <input id="add-custom-type-input" type="text" class="form-control">
                                        </td>
                                        <td style="width: 100px">
                                            <a id="add-custom-type" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                    <?php foreach($custom_types as $type) { ?>
                                    <tr id="custom-tr-<?php echo $type['id']; ?>">
                                        <td class="text-left">
                                            <input id="custom-type-input-<?php echo $type['id']; ?>" type="text" class="form-control" value="<?php echo $type['title']; ?>">
                                        </td>
                                        <td style="width: 100px">
                                            <a title="<?php if($type['status'] == '1') {echo 'Enabled';}else{echo 'Disabled';} ?>" class="btn btn-<?php if($type['status'] == '1') {echo 'info';}else{echo 'default';} ?> pull-left custom-change-status" id="custom-change-status-<?php echo $type['id']; ?>">
                                                <i class="fa fa-power-off"></i>
                                            </a>
                                            <a title="Remove" class="btn btn-danger pull-right custom-remove" id="custom-remove-<?php echo $type['id']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Текст запроса на отзыв</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-right">
                                                <label class="control-label" for="input-status"><?php echo $entry_request_subject; ?></label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="shop_rating_request_subject" value="<?php echo $shop_rating_request_subject; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" style="width: 250px">
                                                <label class="control-label"><?php echo $tokens_label; ?></label>
                                                <p>[store_name] - <?php echo $store_name; ?></p>
                                                <p>[store_name_link] - <?php echo $store_name_link; ?></p>
                                                <p>[customer_name] - <?php echo $customer_name; ?></p>
                                                <p>[ratings_link] - <?php echo $ratings_link; ?></p>
                                                <div style="margin-top: 30px"><i>(<?php echo $tokens_desc; ?>)</i></div>
                                            </td>
                                            <td colspan="">
                                                <textarea name="shop_rating_request_text" id="input-shop_rating_request_text" class="form-control">
                                                    <?php if($shop_rating_request_text){echo $shop_rating_request_text; } ?>
                                                </textarea>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $('.custom-change-status').click(function(){
            var id = this.id.split('-')[3];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
            $.post( url, { action: 'status', custom_id: id }, function( data ) {
                if(data['status'] == 'success'){
                    var btn = $('#custom-change-status-'+data['id']);
                    if(btn.hasClass('btn-info')){
                        btn.removeClass('btn-info');
                        btn.addClass('btn-default');
                    }else{
                        btn.removeClass('btn-default');
                        btn.addClass('btn-info');
                    }
                }
            }, "json");
        });
        $('.custom-remove').click(function(){
            var id = this.id.split('-')[2];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
            $.post( url, { action: 'remove', custom_id: +id }, function( data ) {
                if(data['status'] == 'success'){
                    if (confirm("<?php echo $remove_custom_type;?>"))
                    {
                        $('tr#custom-tr-'+id).remove();
                    }
                }
            }, "json");
        });
        $('.change_status_button').click(function(){
            var rating_id = this.id.split('-')[1];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($change_status);?>';


            $.post( url, { rate_id: rating_id }, function( data ) {
                        if(data == "OK"){
                            if(btn.hasClass('btn-success')){
                                btn.removeClass('btn-success');
                                btn.addClass('btn-danger');
                                btn.find('i').removeClass('fa-check-circle');
                                btn.find('i').addClass('fa-times-circle');
                            }else{
                                btn.removeClass('btn-danger');
                                btn.addClass('btn-success');
                                btn.find('i').removeClass('fa-times-circle');
                                btn.find('i').addClass('fa-check-circle');
                            }
                        }
                    }, "json");
        });

        $('#add-custom-type').click(function(){
            var type_title = $('#add-custom-type-input');
            if(type_title.val()){
                var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                $.post( url, { action: 'create', new_custom_title: type_title.val() }, function( data ) {
                    if(data){
                        var params = {
                            id: data['id'],
                            title: data['title']
                        };
                        createRow(params);

                    }
                }, "json");
                function createRow(params){
                    $('#custom-types').find('tbody').append(
                            $('<tr/>', {
                                id: 'custom-tr-'+params.id
                            }).append([
                                $('<td/>').append(
                                        $('<input>', {
                                            id: 'custom-type-input-t'+params.id,
                                            type:'text',
                                            class: 'form-control',
                                            value: params.title,
                                            keypress: function(){
                                                //$('#custom-change-remove').addClass('hidden');
                                                //$('#custom-change-save').removeClass('hidden');
                                            }
                                        })
                                ),
                                $('<td/>').append([
                                    $('<a/>', {
                                        id: 'custom-change-status-'+params.id,
                                        class: 'btn btn-default pull-left custom-change-status',
                                        title: 'Disabled',
                                        click: function(){
                                            var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                                            $.post( url, { action: 'status', custom_id: +params.id }, function( data ) {
                                                if(data['status'] == 'success'){
                                                    var btn = $('#custom-change-status-'+data['id']);
                                                    if(btn.hasClass('btn-info')){
                                                        btn.removeClass('btn-info');
                                                        btn.addClass('btn-default');
                                                    }else{
                                                        btn.removeClass('btn-default');
                                                        btn.addClass('btn-info');
                                                    }
                                                }
                                            }, "json");

                                        }
                                    }).append(
                                            $('<i/>',{class: 'fa fa-power-off'})
                                    ),
                                    $('<a/>', {
                                        id: 'custom-remove-'+params.id,
                                        class: 'btn btn-danger pull-right custom-remove',
                                        title: 'Remove',
                                        click: function(){
                                            var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                                            $.post( url, { action: 'remove', custom_id: +params.id }, function( data ) {
                                                if(data['status'] == 'success'){
                                                    if (confirm("<?php echo $remove_custom_type;?>"))
                                                    {
                                                        $('tr#custom-tr-'+params.id).remove();
                                                    }
                                                }
                                            }, "json");
                                        }

                                    }).append(
                                            $('<i/>',{class: 'fa fa-trash'})
                                    )
                                ])
                            ])
                    );

                }
                type_title.val('');
            }
        });
    });

</script>
<script type="text/javascript">

        $('textarea#input-shop_rating_request_text').summernote({
            height: 300
        });
</script>


<?php echo $footer; ?>
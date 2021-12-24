<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-eye"></i> <?php echo $heading_title.$rating['rate_id'];?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-shop_rate-answer">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td class="text-right" width="30%"><?php echo $rating_date.':'; ?></td>
                                    <td>
                                        <div class="input-group date">
                                            <input name="rating_date_change" value="<?php echo date('d.m.Y H:i', strtotime($rating['date_added']));?>" class="form-control" type="text" required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <input type="hidden" name="old_rating_date" value="<?php echo date('d.m.Y H:i', strtotime($rating['date_added']));?>"">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%"><?php echo $rating_sender.':'; ?></td>
                                    <td><b class="<?php if(isset($rating['customer_id']) && $rating['customer_id'] != 0) echo 'text-success';?>"><?php echo $rating['customer_name']; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $entry_status.':'; ?></td>
                                <td style="padding: 6px 8px;">
                                    <?php if($rating['rate_status'] == 1){ ?>
                                    <button id="change_status-<?php echo $rating['rate_id']?>" class="btn btn-success btn-xs change_status_button"><i class="fa fa-check-circle fa-fw"></i><span><?php echo $status_published;?></span></button>
                                    <?php }else{ ?>
                                    <button id="change_status-<?php echo $rating['rate_id']?>" class="btn btn-danger btn-xs change_status_button"><i class="fa fa-times-circle fa-fw"></i><span><?php echo $status_unpublished;?></span></button>
                                    <?php }?>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $title_service.':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($rating['service_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($rating['service_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($rating['service_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($rating['service_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($rating['service_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $title_delivery.':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($rating['delivery_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($rating['delivery_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($rating['delivery_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($rating['delivery_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($rating['delivery_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $title_goods.':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($rating['goods_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($rating['goods_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($rating['goods_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($rating['goods_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($rating['goods_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>

                                </td>
                            </tr>
                            <?php foreach($rating['customs'] as $custom){ ?>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $custom['title'].':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>

                                </td>
                            </tr>
                            <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center"><?php echo $comment; ?><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editCommentModal" style="margin-left: 20px"><i class="fa fa-pencil-square-o fa-fw"></i> <?php echo $edit; ?></button></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><p id="rating_comment"><?php echo html_entity_decode(nl2br($rating['comment']), ENT_QUOTES, 'UTF-8'); ?></p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="2" class="text-center"><?php echo $answer; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="2">

                                        <input type="hidden" name="answer_id" value="<?php if(isset($rating_answer['id']))echo $rating_answer['id']; ?>">
                                        <?php if(isset($rating_answer['comment'])){ ?>
                                            <textarea  name="answer" id="answer" rows="8" class="form-control"><?php echo nl2br($rating_answer['comment']);?></textarea>
                                        <?php }else{ ?>
                                            <textarea name="answer" id="answer" rows="8" class="form-control"></textarea>
                                        <?php } ?>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="editCommentModalLabel"><?php echo $edit.' '.$comment; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea  name="new_rating_comment" id="new_rating_comment" rows="8" class="form-control" style="resize: vertical"><?php echo html_entity_decode($rating['comment'], ENT_QUOTES, 'UTF-8');?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_cancel; ?></button>
                                    <button id="edit_comment_ok" type="button" class="btn btn-primary">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_comment_ok').click(function(){
            var new_comment = $('#new_rating_comment').val();
            var new_good = $('#new_rating_good').val();
            var new_bad = $('#new_rating_bad').val();
            $('#rating_comment').html(new_comment.replace(/\r\n|\r|\n/g,'<br />'));
            $('#editCommentModal').modal('hide');
        });
        $('.input-group.date').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            timepicker: false,
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o',
                close: 'fa fa-close'
            }
        });
        $('.change_status_button').click(function(){
            var rating_id = this.id.split('-')[1];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($change_status_url);?>';
            var status_publ = '<?php echo $status_published;?>';
            var status_unpubl = '<?php echo $status_unpublished;?>';

            $.post( url, { rate_id: rating_id }, function( data ) {
                        if(data == "OK"){
                            if(btn.hasClass('btn-success')){
                                btn.removeClass('btn-success');
                                btn.addClass('btn-danger');
                                btn.find('i').removeClass('fa-check-circle');
                                btn.find('i').addClass('fa-times-circle');
                                btn.find('span').text(status_unpubl);
                            }else{
                                btn.removeClass('btn-danger');
                                btn.addClass('btn-success');
                                btn.find('i').removeClass('fa-times-circle');
                                btn.find('i').addClass('fa-check-circle');
                                btn.find('span').text(status_publ);
                            }
                        }
                    }, "json");
        });
    });

</script>

<?php echo $footer; ?>
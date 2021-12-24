<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <style>
    #selectedItemSpan ul{
      display:flex;
      flex-wrap: wrap;
    }
    #selectedItemSpan li{
      width: 30%;
      white-space: nowrap;
      overflow: hidden;
      margin-right: 20px;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="view/javascript/jQueryTransfer/icon_font/css/icon_font.css"/>
  <link rel="stylesheet" type="text/css" href="view/javascript/jQueryTransfer/css/jquery.transfer.css"/>
  <script type="text/javascript" src="view/javascript/jQueryTransfer/js/jquery.transfer.js"></script>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-news" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <?php if ($error) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-news" class="form-horizontal">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
              <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">  
            <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
             
              <?php foreach ($languages as $language) { ?>
              	<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                                          <div class="form-group required">
              				<label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $text_title; ?></label>
              				<div class="col-sm-10">
              				  <input type="text" name="news[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($news[$language['language_id']]['title']) ? $news[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $text_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
              				</div>
                                          </div>
                                          <div class="form-group required">
              				<label class="col-sm-2 control-label" for="input-short<?php echo $language['language_id']; ?>"><?php echo $text_short_description; ?></label>
              				<div class="col-sm-10">
              				  <textarea name="news[<?php echo $language['language_id']; ?>][short_description]" rows="5" placeholder="<?php echo $text_short_description; ?>" id="input-short<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($news[$language['language_id']]['short_description']) ? $news[$language['language_id']]['short_description'] : ''; ?></textarea>
              				</div>
                                          </div>
                                          <div class="form-group">
              				<label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $text_description; ?></label>
              				<div class="col-sm-10">
              				  <textarea name="news[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $text_description; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($news[$language['language_id']]['description']) ? $news[$language['language_id']]['description'] : ''; ?></textarea>
              				</div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-image[<?php echo $language['language_id']; ?>][image]; ?>"><?php echo $text_image; ?></label>
                          <div class="col-sm-10">
                          <a href="" id="thumb-image<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?=$news[$language['language_id']]['thumb']?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
                           <input type="hidden" name="news[<?php echo $language['language_id']; ?>][image]" value="<?php echo isset($news[$language['language_id']]['image']) ? $news[$language['language_id']]['image'] : ''; ?>" id="input-image<?php echo $language['language_id']; ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="news[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($news[$language['language_id']]) ? $news[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                        <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                        <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                        <?php } ?>
                      </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-meta-h1<?php echo $language['language_id']; ?>"><?php echo $entry_meta_h1; ?></label>
                          <div class="col-sm-10">
                            <input type="text" name="news[<?php echo $language['language_id']; ?>][meta_h1]" value="<?php echo isset($news[$language['language_id']]) ? $news[$language['language_id']]['meta_h1'] : ''; ?>" placeholder="<?php echo $entry_meta_h1; ?>" id="input-meta-h1<?php echo $language['language_id']; ?>" class="form-control" />
                            <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                            <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                            <?php } ?>
                          </div>
                      </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                      <div class="col-sm-10">
                        <textarea name="news[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($news[$language['language_id']]) ? $news[$language['language_id']]['meta_description'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                      <div class="col-sm-10">
                        <textarea name="news[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($news[$language['language_id']]) ? $news[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                      </div>
                    </div>
          			</div>
          		<?php } ?>
            </div> 
          </div>
               
    		  <div class="tab-pane" id="tab-data">      
      		  <div class="form-group">
        			<label class="col-sm-2 control-label" for="input-keyword"><?php echo $text_keyword; ?></label>
        			<div class="col-sm-10">
        			  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-keyword" class="form-control" />
        			</div>
      		  </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
              <div class="col-sm-10">
                <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>            
            <!-- hotline -->
            <div class="form-group hotline">
              <style>
                .row{
                    margin-left: 0;
                    margin-right: 0;
                }
                .row+.row{margin-top:20px;}
                /*.hotline .btn{
                      padding: 10px 13px 11px;
                }*/
              </style>
              <div class="row">
              <label class="col-sm-10 text-center"><h3>Настройки для выгрузки xml в hotline</h3></label>
              </div>
              
              
              <div class="row">
                <label class="col-sm-2 control-label" for="input-status">Период проведения акции</label>
                <div class="col-sm-2">
                  <div class="input-group date">
                      <input type="text" name="date_start" value="<?php echo $date_start; ?>" placeholder="Дата старта акции" data-date-format="YYYY-MM-DD" class="form-control" />
                      <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                      </span>
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="input-group date">
                      <input type="text" name="date_end" value="<?php echo $date_end; ?>" placeholder="Дата окончания акции" data-date-format="YYYY-MM-DD" class="form-control" />
                      <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                      </span>
                  </div>
                </div>

              </div>
              <div class="row">
                <label class="col-sm-2 control-label" for="input-status">Тип акции</label>
                <div class="col-sm-4">
                  <select name="type" id="input-status" class="form-control">
                    <option value="0" <?php if(!$type){echo 'selected';} ?>>Не выбрано</option>
                    <option value="1" <?php if($type==1){echo 'selected';} ?>>Скидка на товар</option>
                    <option value="2" <?php if($type==2){echo 'selected';} ?>>Скидка на следующий товар</option>
                    <option value="3" <?php if($type==3){echo 'selected';} ?>>Подарок к покупке</option>
                  </select>
                </div>
              </div>
              <div class="row type" data-gift="3" style="display:none;">
                  <label class="col-sm-2 control-label" for="input-status">Название подарка (услуги). До 100 символов.</label>
                  <div class="col-sm-4">
                    <input type="text" name="gift" value="<?php echo $gift; ?>" class="form-control" placeholder="Название подарка (услуги). До 100 символов.">
                  </div>
              </div>
            </div>
            <script>
              $('.date').datetimepicker({
                pickTime: false
              });
              $('select[name="type"]').on('change',function(){
                val = this.value;
                  $('.type').hide();
                  $('.type[data-gift="'+val+'"]').show();
              });
              $('select[name="type"]').change();
            </script>
            <!-- endhotline -->

            <div class="form-group">
              <div class="row">
              <label class="col-sm-10 text-center" for="input-category"><h3>Выбор товара для акции</h3></label>
              </div>
              
              <label class="col-sm-2 control-label" for="input-category">Выбор категории:</label>
              <div class="col-sm-10">
                <select id="main_category_id" name="main_category_id" class="form-control">
                  <option value="0" selected="selected"><?php echo $text_none; ?></option>
                  <?php foreach($categories as $category) { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-sm-12">
                  <div class="jQueryTransfer" style="margin-top:20px;">
                      
                      <div style="margin-top:20px">
                        Выбранный товар для акции: <span id="selectedItemSpan"></span>
                      </div>
                      <div class="transfer"></div>
                  </div>
              </div>
            </div>

            <div class="form-group">
               <label class="col-sm-2 control-label" for="input-related"><?php echo $text_related; ?></label>
               <div class="col-sm-10">
                  <ul id="relatedprodlist">
                      <?php foreach ($related as $item) { ?>
                      <li class="relprodline" data-value="<?php echo $item['product_id']; ?>"><?php echo $item['name']; ?></li>
                      <?php } ?>        
                  </ul>
               </div>
                            
               <label class="col-sm-2 control-label" for="input-related"><?php echo $text_addrelated; ?></label>
               <div class="col-sm-10">
                  <input type="text" name="addrelated" value="" placeholder="<?php echo $text_addrelated; ?>" id="input-addrelated" class="form-control" />
                  <button id="addrelated" class="btn btn-default">Добавить</button>
               </div>
            </div>  

          </div> 
           
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#language a:first').tab('show');

<?php foreach ($languages as $language) { ?>
    //$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
    ckeditorInit('input-description<?php echo $language['language_id']; ?>', '<?php echo $token; ?>');
<?php } ?>

    $('#addrelated').click(function() {
        var productid=$('#input-addrelated').val();
        $.ajax({
            method: "GET",
            url: "<?php echo $HTTPS_SERVER; ?>index.php?route=extension/news/addRelated",
            data: { news_id: "<?php echo $news_id; ?>", product_id: productid, token: "<?php echo $token; ?>" }
        }).done(function( msg ) {
            $('#relatedprodlist').html(msg);
        });
        return false;
    // MFD-EPS-L566 }); 
   });
   
   $(document).delegate('.relprodline', "click" , function() {
        
        var productid=$(this).data('value');        
        $.ajax({
            method: "GET",
            url: "<?php echo $HTTPS_SERVER; ?>index.php?route=extension/news/delRelated",
            data: { news_id: "<?php echo $news_id; ?>", product_id: productid, token: "<?php echo $token; ?>" }
        }).done(function( msg ) {
            $('#relatedprodlist').html(msg);
        });
        return false;
    // MFD-EPS-L566 }); 
   });
</script>
  <script type="text/javascript">
    $('#main_category_id').on('change',function(){
      category_id = $('#main_category_id option:selected').val();
      category_name = $('#main_category_id option:selected').html();
      url = 'index.php?route=extension/news/getProducts&category_id='+category_id+'&token=<?php echo $token; ?>';
      //console.log(url);
      $.ajax({
        url:url,
        type: 'get',
        dataType:'json',
        data: '',
        beforeSend: function(){},
        complete: function(){},
        success:function(result){
          //console.log(result);
          if(result){
            var products = [];
            $.each(result,function(key, value){
              products.push({"language": value['name'],"value": value['product_id']});
            });

            var groupData = [
              {
                  "groupName": category_name,
                  "groupData": products
              }
            ];
            ////////////
            var settings = {
                "inputId": "languageInput",
                "data": products,
                "groupData": groupData,
                "itemName": "language",
                "groupItemName": "groupName",
                "groupListName" : "groupData",
                "container": "transfer",
                "valueName": "value",
                "callable" : function (data, names) {
                    console.log("Selected ID：" + data)
                    names_html = '<ul>';
                    $.each(names,function(key, value){
                      names_html+='<li>'+value+'</li>';
                    });
                    names_html += '</ul>';
                    //$("#selectedItemSpan").text(names)
                    $("#input-addrelated").val(data);
                    $("#selectedItemSpan").html(names_html);
                }
            };

            Transfer.transfer(settings);
            ////////////
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            //console.log(thrownError);
            console.log(xhr.statusText);
            console.log(xhr.responseText);
        }
      });
    });
     
  </script>
<?php echo $footer; ?>
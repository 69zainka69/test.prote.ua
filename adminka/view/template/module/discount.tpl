<?php
  echo $header;
  echo $column_left;
  function escape_string($string){return str_replace("'","\'",$string);}
?>
<div id="content">
<form action="<?php echo $action; ?>" method="post" id="form-discount">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-discount" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
  <?php if ($error_warning) { ?><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?><button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
  
<script src="view/javascript/discount.js" type="text/javascript"></script>
<style type="text/css">
.table-striped {margin-left: -20px;}
.btn-default{outline:none !important;}
.datetime-block{width:198px;float:left;display:inline-block;margin:7px 0px 0px 0px;}
.datetime-block input[type=text]{width:130px;}
.datetime-block .input-group-btn{float:left;margin:-5px 0px 0px -2px;width:40px;}
.table-striped .datetime-block{margin: 0px 0px 0px 0px;}
.table-striped .datetime-block .input-group-btn{margin: 0px 0px 0px -1px;}
.table-striped .stop-date {width:170px;}
.start-date .input-group-btn{margin-left: -1px !important;}
.stop-date .input-group-btn{margin-left: 0px !important;}
.btn-default {border-radius: 0px !important;-webkit-border-top-right-radius: 3px !important;-webkit-border-bottom-right-radius: 3px !important;-moz-border-radius-topright: 3px !important;-moz-border-radius-bottomright: 3px !important;border-top-right-radius: 3px !important;border-bottom-right-radius: 3px !important;height: 35px;}
.datetime-block i.fa-minus{font-size:10px;padding:0px 10px;line-height:35px; display: inline-block; float: right;}
.discount-value-block i{float:left;font-size:10px;padding-right:7px;line-height:35px;margin-top:8px;}
.discount-value-block input[type=text]{width:80px;float:left;margin-top:8px;}
.discount-value-block span{padding:0px 10px;float:left;height:35px;line-height:35px;margin-top:8px;}
.nav-pills{border-right:1px solid #e8e8e8;}
.nav-pills li{border:1px solid #e8e8e8;border-right:none;}
.nav-pills li.active, .nav-pills li.active:hover{border:1px solid #1e91cf;background:#1e91cf;}
.nav-pills li.active a, .nav-pills li.active a:hover{background:none !important;border:none !important;outline:none;}
.nav-pills li a i{margin-right:10px;font-size:15px;}
.form-group{height:45px;line-height:45px;margin:5px 0px 5px -20px;}
.form-group + .form-group{border-top:1px dashed #e8e8e8;}
.select-type{background:none !important;border:none !important;float:left;width:190px;text-align:center;height:40px;line-height:40px;padding:0px;font-weight:bold;}
.select-type span{margin-left:-20px;}
.clear {clear: both; display: block;}
.pbt-5 {padding-bottom: 5px;}
.display-none {display: none;}
.datetime-block-disabled .btn {background-color: #eee;cursor: not-allowed;}
#tab-discount-manufacturer select {margin-top: -6px;}
.error-field {border-color: #F56B6B;box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;}
.module-status {float: right;}
.module-status select {float: right;width: 100px;margin: -7px -15px 0px 5px;}
</style>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
        <div class="module-status">
          <label for="module_status"><?php echo $text_module_status;?>:</label>
          <select name="discount[setting][status]" id="module_status" onChange="moduleStatus(this.value);" class="form-control">
            <option value="1"<?php if(isset($discount_data['setting']['status']) AND $discount_data['setting']['status'] == 1){echo ' selected="selected"';}?>><?php echo $text_enabled;?></option>
            <option value="0"<?php if(!isset($discount_data['setting']['status']) || $discount_data['setting']['status'] == 0){echo ' selected="selected"';}?>><?php echo $text_disabled;?></option>
          </select>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-2">
            <ul class="nav nav-pills nav-stacked">
              <li class="module-setting"><a href="#tab-setting" id="nav-tab-setting" class="setting" data-toggle="tab"><i class="fa fa-pencil"></i><?php echo $text_module_setting; ?></a></li>
              <li class="select-type"><span><?php echo $text_type_of_discount;?>:</span></li>
              <li><a class="12" href="#tab-discount-total" id="nav-tab-discount-total" data-toggle="tab" onClick="$('#discount_type_total').prop('checked',true);"><i class="fa fa-check-circle"></i><?php echo $text_discount_total; ?></a></li>
              <li class="active"><a href="#tab-discount-category" id="nav-tab-discount-category" data-toggle="tab" onClick="$('#discount_type_category').prop('checked',true);"><i class="fa fa-circle-o"></i><?php echo $text_discount_category; ?></a></li>
              <li><a href="#tab-discount-manufacturer" id="nav-tab-discount-manufacturer" data-toggle="tab" onClick="$('#discount_type_manufacturer').prop('checked',true);"><i class="fa fa-circle-o"></i><?php echo $text_discount_manufacturer; ?></a></li>
              <li><a href="#tab-discount-customer" id="nav-tab-discount-customer" data-toggle="tab" onClick="$('#discount_type_customer_group').prop('checked',true);"><i class="fa fa-circle-o"></i><?php echo $text_discount_customer_group; ?></a></li>
            </ul>
          </div>
          <div class="col-sm-10">
            <div class="tab-content">
              <div class="tab-pane" id="tab-setting">
                <div class="form-group">
                  <label for="discount_setting_special_1" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_include_special_i;?>"><?php echo $text_include_special;?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="discount[setting][special]" id="discount_setting_special_1" value="1"<?php if(isset($discount_data['setting']['special']) AND $discount_data['setting']['special'] == 1){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_yes;?></label>
                    <label class="radio-inline"><input type="radio" name="discount[setting][special]" id="discount_setting_special_0" value="0"<?php if(!isset($discount_data['setting']['special']) || $discount_data['setting']['special'] == 0){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_no;?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="discount_setting_options_1" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_include_options_i;?>"><?php echo $text_include_options;?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="discount[setting][options]" id="discount_setting_options_1" value="1"<?php if(isset($discount_data['setting']['options']) AND $discount_data['setting']['options'] == 1){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_yes;?></label>
                    <label class="radio-inline"><input type="radio" name="discount[setting][options]" id="discount_setting_options_0" value="0"<?php if(!isset($discount_data['setting']['options']) || $discount_data['setting']['options'] == 0){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_no;?></label>
                  </div>
                </div>   
                <div class="display-none">
                  <input type="text" name="discount[setting][status]" value="1" id="discount_setting_status" />
                  <input type="radio" name="discount[setting][discount_type]" value="total" id="discount_type_total" />
                  <input type="radio" name="discount[setting][discount_type]" value="category" id="discount_type_category" />
                  <input type="radio" name="discount[setting][discount_type]" value="manufacturer" id="discount_type_manufacturer" />
                  <input type="radio" name="discount[setting][discount_type]" value="customer_group" id="discount_type_customer_group" />
                </div>
              </div>
              
              
              
              
              
              <?php $discount_type = 'total';?> 
              <div class="tab-pane" id="tab-discount-total">
                <div class="form-group">
                  <label for="discount_<?php echo $discount_type;?>_fulltime" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_fulltime_discount_i;?>"><?php echo $text_fulltime_discount;?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="discount[<?php echo $discount_type;?>][fulltime]" value="1" id="discount_<?php echo $discount_type;?>_fulltime_1" onClick="setFullTimeDiscount('<?php echo $discount_type;?>');"<?php if(isset($discount_data[$discount_type]['fulltime']) AND $discount_data[$discount_type]['fulltime'] == 1){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_yes;?></label>
                    <label class="radio-inline"><input type="radio" name="discount[<?php echo $discount_type;?>][fulltime]" value="0" id="discount_<?php echo $discount_type;?>_fulltime_0" onClick="setFullTimeDiscount('<?php echo $discount_type;?>');"<?php if(!isset($discount_data[$discount_type]['fulltime']) || $discount_data[$discount_type]['fulltime'] == 0){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_no;?></label>
                  </div>
                </div>
                <div class="form-group" id="discount_<?php echo $discount_type;?>_date"<?php if(isset($discount_data[$discount_type]['fulltime']) AND $discount_data[$discount_type]['fulltime'] == 1){echo ' style="display: none;"';} ?>>
                  <label for="discount_<?php echo $discount_type;?>_date_start" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_discount_date_i;?>"><?php echo $text_discount_date;?></span></label>
                  <div class="col-sm-10">
                    <div class="datetime-block input-group datetime start-date">
                      <input type="text" name="discount[<?php echo $discount_type;?>][discount_start]" value="<?php if(isset($discount_data[$discount_type]['discount_start'])){echo $discount_data[$discount_type]['discount_start'];} ?>" class="form-control datetime<?php if(isset($error[$discount_type]['discount_start'])){echo ' error-field';}?>" id="discount_<?php echo $discount_type;?>_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>" />
                      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                      <i class="fa fa-minus"></i>
                    </div>
                    <div class="datetime-block input-group datetime stop-date">
                      <input type="text" name="discount[<?php echo $discount_type;?>][discount_stop]" value="<?php if(isset($discount_data[$discount_type]['discount_stop'])){echo $discount_data[$discount_type]['discount_stop'];} ?>" class="form-control datetime<?php if(isset($error[$discount_type]['discount_stop'])){echo ' error-field';}?>" id="discount_<?php echo $discount_type;?>_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>" />
                      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_discount_type_i;?>"><?php echo $text_discount_type;?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="discount[<?php echo $discount_type;?>][discount_type]" value="percentage" id="discount_<?php echo $discount_type;?>_type_percentage" onClick="setDiscountType('<?php echo $discount_type;?>',this.value);"<?php if(isset($discount_data[$discount_type]['discount_type']) AND $discount_data[$discount_type]['discount_type'] == 'percentage'){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_percentage;?></label>
                    <label class="radio-inline"><input type="radio" name="discount[<?php echo $discount_type;?>][discount_type]" value="fixed" id="discount_<?php echo $discount_type;?>_type_fixed" onClick="setDiscountType('<?php echo $discount_type;?>',this.value);"<?php if(isset($discount_data[$discount_type]['discount_type']) AND $discount_data[$discount_type]['discount_type'] == 'fixed'){echo ' checked="checked"';} ?> />&nbsp;<?php echo $text_fixed;?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="discount_<?php echo $discount_type;?>_type_value" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_discount_value_i;?>"><?php echo $text_discount_value;?></span></label>
                  <div class="col-sm-10">
                    <div class="discount-value-block">
                      <i class="fa fa-minus"></i>
                      <input type="text" value="<?php if(isset($discount_data[$discount_type]['discount_value'])){echo $discount_data[$discount_type]['discount_value'];} ?>" name="discount[<?php echo $discount_type;?>][discount_value]" id="discount_<?php echo $discount_type;?>_type_value" size="10" class="form-control<?php if(isset($error[$discount_type]['discount_value'])){echo ' error-field';}?>" />
                      <span id="discount_<?php echo $discount_type;?>_type_character"></span>
                    </div>
                  </div>
                </div>
              </div>
              
              
              
              
              
              <?php $discount_type = 'category';?>
              <div class="tab-pane active" id="tab-discount-category">
                <table id="category_discount" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="left"><?php echo $text_category;?>:</td>
                      <td class="center" style="width: 160px;">Сумма корзины (с ... по ...грн):</td>
                      <td class="center" style="width: 389px;"><?php echo $text_discount_date;?>:</td>
                      <td class="center" style="width: 160px;"><?php echo $text_discount_type;?>:</td>
                      <td class="center" style="width: 165px;"><?php echo $text_discount_value;?>:</td>
                      <td class="text-center" style="width: 80px;"><?php echo $text_action;?></td>
                    </tr>
                  </thead>
                  <?php $category_number = 1;?>
                  <tbody id="category-body">
                  <?php if(isset($discount_data[$discount_type])){ ?>
                    <?php foreach($discount_data[$discount_type] as $category){?>
                      <tr id="category-discount-<?php echo $category_number;?>">
                        <td class="left">
                          <select name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][category_id]" style="width: 100%;" class="form-control<?php if(isset($error[$discount_type][$category_number]['category_id'])){echo ' error-field';}?>">
                          <?php foreach($categories as $cat){ ?>
                            <option value="<?php echo (int)$cat['category_id'];?>"<?php if(isset($category['category_id']) AND $category['category_id'] == $cat['category_id']){echo ' selected="selected"';}?>><?php echo escape_string($cat['name']);?></option>
                          <?php } ?>
                          </select>
                          <span class="clear pbt-5"></span>
                          <input type="checkbox" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][subcategories]" value="1" id="category_<?php echo $category_number;?>_subcategories"<?php if(isset($category['subcategories']) AND $category['subcategories'] == 1){echo ' checked="checked"';}?> />
                          <label for="category_<?php echo $category_number;?>_subcategories"><?php echo $text_include_subcategories;?></label>
                        </td>                        
                        <td class="left">
                          <div style="display:flex;">
                          <input type="text" style="width:100px;" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][amount_from]" value="<?php if(isset($category['amount_from'])){echo $category['amount_from'];}?>" 
                          class="form-control" size="8" placeholder="сумма с" />
                          <input type="text" style="width:100px;" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][amount_to]" value="<?php if(isset($category['amount_to'])){echo $category['amount_to'];}?>" 
                          class="form-control" size="8" placeholder="сумма до" />
                          </div>
                        </td>
                        <td class="right">
                          <div class="datetime-block input-group datetime start-date">
                            <input type="text" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][discount_start]" value="<?php if(isset($category['discount_start'])){echo $category['discount_start'];}?>" class="form-control datetime<?php if(isset($error[$discount_type][$category_number]['discount_start'])){echo ' error-field';}?>" id="category_<?php echo $category_number;?>_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>"<?php if(isset($category['fulltime']) AND $category['fulltime'] == 1){echo ' disabled="disabled"';}?> />
                            <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                            <i class="fa fa-minus"></i>
                          </div>
                          <div class="datetime-block input-group datetime stop-date">
                            <input type="text" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][discount_stop]" value="<?php if(isset($category['discount_stop'])){echo $category['discount_stop'];}?>" class="form-control datetime<?php if(isset($error[$discount_type][$category_number]['discount_stop'])){echo ' error-field';}?>" id="category_<?php echo $category_number;?>_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>"<?php if(isset($category['fulltime']) AND $category['fulltime'] == 1){echo ' disabled="disabled"';}?> />
                            <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                          </div>
                          <span class="clear pbt-5"></span>
                          <input onClick="changeCategoryFulltime(<?php echo $category_number;?>)" type="checkbox" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][fulltime]" id="category_<?php echo $category_number;?>_fulltime" value="1"<?php if(isset($category['fulltime'])){echo ' checked="checked"';}?> />&nbsp;
                          <label for="category_<?php echo $category_number;?>_fulltime"><?php echo $text_fulltime;?></label>
                        </td>
                        <td class="center">
                          <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][discount_type]" value="percentage" id="category_<?php echo $category_number;?>_type_percentage" onClick="setDiscountCategoryType('<?php echo $discount_type;?>',this.value, <?php echo $category_number;?>);"<?php if(isset($category['discount_type']) AND $category['discount_type'] == "percentage"){echo ' checked="checked"';}?> />
                          <label for="category_<?php echo $category_number;?>_type_percentage"><?php echo $text_percentage;?></label>
                          <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][discount_type]" value="fixed" id="category_<?php echo $category_number;?>_type_fixed" onClick="setDiscountCategoryType('<?php echo $discount_type;?>',this.value, <?php echo $category_number;?>);"<?php if(isset($category['discount_type']) AND $category['discount_type'] == "fixed"){echo ' checked="checked"';}?> />
                          <label for="category_<?php echo $category_number;?>_type_fixed"><?php echo $text_fixed;?></label>
                          <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][discount_type]" value="pricelist" id="category_<?php echo $category_number;?>_type_pricelist" onClick="setDiscountCategoryType('<?php echo $discount_type;?>',this.value, <?php echo $category_number;?>);"<?php if(isset($category['discount_type']) AND $category['discount_type'] == "pricelist"){echo ' checked="checked"';}?> />
                          <label for="category_<?php echo $category_number;?>_type_pricelist">Прайслист с АХ</label>
                        </td>
                        <td class="center">
                          <span class="discount-value-block">
                            <i class="fa fa-minus"></i>
                            <input type="text" value="<?php if(isset($category['discount_value'])){echo $category['discount_value'];}?>" id="discount_<?php echo $discount_type;?>_category_<?php echo $category_number;?>_type_value" name="discount[<?php echo $discount_type;?>][<?php echo $category_number;?>][discount_value]" size="10" class="form-control<?php if(isset($error[$discount_type][$category_number]['discount_value'])){echo ' error-field';}?>" />
                            <span id="discount_<?php echo $discount_type;?>_category_<?php echo $category_number;?>_type_character"></span>
                          </span>
                        </td>
                        <td align="center"><button type="button" onclick="$('#category-discount-<?php echo $category_number;?>').remove();" data-toggle="tooltip" title="<?php echo $text_remove;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
                    <?php $category_number++;} ?>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                      <td align="center"><button type="button" onclick="addCategory();" data-toggle="tooltip" title="<?php echo $text_add_category;?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              
              
              
              
              
          <?php $discount_type = 'manufacturer';?>
          <div class="tab-pane" id="tab-discount-manufacturer">
            <table id="manufacturer_discount" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <td class="left"><?php echo $text_manufacturer;?>:</td>
                  <td class="center" style="width: 389px;"><?php echo $text_discount_date;?>:</td>
                  <td class="center" style="width: 160px;"><?php echo $text_discount_type;?>:</td>
                  <td class="center" style="width: 165px;"><?php echo $text_discount_value;?>:</td>
                  <td class="text-center" style="width: 80px;"><?php echo $text_action;?></td>
                </tr>           
              </thead>
              <?php $manufacturer_number = 1;?>
              <tbody id="manufacturer-body">
              <?php if(isset($discount_data[$discount_type])){ ?>
                <?php foreach($discount_data[$discount_type] as $manufacturer_data){?>
                  <tr id="manufacturer-discount-<?php echo $manufacturer_number;?>">
                    <td class="left">
                      <select name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][manufacturer_id]" style="width: 100%;" class="form-control<?php if(isset($error[$discount_type][$manufacturer_number]['manufacturer_id'])){echo ' error-field';}?>">
                        <?php foreach($manufacturers as $manufacturer){ ?>
                          <option value="<?php echo (int)$manufacturer['manufacturer_id'];?>"<?php if(isset($manufacturer_data['manufacturer_id']) AND $manufacturer_data['manufacturer_id'] == $manufacturer['manufacturer_id']){echo ' selected="selected"';}?>><?php echo escape_string($manufacturer['name']);?></option>
                        <?php } ?>
                      </select>
                      <span class="clear pbt-5"></span>
                      <small><?php echo $text_select_manufacturer;?></small>
                    </td>
                    <td class="right">
                      <div class="datetime-block input-group datetime start-date">
                        <input type="text" name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][discount_start]" value="<?php if(isset($manufacturer_data['discount_start'])){echo $manufacturer_data['discount_start'];}?>" class="form-control datetime<?php if(isset($error[$discount_type][$manufacturer_number]['discount_start'])){echo ' error-field';}?>" id="manufacturer_<?php echo $manufacturer_number;?>_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>"<?php if(isset($manufacturer_data['fulltime']) AND $manufacturer_data['fulltime'] == 1){echo ' disabled="disabled"';}?> />
                        <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                        <i class="fa fa-minus"></i>
                      </div>
                      <div class="datetime-block input-group datetime stop-date">
                        <input type="text" name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][discount_stop]" value="<?php if(isset($manufacturer_data['discount_stop'])){echo $manufacturer_data['discount_stop'];}?>" class="form-control datetime<?php if(isset($error[$discount_type][$manufacturer_number]['discount_stop'])){echo ' error-field';}?>" id="manufacturer_<?php echo $manufacturer_number;?>_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>"<?php if(isset($manufacturer_data['fulltime']) AND $manufacturer_data['fulltime'] == 1){echo ' disabled="disabled"';}?> />
                        <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                      </div>
                      <span class="clear pbt-5"></span>
                      <input onClick="changeManufacturerFulltime(<?php echo $manufacturer_number;?>)" type="checkbox" name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][fulltime]" id="manufacturer_<?php echo $manufacturer_number;?>_fulltime" value="1"<?php if(isset($manufacturer_data['fulltime'])){echo ' checked="checked"';}?> />&nbsp;
                      <label for="manufacturer_<?php echo $manufacturer_number;?>_fulltime"><?php echo $text_fulltime;?></label>
                    </td>
                    <td class="center">
                      <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][discount_type]" value="percentage" id="manufacturer_<?php echo $manufacturer_number;?>_type_percentage" onClick="setDiscountManufacturerType('<?php echo $discount_type;?>',this.value, <?php echo $manufacturer_number;?>);"<?php if(isset($manufacturer_data['discount_type']) AND $manufacturer_data['discount_type'] == "percentage"){echo ' checked="checked"';}?> />
                      <label for="manufacturer_<?php echo $manufacturer_number;?>_type_percentage"><?php echo $text_percentage;?></label>
                      <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][discount_type]" value="fixed" id="manufacturer_<?php echo $manufacturer_number;?>_type_fixed" onClick="setDiscountManufacturerType('<?php echo $discount_type;?>',this.value, <?php echo $manufacturer_number;?>);"<?php if(isset($manufacturer_data['discount_type']) AND $manufacturer_data['discount_type'] == "fixed"){echo ' checked="checked"';}?> />
                      <label for="manufacturer_<?php echo $manufacturer_number;?>_type_fixed"><?php echo $text_fixed;?></label>
                    </td>
                    <td class="center">
                      <span class="discount-value-block">
                        <i class="fa fa-minus"></i>
                        <input type="text" value="<?php if(isset($manufacturer_data['discount_value'])){echo $manufacturer_data['discount_value'];}?>" id="discount_<?php echo $discount_type;?>_manufacturer_<?php echo $manufacturer_number;?>_type_value" name="discount[<?php echo $discount_type;?>][<?php echo $manufacturer_number;?>][discount_value]" size="10" class="form-control<?php if(isset($error[$discount_type][$manufacturer_number]['discount_value'])){echo ' error-field';}?>" />
                        <span id="discount_<?php echo $discount_type;?>_manufacturer_<?php echo $manufacturer_number;?>_type_character"></span>
                      </span>
                    </td>
                    <td align="center"><button type="button" onclick="$('#manufacturer-discount-<?php echo $manufacturer_number;?>').remove();" data-toggle="tooltip" title="<?php echo $text_remove;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                  </tr>
                <?php $manufacturer_number++;} ?>
              <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td align="center"><button type="button" onclick="addManufacturer();" data-toggle="tooltip" title="<?php echo $text_add_manufacturer;?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
              </tfoot>
            </table>
          </div>
          
          
          
          
          
          <?php $discount_type = 'customer_group';?>
          <div class="tab-pane" id="tab-discount-customer">
            <table id="customer-group_discount" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <td class="left"><?php echo $text_customer_group;?>:</td>
                  <td class="center" style="width: 389px;"><?php echo $text_discount_date;?>:</td>
                  <td class="center" style="width: 160px;"><?php echo $text_discount_type;?>:</td>
                  <td class="center" style="width: 165px;"><?php echo $text_discount_value;?>:</td>
                  <td class="text-center" style="width: 80px;"><?php echo $text_action;?></td>
                </tr>           
              </thead>
              <?php $customer_group_number = 1;?>
              <tbody id="customer-group-body">
              <?php if(isset($discount_data[$discount_type])){ ?>
              <?php foreach($discount_data[$discount_type] as $customer_group_data){?>
                <tr id="customer-discount-<?php echo $customer_group_number;?>">
                  <td class="left">
                    <select name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][customer_group_id]" style="width: 100%;" class="form-control<?php if(isset($error[$discount_type][$customer_group_number]['customer_group_id'])){echo ' error-field';}?>">
                      <?php foreach($customer_groups as $customer_group){ ?>
                        <option value="<?php echo (int)$customer_group['customer_group_id'];?>"<?php if(isset($customer_group_data['customer_group_id']) AND $customer_group_data['customer_group_id'] == $customer_group['customer_group_id']){echo ' selected="selected"';}?>><?php echo escape_string($customer_group['name']);?></option>
                      <?php } ?>
                    </select>
                    <span class="clear pbt-5"></span>
                    <small><?php echo $text_select_customer_group; ?></small>
                  </td>
                  <td class="right">
                    <div class="datetime-block input-group datetime start-date">
                      <input type="text" name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][discount_start]" value="<?php if(isset($customer_group_data['discount_start'])){echo $customer_group_data['discount_start'];}?>" class="form-control datetime<?php if(isset($error[$discount_type][$customer_group_number]['discount_start'])){echo ' error-field';}?>" id="customer_group_<?php echo $customer_group_number;?>_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>"<?php if(isset($customer_group_data['fulltime']) AND $customer_group_data['fulltime'] == 1){echo ' disabled="disabled"';}?> />
                      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                      <i class="fa fa-minus"></i>
                    </div>
                    <div class="datetime-block input-group datetime stop-date">
                      <input type="text" name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][discount_stop]" value="<?php if(isset($customer_group_data['discount_stop'])){echo $customer_group_data['discount_stop'];}?>" class="form-control datetime<?php if(isset($error[$discount_type][$customer_group_number]['discount_stop'])){echo ' error-field';}?>" id="customer_group_<?php echo $customer_group_number;?>_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>"<?php if(isset($customer_group_data['fulltime']) AND $customer_group_data['fulltime'] == 1){echo ' disabled="disabled"';}?> />
                      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>
                    </div>
                    <span class="clear pbt-5"></span>
                    <input onClick="changeCustomerGroupFulltime(<?php echo $customer_group_number;?>)" type="checkbox" name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][fulltime]" id="customer_group_<?php echo $customer_group_number;?>_fulltime" value="1"<?php if(isset($customer_group_data['fulltime'])){echo ' checked="checked"';}?> />&nbsp;
                    <label for="customer_group_<?php echo $customer_group_number;?>_fulltime"><?php echo $text_fulltime;?></label>
                  </td>
                  <td class="center">
                    <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][discount_type]" value="percentage" id="customer_group_<?php echo $customer_group_number;?>_type_percentage" onClick="setDiscountCustomerGroupType('<?php echo $discount_type;?>',this.value, <?php echo $customer_group_number;?>);"<?php if(isset($customer_group_data['discount_type']) AND $customer_group_data['discount_type'] == "percentage"){echo ' checked="checked"';}?> />
                    <label for="customer_group_<?php echo $customer_group_number;?>_type_percentage"><?php echo $text_percentage;?></label>
                    <input type="radio" name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][discount_type]" value="fixed" id="customer_group_<?php echo $customer_group_number;?>_type_fixed" onClick="setDiscountCustomerGroupType('<?php echo $discount_type;?>',this.value, <?php echo $customer_group_number;?>);"<?php if(isset($customer_group_data['discount_type']) AND $customer_group_data['discount_type'] == "fixed"){echo ' checked="checked"';}?> />
                    <label for="customer_group_<?php echo $customer_group_number;?>_type_fixed"><?php echo $text_fixed;?></label>
                  </td>
                  <td class="center">
                    <span class="discount-value-block">
                      <i class="fa fa-minus"></i>
                      <input type="text" value="<?php if(isset($customer_group_data['discount_value'])){echo $customer_group_data['discount_value'];}?>" id="discount_<?php echo $discount_type;?>_customer_group_<?php echo $customer_group_number;?>_type_value" name="discount[<?php echo $discount_type;?>][<?php echo $customer_group_number;?>][discount_value]" size="10" class="form-control<?php if(isset($error[$discount_type][$customer_group_number]['discount_value'])){echo ' error-field';}?>" />
                      <span id="discount_<?php echo $discount_type;?>_customer_group_<?php echo $customer_group_number;?>_type_character"></span>
                    </span>
                  </td>
                  <td align="center"><button type="button" onclick="$('#customer-discount-<?php echo $customer_group_number;?>').remove();" data-toggle="tooltip" title="<?php echo $text_remove;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                </tr>
                <?php $customer_group_number++;} ?>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td align="center"><button type="button" onclick="addCustomerGroup();" data-toggle="tooltip" title="<?php echo $text_add_manufacturer;?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
              </tfoot>
            </table>
          </div>
            
            
            
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
  </form>
</div>
                  
<script type="text/javascript">
	$('.datetime').datetimepicker({
    format:'YYYY-MM-DD H:mm',
		pickTime: true
	});
  
  $('.nav-pills li a').click(function(){
    if($(this).attr("class") != "setting"){
      $('.nav-pills li a i').removeClass();
      $('.nav-pills li a i').addClass("fa fa-circle-o");
      $('.nav-pills li.module-setting a i').removeClass();
      $('.nav-pills li.module-setting a i').addClass("fa fa-pencil");
      $(this).children().removeClass("fa fa-circle-o");
      $(this).children().addClass("fa fa-check-circle");
    }
  });





function getCategory(element_id){
$('#category_'+element_id+'_name').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php if(isset($_GET['token'])){echo $_GET['token'];}?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
	
	 var cat_id = $(this).attr('aria-category-number');
	
    document.getElementById('category_'+cat_id+'_name').value = ui.item.label;
    document.getElementById('category_'+cat_id+'_value').value = ui.item.value;
 
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});
}


var category_number       = <?php if(isset($category_number)){echo (int)$category_number;}else{echo '1';}?>;
var manufacturer_number   = <?php if(isset($manufacturer_number)){echo (int)$manufacturer_number;}else{echo '1';}?>;
var customer_group_number = <?php if(isset($customer_group_number)){echo (int)$customer_group_number;}else{echo '1';}?>;



function addCategory(){
  category_number++;
  var html = '';
  html    += '<tr id="category-discount-'+category_number+'">';
  html    += '  <td class="left">';
  html    += '    <select name="discount[category]['+category_number+'][category_id]" style="width: 100%;" class="form-control">';
  <?php foreach($categories as $cat){ ?>
  html    += '      <option value="<?php echo (int)$cat['category_id'];?>"><?php echo escape_string($cat['name']);?></option>';
  <?php } ?>
  html    += '    </select>';
  html    += '    <span class="clear pbt-5"></span>';
  html    += '    <input type="checkbox" name="discount[category]['+category_number+'][subcategories]" value="1" id="category_'+category_number+'_subcategories" />';
  html    += '    <label for="category_'+category_number+'_subcategories"><?php echo $text_include_subcategories;?></label>';
  html    += '  </td>';
  html    += '  <td class="left">';
  html    += '    <div style="display:flex;">';
  html    += '    <input type="text" style="width:100px;" name="discount[category]['+category_number+'][amount_from]" value="" class="form-control" size="8" placeholder="сумма с" />';
  html    += '    <input type="text" style="width:100px;" name="discount[category]['+category_number+'][amount_to]" value="" class="form-control" size="8" placeholder="сумма до" />';
  html    += '    </div>';
  html    += '  </td>';
  html    += '  <td class="right">';
  html    += '    <div class="datetime-block input-group datetime start-date">';
  html    += '      <input type="text" name="discount[category]['+category_number+'][discount_start]" value="" class="form-control datetime" id="category_'+category_number+'_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>" />';
  html    += '      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>';
  html    += '      <i class="fa fa-minus"></i>';
  html    += '    </div>';
  html    += '    <div class="datetime-block input-group datetime stop-date">';
  html    += '      <input type="text" name="discount[category]['+category_number+'][discount_stop]" value="" class="form-control datetime" id="category_'+category_number+'_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>" />';
  html    += '      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>';
  html    += '    </div>';
  html    += '    <span class="clear pbt-5"></span>';
  html    += '    <input onClick="changeCategoryFulltime('+category_number+')" type="checkbox" name="discount[category]['+category_number+'][fulltime]" id="category_'+category_number+'_fulltime" value="1" />&nbsp;';
  html    += '    <label for="category_'+category_number+'_fulltime"><?php echo $text_fulltime;?></label>';
  html    += '  </td>';
  html    += '  <td class="center">';
  html    += '    <input type="radio" name="discount[category]['+category_number+'][discount_type]" value="percentage" id="category_'+category_number+'_type_percentage" onClick="setDiscountCategoryType(\'category\',this.value, '+category_number+');" checked="checked" />';
  html    += '    <label for="category_'+category_number+'_type_percentage"><?php echo $text_percentage;?></label>';
  html    += '    <input type="radio" name="discount[category]['+category_number+'][discount_type]" value="fixed" id="category_'+category_number+'_type_fixed" onClick="setDiscountCategoryType(\'category\',this.value, '+category_number+');" />';
  html    += '    <label for="category_'+category_number+'_type_fixed"><?php echo $text_fixed;?></label>';
  html    += '  </td>';
  html    += '  <td class="center">';
  html    += '    <span class="discount-value-block">';
  html    += '      <i class="fa fa-minus"></i>';
  html    += '      <input type="text" value="" id="discount_category_category_'+category_number+'_type_value" name="discount[category]['+category_number+'][discount_value]" size="10" class="form-control" />';
  html    += '      <span id="discount_category_category_'+category_number+'_type_character"></span>';
  html    += '    </span>';
  html    += '  </td>';
  html    += '  <td align="center"><button type="button" onclick="$(\'#category-discount-\'+category_number).remove();" data-toggle="tooltip" title="<?php echo $text_remove;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html    += '</tr>';
  
  $('#category-body').append(html);
  setDiscountCategoryType('category','percentage',category_number);

  $('#category-discount-'+category_number+' .datetime').datetimepicker({
    format:'YYYY-MM-DD H:mm',
		pickTime: true
	});
  
  return false;
}






function addManufacturer(){
  manufacturer_number++;
  var html = '';
  
  html += '<tr id="manufacturer-discount-'+manufacturer_number+'">';
  html += '  <td class="left">';
  html += '    <select name="discount[manufacturer]['+manufacturer_number+'][manufacturer_id]" style="width: 100%;" class="form-control">';
  <?php foreach($manufacturers as $manufacturer){ ?>
  html += '        <option value="<?php echo (int)$manufacturer['manufacturer_id'];?>"><?php echo escape_string($manufacturer['name']);?></option>';
  <?php } ?>
  html += '    </select>';
  html += '    <span class="clear pbt-5"></span>';
  html += '    <small><?php echo $text_select_manufacturer;?></small>';
  html += '  </td>';
  html += '  <td class="right">';
  html += '    <div class="datetime-block input-group datetime start-date">';
  html += '      <input type="text" name="discount[manufacturer]['+manufacturer_number+'][discount_start]" value="" class="form-control datetime" id="manufacturer_'+manufacturer_number+'_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>" />';
  html += '      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>';
  html += '      <i class="fa fa-minus"></i>';
  html += '    </div>';
  html += '    <div class="datetime-block input-group datetime stop-date">';
  html += '      <input type="text" name="discount[manufacturer]['+manufacturer_number+'][discount_stop]" value="" class="form-control datetime" id="manufacturer_'+manufacturer_number+'_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>" />';
  html += '      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>';
  html += '    </div>';
  html += '    <span class="clear pbt-5"></span>';
  html += '    <input onClick="changeManufacturerFulltime('+manufacturer_number+')" type="checkbox" name="discount[manufacturer]['+manufacturer_number+'][fulltime]" id="manufacturer_'+manufacturer_number+'_fulltime" value="1" />&nbsp;';
  html += '    <label for="manufacturer_'+manufacturer_number+'_fulltime"><?php echo $text_fulltime;?></label>';
  html += '  </td>';
  html += '  <td class="center">';
  html += '    <input type="radio" name="discount[manufacturer]['+manufacturer_number+'][discount_type]" value="percentage" id="manufacturer_'+manufacturer_number+'_type_percentage" onClick="setDiscountManufacturerType(\'manufacturer\',this.value, '+manufacturer_number+');" checked="checked" />';
  html += '    <label for="manufacturer_'+manufacturer_number+'_type_percentage"><?php echo $text_percentage;?></label>';
  html += '    <input type="radio" name="discount[manufacturer]['+manufacturer_number+'][discount_type]" value="fixed" id="manufacturer_'+manufacturer_number+'_type_fixed" onClick="setDiscountManufacturerType(\'manufacturer\',this.value, '+manufacturer_number+');" />';
  html += '    <label for="manufacturer_'+manufacturer_number+'_type_fixed"><?php echo $text_fixed;?></label>';
  html += '  </td>';
  html += '  <td class="center">';
  html += '    <span class="discount-value-block">';
  html += '      <i class="fa fa-minus"></i>';
  html += '      <input type="text" value="" id="discount_manufacturer_manufacturer_'+manufacturer_number+'_type_value" name="discount[manufacturer]['+manufacturer_number+'][discount_value]" size="10" class="form-control" />';
  html += '      <span id="discount_manufacturer_manufacturer_'+manufacturer_number+'_type_character"></span>';
  html += '    </span>';
  html += '  </td>';
  html += '  <td align="center"><button type="button" onclick="$(\'#manufacturer-discount-\'+manufacturer_number).remove();" data-toggle="tooltip" title="<?php echo $text_remove;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#manufacturer-body').append(html);
  setDiscountManufacturerType('manufacturer','percentage',manufacturer_number);
  
  $('#manufacturer-discount-'+manufacturer_number+' .datetime').datetimepicker({
    format:'YYYY-MM-DD H:mm',
		pickTime: true
	});
  
  return false;
}






function addCustomerGroup(){
  customer_group_number++;
  var html = '';
  
  html += '<tr id="customer-discount-'+customer_group_number+'">';
  html += '  <td class="left">';
  html += '    <select name="discount[customer_group]['+customer_group_number+'][customer_group_id]" style="width: 100%;" class="form-control">';
  <?php foreach($customer_groups as $customer_group){ ?>
  html += '        <option value="<?php echo (int)$customer_group['customer_group_id'];?>"><?php echo escape_string($customer_group['name']);?></option>';
  <?php } ?>
  html += '    </select>';
  html += '    <span class="clear pbt-5"></span>';
  html += '    <small><?php echo $text_select_customer_group; ?></small>';
  html += '  </td>';
  html += '  <td class="right">';
  html += '    <div class="datetime-block input-group datetime start-date">';
  html += '      <input type="text" name="discount[customer_group]['+customer_group_number+'][discount_start]" value="" class="form-control datetime" id="customer_group_'+customer_group_number+'_date_start" size="15" placeholder="<?php echo $text_discount_date_start;?>" />';
  html += '      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>';
  html += '      <i class="fa fa-minus"></i>';
  html += '    </div>';
  html += '    <div class="datetime-block input-group datetime stop-date">';
  html += '      <input type="text" name="discount[customer_group]['+customer_group_number+'][discount_stop]" value="" class="form-control datetime" id="customer_group_'+customer_group_number+'_date_stop" size="15" placeholder="<?php echo $text_discount_date_end;?>" />';
  html += '      <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button></span>';
  html += '    </div>';
  html += '    <span class="clear pbt-5"></span>';
  html += '    <input onClick="changeCustomerGroupFulltime('+customer_group_number+')" type="checkbox" name="discount[customer_group]['+customer_group_number+'][fulltime]" id="customer_group_'+customer_group_number+'_fulltime" value="1" />&nbsp;';
  html += '    <label for="customer_group_'+customer_group_number+'_fulltime"><?php echo $text_fulltime;?></label>';
  html += '  </td>';
  html += '  <td class="center">';
  html += '    <input type="radio" name="discount[customer_group]['+customer_group_number+'][discount_type]" value="percentage" id="customer_group_'+customer_group_number+'_type_percentage" onClick="setDiscountCustomerGroupType(\'customer_group\',this.value, '+customer_group_number+');" checked="checked" />';
  html += '    <label for="customer_group_'+customer_group_number+'_type_percentage"><?php echo $text_percentage;?></label>';
  html += '    <input type="radio" name="discount[customer_group]['+customer_group_number+'][discount_type]" value="fixed" id="customer_group_'+customer_group_number+'_type_fixed" onClick="setDiscountCustomerGroupType(\'customer_group\',this.value, '+customer_group_number+');" />';
  html += '    <label for="customer_group_'+customer_group_number+'_type_fixed"><?php echo $text_fixed;?></label>';
  html += '  </td>';
  html += '  <td class="center">';
  html += '    <span class="discount-value-block">';
  html += '      <i class="fa fa-minus"></i>';
  html += '      <input type="text" value="" id="discount_customer_group_customer_group_'+customer_group_number+'_type_value" name="discount[customer_group]['+customer_group_number+'][discount_value]" size="10" class="form-control" />';
  html += '      <span id="discount_customer_group_customer_group_'+customer_group_number+'_type_character"></span>';
  html += '    </span>';
  html += '  </td>';
  html += '  <td align="center"><button type="button" onclick="$(\'#customer-discount-\'+customer_group_number).remove();" data-toggle="tooltip" title="<?php echo $text_remove;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#customer-group-body').append(html);
  setDiscountCustomerGroupType('customer_group','percentage',customer_group_number);
  $('#customer-discount-'+customer_group_number+' .datetime').datetimepicker({
    format:'YYYY-MM-DD H:mm',
		pickTime: true
	});
  return false;
}

<?php
/******************************* DEFAULT VALUES *******************************/

//total
if(!isset($discount_data['total']['discount_type'])){
  echo '$("#discount_total_type_percentage").click();'."\n";
}else{
  echo '$("#discount_total_type_'.$discount_data['total']['discount_type'].'").click();'."\n";
}

//category
  $num = 1;
  if(isset($discount_data['category'])){
    foreach($discount_data['category'] as $category){
      if(isset($category['discount_type'])){ 
        echo '$("#category_'.$num.'_type_'.$category['discount_type'].'").click();'."\n";
      }
      $num++;
    }
  }

//manufacturer
  $num = 1;
  if(isset($discount_data['manufacturer'])){
    foreach($discount_data['manufacturer'] as $manufacturer){
      if(isset($manufacturer['discount_type'])){
        echo '$("#manufacturer_'.$num.'_type_'.$manufacturer['discount_type'].'").click();'."\n";
      }
      $num++;
    }
  }

//customer_group
  $num = 1;
  if(isset($discount_data['customer_group'])){
    foreach($discount_data['customer_group'] as $customer){
      if(isset($customer['discount_type'])){
        echo '$("#customer_group_'.$num.'_type_'.$customer['discount_type'].'").click();'."\n";
      }
      $num++;
    }
  }
?>



function setDiscountType(type,value){
  if(value == "fixed"){
    document.getElementById("discount_"+type+"_type_character").innerHTML = '<?php echo $primary_currency_code;?>';
  }else{
    document.getElementById("discount_"+type+"_type_character").innerHTML = '%';
  }
}

function setDiscountCategoryType(type, value, category_number){
  if(value == "fixed"){
    document.getElementById("discount_"+type+"_category_"+category_number+"_type_character").innerHTML = '<?php echo $primary_currency_code;?>';
  }else if(value == "pricelist"){
    document.getElementById("discount_"+type+"_category_"+category_number+"_type_character").innerHTML = 'Опт-1, Опт-2, ...';
  }else{
    document.getElementById("discount_"+type+"_category_"+category_number+"_type_character").innerHTML = '%';
  }
}
          

function setDiscountManufacturerType(type, value, manufacturer_number){
  if(value == "fixed"){
    document.getElementById("discount_"+type+"_manufacturer_"+manufacturer_number+"_type_character").innerHTML = '<?php echo $primary_currency_code;?>';
  }else{
    document.getElementById("discount_"+type+"_manufacturer_"+manufacturer_number+"_type_character").innerHTML = '%';
  }
}
          

function setDiscountCustomerGroupType(type, value, customer_group_number){
  if(value == "fixed"){
    document.getElementById("discount_"+type+"_customer_group_"+customer_group_number+"_type_character").innerHTML = '<?php echo $primary_currency_code;?>';
  }else{
    document.getElementById("discount_"+type+"_customer_group_"+customer_group_number+"_type_character").innerHTML = '%';
  }
}



//actual tab display
<?php if(isset($discount_data['setting']['discount_type'])){?>
  <?php if($discount_data['setting']['discount_type'] == "total"){ ?>
    $('#nav-tab-discount-total').click();
    $('#discount_type_total').click();
  <?php } ?>
  
  <?php if($discount_data['setting']['discount_type'] == "manufacturer"){ ?>
    $('#nav-tab-discount-manufacturer').click();
    $('#discount_type_manufacturer').click();
  <?php } ?>
  
  <?php if($discount_data['setting']['discount_type'] == "category"){ ?>
    $('#nav-tab-discount-category').click();
    $('#discount_type_category').click();
  <?php } ?>
  
  <?php if($discount_data['setting']['discount_type'] == "customer_group"){ ?>
    $('#nav-tab-discount-customer').click();
    $('#discount_type_customer_group').click();
  <?php } ?>
  
<?php }else{?>
    $('#nav-tab-discount-total').click();
    $('#discount_type_total').click();
<?php } ?>
</script>
<?php echo $footer; ?>
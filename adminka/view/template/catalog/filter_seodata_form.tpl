<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button id="savecopy" data-toggle="tooltip" title="Сохранить копию" class="btn"><i class="fa fa-copy"></i></button>
        <button id="savebtn" type="submit" form="form-attribute-group" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-attribute-group" class="form-horizontal">
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-attribute-group">Категория</label>
                <div class="col-sm-10">
                  <select name="category_id" id="input-category" class="form-control">
                    <?php foreach ($categories as $category) { ?>
                    <?php if ($category['category_id'] == $filter_seodata_info['category_id']) { ?>
                    <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name'].' ['.$category['category_id'].']'; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name'].' ['.$category['category_id'].']'; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-attribute-group">Группа фильтра</label>
                <div class="col-sm-10">
                  <select name="filter_group_id" id="input-filter_group" class="form-control">
                    <?php foreach ($filter_groups as $filter_group) { ?>
                    <?php if ($filter_group['filter_group_id'] == $filter_seodata_info['filter_group_id']) { ?>
                    <option value="<?php echo $filter_group['filter_group_id']; ?>" selected="selected"><?php echo $filter_group['name'].' ['.$filter_group['filter_group_id'].']'; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $filter_group['filter_group_id']; ?>"><?php echo $filter_group['name'].' ['.$filter_group['filter_group_id'].']'; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-attribute-group">Значение фильтра</label>
                <div class="col-sm-10">
                  <select name="filter_id" id="input-filter" class="form-control">
                    <?php foreach ($filters as $filter) { ?>
                    <?php if ($filter['filter_id'] == $filter_seodata_info['filter_id']) { ?>
                    <option value="<?php echo $filter['filter_id']; ?>" selected="selected"><?php echo $filter['name'].' ['.$filter['filter_id'].']'; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $filter['filter_id']; ?>"><?php echo $filter['name'].' ['.$filter['filter_id'].']'; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-attribute-group">Язык</label>
                <div class="col-sm-10">
                  <select name="language_id" id="input-languageid" class="form-control">
                    <?php foreach ($languages as $id=>$language) { ?>
                    <?php if ($id == $filter_seodata_info['language_id']) { ?>
                    <option value="<?php echo $id; ?>" selected="selected"><?php echo $language ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $id; ?>"><?php echo $language; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-attribute-group">Параметр</label>
                <div class="col-sm-10">
                  <select name="param_name" id="input-paramname" class="form-control">
                    <?php foreach ($paramnames as $paramname) { ?>
                    <?php if ($paramname == $filter_seodata_info['param_name']) { ?>
                    <option value="<?php echo $paramname; ?>" selected="selected"><?php echo $paramname ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $paramname; ?>"><?php echo $paramname; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
            
          <div class="form-group required">
            <label class="col-sm-2 control-label">Значение параметра</label>
            <div class="col-sm-10">              
              <div class="input-group">
                   <textarea name="param_value" id="input-paramvalue">
                        <?php echo isset($filter_seodata_info['param_value']) ? $filter_seodata_info['param_value'] : ''; ?>    
                   </textarea>       
                  
              </div>              
            </div>
          </div>          
        </form>
      </div>
    </div>
  </div>
</div>

<script>
<?php if ($ckeditor) { ?>
    ckeditorInit('input-paramvalue', '<?php echo $token; ?>');
<?php } else { ?>
    $('#input-paramvalue').summernote({height: 300, lang:'ru-RU'});
<?php } ?>

$('#savecopy').click(function() {
    var oldaction=$('#form-attribute-group').attr('action');
    oldaction=oldaction.replace('/edit','/add');
    $('#form-attribute-group').attr('action', oldaction);    
    $('#savebtn').click();
});
</script>
<?php echo $footer; ?>
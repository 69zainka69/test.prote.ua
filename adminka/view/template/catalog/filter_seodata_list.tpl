<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-attribute-group').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label" for="input-filter_category"><?php echo $entry_category; ?></label>
                <div class="input-group">
                    <input type="text" name="filter_category" value="<?php echo $filter_category; ?>" placeholder="<?php echo $entry_category; ?>" id="input-filter_category" class="form-control" />
                    <span class="input-group-btn">
                        <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i></button>                    
                    </span>
                </div>
              </div> 
            </div>             
          </div>  
        </div>  
          
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-attribute-group">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'cd.name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'fgd.name') { ?>
                    <a href="<?php echo $sort_fgname; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_filter_group; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_fgname; ?>"><?php echo $column_filter_group; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'fd.name') { ?>
                    <a href="<?php echo $sort_fname; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_filter; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_fname; ?>"><?php echo $column_filter; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'ag.sort_order') { ?>
                    <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_paramname; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_paramname; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($filter_seodata_items) { ?>
                <?php foreach ($filter_seodata_items as $filter_seodata_item) { ?>                
                <tr>
                  <td class="text-center"><?php if (in_array($filter_seodata_item['id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $filter_seodata_item['id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $filter_seodata_item['id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $filter_seodata_item['name']; ?></td>
                  <td class="text-right"><?php echo $filter_seodata_item['filter_group_id']; ?></td>
                  <td class="text-right"><?php echo $filter_seodata_item['filter_id']; ?></td>
                  <td class="text-right"><?php echo $filter_seodata_item['param_name']; ?></td>
                  <td class="text-right"><a href="<?php echo $filter_seodata_item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
    
$('#button-filter').on('click', function() {
    url = 'index.php?route=catalog/filter_seodata&token=<?php echo $token; ?>';

    var filter_category = $('input[name=\'filter_category\']').val();

    if (filter_category) {
        url += '&filter_category=' + encodeURIComponent(filter_category);
    }

    location = url;
});


$('input[name=\'filter_category\']').bind('keydown', function(e) {
  
  if (e.keyCode == 13) {
    $('#button-filter').trigger('click');
  }
});
//--></script> 
<?php echo $footer; ?>
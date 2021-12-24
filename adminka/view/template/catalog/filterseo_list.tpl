<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> <a href="<?php echo $repair; ?>" data-toggle="tooltip" title="<?php echo $button_rebuild; ?>" class="btn btn-default"><i class="fa fa-refresh"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
            <div class="col-sm-8">
              <div class="form-group">
                <label class="control-label" for="input-name">Введите название, title, H1, ссылку</label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="Введите название, title, H1, ссылку" id="input-name" class="form-control" />
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
               <label class="control-label" style="width:100%;">&nbsp;</label>
              <button type="button" id="button-filter" class="btn btn-primary pull-left"><i class="fa fa-search"></i>Поиск</button>
              </div>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-category">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>">Категория</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>">Категория</a>
                    <?php } ?></td>
                  <td class="text-left hidden"><?php if ($sort == 'sort_group') { ?>
                    <a href="<?php echo $sort_sort_group; ?>" class="<?php echo strtolower($order); ?>">Группа фильтра</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sort_group; ?>">Группа фильтра</a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'sort_filter') { ?>
                    <a href="<?php echo $sort_sort_filter; ?>" class="<?php echo strtolower($order); ?>">Фильтр</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sort_filter; ?>">Фильтр (H1)</a>
                    <?php } ?></td>
                  <td class="text-left">
                    Значения фильтра
                    </td>
                  <td class="text-right">Ссылка</td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($filteries) { ?>
                <?php foreach ($filteries as $filter) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($filter['filterseo_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $filter['filterseo_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $filter['filterseo_id']; ?>" />
                    <?php } ?></td>
                  <td class="left"><?php echo $filter['category_name']; ?></td>
                  <td class="left hidden"><?php echo $filter['filter_group_name']; ?></td>
                  <td class="left"><?php echo $filter['filter_seo_name']; ?></td>
                  <td class="left">
                    <?php foreach($filter['filterseo_filters'] as $value){ ?>
                      <div></div><?php echo $value['name'];?></div>
                    <?php } ?>
                  </td>
                  <td class="left"><?php echo $filter['url']; ?></td>
                  <td class="text-right"><a href="<?php echo $filter['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
  $('input[name=\'filter_name\']').on('keydown', function(e) {
    if (e.keyCode == 13) {
      $('#button-filter').trigger('click');
    }
  });

$('#button-filter').on('click', function() {
  var url = 'index.php?route=catalog/filterseo&token=<?php echo $token; ?>';
  var filter_name = $('input[name=\'filter_name\']').val();
  if (filter_name) {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  }
  location = url;
});
//--></script>
<?php echo $footer; ?>
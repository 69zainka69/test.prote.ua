<?php

$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");
 echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-bestseller" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-bestseller" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
            <div class="col-sm-10">
              <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-prodone"><?php echo $entry_prodone; ?></label>
            <div class="col-sm-10">
              <input type="text" name="prodone" value="<?php echo $prodone; ?>" placeholder="<?php echo $entry_prodone; ?>" id="input-prodone" class="form-control" />
              <?php if ($error_prodone) { ?>
              <div class="text-danger"><?php echo $error_prodone; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-prodotwo"><?php echo $entry_prodotwo; ?></label>
            <div class="col-sm-10">
              <input type="text" name="prodotwo" value="<?php echo $prodotwo; ?>" placeholder="<?php echo $entry_prodotwo; ?>" id="input-prodotwo" class="form-control" />
              <?php if ($error_prodotwo) { ?>
              <div class="text-danger"><?php echo $error_prodotwo; ?></div>
              <?php } ?>
            </div>
           </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-prodthree"><?php echo $entry_prodthree; ?></label>
            <div class="col-sm-10">
              <input type="text" name="prodthree" value="<?php echo $prodthree; ?>" placeholder="<?php echo $entry_prodthree; ?>" id="input-prodthree" class="form-control" />
              <?php if ($error_prodthree) { ?>
              <div class="text-danger"><?php echo $error_prodthree; ?></div>
              <?php } ?>
            </div>
         </div>

         <div class="form-group">
            <label class="col-sm-2 control-label" for="input-prodfour"><?php echo $entry_prodfour; ?></label>
            <div class="col-sm-10">
              <input type="text" name="prodfour" value="<?php echo $prodfour; ?>" placeholder="<?php echo $entry_prodfour; ?>" id="input-prodfour" class="form-control" />
              <?php if ($error_prodfour) { ?>
              <div class="text-danger"><?php echo $error_prodfour; ?></div>
              <?php } ?>
            </div>
         </div>

<div class="form-group">
            <label class="col-sm-2 control-label" for="input-prodfive"><?php echo $entry_prodfive; ?></label>
            <div class="col-sm-10">
              <input type="text" name="prodfive" value="<?php echo $prodfive; ?>" placeholder="<?php echo $entry_prodfive; ?>" id="input-prodfive" class="form-control" />
              <?php if ($error_prodfive) { ?>
              <div class="text-danger"><?php echo $error_prodfive; ?></div>
              <?php } ?>
            </div>
         </div>

         <div class="form-group">
            <label class="col-sm-2 control-label" for="input-prodsix"><?php echo $entry_prodsix; ?></label>
            <div class="col-sm-10">
              <input type="text" name="prodsix" value="<?php echo $prodsix; ?>" placeholder="<?php echo $entry_prodsix; ?>" id="input-prodsix" class="form-control" />
              <?php if ($error_prodsix) { ?>
              <div class="text-danger"><?php echo $error_prodsix; ?></div>
              <?php } ?>
            </div>
         </div>




          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
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
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
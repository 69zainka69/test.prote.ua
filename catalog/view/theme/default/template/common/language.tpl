<?php
if(isset($languages)){
$languagetitle='';
if (count($languages) > 1) {
   $langlist = '';
   foreach ($languages as $language) {
      if ($language['code'] == $code) {
         $languagetitle=$language['name'];
      } else { 
         $langlist .= '<li><a href="' . $language['code'] . '" class="lselect">' . $language['name'] .'</a></li>';
      }
   }   
   ?>

  <div class="pull-left">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="language">
    <div class="btn-group">
      <button class="btn btn-link dropdown-toggle" style="padding: 0 5px; border-top-width:0" data-toggle="dropdown">
      <span class="hidden-sm hidden-md"><?= $languagetitle ?></span> <i class="fa fa-caret-down"></i></button>
      <ul class="dropdown-menu">
          <?= $langlist ?>
      </ul>
    </div>
    <input type="hidden" name="code" value="" />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
  </form>
  </div>
<?php } ?>
<?php } ?>

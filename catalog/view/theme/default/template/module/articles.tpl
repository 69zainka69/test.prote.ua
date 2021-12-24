<div class="panel panel-default">
  <div class="panel-heading"><?php echo $heading_title; ?></div>
  <div class="panel-body">
  <?php foreach ($all_articles as $articles) { ?>
	<div style="margin-bottom:10px; padding-bottom: 5px; border-bottom:1px solid #eee;">
	  <a href="<?php echo $articles['view']; ?>"><?php echo $articles['title']; ?></a><span style="float:right;"><?php echo $articles['date_added']; ?></span><br />
	  <?php echo $articles['description']; ?>
	</div>
  <?php } ?>
  </div>
</div>

<style>
.review{border-bottom:2px solid #f1f1f1;margin-bottom:25px;padding: 0 0 15px 10px;}
.author{font-weight:bold;color:#333;}
.reviews .rating{float:right;}
</style>
<div class="reviews">
<?php if ($reviews) { ?>

<?php foreach ($reviews as $review) { ?>
<div class="review">
  
  <div class="author"><?php echo $review['author']; ?>
    <div class="rating">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
      <?php if ($review['rating'] < $i) { ?>
      <span class="star"></span>
      <?php } else { ?>
      <span class="star ok"></span>
      <?php } ?>
      <?php } ?>
    </div>    
  </div>
  <? /* <div class="date_added"><?php echo $review['date_added']; ?></div>*/ ?>
  
  <div class="text">
   <p><?php echo $review['text']; ?></p>
      
  </div>
</div>
<?php } ?>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<p><?php echo $text_no_reviews; ?></p>
<?php } ?>
</div>
<div class="infos__col">
  <div class="title">
    <?php if($module1 + 1 === 1) : ?>
    <div class="infos__col-title infos__col-title--blue"><?php echo htmlspecialchars_decode($title) ; ?></div>
    <?php elseif($module1 + 1 === 2) : ?>
    <div class="infos__col-title infos__col-title--yellow"><?php echo htmlspecialchars_decode($title) ; ?></div>
    <?php endif;?>
  <div class="text"><?php echo $description; ?></div>
</div>
</div>
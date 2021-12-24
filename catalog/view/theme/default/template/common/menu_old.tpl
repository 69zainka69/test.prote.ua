 <ul class="open aim" style="display:none;">
    <?php foreach ($catalogmenu_new as $key => $category){?>
    <li class="has-sub mainli<?php if($key==0)echo ' opens1 active1';?>" data-id="<?php echo $key; ?>">
        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        <?php if($category['children']){?>
        <div class="subnav">
        <?php foreach (array_chunk($category['children'], 11) as $categorychildren){?>
          <ul>
             <?php foreach ($categorychildren as $children){?>
                 <li<?php if(isset($children['children']) && !empty($children['children'])){?> class="has-sub"<?php } ?>><a href="<?php echo $children['href']; ?>"<?php if($children['href']=='/'){?> class="noactive" onclick="return false"<?php } ?>><?php echo $children['name']; ?></a>
                  <?php if(isset($children['children']) && !empty($children['children'])){?>
                  <div class="subnav ul3">
                    <?php foreach (array_chunk($children['children'], 11) as $categorychild2){?>
                      <ul>
                         <?php foreach ($categorychild2 as $child2){?>
                             <li><a href="<?php echo $child2['href']; ?>"><?php echo $child2['name']; ?></a></li>
                         <?php } ?>
                      </ul>
                    <?php } ?>
                    </div>
                    <?php } ?>
                 </li>
             <?php } ?>
          </ul>

        <?php } ?>
        </div>
        <?php } ?>
    </li>
    <?php } ?>
  </ul>
  <?php foreach ($catalogmenu_new as $key => $category){?>
    <div class="action_box" id="action<?php echo $key; ?>">
      <?php if($category['image1']){?>
      <div class="item">
        <!-- <div class="thumb"> -->
          <img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $category['image1']; ?>" alt="<?php echo strip_tags($category['description1']); ?>" title="<?php echo strip_tags($category['description1']); ?>">
          <!-- </div> -->
        <div class="name">
          <?php if($category['href1']){?><a href="<?php echo $category['href1']; ?>"><?php echo $category['description1']; ?></a><?php } else{?>
          <span><?php echo $category['description1']; ?></span>
          <?php } ?>
        </div>
        <div class="line"></div>
        <!-- <div class="info"> -->
          <a href="<?=$langurl;?>/preorder/" class="orangebox button">
            <span class="svg"><img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/13-parachut2.svg" title="action" alt="action" style="width:32px;height:38px;"/> <?php //echo file_get_contents(DIR_IMAGE.'/ico/13-parachut.svg');?></span>
              <?php echo $text_action4; ?>
          </a>
        <!-- </div> -->
      </div>
      <?php } ?>
      <?php if($category['image2']){?>
      <div class="item">
        <div class="thumb"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $category['image2']; ?>" alt="<?php echo strip_tags($text_action5); ?>" title="<?php echo strip_tags($text_action5); ?>"></div>
        <div class="name"><a href="<?php echo $category['href2']; ?>"><?php echo $category['description2']; ?></a></div>
        <div class="line"></div>
        <div class="info text">
          <!-- <div class="text"> -->
            <?php echo $text_action5; ?>
          <!-- </div> -->
        </div>
      </div>
      <?php } ?>
    </div>
  <?php } ?>

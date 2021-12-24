<svg style="display:none;height:0;width:0;">
    <style>
    <?php echo file_get_contents(DIR_APPLICATION.'/view/js/modal.css');?>
    </style></svg>
    <?php if(!$logged){ ?>
    <div class="overlay overlay-modal"></div>
    <div class="modal modal-form modal-login">
        <div class="body">
          <div class="modal-overlay"></div>
          <div class="modal-body">
            <div class="modal-close">+</div>
            <div id="modal-login"><?php echo $login_html; ?></div>
            <?php /* <script>
                $('#modal-login').load('login/?get_login=1&lang=<?php //echo str_replace('/','',$langurl); ?>');
            </script> */ ?>
          </div>
        </div>
    </div>
    <?php } ?>
    <div class="modal modal-form modal-callback">
        <div class="body">
          <div class="modal-overlay"></div>
          <div class="modal-body">
            <div class="modal-close">+</div>
            <form id="modal-callback" method="post" name="form-callback-modal" class="callback-form form send">
              <div class="modal__title"><?php echo $modal_title; ?></div>
              <input type="hidden" name="title" value="<?php echo $modal_title; ?>">
              <input type="hidden" name="validate" value="tel,name">
              <label><input type="tel" name="tel" placeholder="<?php echo $modal_tel; ?>"  required></label>
              <label><input type="text" name="name" placeholder="<?php echo $modal_name; ?>" required></label>
              <label><input type="hidden" name="g-recaptcha-response" ></label>
              <textarea name="comment" cols="30" rows="5" class="textarea" placeholder="<?php echo $modal_info; ?>"></textarea>
              <div class="buttons">
                <div class="info"><?php echo $modal_time; ?></div>
                <button class="btn" type="submit" data-id="modal-callback"><?php echo $button_submit; ?></button>
              </div>
            </form>
          </div>
        </div>
    </div>
    <div class="btn-modal success" data-modal="modal-success"></div>
    <div class="modal modal-form modal-success">
        <div class="body">
          <div class="modal-overlay"></div>
          <div class="modal-body">
            <div class="modal-close">+</div>
            <form id="modal-success" method="post" name="form-callback-modal" class="callback-form form send">
              <div class="modal__title">&nbsp;</div>
              <div class="text-success"></div>
            </form>
          </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        /*function lockScroll(e) {e.preventDefault(); }*/
        OpenModalDialog = false;
        var overlayModal = $(".overlay--modal");
    
        $('body').on('click',".oneclick, .btn-modal",function(e) {
          console.log('click');
            e.preventDefault();
            var modalName = $(this).data("modal");
            console.log(modalName);
            if ($(document).height() > $(window).height()) {
                var scrollTop = ($('html').scrollTop()) ? $('html').scrollTop() : $('body').scrollTop(); // Works for Chrome, Firefox, IE...
                $('html').addClass('no-scroll').css('top',-scrollTop);
                $(window).resize();
            }
            $("." + modalName).addClass("show").fadeIn(200);
            OpenModalDialog=true;
            setTimeout(function() {
                modalFlex();
            }, 100);
            $(".modal-overlay").click(function() {
                var scrollTop = parseInt($('html').css('top'));
                $('html').removeClass('no-scroll');
                $('html,body').scrollTop(-scrollTop);
                $(window).resize();
                $(this).closest(".modal").removeClass("show");
                $(this).closest(".modal").fadeOut(200);
                OpenModalDialog=false;
            });
        });
    
        $(this).keydown(function(eventObject){
            if(OpenModalDialog && eventObject.which == 27){
                $(".modal-close").click();
                OpenModalDialog=false;
            }
        });
    
        $(".modal-close").click(function() {
            var scrollTop = parseInt($('html').css('top'));
            $('html').removeClass('no-scroll');
            $('html,body').scrollTop(-scrollTop);
            $(window).resize();
            $(this).closest(".modal").removeClass("show");
            $(this).closest(".modal").fadeOut(200);
            OpenModalDialog=false;
        });
    
        modalFlex();
        $(window).resize(function() {
            modalFlex();
        });
    
        function modalFlex () {
            if ( $(window).height() < $(".modal.show").find(".modal-body").height() + 30 ) {
                $(".modal.show").find(".body").css("align-items", "flex-start");
            }else{
                $(".modal.show").find(".body").removeAttr("style");
            }
        }
    
    });
    </script>
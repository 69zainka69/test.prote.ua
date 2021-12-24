<div class="modal-review">
  <div class="modal-review__header">
    <?php echo file_get_contents(DIR_IMAGE . '/ico/vidguk-icon.svg'); ?>
    <?php echo $title_leavereview; ?>
  </div>
  <style>
    .stars {
      display: flex;
      flex-flow: row-reverse;
      justify-content: flex-end;
    }

    .stars--invalid {
      display: none;
      width: 100%;
      color: #fd9710;
      text-align: center;
    }

    .star.is-selected svg,
    .star.is-selected~.star svg {
      fill: darken(orange, 20%);
    }

    .star:hover svg,
    .star:hover~.star svg {
      fill: orange;
    }

    #rated {
      margin-top: 1em;
    }

    [dir="rtl"] {
      direction: rtl
    }
  </style>
  <div class="modal-review__container">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="newShopRatingForm">
      <span class="modal-review__description">
        <?php echo $text_appreciate; ?>:
      </span>
      <div class="modal-review__feedback">
        <div class="modal-review__criterion-block">
          <div class="modal-review__criterion">
            <?php echo $title_service; ?>:
          </div>
          <div class="modal-review__stars">
            <div class="rate-stars">
              <div class="hidden">
                <input name="service_rate" type="hidden" value="0">
              </div>
              <div class="rate-star" id="service_rate-1"></div>
              <div class="rate-star" id="service_rate-2"></div>
              <div class="rate-star" id="service_rate-3"></div>
              <div class="rate-star" id="service_rate-4"></div>
              <div class="rate-star" id="service_rate-5"></div>
            </div>
          </div>
        </div>
        <div class="modal-review__criterion-block">
          <div class="modal-review__criterion">
            <?php echo $title_delivery; ?>:
          </div>
          <div class="modal-review__stars">
            <div class="rate-stars">
              <div class="hidden">
                <input name="delivery_rate" type="hidden" value="0">
              </div>
              <div class="rate-star" id="delivery_rate-1"></div>
              <div class="rate-star" id="delivery_rate-2"></div>
              <div class="rate-star" id="delivery_rate-3"></div>
              <div class="rate-star" id="delivery_rate-4"></div>
              <div class="rate-star" id="delivery_rate-5"></div>
            </div>
          </div>
        </div>
        <div class="modal-review__criterion-block">
          <div class="modal-review__criterion">
            <?php echo $title_product; ?>:
          </div>
          <div class="modal-review__stars">
            <div class="rate-stars">
              <div class="hidden">
                <input name="goods_rate" type="hidden" value="0">
              </div>
              <div class="rate-star" id="goods_rate-1"></div>
              <div class="rate-star" id="goods_rate-2"></div>
              <div class="rate-star" id="goods_rate-3"></div>
              <div class="rate-star" id="goods_rate-4"></div>
              <div class="rate-star" id="goods_rate-5"></div>
            </div>
          </div>
        </div>
        <div class="stars--invalid"><?php echo $error_star_empty; ?></div>
        <fieldset class="modal-review__planing-buy">
          <input type="checkbox" name="planing" style="display:none" onclick="chengePlaningBuy();" checked />
          <label class="modal-rewiew__planing-text" onclick="$(this).prev().click();">
            <?php echo $text_planinglable; ?>
          </label>
          <div style="display:none">
            <label>
              <input type="radio" id="planing_buy_true" name="planing_buy" value="1" checked="checked" />
            </label>
            <label>
              <input type="radio" id="planing_buy_false" name="planing_buy" value="0" />
            </label>
          </div>
        </fieldset>
        <div class="modal-review__group-checkbox">
          <fieldset class="modal-review__sex">
            <input class="modal-review__sex-input" type="checkbox" name="sex" value="male" style="display:none"
              onclick="onlyOne(this);" />
            <label class="modal-rewiew__sex-lable" name="sex" onclick="$(this).prev().click();">
              <?php echo $title_male; ?>
            </label>
          </fieldset>
          <fieldset class="modal-review__sex">
            <input class="modal-review__sex-input" type="checkbox" name="sex" value="famale" style="display:none"
              onclick="onlyOne(this);" />
            <label class="modal-review__sex-lable" name="sex" onclick="$(this).prev().click();">
              <?php echo $title_famale; ?>
            </label>
          </fieldset>
        </div>
        <input type="text" class="modal-review__input" id="input-name" placeholder="<?php echo $title_name; ?>"
          name="name">
        <input type="text" class="modal-review__input" id="input-city" placeholder="<?php echo $title_city; ?>"
          name="city">
        <textarea class="modal-review__textarea" id="input-review" placeholder="<?php echo $title_review; ?>"
          name="comment"></textarea>
        <button class="modal-review__submit" type="button">
          <?php echo $title_leavereview; ?>
        </button>
    </form>
  </div>
</div>
<style>
  <?php echo file_get_contents(DIR_APPLICATION . 'view/theme/default/stylesheet/shop_rate.css');
  ?>
</style>
<script type="text/javascript">
  function chengePlaningBuy() {
    //$('input[name=\"planing\"]:not(:checked)').click();
    if ($('input[name="planing"]').attr("checked") == 'checked') {
      $('#planing_buy_false').prop('checked', true);
      $('input[name="planing"]').attr("checked", fasle);
    }
  }

  $(document).ready(function () {
    $('.newShoprRating .rate-star').click(function () {
      var params = this.id.split('-');
      var type = params[0];
      var id = params[1];
      $('.newShoprRating [id^=' + type + ']').removeClass('star-change');

      for (var i = 1; i <= id; i++) {
        $('#' + type + '-' + i).addClass('star-change');
      }
      $(".newShoprRating input[name=" + type + "-input]").val(id);
    });


    $('.rate-star').hover(
      function () {
        var params = this.id.split('-');
        var type = params[0];
        var id = params[1];
        $('[id^=' + type + ']').removeClass('star-hover');

        for (var i = 1; i <= id; i++) {
          $('#' + type + '-' + i).addClass('star-hover');
        }
      }, function () {
        var params = this.id.split('-');
        var type = params[0];
        var id = params[1];

        $('[id^=' + type + ']').removeClass('star-hover');
      }
    );
    $('.rate-star').click(function () {
      var params = this.id.split('-');
      var type = params[0];
      var id = params[1];
      $('[id^=' + type + ']').removeClass('star-change');

      for (var i = 1; i <= id; i++) {
        $('#' + type + '-' + i).addClass('star-change');
      }
      //$("input[name="+type+"-input]").attr('checked', false);
      //$("input[name="+type+"-input][value=" + id + "]").attr('checked', true);
      $("input[name=" + type + "]").val(id);
    });
  });


  function onlyOne(checkbox) {
    $(checkbox).attr('checked');
    let checkboxes = document.getElementsByName('sex')
    checkboxes.forEach((item) => {
      if (item !== checkbox) item.checked = false
    })
  }
  $(document).ready(function () {
    $(".chb").change(function () {
      $(".chb").prop('checked', false);
      $(this).prop('checked', true);
    });

    $(".chb").change(function () {
      $(".chb").not(this).prop('checked', false);
    });

    $('.newShoprRating .rate-star').hover(
      function () {
        var params = this.id.split('-');
        var type = params[0];
        var id = params[1];
        $('.newShoprRating [id^=' + type + ']').removeClass('star-hover');

        for (var i = 1; i <= id; i++) {
          $('.newShoprRating#' + type + '-' + i).addClass('star-hover');
        }
      }, function () {
        var params = this.id.split('-');
        var type = params[0];
        var id = params[1];

        $('.newShoprRating [id^=' + type + ']').removeClass('star-hover');
      }
    );

    $('.newShoprRating .rate-star').click(function () {
      var params = this.id.split('-');
      var type = params[0];
      var id = params[1];
      $('.newShoprRating [id^=' + type + ']').removeClass('star-change');

      for (var i = 1; i <= id; i++) {
        $('#' + type + '-' + i).addClass('star-change');
      }
      $(".newShoprRating input[name=" + type + "-input]").val(id);
    });

    function checkInput() {
      let form = $(".newShopRatingForm");

      let inputs = ['#input-name', '#input-city', '#input-review'];

      inputs.forEach(function (item) {
        if ($(item).val() != '') {
          $(this).removeClass('input--invalid');
        } else {
          $(item).addClass('input--invalid');
        }
      });
    };


    $(".newShopRatingForm input, .newShopRatingForm textarea").on('input', function () {
      let item = $(this),
        value = item.val();
      if (value != '') {
        $(this).removeClass('input--invalid');
      } else {
        $(this).addClass('input--invalid');
      }
    });
    if ($('input[name="planing"]').attr('checked') == 'undefined') {
      $('#planing_buy_true').val(0);
    }
    $('.modal-review__submit').on('click', function (e) {
      checkInput();
      e.preventDefault();

      let sizeEmpty = $(".newShopRatingForm").find('.input--invalid').length;
      if ($('input[name="goods_rate"]').val() < 1 ||
        $('input[name="delivery_rate"]').val() < 1 ||
        $('input[name="service_rate"]').val() < 1) {
        $('.stars--invalid').show();
        sizeEmpty = 1;
      }else{
        $('.stars--invalid').hide();
      }
      if (sizeEmpty === 0) {
        $.ajax({
          url: '/otzivi/',
          type: 'post',
          dataType: 'json',
          data: $(".newShopRatingForm").serialize(),
          beforeSend: function () {
          },
          complete: function () {
          },
          success: function (json) {
            //console.log(json);
            $('.success, .error').remove();
            if (json['error']) {
              if (json['error']['name']) {
                $('.modal-review input[name="name"]').after('<div class="error">' + json['error']['name'] + '</div>');
              }
              if (json['error']['text']) {
                $('.modal-review textarea[name="text"]').after('<div class="error">' + json['error']['text'] + '</div>');
              }
              if (json['error']['rating']) {
                $('.modal-review .ratingg').after('<div class="error">' + json['error']['rating'] + '</div>');
              }
            }
            if (json['success']) {
              $("html, body").stop().animate({scrollTop:0}, 500, 'swing');
              $('.newShopRatingForm')[0].reset();
              let stars = $('.rate-star');
              for (let i = 0; stars.length > i; i++) {
                console.log(stars[i]);
                $(stars[i]).removeClass('star-change');
              }
            }
            return false;
          },
          error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        });
      }
    });
  });

</script>
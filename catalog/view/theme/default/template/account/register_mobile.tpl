<?php 
if(isset($header)){
echo $header; }
?>
<style>
.breadcrumb{margin-bottom:20px;}
h1{color:#00adee;font-size:23px;font-weight:normal;}
</style>

<style>
  #register{display:flex;justify-content:center;margin-top: -25px;}
  #content{flex-basis: auto;width: 100%;}
  fieldset{border:none;padding:0;margin:0;}
  p{color:#999;font-family:'Trebuchet MS';font-size:12px;}
  p a,.buttons a{text-decoration:underline;color:#00adee;}
  p a:hover,.buttons a:hover{text-decoration:none;color:#fd9710;}
  #account{margin-top:25px;}
  #account>div{padding-top:2px;}
  input[type="checkbox"]{display:none;}
  input[type="checkbox"] + label {cursor:pointer;position:relative;padding-left:27px;color:#999!important;}
  input[type="checkbox"]:checked + label::before{content:"";width:16px;height:7px;border-left:3px solid #fd9710;border-bottom:3px solid #fd9710;position:absolute;left:2px;top:0px;z-index:1;transform:rotate(-45deg);}
  input[type="checkbox"] + label::after{content:"";position:absolute;width:15px;height:15px;background:#ebebeb;top:0;left:0px;}
  /*input[type="email"]{margin-bottom:7px;}*/
  .buttons{display:flex;flex-direction:row;padding-top:18px;color:#999;font-family:'Trebuchet MS';font-size:12px;line-height:13px;}
  .buttons .button{margin-right:25px;}
  .text-danger{color:red;font-family:'Trebuchet MS';font-size:12px;}
  <?php echo file_get_contents(DIR_APPLICATION.'/view/js/edanger.css');?>
  </style>
  <script>
    $(document).ready(function(){    
      const individualPearsonInputs = ['#input-firstname', '#input-lastname', '#input-email', '#input-password', '#input-confirm'];
      const legalPearsonInputs = ['#input-firstname', '#input-lastname', '#input-email',
          '#input-password', '#input-confirm', '#input-custom-field1', '#input-custom-field2', '.top-panel .register-form__telephone'
      ];  
      function checkInput() {
        let form = $("#register_mobile_ajax");

        let individualPearsonInputs = ['#input-firstname', '#input-lastname', '#input-email', '#input-password', '#input-confirm'];
        let legalPearsonInputs = ['#input-firstname', '#input-lastname', '#input-email',
            '#input-password', '#input-confirm', '#input-custom-field1', '#input-custom-field2', '#input-custom-field3'
        ];
        let typePearson = $('#register_mobile_ajax input[name=\'customer_group_id\']:checked').val();
        if (typePearson == 1) {
            individualPearsonInputs.forEach(function(item) {
              item = `#register_mobile_ajax ${item}`;
                if ($(item).val() != '') {
                    $(this).removeClass('register-form__input--invalid');
                } else {
                    $(item).addClass('register-form__input--invalid');
                }
            });
        } else if (typePearson == 4) {
            legalPearsonInputs.forEach(function(item) {
              item = `#register_mobile_ajax ${item}`;
                if ($(item).val() != '') {
                    $(this).removeClass('register-form__input--invalid');
                } else {
                    $(item).addClass('register-form__input--invalid');
                }
            });
        }
    }

    individualPearsonInputs.forEach(function(selector) {
      validateField('.header-m__login-form ' + selector);
    });
    legalPearsonInputs.forEach(function(selector) {
      validateField('.header-m__login-form ' + selector);
    });
    function validateField(element) {
      $(element).on('focusout', (e) => {
        if ($(e.target).val() != '') {
          $(this).removeClass('register-form__input--invalid');
        } else {
          $(element).addClass('register-form__input--invalid');
        }
      });
    }

    $('#register_mobile_ajax .register-form__type-pearson input').on('change', function() {
      let type = $('#register_mobile_ajax input[name=customer_group_id]:checked').val(); 
      if (type == 4) {
        $('#register_mobile_ajax .register-form__legal').addClass('register-form__legal--show'); 
      } else {
        $('#register_mobile_ajax .register-form__legal').removeClass('register-form__legal--show');
      }
      checkInput();
 });

 $("#register_mobile_ajax input").on('input', function () {
  let item = $(this),
    value = item.val();
    if(value != '') {
      $(this).removeClass('register-form__input--invalid');
    } else {
      $(this).addClass('register-form__input--invalid');
    }
});


  $("#register_mobile_ajax").submit(function(e) {
    e.preventDefault();
    id=$(this).attr('id');
    console.log($(this).serialize());
    checkInput();
    let sizeEmpty = $("#register_mobile_ajax").find('.register-form__input--invalid').length;
    if(sizeEmpty === 0){
      $.ajax({
          url: '<?php echo $action; ?>?json=1',
          type: 'post',
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() {
            $('.register-form__error').slideToggle('fast');
          },
          success: function(json) {
            console.log(json);
            if(json['error']){
              $('.register-form__error').remove();
              if(json['error']['password']){
                $('.register-form__password').before('<div class="register-form__error" style="display:none;">'+json['error']['password']+'</div>');
              }
              if(json['error']['confirm']){
                $('.register-form__confirm').before('<div class="register-form__error" style="display:none;">'+json['error']['confirm']+'</div>');
              }
              if(json['error']['firstname']){
                $('.register-form__name').before('<div class="register-form__error" style="display:none;">'+json['error']['firstname']+'</div>');
              }
              if(json['error']['lastname']){
                $('.register-form__surname').before('<div class="register-form__error" style="display:none;">'+json['error']['lastname']+'</div>');
              }
              if(json['error']['email']){
                $('.register-form__email').before('<div class="register-form__error" style="display:none;">'+json['error']['email']+'</div>');
              }
              if(json['error']['email_exists']){
                $('.register-form__email').before('<div class="register-form__error" style="display:none;">'+json['error']['email_exists']+'</div>');
              }
              if(json['error']['telephone']){
                $('.register-form__telephone').before('<div class="register-form__error" style="display:none;">'+json['error']['telephone']+'</div>');
              }
              if(json['error']['company']){
                $('#input-custom-field2').before('<div class="register-form__error" style="display:none;">'+json['error']['company']+'</div>');
              }
              if(json['error']['edrpou']){
                $('#input-custom-field1').before('<div class="register-form__error" style="display:none;">'+json['error']['edrpou']+'</div>');
              }
               if(json['error']['inn']){
                $('#input-custom-field3').before('<div class="register-form__error" style="display:none;">'+json['error']['inn']+'</div>');
              }
              $('.register-form__error').slideToggle('fast');
            } else if(json['redirect'])
            {
              location=json['redirect'];
            }
            return false;
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });
    }
      return false;
    });
  });
    </script>
  <div id="register"><?php //echo $column_left; ?>
    <div id="content"><?php //echo $content_top; ?>

      <form action="<?php echo $action; ?>" id="register_mobile_ajax" method="post" enctype="multipart/form-data" class="form-horizontal register-form">
        <input type="hidden" name="g-recaptcha-response" >
        <fieldset id="account" class="register-form__block">
          <?php /* <legend><?php //echo $text_your_details; ?></legend> */ ?>
          <?php if ($error_captcha) { ?>
            <div class="text-danger"><?php echo $error_captcha; ?></div>
            <?php } ?>
          <div class="register-form__customers" style="display:<?php echo (count($customer_groups) > 1 ? 'block' :'none'); ?>;">
            <label class="register-form__group"><?php echo $entry_customer_group; ?></label>
            <div>
              <?php foreach ($customer_groups as $customer_group) { ?>
              <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
              <div class="radio">
                <label class="register-form__type-pearson">
                  <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked"/>
                  <?php echo $customer_group['name']; ?></label>
              </div>
              <?php } else { ?>
              <div class="radio">
                <label class="register-form__type-pearson">
                  <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" />
                  <?php echo $customer_group['name']; ?></label>
              </div>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
          <div>
            <div>
              <?php if ($error_firstname) { ?>
              <div class="text-danger"><?php echo $error_firstname; ?></div>
              <?php } ?>
              <input type="text" name="firstname" value="<?php echo $firstname; ?>" minlength="3" maxlength="32" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control register-form__name" />
            </div>
          </div>
          <div>
            <div>
              <?php if ($error_lastname) { ?>
              <div class="text-danger"><?php echo $error_lastname; ?></div>
              <?php } ?>
              <input type="text" name="lastname" value="<?php echo $lastname; ?>" minlength="3" maxlength="32" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control register-form__surname" />
            </div>
          </div>
                 
          <!--
          <div>
            <label for="input-fax"><?php echo $entry_fax; ?></label>
            <div>
              <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
            </div>
          </div>
          -->
          <?php foreach ($custom_fields as $custom_field) { ?>
          <?php if ($custom_field['location'] == 'account') { ?>
          <?php if ($custom_field['type'] == 'select') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'radio') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label><?php echo $custom_field['name']; ?></label>
            <div>
              <div>
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <div class="radio">
                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                  <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } else { ?>
                  <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'checkbox') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label><?php echo $custom_field['name']; ?></label>
            <div>
              <div>
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <div class="checkbox">
                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $register_custom_field[$custom_field['custom_field_id']])) { ?>
                  <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } else { ?>
                  <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'text') { ?>
            <div class="register-form__legal">
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <div>
              <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control register-form__input"/>
              <?php if($custom_field['custom_field_id'] == 3) { ?>
              <div class="register-form__require"><?php echo $text_required; ?></div>
              <?php } ?>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
        </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'textarea') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?></textarea>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'file') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label><?php echo $custom_field['name']; ?></label>
            <div>
              <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :''); ?>" />
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'date') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <div class="input-group date">
                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'time') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <div class="input-group time">
                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'datetime') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <div class="input-group datetime">
                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
          <?php } ?>
        </fieldset>
        <div>
          <div class="relative">
            <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control register-form__telephone" />
            <?php if ($error_telephone) { ?>
            <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_telephone; ?></span></div>
            <?php } ?>      
          </div>
        </div>
        <div>
          <div class="relative">
            <?php if ($error_email) { ?>
            <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_email; ?></span></div>
            <?php } ?>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control register-form__email" />
            <?php if ($error_warning) { ?>
            <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_warning; ?></span></div>
            <?php } ?>
          </div>
        </div>   
        <?php /*  <!--
        <fieldset id="address">
          <legend><?php echo $text_your_address; ?></legend>
          <div>
            <label for="input-company"><?php echo $entry_company; ?></label>
            <div>
              <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
            </div>
          </div>
          <div>
            <label for="input-address-1"><?php echo $entry_address_1; ?></label>
            <div>
              <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1" class="form-control" />
              <?php if ($error_address_1) { ?>
              <div class="text-danger"><?php echo $error_address_1; ?></div>
              <?php } ?>
            </div>
          </div>
          <div>
            <label for="input-address-2"><?php echo $entry_address_2; ?></label>
            <div>
              <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2" class="form-control" />
            </div>
          </div>
          <div>
            <label for="input-city"><?php echo $entry_city; ?></label>
            <div>
              <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
              <?php if ($error_city) { ?>
              <div class="text-danger"><?php echo $error_city; ?></div>
              <?php } ?>
            </div>
          </div>
          <div>
            <label for="input-postcode"><?php echo $entry_postcode; ?></label>
            <div>
              <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
              <?php if ($error_postcode) { ?>
              <div class="text-danger"><?php echo $error_postcode; ?></div>
              <?php } ?>
            </div>
          </div>
          <div>
            <label for="input-country"><?php echo $entry_country; ?></label>
            <div>
              <select name="country_id" id="input-country" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($countries as $country) { ?>
                <?php if ($country['country_id'] == $country_id) { ?>
                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php if ($error_country) { ?>
              <div class="text-danger"><?php echo $error_country; ?></div>
              <?php } ?>
            </div>
          </div>
          <div>
            <label for="input-zone"><?php echo $entry_zone; ?></label>
            <div>
              <select name="zone_id" id="input-zone" class="form-control">
              </select>
              <?php if ($error_zone) { ?>
              <div class="text-danger"><?php echo $error_zone; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php foreach ($custom_fields as $custom_field) { ?>
          <?php if ($custom_field['location'] == 'address') { ?>
          <?php if ($custom_field['type'] == 'select') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'radio') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label><?php echo $custom_field['name']; ?></label>
            <div>
              <div>
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <div class="radio">
                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                  <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } else { ?>
                  <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'checkbox') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label><?php echo $custom_field['name']; ?></label>
            <div>
              <div>
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <div class="checkbox">
                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $register_custom_field[$custom_field['custom_field_id']])) { ?>
                  <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } else { ?>
                  <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'text') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'textarea') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?></textarea>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'file') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label><?php echo $custom_field['name']; ?></label>
            <div>
              <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :''); ?>" />
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'date') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <div class="input-group date">
                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'time') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <div class="input-group time">
                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php if ($custom_field['type'] == 'datetime') { ?>
          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class=" custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <label for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
            <div>
              <div class="input-group datetime">
                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] :$custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
          <?php } ?>
        </fieldset>
        --> */ ?>
        <fieldset class="register-form__promotions">
          <div>
              <input type="checkbox" name="news" style="display:none" onclick="chengenews();" <?php if (!$newsletter) { ?> checked <?php } ?>/>
              <label class="register-form__promotions-text"  onclick="$(this).prev().click();">
              <?php echo $entry_newsletter; ?>
            </label>
            <script>
              function chengenews(){
                  $('input[name=\"newsletter\"]:not(:checked)').click();
              }
            </script>
            <div style="display:none">
            <?php if ($newsletter) { ?>
            <label>
              <input type="radio" name="newsletter" value="1" checked="checked" />
              <?php echo $text_yes; ?></label>
            <label>
              <input type="radio" name="newsletter" value="0" />
              <?php echo $text_no; ?></label>
            <?php } else { ?>
            <label>
              <input type="radio" name="newsletter" value="1" />
              <?php echo $text_yes; ?></label>
            <label>
              <input type="radio" name="newsletter" value="0" checked="checked" />
              <?php echo $text_no; ?></label>
            <?php } ?>
            </div>
          </div>
        </fieldset>    
        <fieldset id="pass" class="register-form__passwords-block">
          <div>
            <div class="relative">
              <input type="password" name="password" value="<?php echo $password; ?>" minlength="4" maxlength="20" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control register-form__password" />
              <?php if ($error_password) { ?>
              <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_password; ?></span></div>
              <?php } ?>
            </div>
          </div>
          <div>
            <div class="relative">
              <?php if ($error_confirm) { ?>
              <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_confirm; ?></span></div>
              <?php } ?>
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" minlength="4" maxlength="20" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control register-form__password register-form__confirm" />
            </div>
          </div>
        </fieldset>
        <?php echo $captcha; ?>
        <?php if ($text_agree) { ?>
          <div>
            <input type="submit" value="<?php echo $button_register; ?>" class="register-form__submit" />
          </div>          
          <div class="register-form__private-policy"><?php echo $text_agree; ?>
            <?php if ($agree) { ?>
            <input type="hidden" name="agree" value="1" checked="checked" />
            <?php } else { ?>
            <input type="hidden" name="agree" value="1" />
            <?php } ?>
            &nbsp;
          </div>
        <?php } else { ?>
        <div class="buttons">
          <div>
            <input type="submit" value="<?php echo $button_register; ?>" class="btn btn-primary btn-blue-shadow" />
          </div>
        </div>
        <?php } ?>
      </form>
      <?php //echo $content_bottom; ?></div>
    <?php //echo $column_right; ?></div>

<script>
// Sort the custom fields
$(document).ready(function() {
  $('#account .[data-sort]').detach().each(function() {

    function insertByPosition(element, position) {
      if (position === 'after') {
        if($(this).attr('data-sort') > $(`${element} .`).length) $(`${element} .:last`).after(this);
      } else if (position === 'before') {
        if ($(this).attr('data-sort') < -$(`${element} .`).length) $(`${element} .:first`).before(this);
      }
    }

    if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .').length) {
      $('#account .').eq($(this).attr('data-sort')).before(this);
    }
    insertByPosition('#account', 'after');
    insertByPosition('#account', 'before');
  });

  $('#address .[data-sort]').detach().each(function() {
    if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .').length) {
      $('#address .').eq($(this).attr('data-sort')).before(this);
    }
    insertByPosition('#accoaddressunt', 'after');
    insertByPosition('#accoaddressunt', 'before');
  });

  $('input[name=\'customer_group_id\']').on('change', function() {
    $.ajax({
      url:'index.php?route=account/register/customfield&customer_group_id=' + this.value,
      dataType:'json',
      success:function(json) {
        $('.custom-field').hide();
        $('.custom-field').removeClass('required');

        for (i = 0; i < json.length; i++) {
          custom_field = json[i];

          $('#custom-field' + custom_field['custom_field_id']).show();

          if (custom_field['required']) {
            $('#custom-field' + custom_field['custom_field_id']).addClass('required');
          }
        }


      },
      error:function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  $('input[name=\'customer_group_id\']:checked').trigger('change');
}
</script>
</script>
<?php /* <script><!--
$('button[id^=\'button-custom-field\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display:none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url:'index.php?route=tool/upload',
				type:'post',
				dataType:'json',
				data:new FormData($('#form-upload')[0]),
				cache:false,
				contentType:false,
				processData:false,
				beforeSend:function() {
					$(node).button('loading');
				},
				complete:function() {
					$(node).button('reset');
				},
				success:function(json) {
					$(node).parent().find('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error:function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script> */ ?>
<?php /* <script><!--
$('.date').datetimepicker({
	pickTime:false
});

$('.time').datetimepicker({
	pickDate:false
});

$('.datetime').datetimepicker({
	pickDate:true,
	pickTime:true
});
//--></script> */ ?>
<?php /* <script><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url:'index.php?route=account/account/country&country_id=' + this.value,
		dataType:'json',
		beforeSend:function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete:function() {
			$('.fa-spin').remove();
		},
		success:function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error:function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script> */ ?>

<?php 
if(isset($footer)){
echo $footer; }
?>


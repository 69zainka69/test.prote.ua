var lang='';
language = jQuery('html').attr('lang');
if(language=='uk'){lang='&lang=ua';}
$(document).ready(function() {
  forma_act='';
  block_button=false;
  
  $('form.send').on('submit',function(e){
    e.preventDefault();
    if(block_button)return;
    block_button=true;
    id='#'+$(this).attr('id');
    $('.error').remove();
    $.ajax({
      url: 'index.php?route=information/callback'+lang,
      type: 'post',
      data: $('#'+$(this).attr('id')).serialize(),
      dataType: 'json',
      beforeSend: function() {
        
      },  
      complete: function() {
        block_button=false;
        //$('.form-block .submit').attr('disabled', false);
      },        
      success: function(json) {
        console.log(json);
        if (json['success']) {
          $('.modal-close').click();

          $('.modal-success .text-success').html(json['success']);
          $('.btn-modal.success').click();
          $(id+' input').val('');
          /*$('#'+$(this).attr('id')+' input[name=\'namefile\']').val('');
          $('#'+$(this).attr('id')+' input[name=\'file\']').val('');*/
          $(id+' textarea').val('');
          $('#button-upload').text($('#button-upload').attr('data-original-text'));
        } else if (json['error']) {
          if(json['error']['name']){
            $('input[name="name"]').before('<div class="error">'+json['error']['name']+'</div>');
          }
          if(json['error']['tel']){
            $('input[name="tel"]').before('<div class="error">'+json['error']['tel']+'</div>');
          }
          if(json['error']['email']){
            $('input[name="email"]').before('<div class="error">'+json['error']['email']+'</div>');
          }
          if(json['error']['captcha']){
            $('input[name="g-recaptcha-response"]').before('<div class="error">'+json['error']['captcha']+'</div>');
          }
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        block_button=false;
      }
    }); 
    return false;
  
  }); 

}); 
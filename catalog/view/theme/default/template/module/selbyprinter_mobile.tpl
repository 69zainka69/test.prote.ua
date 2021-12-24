<svg style="display:none;height:0;width:0;">
<style>
.selbyprinter .box-heading{background:#bee9f9;display:flex;align-items:center;}
.box button[type="button"]{background:#bee9f9;width:100%;font-size:13px;}
.box button[type="button"]:hover{background:#fd9710;color:#fff;}
.box-heading{padding:10px;padding-bottom: 6px;font-size: 16px;font-weight: bold;color: #333;font-family: 'Trebuchet MS';}
.box-heading .svg{padding-right:10px;}
.box-heading .txt{line-height: 17px;min-height:51px;}
.selbyprinter .bf-attr-block-cont{padding:24px 0 24px;overflow:visible;}
.selbyprinter select{margin-bottom:18px;}
.modal-selbyprinter select {
  cursor: pointer;
  display: inline-block;
  position: relative;
  color: #C4C4C4;
  height: 40px;
  background: #fff;
  border-radius: 3px;
  border: 2px solid #e1e1e1;
  width: 100%;
  font-family: "Open Sans", sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 15px;
  line-height: 20px;
  margin-bottom: 11px;
}
</style>
</svg>
<style>
.modal-selbyprinter #selectprn { 
  margin-bottom: 10px
}
.modal-selbyprinter h1 {
  font-weight: normal;
  font-size: 40px;
  font-weight: normal;
  text-transform: uppercase;
}
.modal-selbyprinter h1 span {
  font-size: 13px;
  display: block;
  padding-left: 4px;
}

.modal-selbyprinter p {
  margin-top: 200px;
}
.modal-selbyprinter p a {
  text-transform: uppercase;
  text-decoration: none;
  display: inline-block;
  color: #fff;
  padding: 5px 10px;
  margin: 0 5px;
  background-color: #b83729;
  -moz-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  -webkit-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
}
.chosen-container {
  width: 250px;
  box-shadow: none;
  position: relative;
}
.modal-selbyprinter .select-hidden {
  display: none;
  visibility: hidden;
  padding-right: 10px;
}

#modalprint .chosen-container-single .chosen-single {
  box-shadow: none;
  width: 250px;
  position: relative;
  right: 2px;
  background: transparent;
}
#modalprint .chosen-container-single .chosen-single div b {
  position: relative;
  top: 6px;
}
#modalprint .chosen-container {
  width: 250px;
  background: #FFFFFF;
  border: 2px solid #e1e1e1;
  border-radius: 3px;
  height: 40px;
  font-family: Open Sans;
  font-style: normal;
  font-weight: normal;
  font-size: 15px;
  line-height: 20px;
  color: #C4C4C4;
  margin-bottom: 12px !important;
  -webkit-appearance: none;
}
#modalprint .chosen-container.chosen-with-drop .chosen-drop {
  width: 250px;
  position: absolute;
  right: -2px;
}

#modalprint .chosen-container-single .chosen-single {
  height: 36px;
  border: none;
  display: flex;
}
#modalprint .chosen-container-single .chosen-single span {
  font-family: Open Sans, sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 15px;
  line-height: 20px;
  color: #C4C4C4;
  align-items: center;
  display: flex;
  padding-left: 10px;
}
.modal-selbyprinter select option {
  max-width: 250px;
   white-space: inherit;
}

.modal-selbyprinter .select {
  cursor: pointer;
  display: inline-block;
  position: relative;
  color: #fff;
  height: 40px;
  background: #FFFFFF;
  border-radius: 3px;
  border: 2px solid #e1e1e1;
  width: 100%;
  font-family: "Open Sans", sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 15px;
  line-height: 20px;
  margin-bottom: 11px;
}

.modal-selbyprinter .select-styled {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: #FFFFFF;
  padding: 8px 15px;
  -moz-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  -webkit-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
  font-family: Open Sans;
  font-style: normal;
  font-weight: normal;
  font-size: 15px;
  line-height: 20px;
  color: #C4C4C4;
}

.modal-selbyprinter .select-styled:active:after, .select-styled.active:after {
  content: "";
  position: absolute;
  right: 10px;
  z-index: 1;
  background: url("/image/ico/p_arrow.svg") no-repeat;
  width: 16px;
  height: 10px;
  top: 16px;
}

.modal-selbyprinter .select-options {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  left: 0;
  z-index: 999;
  margin: 0;
  padding: 0;
  list-style: none;
  font-family: "Open Sans", sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
  line-height: 27px;
  color: rgb(196, 196, 196);
  background: rgb(255, 255, 255) none repeat scroll 0% 0%;
  border: 1px solid rgb(196, 196, 196);
  border-radius: 3px;
}
.modal-selbyprinter .select-options li:nth-child(1) {
  color: #C4C4C4;
}

.modal-selbyprinter .select-options li {
  margin: 0;
  text-indent: 15px;
  -moz-transition: all 0.15s ease-in;
  -o-transition: all 0.15s ease-in;
  -webkit-transition: all 0.15s ease-in;
  transition: all 0.15s ease-in;
  height: 26px;
  color: #555555;
  font-family: "Open Sans", sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
  line-height: 27px;
}
.modal-selbyprinter .select-options li:hover {
  background: #D3E8F5;
}
.modal-selbyprinter .select-options li[rel="hide"] {
  display: none;
}
</style>
<script>
$(function() {
    $('.modal-selbyprinter__manufacturer').each(function() {
        var $this = $(this),
            numberOfOptions = $(this).children('option').length;
        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul/>', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function() {
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            let text = $(this).text();
            $styledSelect.text($(this).text()).removeClass('active');
            $(".modal-selbyprinter #prnbrand option[value=" + text + "]").attr('selected', 'true').text(text);
            $('.modal-selbyprinter #prnbrand').find(":selected").text();
            $this.val($(this).attr('rel'));
            $list.hide();
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });
});
</script>
<div class="modal-selbyprinter catalog-selbyprinter selbyprinter box hidden-xs hidden-sm">
  <div class="modal-selbyprinter__close"></div>
  <div class="box-heading">
    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/Union.svg');?></span>
    <span class="modal-selbyprinter__title txt" id="textdruk" data-text="<?php echo $text_searchcat; ?>"><?=$text_searchcat?></span>
  </div>
  <div class="box-content">
  <div class="bf-attr-block-cont">
    <form id="modalprint" method="POST">
  <div id="selectbrandmodal" class="input-group">
    <input type="hidden" name="categoryid" id="categoryid" value="<?php echo $categoryId?>">
    <select name="prnbrand" id="prnbrand" class="modal-selbyprinter__select modal-selbyprinter__manufacturer form-control input-lg mounth">
        <option value="" disabled selected><?=$text_selbrand?></option>
        <?php foreach ($brands as $key=>$value) {  
            echo '<option value="' . $value['brand'] . '">' . $value['brand'] . '</option>';              	
        }?>        
    </select>
  </div>
  
  <div id="selectprn" class="input-group">
    <div id="prnlist">
    <select name="prnprinter" id="prnprinter" class="modal-selbyprinter__select form-control input-lg" >
        <option value="" disabled selected><?php echo $text_selmodel; ?></option>
    </select>
    </div>
  </form>
<? /*    
    <span class="input-group-btn">
      <button type="button" id="selectprnbtn" class="btn btn-default btn-lg"><i class="fa fa-arrow-down"></i></button>
    </span>
*/ ?>  
  </div>  

  <div class="text-center" style="margin-top:5px;">
    <button type="button" id="button-filter" class="modal-selbyprinter__send btn btn-primary btn-blue-shadow" ><?=$text_select?>!</button>
  </div>
 </div>
</div>
<script>
$(function(){
   $('.select-options li').click(function(){
     // brandval=$('.modal-selbyprinter #selectbrand option:selected').text();
      category=$('.modal-selbyprinter #categoryid').val();
      brandval = $('.modal-selbyprinter #prnbrand').find(":selected").text();
      $.get("/index.php?route=product/prnjson/", { brand : brandval, category : category, language: '<?php echo $text_selmodel;?>' } ).done (function( data ) {
          $(".modal-selbyprinter #prnlist").html( data );
          $(".modal-selbyprinter .chosen-select").chosen({
              disable_search_threshold: 10,
              search_contains: true,
              no_results_text: "Oops, nothing found!"//,
              //width: "95%"
            });
      }); 
      
   });

   $('.modal-selbyprinter #button-filter').click(function() { window.location.href = '/search?prn=' + $('.modal-selbyprinter #prnprinter option:selected').val() + '&cat_id=' + $('#categoryid').val() });

  _show();
});

function _show(){
  i = 0;
  _text = $('#textdruk').attr('data-text');
  clearInterval(this._int);
  _int = setInterval(function(){
      $('#textdruk').html(_text.slice(0, i));
      i++;
      if(i >= _text.length){
          setTimeout(function() { _show() }, 1000);
      }
  }, 100);
}
</script>


</div>
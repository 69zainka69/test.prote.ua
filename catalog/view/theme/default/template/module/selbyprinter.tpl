<svg style="display:none;height:0;width:0;">
<style>
.selbyprinter .box-heading{background:#bee9f9;display:flex;align-items:center;}
.box button[type="button"]{background:#bee9f9;width:100%;font-size:13px;}
.box button[type="button"]:hover{background:#fd9710;color:#fff;}
.box-heading{padding:10px;font-size: 16px;font-weight: bold;color: #333;font-family: 'Trebuchet MS';}
.box-heading .svg{padding-right:10px;}
.box-heading .txt{line-height: 17px;min-height:51px;}
.selbyprinter .bf-attr-block-cont{padding:24px 0 24px;overflow:visible;}
.selbyprinter select{margin-bottom:18px;}
</style>
</svg>
<div class="catalog-selbyprinter selbyprinter box hidden-xs hidden-sm">
  <div class="box-heading">
    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/14-pidbir.svg');?></span>
    <span class="txt" id="textdruk" data-text="<?php echo $text_searchcat; ?>"><?=$text_searchcat?></span>
  </div>
  <div class="box-content">
  <div class="bf-attr-block-cont">
  <div id="selectbrand" class="input-group">
    <input type="hidden" name="categoryid" id="categoryid" value="<?php echo $categoryId?>">
    <select name="prnbrand" id="prnbrand" class="form-control input-lg" >
        <option value="" disabled selected><?=$text_selbrand?></option>
        <?php foreach ($brands as $key=>$value) {  
            echo '<option value="' . $value['brand'] . '">' . $value['brand'] . '</option>';              	
        }?>        
    </select>
<? /*
    <span class="input-group-btn">
      <button type="button" id="prnbrandbtn" class="btn btn-default btn-lg"><i class="fa fa-arrow-down"></i></button>
    </span>*/ ?>

  </div>
  
  <div id="selectprn" class="input-group">
    <div id="prnlist">
    <select name="prnprinter" id="prnprinter" class="form-control input-lg" >
        <option value="" disabled selected><?php echo $text_selmodel; ?></option>
    </select>
    </div>
<? /*    
    <span class="input-group-btn">
      <button type="button" id="selectprnbtn" class="btn btn-default btn-lg"><i class="fa fa-arrow-down"></i></button>
    </span>
*/ ?>  
  </div>  

  <div class="text-center" style="margin-top:5px;">
    <button type="button" id="button-filter" class="btn btn-primary btn-blue-shadow" ><?=$text_select?>!</button>
  </div>
 </div>
</div>
<script>
$(document).ready(function(){  
   $('#selectbrand').change(function() {  
      brandval=$('#selectbrand option:selected').text();
      category=$('#categoryid').val();      
      $.get( "/index.php?route=product/prnjson/", { brand : brandval, category : category, language: '<?php echo $text_selmodel;?>' } ).done (function( data ) {
          $( "#prnlist" ).html( data );
          $(".chosen-select").chosen({
              disable_search_threshold: 10,
              search_contains: true,
              no_results_text: "Oops, nothing found!"//,
              //width: "95%"
            });
      }); 
      
   });

   $('#button-filter').click(function() { window.location.href = '/search?prn=' + $('#prnprinter option:selected').val() + '&cat_id=' + $('#categoryid').val() });

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
<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/selbyprinter_mobile.tpl');?>
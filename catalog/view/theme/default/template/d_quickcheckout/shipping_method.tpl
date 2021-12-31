<? /*
	Ajax Quick Checkout 
	v6.0.0
	Dreamvention.com 
	d_quickcheckout/shipping_method.tpl 
*/ ?>
</script>

<script>
        $(function frmotpr() {
            var field = new Array("filter_np_city", "np_warehouse","filter_just_city", "just_warehouse","filter_meest_city", "meest_warehouse", );
            $("#shipping_method_form").submit(function() {
                var error = 0;
                $("#shipping_method_form").find(":input").each(function() {
                    for (var i = 0; i < field.length; i++) {
                        if ($(this).attr("name") == field[i]) {
                            if (!$(this).val()) {
                                $(this).addClass('notvalid');
                                error = 1;
                            } else {
                                $(this).removeClass('notvalid');
                            }
                        }
                    }
                })
                if (error == 0) {
                    return true;
                } else {
                    var err_text = "";
                    if (error == 1) err_text = "Це поле необхідно заповнити";
                    $("#messenger").html(err_text);
                    $("#messenger").fadeIn("slow");
                    return false;
                }
            })
        });
    </script>


<div id="shipping_method" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div>

<script>
    $.validator.messages.required = "Your new required message here!";
    
</script>
  
<script type="text/html" id="shipping_method_template">

<form name="formss" id="shipping_method_form" <%= parseInt(model.config.display) && model.show_shipping_method ? '' : 'class=""' %>>
    <% if (model.shipping_methods.length != 0 ) { %>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <span class="icon">
                        <i class="<%= model.config.icon %>"></i>
                    </span>
                    <span class="text"><%= model.config.title %></span>
                </h4>
            </div>
            <div class="panel-body">
                <div class="title"><%= model.config.description %></div>
                <% if(model.error){ %>
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-circle"></i> <%= model.error %>
                    </div>
                <% } %>
                <div id="shipping_method_list">					

                    <% if(model.config.input_style == 'select') { %>
                        <div class="select-input form-group">
                            <select name="shipping_method" class="sel yes form-control shipping-method-select" data-refresh="5" >
                                <% _.each(model.shipping_methods, function(shipping_method) { %>
                                    <% if (parseInt(model.config.display_title)) { %> 
                                        <!-- <optgroup label="<%= shipping_method.title %>"> -->
                                    <% } %>
                                    <% _.each(shipping_method.quote, function(quote) { %>
                                    <% if (quote.code == model.shipping_method.code) { %>
                                        <option  value="<%= quote.code %>" id="<%= quote.code %>" selected="selected" ><%= shipping_method.title %></option>
                                    <% } else { %>
                                        <option  value="<%= quote.code %>" id="<%= quote.code %>" ><%= shipping_method.title %></option>
                                    <% } %>
                                    <% }) %>
                                <% if (parseInt(model.config.display_title)) { %> 
                                        <!-- </optgroup> -->
									<% } %>
								<% }) %>
								</select>
							</div>

                            
                            <% _.each(model.shipping_methods, function(shipping_method) { %>
                                   
                                    <% _.each(shipping_method.quote, function(quote) { %>

                                                    
                                         <div id="pane_<%= quote.code %>" class="panel-collapse collapse <% if (quote.code == model.shipping_method.code) { %>in<% } %>">
                                           
                                            <div class="descr_content">
                                                <%= quote.title %>
                                            </div>

                                        <% if (quote.code == model.shipping_method.code) { %>
                                            
                                        <% } else { %>
                                            
                                        <% } %>

                                        <% if (quote.code == 'flat.flat') { %>
                                
                                            <div id="flat_address_input" class="text-input form-group sort-item required" >
                                            <% if (model.shipping_method.code == 'flat.flat') { %>
                                                <input type="text" id='flat_address' value="<%= model.shipping_method.flat_address %>" class="form-control required" name='flat_address' required placeholder="* Укажите адрес доставки" class="styled" data-refresh="5" />
                                               
                                            <% } else { %>
                                                <input type="text" id='flat_address' value="<%= model.shipping_method.flat_address %>" class="form-control" name='flat_address' placeholder="Укажите адрес доставки" class="styled" data-refresh="5" />
                                            <% } %>
                                            </div>
                                <div style="color:red;" id="kyiv-error"> </div>
                                        <% } %>
                        
                                        <% if (quote.code == 'ukrpost.ukrpost') { %>
                                            
                                            <div id="ukrpost_address_input" class="text-input form-group sort-item required" >
                                            <% if (model.shipping_method.code == 'ukrpost.ukrpost') { %>
                                                <input type="text" id='ukrpost_address' value="<%= model.shipping_method.ukrpost_address %>" class="form-control required" name='ukrpost_address' required placeholder="* Укажите адрес доставки" class="styled" data-refresh="5" />
                                            <% } else { %>
                                                <input type="text" id='ukrpost_address' value="<%= model.shipping_method.ukrpost_address %>" class="form-control" name='ukrpost_address' placeholder="Укажите адрес доставки" class="styled" data-refresh="5" />
                                            <% } %>
                                            <div class="panel-body">
                                                <div class="title"><?php echo $text_warning_title;?></div>
                                                <div class="body"><?php echo $text_warning_body;?></div>
                                            </div>
                                            </div>
                                        <% } %>   
                                        <% if (quote.code == 'free.free') { %>
                                            
                                            <div id="free_address_input" class="text-input form-group sort-item required" >
                                            <% if (model.shipping_method.code == 'free.free') { %>
                                                <input type="text" id='free_address' value="<%= model.shipping_method.free_address %>" class="form-control required" name='free_address' required placeholder="* Укажите адрес доставки" class="styled" data-refresh="5" />
                                                <div>
                                            <% } else { %>
                                                <input type="text" id='free_address' value="<%= model.shipping_method.free_address %>" class="form-control" name='free_address' placeholder="Укажите адрес доставки" class="styled" data-refresh="5" />
                                            <% } %>
                                            <div style="color: red!important;" id="free_address-error"></div>
                                            <div class="panel-body">
                                                <div class="title"><?php echo $text_warning_title;?></div>
                                                <div class="body"><?php echo $text_warning_body;?></div>
                                            </div>
                                            </div>
                                            
                                        <% } %>  



                                        <% if (quote.code == 'justin.justin') { %>
                                      
                                         <label for="just_city"><?php echo $city_shipping_address; ?></label>
                                         <input type="text" required name="filter_just_city" id="filter_just_city" value="<%= model.shipping_method.justcity_selected %>" placeholder="<?php echo $text_filter_just_city;?>">
                                           <div style="color: red!important;" id="messenger"></div>

                                         <select class="form-control" required name="just_city" id="just_city" data-refresh="5" style="display:none;">
                                             <option disabled selected><?php echo $city2_shipping_address; ?></option>
                                             <%= model.shipping_method.justcitysselect %>
                                         </select>
                                         <label for="just_warehouse"><?php echo $warehouse_shipping_address; ?></label>
                                         <select class="form-control" required name="just_warehouse" id="just_warehouse" data-refresh="5" >
                                             <option disabled selected><?php echo $warehouse2_shipping_address; ?></option>
                                             <%= model.shipping_method.justwhselect %>
                                         </select>
                                                    <div style="color: red!important;" id="messenger-warning"></div>
                                            <div class="panel-body">
                                                <div class="title"><?php echo $text_warning_title;?></div>
                                                <div class="body"><?php echo $text_warning_body;?></div>
                                            </div>
                                        <% } %>

                                             <% if (quote.code == 'meest.meest') { %>
                                      
                                         <label for="meest_city"><?php echo $city_shipping_address; ?></label>
                                         <input type="text" required name="filter_meest_city" id="filter_meest_city" value="<%= model.shipping_method.meestcity_selected %>" placeholder="<?php echo $text_filter_meest_city;?>">
                                           <div style="color: red!important;" id="messenger"></div>

                                         <select class="form-control" required name="meest_city" id="meest_city" data-refresh="5" style="display:none;">
                                             <option disabled selected><?php echo $city2_shipping_address; ?></option>
                                             <%= model.shipping_method.meestcitysselect %>
                                         </select>
                                         <label for="meest_warehouse"><?php echo $warehouse_shipping_address; ?></label>
                                         <select class="form-control" required name="meest_warehouse" id="meest_warehouse" data-refresh="5" >
                                             <option disabled selected><?php echo $warehouse2_shipping_address; ?></option>
                                             <%= model.shipping_method.meestwhselect %>
                                         </select>
                                                    <div style="color: red!important;" id="messenger-warning"></div>
                                            <div class="panel-body">
                                                <div class="title"><?php echo $text_warning_title;?></div>
                                                <div class="body"><?php echo $text_warning_body;?></div>
                                            </div>
                                        <% } %>

                                      <% if (quote.code == 'novaposhta.novaposhta') { %>
                                      
                                         <label for="np_city"><?php echo $city_shipping_address; ?></label>
                                         <input type="text" required name="filter_np_city" id="filter_np_city" value="<%= model.shipping_method.npcity_selected %>" placeholder="<?php echo $text_filter_np_city;?>">
                                           <div style="color: red!important;" id="messenger"></div>

                                         <select class="form-control" required name="np_city" id="np_city" data-refresh="5" style="display:none;">
                                             <option disabled selected><?php echo $city2_shipping_address; ?></option>
                                             <%= model.shipping_method.npcitysselect %>
                                         </select>
                                         <label for="np_warehouse"><?php echo $warehouse_shipping_address; ?></label>
                                         <select class="form-control" required name="np_warehouse" id="np_warehouse" data-refresh="5" >
                                             <option disabled selected><?php echo $warehouse2_shipping_address; ?></option>
                                             <%= model.shipping_method.npwhselect %>
                                         </select>
                                                    <div style="color: red!important;" id="messenger-warning"></div>
                                            <div class="panel-body">
                                                <div class="title"><?php echo $text_warning_title;?></div>
                                                <div class="body"><?php echo $text_warning_body;?></div>
                                            </div>
                                        <% } %>

                                        <% if (quote.code == 'intime.intime') { %>   
                                        <label for="in_city"><?php echo $city_shipping_address; ?></label>
                                        <input type="text" required name="filter_in_city" value="<%= model.shipping_method.incity_selected %>" placeholder="<?php echo $text_filter_np_city;?>">
                                         <select class="form-control" required name="in_city" id="in_city" data-refresh="5" style="display:none">
                                             <option disabled selected><?php echo $city2_shipping_address; ?></option>
                                             <%= model.shipping_method.incitysselect %>
                                         </select>
                                         <label for="in_warehouse"><?php echo $warehouse_shipping_address; ?></label>
                                         <select class="form-control" required name="in_warehouse" id="in_warehouse" data-refresh="5" >
                                             <option disabled selected><?php echo $warehouse2_shipping_address; ?></option>
                                             <%= model.shipping_method.inwhselect %>
                                         </select>
                                            <div class="panel-body">
                                                <div class="title"><?php echo $text_warning_title;?></div>
                                                <div class="body"><?php echo $text_warning_body;?></div>
                                            </div>
                                        <% } %>

                                        
                                    </div>



                                    <% }) %>
                                
                                <% }) %>
                            
                    <% }else{ %>
                        <div class="select-input form-group">
                            
                            <select name="shipping_method1" class="sel form-control shipping-method-select" data-refresh="5" >
                                <% _.each(model.shipping_methods, function(shipping_method) { %>
                                    <% _.each(shipping_method.quote, function(quote) { %>
                                    <% if (quote.code == model.shipping_method.code) { %>
                                        <option  value="<%= quote.code %>" id="<%= quote.code %>" selected="selected" ><%= shipping_method.title %></option>
                                    <% } else { %>
                                        <option  value="<%= quote.code %>" id="<%= quote.code %>" ><%= shipping_method.title %></option>
                                    <% } %>
                                    <% }) %>
                                <% if (parseInt(model.config.display_title)) { %> 
                                        </optgroup>
                                    <% } %>
                                <% }) %>
                                </select>
                            </div>

                        <% _.each(model.shipping_methods, function(shipping_method) { %>
                            <% if (parseInt(model.config.display_title)) { %> 
									<strong class="title"><%= shipping_method.title %></strong>
								<% } %>

								<% if (!shipping_method.error) { %>
									<% _.each(shipping_method.quote, function(quote) { %>
									  <div class="radio-input radio">
									    <label for="<%= quote.code %>">
									    <% if (quote.code == model.shipping_method.code) { %>
									      <input type="radio" name="shipping_method" value="<%= quote.code %>" id="<%= quote.code %>" checked="checked" data-refresh="5" class="styled"/>
									    <% } else { %>
									      <input type="radio" name="shipping_method" value="<%= quote.code %>" id="<%= quote.code %>" data-refresh="5" class="styled"/> 
									    <% } %>
									    <span class="text" id='<%= quote.code %>'><%= quote.title %></span>
                                                                            
                                                                            </label>
                      <!-- <span class="price"><%= quote.text %></span></label> -->
                      <div id="pane_<%= quote.code %>" class="panel-collapse collapse <% if (quote.code == model.shipping_method.code) { %>in<% } %>">
                      
                      <% if (quote.code == 'flat.flat') { %>
                            
                            <div id="flat_address_input" class="text-input form-group sort-item required" >
                            <% if (model.shipping_method.code == 'flat.flat') { %>
                                <input type="text" id='flat_address' value="<%= model.shipping_method.flat_address %>" class="form-control required" name='flat_address' required placeholder="* Укажите адрес доставки" class="styled" data-refresh="5" />
                            <% } else { %>
                                <input type="text" id='flat_address' value="<%= model.shipping_method.flat_address %>" class="form-control" name='flat_address' placeholder="Укажите адрес доставки" class="styled" data-refresh="5" />
                            <% } %>
                            </div>
                            
                     	<% } %>
                        
                     <% if (quote.code == 'ukrpost.ukrpost') { %>
                            
                            <div id="ukrpost_address_input" class="text-input form-group sort-item required" >
                            <% if (model.shipping_method.code == 'ukrpost.ukrpost') { %>
                                <input type="text" id='ukrpost_address' value="<%= model.shipping_method.ukrpost_address %>" class="form-control required" name='ukrpost_address' required placeholder="* Укажите адрес доставки" class="styled" data-refresh="5" />
                            <% } else { %>
                                <input type="text" id='ukrpost_address' value="<%= model.shipping_method.ukrpost_address %>" class="form-control" name='ukrpost_address' placeholder="Укажите адрес доставки" class="styled" data-refresh="5" />
                            <% } %>
                            </div>
                            
                        <% } %>   
                     <% if (quote.code == 'free.free') { %>
                            
                            <div id="free_address_input" class="text-input form-group sort-item required" >
                            <% if (model.shipping_method.code == 'free.free') { %>
                                <input type="text" id='free_address' value="<%= model.shipping_method.free_address %>" class="form-control required" name='free_address' required placeholder="* Укажите адрес доставки" class="styled" data-refresh="5" />
                            <% } else { %>
                                <input type="text" id='free_address' value="<%= model.shipping_method.free_address %>" class="form-control" name='free_address' placeholder="Укажите адрес доставки" class="styled" data-refresh="5" />
                            <% } %>
                            </div>
                            
                     	<% } %>   




                    <% if (quote.code == 'justin.justin') { %>
                      
                         <select class="form-control" name="just_city" id="just_city" data-refresh="5" >
                             <option disabled selected>Выберите населенный пункт</option>
                             <%= model.shipping_method.justcitysselect %>
                         </select>

                         <select class="form-control" name="just_warehouse" id="just_warehouse" data-refresh="5" >
                             <option disabled selected>Выберите склад</option>
                             <%= model.shipping_method.justwhselect %>
                         </select>
 
                     	<% } %>

                         <% if (quote.code == 'meest.meest') { %>
                      
                         <select class="form-control" name="meest_city" id="meest_city" data-refresh="5" >
                             <option disabled selected>Выберите населенный пункт</option>
                             <%= model.shipping_method.meestcitysselect %>
                         </select>

                         <select class="form-control" name="meest_warehouse" id="meest_warehouse" data-refresh="5" >
                             <option disabled selected>Выберите склад</option>
                             <%= model.shipping_method.meestwhselect %>
                         </select>
 
                     	<% } %>

                        <% if (quote.code == 'intime.intime') { %>   
                        
                         <select class="form-control" name="in_city" id="in_city" data-refresh="5" required >
                             <option disabled selected>Выберите населенный пункт</option>
                             <%= model.shipping_method.incitysselect %>
                         </select>

                         <select class="form-control" name="in_warehouse" id="in_warehouse" data-refresh="5" required >
                             <option disabled selected>Выберите склад</option>
                             <%= model.shipping_method.inwhselect %>
                         </select>


                     	<% } %>








                      <% if (quote.code == 'novaposhta.novaposhta') { %>
                      
                         <select class="form-control" name="np_city" id="np_city" data-refresh="5" >
                             <option disabled selected>Выберите населенный пункт</option>
                             <%= model.shipping_method.npcitysselect %>
                         </select>

                         <select class="form-control" name="np_warehouse" id="np_warehouse" data-refresh="5" >
                             <option disabled selected>Выберите склад</option>
                             <%= model.shipping_method.npwhselect %>
                         </select>
 
                     	<% } %>

                        <% if (quote.code == 'intime.intime') { %>   
                        
                         <select class="form-control" name="in_city" id="in_city" data-refresh="5" required >
                             <option disabled selected>Выберите населенный пункт</option>
                             <%= model.shipping_method.incitysselect %>
                         </select>

                         <select class="form-control" name="in_warehouse" id="in_warehouse" data-refresh="5" required >
                             <option disabled selected>Выберите склад</option>
                             <%= model.shipping_method.inwhselect %>
                         </select>


                     	<% } %>
                      </div>
                    </div>
									<% }) %>
								<% } else { %>
									<div class="error alert alert-error"><%= shipping_method.error %></div>
								<% } %>
							<% }) %>
						<% } %>
					
				</div>
			</div>
		</div>
	<% }else{ %>
    <% if (model.shipping_error) { %> 
       <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <%= model.shipping_error %></div>
   <% } %>
	<% } %>
</form>
</script>

<script>
$(function() {
	qc.shippingMethod = $.extend(true, {}, new qc.ShippingMethod(<?php echo $json; ?>));
	qc.shippingMethodView = $.extend(true, {}, new qc.ShippingMethodView({
		el:$("#shipping_method"), 
		model: qc.shippingMethod, 
		template: _.template($("#shipping_method_template").html())
	}));
});

$(document.body).on('change',"[name=shipping_method1]",function (e) {
   
   var optVal= $("[name=shipping_method1] option:selected").val();
   console.log(optVal);
   $('input[value="'+optVal+'"]').prop('checked', true).change();
});
</script>

<script>
    
$(document).ready(function() {
getsel();
oncomplete();
});
function getsel(){ $('.sel.yes').each(function() {
    $(this).removeClass('yes');
  var $this = $(this),
    selectOption = $this.find('option'),
    selectOptionLength = selectOption.length,
    //selectedOption = selectOption.filter(':selected'),
    dur = 150;
    //pr=$this.data('text');
  $this.hide();
  $this.wrap('<div class="select"></div>');
  $('<div>', {
    class: 'select__gap'/*,
    text: pr*/
  }).insertAfter($this);

  var selectGap = $this.next('.select__gap'),
    caret = selectGap.find('.caret');
  $('<ul>', {
    class: 'select__list'
  }).insertAfter(selectGap);

  var selectList = selectGap.next('.select__list');
  // Add li - option items
  for (var i = 0; i < selectOptionLength; i++) {
    
    cl='';
    if(selectOption.eq(i).attr('selected')){
      cl=' selected';
      //selectGap.text(pr+' '+selectOption.eq(i).text().toLowerCase());
      selectGap.text(''+selectOption.eq(i).text());
      selectGap.attr('data-sel',selectOption.eq(i).val());
      
    }

    $('<li>', {
        class: 'select__item'+cl,
        html: $('<span>', {
          text: ''+selectOption.eq(i).text()
        })
      })
      .attr('data-value', selectOption.eq(i).val())
      .appendTo(selectList);
  }
  var selectItem = selectList.find('li');

  selectList.slideUp(0);
  selectGap.on('click', function() {
    
    if (!$(this).hasClass('on')) {
      $(this).addClass('on');
      selectList.slideDown(dur);
      selectItem.on('click', function() {
            var chooseItem = $(this).data('value');
            $('.select__item').removeClass('selected');
            $(this).addClass('selected');
            //$('select').val(chooseItem).attr('selected', 'selected');
            $this.val(chooseItem).attr('selected', 'selected');
            //pr=$this.data('text');
            //selectGap.text(pr+' '+$(this).find('span').text().toLowerCase());
            selectGap.text(''+$(this).find('span').text());
            //selectGap.attr('data-valll','text');
            //$('.select__gap').
            selectList.slideUp(dur);
            selectGap.removeClass('on');
            //$('input[value="'+chooseItem+'"]').prop('checked', true).change();
            //$('input[value="'+chooseItem+'"]').parent().parent().slideToggle(true);
            $this.change();
      });

    } else {
      $(this).removeClass('on');
      selectList.slideUp(dur);
    }
  });
});
}
</script>

<!-- <link href="catalog/view/javascript/d_quickcheckout/autocomplete/jquery-ui.css" rel="stylesheet"> -->

<script>
    // Filter
function oncomplete(){
    var lang='';
language = jQuery('html').attr('lang');
if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
     $('input[name=\'filter_np_city\']').autocomplete({
        //source: availableTags
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=d_quickcheckout/shipping_method/autocomplete&filter_np_city=' +  encodeURIComponent(request.term)+lang,
                dataType: 'json',
                success: function(json) {
                    console.log(json);
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['id']
                        }
                    }));
                }
            });
        },
        select: function(e, ui) {
            $(this).val(ui.item.label); 
            $('select option[value="'+ui.item.value+'"]').prop("selected", true).change();
            return false;
        }
    });



$('input[name=\'filter_just_city\']').autocomplete({
        //source: availableTags
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=d_quickcheckout/shipping_method/autocomplete&filter_just_city=' +  encodeURIComponent(request.term)+lang,
                dataType: 'json',
                success: function(json) {
                    console.log(json);
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['id']
                        }
                    }));
                }
            });
        },
        select: function(e, ui) {
            $(this).val(ui.item.label); 
            $('select option[value="'+ui.item.value+'"]').prop("selected", true).change();
            return false;
        }
    });


$('input[name=\'filter_meest_city\']').autocomplete({
        //source: availableTags
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=d_quickcheckout/shipping_method/autocomplete&filter_meest_city=' +  encodeURIComponent(request.term)+lang,
                dataType: 'json',
                success: function(json) {
                    console.log(json);
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['id']
                        }
                    }));
                }
            });
        },
        select: function(e, ui) {
            $(this).val(ui.item.label); 
            $('select option[value="'+ui.item.value+'"]').prop("selected", true).change();
            return false;
        }
    });


     $('input[name=\'filter_in_city\']').autocomplete({
        //source: availableTags
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=d_quickcheckout/shipping_method/autocomplete&filter_in_city=' +  encodeURIComponent(request.term)+lang,
                dataType: 'json',
                success: function(json) {
                    console.log(json);
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['id']
                        }
                    }));
                }
            });
        },
        select: function(e, ui) {
            console.log(ui.item.value);
            $(this).val(ui.item.label);
            $('select option[value="'+ui.item.value+'"]').prop("selected", true).change();
            return false;
        }
    });
}

/*$('#product-filter').delegate('.fa-minus-circle', 'click', function() {
    $(this).parent().remove();
});*/
</script>

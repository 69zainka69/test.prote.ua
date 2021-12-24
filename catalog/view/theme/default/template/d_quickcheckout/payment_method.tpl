<!-- 
	Ajax Quick Checkout 
	v6.0.0
	Dreamvention.com 
	d_quickcheckout/payment_method.tpl 
-->
<!-- <div id="payment_method" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div> -->
<div id="payment_method" class="qc-step" data-col="3" data-row="<?php echo $row; ?>"></div>
<script type="text/html" id="payment_method_template" >
<form id="payment_method_form" <%= parseInt(model.config.display) ? '' : 'class="hidden"' %>>
	<% if (model.error_warning) { %>
		<div class="error"><%= model.error_warning %></div>
	<% } %>
	<% if (model.payment_methods.length != 0) { %>
		<div class="panel panel-default" >
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
				<div id="payment_method_list" class="<%= parseInt(model.config.display_options) ? '' : 'hidden' %>">
				<% if(model.config.input_style == 'select') { %>
					<div class="select-input form-group">
						<select name="payment_method" class="sel yes1 form-control payment-method-select" data-refresh="6" >
						<% _.each(model.payment_methods, function(payment_method) { %>
							<% if (payment_method.code == model.payment_method.code) { %>
								<option  value="<%= payment_method.code %>" id="<%= payment_method.code %>" selected="selected" ><%= payment_method.title %> <span class="price"><%= (payment_method.cost) ? payment_method.cost : '' %></span></option>
							<% } else { %>
								<option  value="<%= payment_method.code %>" id="<%= payment_method.code %>" ><%= payment_method.title %> <span class="price"><%= (payment_method.cost) ? payment_method.cost : '' %></span></option>
							<% } %>
						<% }) %>
						</select>
					</div>
					<% _.each(model.payment_methods, function(payment_method) { %>
						<% if (payment_method.terms) { %>
							<% if (payment_method.code == model.payment_method.code) { %>
								<p class="payment-method-terms <%= payment_method.code %>">(<%= payment_method.terms %>)</p>
							<% } else { %>
								<p class="payment-method-terms <%= payment_method.code %> hidden">(<%= payment_method.terms %>)</p>
							<% } %>
							
						<% } %>
					<% }) %>

				<% }else{ %>
					<% _.each(model.payment_methods, function(payment_method) { %>
						<div>
							<label for="<%= payment_method.code %>">
								<% if (payment_method.code == model.payment_method.code) { %>
									<input type="radio" name="payment_method" value="<%= payment_method.code %>" id="<%= payment_method.code %>" checked="checked" class="styled"  data-refresh="6"/>
								<% } else { %>
									<input type="radio" name="payment_method" value="<%= payment_method.code %>" id="<%= payment_method.code %>" class="styled"  data-refresh="6"/>
								<% } %>

								<% if(0 && parseInt(model.config.display_images)) { %>
									<img class="payment-image" src="<%= payment_method.image %>" />
								<% } %>
      
								<%= payment_method.title %>
								<span class="price"><%= payment_method.cost ? payment_method.cost : '' %></span>

								<% if (payment_method.terms) { %>
								    <p class="payment-method-terms <%= payment_method.code %>">(<%= payment_method.terms %>)</p>
								<% } %>
							</label>
						</div>
					<% }) %>
				<% } %>
				</div>									
			</div>
		</div>
	<% } else{ %>
    <% if (model.payment_error) { %> 
       <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <%= model.payment_error %></div>
   <% } %>
	<% } %>
</form>
</script>
<script>
$(function() {
	qc.paymentMethod = $.extend(true, {}, new qc.PaymentMethod(<?php echo $json; ?>));
	qc.paymentMethodView = $.extend(true, {}, new qc.PaymentMethodView({
		el:$("#payment_method"), 
		model: qc.paymentMethod, 
		template: _.template($("#payment_method_template").html())
	}));
});
</script>
<script>
$(document).ready(function() {
getsel1();
});
function getsel1(){ $('.sel.yes1').each(function() {
    $(this).removeClass('yes1');
  var $this2 = $(this),
    selectOption2 = $this2.find('option'),
    selectOption2Length = selectOption2.length,
    selectedOption2 = selectOption2.filter(':selected'),
    dur = 150;
    //pr=$this2.data('text');
  $this2.hide();
  $this2.wrap('<div class="select"></div>');
  $('<div>', {
    class: 'select__gap2'/*,
    text: pr*/
  }).insertAfter($this2);

  var selectGap2 = $this2.next('.select__gap2'),
    caret2 = selectGap2.find('.caret');
  $('<ul>', {
    class: 'select__list'
  }).insertAfter(selectGap2);

  var selectList2 = selectGap2.next('.select__list');
  // Add li - option items
  for (var i = 0; i < selectOption2Length; i++) {
    
    cl='';
    if(selectOption2.eq(i).attr('selected')){
      cl=' selected';
      //selectGap2.text(pr+' '+selectOption2.eq(i).text().toLowerCase());
      selectGap2.text(''+selectOption2.eq(i).text());
      selectGap2.attr('data-sel',selectOption2.eq(i).val());
      
    }

    $('<li>', {
        class: 'select__item2'+cl,
        html: $('<span>', {
          text: ''+selectOption2.eq(i).text()
        })
      })
      .attr('data-value', selectOption2.eq(i).val())
      .appendTo(selectList2);
  }
  var selectItem2 = selectList2.find('li');

  selectList2.slideUp(0);
  selectGap2.on('click', function() {
    if (!$(this).hasClass('on')) {
      $(this).addClass('on');
      selectList2.slideDown(dur);
      selectItem2.on('click', function() {
	        var chooseItem2 = $(this).data('value');
	        $('.select__item2').removeClass('selected');
	        $(this).addClass('selected');
	        $this2.val(chooseItem2).attr('selected', 'selected');
	        selectGap2.text(''+$(this).find('span').text());
	        selectList2.slideUp(dur);
	        selectGap2.removeClass('on');
	        $this2.change();
      });

    } else {
      $(this).removeClass('on');
      selectList2.slideUp(dur);
    }
  });
});
}
</script>
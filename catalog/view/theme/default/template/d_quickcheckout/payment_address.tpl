<!-- 
	Ajax Quick Checkout 
	v6.0.0
	Dreamvention.com 
	d_quickcheckout/payment_address.tpl 
-->
<div id="payment_address" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div>
<script type="text/html" id="payment_address_template">
<div class="<%= parseInt(model.config.display) ? '' : 'hidden' %>">
	<% if(model.payment_address.customer_group_id == 4) { %>
		<style>
		#payment_address_company_input{display:block;}
		#payment_address_fax_input{display:block;}
		</style>
	<% }else{ %> 
		<style>
		#payment_address_company_input{display:none;}
		#payment_address_fax_input{display:none;}
		</style>
	<% } %>
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
			<% if(model.account == 'logged'){ %> 
			<div class="title"><?php echo $fio; ?></div>
			
			<% }else{ %> 
			<div class="title"><%= model.config.description %></div>
			<% } %> 


			<% if(model.account == 'logged1'){ %> 
				
				<p><?php echo $text_address_existing; ?></p>

				<% if(config.design.address_style == 'list') { %>
				<div class="list-group">
				<% _.each (model.addresses, function(address) { %>
					<div class="list-group-item <%= address.address_id == model.payment_address.address_id ? 'active' : '' %>">
			            <label for="payment_address_exists_<%= address.address_id %>">  
			            	<input type="radio" name="payment_address[address_id]" class="payment-address"  value="<%= address.address_id %>" id="payment_address_exists_<%= address.address_id %>" <%= address.address_id == model.payment_address.address_id ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' /> 
			              	<div class="address-item" ><%= sformat(address.address_format, address) %> </div>
			            </label>
			        </div>
		        <% }) %>
				</div>
				<% }else{ %> 
					<% _.each (model.addresses, function(address) { %>
					<div class="radio-input">
						<label for="payment_address_exists_<%= address.address_id %>">  
			            	<input type="radio" name="payment_address[address_id]" class="payment-address" value="<%= address.address_id %>" id="payment_address_exists_<%= address.address_id %>" <%= address.address_id == model.payment_address.address_id ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' /> 
			                <strong> <%= address.firstname %> 
			                <%= address.lastname %></strong>
			                <%= address.address_1 %>
			                <%= address.address_2 %>
			                <%= address.city %> 
			                <%= address.zone %> 
			                <%= address.country %>,
			                <%= address.postcode %>
			            </label>
		            </div>
		            <% }) %>
				<% } %>
				<div class="radio-input">
		            <input type="radio" name="payment_address[address_id]" class="payment-address" value="new" id="payment_address_exists_new" <%= model.payment_address.address_id == 'new' ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' />
		            <label for="payment_address_exists_new">
		                <?php echo $text_address_new; ?>
		            </label>
		        </div>
		        <form id="payment_address_form" class="form-horizontal <%= model.payment_address.address_id == 'new' ? '' : 'hidden' %>">
				
				</form>

			<% }else{ %>
			<form id="payment_address_form" class="form-horizontal">
				
			</form>
			<% } %>
		</div>
	</div>
</div>
</script>

<script>
$(function() {
	qc.paymentAddress = $.extend(true, {}, new qc.PaymentAddress(<?php echo $json; ?>));
	qc.paymentAddressView = $.extend(true, {}, new qc.PaymentAddressView({
		el:$("#payment_address"), 
		model: qc.paymentAddress, 
		template: _.template($("#payment_address_template").html())
	}));
	qc.paymentAddressView.setZone(qc.paymentAddress.get('payment_address.country_id'));
	//qc.paymentAddressView.complete();
});


</script>
<script>
/*$(document).ready(function() {
	oncomplete2();
});
function oncomplete2(){   
	console.log('00000');
	$('#payment_address_customer_group_id_input input').on('click',function(){
            console.log('11111');
    });
}*/
</script>
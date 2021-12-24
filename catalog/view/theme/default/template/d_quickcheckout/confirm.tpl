<!--
	Ajax Quick Checkout
	v6.0.0
	Dreamvention.com
	d_quickcheckout/confirm.tpl
-->


<div id="confirm_view" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div>
<script type="text/html" id="confirm_template">
<div id="confirm_wrap">
	<div class="panel panel-default">
		<div class="panel-body">
			<form id="confirm_form" class="form-horizontal">
			</form>
			<div id="totalss">
				<div id="sumtotal">
					<div class="text"><?php echo $text_total; ?></div>
					<div class="sum"></div>
				</div>
				<div id="sumshipping">
					<div class="text">(<?php echo $text_info_confirm; ?><span class="sum"></span>)</div>
				</div>
			</div>
			<button id="qc_confirm_order" onclick="valid()" class="button" <%= model.show_confirm ? '' : 'disabled="disabled"' %>>
                <% if(Number(model.payment_popup)) { %><?php echo $button_continue; ?><% }else{ %><?php echo $button_confirm; ?><% } %></span>

                <div class="order-sum-tooltip">
                    <p><?php echo $text_info_min_order_sum; ?></p>
                </div>
            </button>
			<div style="color:red;" id="massengers-name"></div>
			<div style="color:red;" id="massengers-lastname"></div>
			<div style="color:red;" id="massengers-telephone"></div>
			<div style="color:red;" id="massengers-email"></div>
		
		</div>
	</div>
</div>
</script>

<script>

$(function() {
	qc.confirm = $.extend(true, {}, new qc.Confirm(<?php echo $json; ?>));
	qc.confirmView = $.extend(true, {}, new qc.ConfirmView({
		el:$("#confirm_view"),
		model: qc.confirm,
		template: _.template($("#confirm_template").html())
	}));
});

$('body').on('click', function() {
    $('#qc_confirm_order .order-sum-tooltip').removeClass('active');
});

</script>



<script>
function valid() {
var citys = document.getElementById('filter_np_city').value;
var viddile = document.getElementById('np_warehouse').value;
var name = document.getElementById('payment_address_firstname').value;
var lastname = document.getElementById('payment_address_lastname').value;
var telephone = document.getElementById('payment_address_telephone').value;
var email = document.getElementById('payment_address_email').value;
var nich = document.getElementById('free_address').value;
var kyiv = document.getElementById('flat_address').value;
var ukrpost = document.getElementById('ukrpost_address').value;



if (name === "") {
    document.getElementById('massengers-name').innerHTML="Пожалуйста, заполните поле Вашего имени";
  }
if (lastname === "") {
    document.getElementById('massengers-lastname').innerHTML="Пожалуйста, заполните поле Вашей фамилии";
  }
if (telephone === "") {
    document.getElementById('massengers-telephone').innerHTML="Пожалуйста, заполните поле Телефон";
  }
if (email === "") {
    document.getElementById('massengers-email').innerHTML="Пожалуйста, заполните поле E-mail";
  }


if (ukrpost === "") {
    document.getElementById('free_address-error').innerHTML="Це поле необхідно заповнити";
  }
if (kyiv === "") {
    document.getElementById('kyiv-error').innerHTML="Це поле необхідно заповнити";
  }
if (nich === "") {
    document.getElementById('free_address-error').innerHTML="Це поле необхідно заповнити";
  }
if (viddile === "Виберіть склад") {
    document.getElementById('messenger-warning').innerHTML="Це поле необхідно заповнити";
  }
if (citys ===  "") {
    document.getElementById('messenger').innerHTML="Це поле необхідно заповнити";
  }


//console.log('Город НП:',citys)
//console.log('Отделение НП: ', viddile)
//console.log('Имя: ', name)
//console.log('Фамилия: ', lastname)
//console.log('Телефон: ', telephone)
//console.log('Email: ', email)
//console.log('Ночной экспрес: ', nich)
//console.log('Доставка по киеву: ', kyiv)
//console.log('Укр почта: ', ukrpost)
}
</script>



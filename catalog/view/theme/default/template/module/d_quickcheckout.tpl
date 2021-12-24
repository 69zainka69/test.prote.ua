<!-- <script src="catalog/view/javascript/jquery/jquery-ui-1.12.1/jquery-ui.min.js"></script> -->
<link href="catalog/view/javascript/d_quickcheckout/autocomplete/jquery-ui.css" rel="stylesheet">
<!-- <link href="catalog/view/javascript/jquery/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet"> -->
<script src="catalog/view/javascript/d_quickcheckout/autocomplete/jquery-ui.min.js"></script>
<script>
var config = <?php echo $json_config; ?>;
if(typeof(ga) == "undefined")
   config.general.analytics_event = 0;
</script>
<style>
<?php echo $config['design']['custom_style']; ?>
<?php if($config['design']['only_quickcheckout']){ ?>
body > *{
	display: none
}
body > #d_quickcheckout{
	display: block;
}
#d_quickcheckout.container #d_logo{
	margin: 20px 0px;
}
<?php } ?>
#content{width:100%;}
#cart_view{display:none;}
#cart_view .panel-heading{display:none;}
#cart_view .table{display:none;}
#cart_view .row{margin:0;}
#cart_view .text-right{padding: 0 10px;color:#333;}
#cart_view label{color:#999!important;}
.collapse{display:none;}
.collapse.in{display:block;}
.hidden{display:none;}
#payment_address .control-label{display:none;}
#payment_address label{color:#999!important;}
#shipping_address{display:none;}
#dflex{display:flex;margin:0;}
#dflex>div{width:33.33%;padding:15px;}
/*input[name=shipping_method]{display:none;}*/
#shipping_method_list .radio-input.radio{display:none;}
#payment_view{display:none;}
#payment_view .buttons{display:none;}

<?php echo file_get_contents(DIR_APPLICATION.'/view/js/select.css');?>
.select{width:100%;}
.select__gap, .select__gap2{margin:0;border:1px solid #cecece;padding: 12px 30px 12px 55px;}
.select__list{margin:0;background:#fff;}
.select__list li span{padding: 12px 30px 12px 55px;}
.select__list li{border-bottom:1px solid #cecece;border-left:1px solid #cecece;border-right:1px solid #cecece;}
.panel-title{color:#00adee;font-size:14px;font-weight:normal;margin-bottom:15px;}
.panel-body{padding-top:9px;}
.panel-body .title{color:#fd9710;font-size:15px;font-weight:normal;margin-bottom:17px;}
#payment_address input[type=tel],#payment_address input[type=text]{margin: 15px 0 0;}
#payment_address #payment_address_email{margin: 15px 0 0;}
#payment_address #payment_address_firstname{margin:0;}
.select__gap[data-sel="pickup.pickup"],.select__item[data-value="pickup.pickup"]{
background: url('/image/ico/checkout/samo.svg') 15px 10px no-repeat;
}
.select__gap[data-sel="flat.flat"],.select__item[data-value="flat.flat"]{
background: url('/image/ico/checkout/kurier.svg') 15px 10px no-repeat;
}
.select__gap[data-sel="novaposhta.novaposhta"],.select__item[data-value="novaposhta.novaposhta"]{
background: url('/image/ico/checkout/np.svg') 15px 10px no-repeat;
}
.select__gap[data-sel="justin.justin"],.select__item[data-value="justin.justin"]{
background: url('/image/ico/checkout/justin.svg') 15px 10px no-repeat;
}
.select__gap[data-sel="meest.meest"],.select__item[data-value="meest.meest"]{
background: url('/image/ico/checkout/meest.svg') 15px 10px no-repeat;
}
.select__gap[data-sel="intime.intime"],.select__item[data-value="intime.intime"]{
background: url('/image/ico/checkout/intaim.svg') 15px 11px no-repeat;
}
.select__gap[data-sel="ukrpost.ukrpost"],.select__item[data-value="ukrpost.ukrpost"]{
background: url('/image/ico/checkout/ukrposhta.svg') 15px 13px no-repeat;
}
.select__gap[data-sel="free.free"],.select__item[data-value="free.free"]{
background: url('/image/ico/checkout/ne.svg') 15px 6px no-repeat;
}

.select__gap2[data-sel="cod"],.select__item2[data-value="cod"]{
background: url('/image/ico/checkout/gotivka.svg') 15px 8px no-repeat;
}
.select__gap2[data-sel="privat24"],.select__item2[data-value="privat24"]{
background: url('/image/ico/checkout/portmone.svg') 15px 9px no-repeat;
}
.select__gap2[data-sel="portmone"],.select__item2[data-value="portmone"]{
background: url('/image/ico/checkout/portmone.svg') 15px 9px no-repeat;
}
.select__gap2[data-sel="liqpay"],.select__item2[data-value="liqpay"]{
	background: url('/image/ico/checkout/liqpay.svg') 10px 15px no-repeat;
}
.select__gap2[data-sel="bank_transfer"],.select__item2[data-value="bank_transfer"]{
background: url('/image/ico/checkout/bezgot-PDV.svg') 15px 13px no-repeat;
}
.select__gap2[data-sel="bank_transfer2"],.select__item2[data-value="bank_transfer2"]{
background: url('/image/ico/checkout/bezgot-bezPDV.svg') 15px 13px no-repeat;
}

.select__gap.select__item.selected,.select__item:hover,
.select__gap2.select__item2.selected,.select__item2:hover{
 background-color: #ecf7fb;
}
.select__item span:hover,.select__item2 span:hover{background:none;}

.select__gap[data-sel="ukrpost.ukrpost"],.select__item[data-value="ukrpost.ukrpost"] span{
    padding: 12px 30px 12px 105px;
}

.select__gap[data-sel="intime.intime"],.select__item[data-value="intime.intime"] span{
    padding: 12px 30px 12px 100px;
}
.select__gap[data-sel="novaposhta.novaposhta"],.select__item[data-value="novaposhta.novaposhta"] span{
    padding: 12px 30px 12px 95px;
}
.select__item.selected,.select__item2.selected{display:none;}
#content label{font-family: 'Trebuchet MS';color: #00aff2;font-size: 12px;}
.select-input{margin-bottom:20px;}
.descr_content{font-size:13px;color:#333;margin-bottom:20px;}
#confirm_comment_input label{color: #fd9710;font-size: 15px;font-weight: normal;padding-bottom: 15px;font-family: 'Open Sans',sans-serif;display:block;}
#confirm_agree_input label{color:#999;line-height:13px;display:block;margin-top:5px;margin-bottom:5px;}
#confirm_agree_input label a{color:#00adee;text-decoration:underline;}
#qc_confirm_order{width:100%;}
.text-danger{color:red;font-size:11px;padding: 0 0 5px;}
.title_comment{color:#00adee;font-size:14px;font-weight:normal;margin-bottom:15px;border-bottom:2px solid #00adee;padding-bottom:20px;}
#confirm_view textarea{}
#totalss>div{font-family: 'Trebuchet MS';}
#sumtotal{display:flex;color:#333;font-size:15px;margin-top:15px;}
#sumtotal{justify-content:space-between;margin-bottom:15px;}
#sumtotal .sum{font-size:32px;height:110px;}
#sumshipping{font-size:12px;color:#00aff2;text-align:right;margin-bottom:10px;}
.login-btn-group{display:none;}
.or{text-align:center;position:relative;padding-bottom:3px;}
.or span {background:#fff;padding:7px;color:#333;font-size:13px;position:relative;}
.or:before{content:'';border-bottom:1px solid #f8f7f8;width:100%;top:50%;position:absolute;left:0;}
#login_view{margin-top:18px;}
#login_view .panel-heading{color:#fd9710;font-size:15px;font-weight:normal;padding-top:24px;padding-bottom:10px;}
#login_view .control-label{display:none;}
.rem_pas{text-align:right;}
.rem_pas a{color:#999;font-family: 'Trebuchet MS';font-size:12px;text-decoration:underline;}
#login_view .button{width:100%;margin-top:10px;}
#confirm_wrap{padding-top:20px;}

#qc_confirm_order:disabled {background: lightgray;}
#qc_confirm_order {position: relative;}
#qc_confirm_order .qc_confirm_order_preloader {position: absolute;top: 2px;right: 3px;}
#qc_confirm_order .qc_confirm_order_preloader img {width: 30px;height: 30px;}
#qc_confirm_order .order-sum-tooltip {display:none;top: -95px;left: 30px;text-align:center;font-family: 'Open Sans',sans-serif;font-weight: normal;font-size: 13px;line-height: 1.5em;position: absolute;z-index: 999;background-color: #ECF7FB;width: 290px;border: 1px solid #BEE9F9;padding: 8px 6px;border-radius: 16px;}
#qc_confirm_order .order-sum-tooltip:after, .order-sum-tooltip:before {content: "";font-size: 0;line-height: 0;border-top: 20px solid transparent;border-bottom: 0 solid transparent;border-right: 21px solid #ECF7FB;position: absolute;bottom: 14px;left: -19px;}
#qc_confirm_order .order-sum-tooltip:before {border-right: 21px solid #BEE9F9;bottom: 13px;left: -21px;}
#qc_confirm_order .order-sum-tooltip p {margin: 0;padding: 0;color: #333;padding: 2px 7px;line-height: 17px;}
#qc_confirm_order .order-sum-tooltip.active {display: block;}
@media (max-width: 350px) {
#qc_confirm_order .order-sum-tooltip {left: 10px;}
}

#modal-agree .modal-body{max-width:800px;max-height:100%;overflow:auto;padding:25px; }
#modal-agree .modal__title{
background: url('image/ico/account/polit.svg') 22px 0 no-repeat;
padding-left:73px;
padding-bottom:17px;
border-bottom:1px solid #cecece;
line-height:41px;
}
#modal-agree .form{
font-size:12px;
color:#999;
font-family:'Trebuchet MS';
line-height:13px;
}
#modal-agree .form b{
font-size:15px;
color:#333;
font-family:'Trebuchet MS';
font-weight:normal;
}
#modal-agree .form p{
padding:7px 0 10px;
}
#confirm_agree_input input{display:none;}
@media (max-width: 768px) {
#dflex>div{width:100%;}
}
#free_address-error{color: red!important;}
#payment_address_form{display:flex;flex-wrap:wrap;}
#payment_address_form>div{width:100%;}
#payment_address_form #payment_address_heading_heading{width:50%; color:#fd9710; padding-left:10px; }
#payment_address_form #payment_address_customer_group_id_input{width:50%; }
#payment_address_customer_group_id_input input{display:none;}
#payment_address_customer_group_id_input input+label{position:relative;padding-left:20px;cursor:pointer;}
#payment_address_customer_group_id_input input+label:before{content:''; position:absolute; left:1px; top:2px; width: 11px; height: 11px; border:2px solid #fff; border-radius: 50%; }
#payment_address_customer_group_id_input input:checked+label:before{background: #fd9710; }
#payment_address_customer_group_id_input input+label:after{content:''; position:absolute; left:0; top:1px; width: 13px; height: 13px; border:1px solid #999; border-radius: 50%; }
#payment_address_company_input{margin-top:20px;}
#payment_address_email_input{margin-bottom:10px;}
label{font-family:'Trebuchet MS';color:#00aff2;font-size:12px;}
#confirm_no_call_input{margin:20px 0;}
#confirm_no_call_input input[type="checkbox"]{display:none;}
#confirm_no_call_input input[type="checkbox"] + label {cursor:pointer;position:relative;padding-left:27px;color:#999!important;}
#confirm_no_call_input input[type="checkbox"]:checked + label::before{content:"";width:16px;height:7px;border-left:3px solid #fd9710;border-bottom:3px solid #fd9710;position:absolute;left:2px;top:0px;z-index:1;transform:rotate(-45deg);}
#confirm_no_call_input input[type="checkbox"] + label::after{content:"";position:absolute;width:15px;height:15px;background:#ebebeb;top:0;left:0px;}
#payment_address_shipping_address_input{display:none!important;}
.error{color: red!important;display: block;}
<?php echo file_get_contents(DIR_APPLICATION.'view/js/tooltip.css'); ?>
</style>
<!-- <link href="catalog/view/theme/default/stylesheet/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" /> -->
<script async src="catalog/view/theme/default/stylesheet/bootstrap/js/bootstrap.min.js"></script>
<div id="d_quickcheckout">
	<?php if($config['design']['only_quickcheckout']){ ?>
	<div id="d_logo" class="center-block text-center"></div>
	<?php } ?>
	<?php echo $field; ?>

	<div class="qc-col-0">
		<?php echo $payment_address; ?>
		<?php echo $shipping_address; ?>
		<?php echo $shipping_method; ?>
		<?php echo $payment_method; ?>
		<?php echo $cart; ?>
		<?php echo $payment; ?>
		<?php echo $confirm; ?>
		<?php echo $login; ?>
	</div>
	<div class="row" id="dflex">
		<div class="qc-col-1"></div>
		<div class="qc-col-2"></div>
		<div class="qc-col-3"></div>
		<div class="qc-col-4"></div>
	</div>
</div>
<script>
$(function() {

	$('.qc-step').each(function(){
		$(this).appendTo('.qc-col-' + $(this).attr('data-col'));
		//$(this).appendTo('.qc-col-1');
	})
	$('.qc-step').tsort({attr:'data-row'});
<?php if($config['design']['only_quickcheckout']){ ?>
	$('body').prepend($('#d_quickcheckout'));
	$('#d_quickcheckout').addClass('container')
	$('#d_quickcheckout #d_logo ').prepend($('header #logo').html())
<?php } ?>
<?php if(!$config['design']['breadcrumb']) { ?>
	$('.qc-breadcrumb').hide();
<?php } ?>
})
</script>


<script>
$(document).ready(function() {
replace_totals();
});

function replace_totals(){
	$('#sumshipping .sum').html($('#sum_shipping').html());
	$('#sumtotal .sum').html($('#sum_total').html());
}

//$(function() {
/*$(document).ready(function() {
$('input[type="text"]').on('focus',function(e){
	var $self = $(this);
	$self.data('placeholder-tmp', $self.attr('placeholder'));
	$self.attr('placeholder', '');

});

$('input[type="text"]').on('blur',function(e){
	var $self = $(this);

	$self.attr('placeholder', $self.data('placeholder-tmp'));
});
});*/

</script>

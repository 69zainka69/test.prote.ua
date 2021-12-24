 
<!--  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
 <script src="/catalog/view/js/jquery_cookie/jquery.cookie.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto:700,900&display=swap" rel="stylesheet">
<style>
@font-face {
    font-family: 'FreeSetBlackC';
    src: url('catalog/view/theme/default/fonts/FreeSetBlackC/FreeSetBlackC_18652.eot');
    src: url('catalog/view/theme/default/fonts/FreeSetBlackC/FreeSetBlackC_18652.eot') format('embedded-opentype'),
         url('catalog/view/theme/default/fonts/FreeSetBlackC/FreeSetBlackC_18652.woff2') format('woff2'),
         url('catalog/view/theme/default/fonts/FreeSetBlackC/FreeSetBlackC_18652.woff') format('woff'),
         url('catalog/view/theme/default/fonts/FreeSetBlackC/FreeSetBlackC_18652.ttf') format('truetype'),
         url('catalog/view/theme/default/fonts/FreeSetBlackC/FreeSetBlackC_18652.svg#FreeSetBlackC_18652') format('svg');
}
.d-flex{display:flex;}
#blackfridey{
	margin: auto;
	max-width:1153px;
	background: #ffaa00;
	
	position: relative;
}
.boxfr{

}
@media (min-width:320px){#blackfridey{width:97%}}
@media (min-width:576px){#blackfridey{width:97%}}
@media (min-width:768px){#blackfridey{width:700px;}}
@media (min-width:992px){#blackfridey{width:700px;}}
@media (min-width:1230px){#blackfridey{width:700px;}}
@media (min-width:1300px){#blackfridey{width:700px;}}
#blackfridey .b-tile{
	font-family: 'FreeSetBlackC', arial;
	font-size:23px;
	text-align: center;
	padding-top: 20px;
}
#blackfridey .b-tile span{
	font-size:60px;
	font-size: 38px;
}
#blackfridey .products1{
	display: flex;
	flex-wrap:wrap;
	justify-content: center;
	
	margin:30px 20px;
	margin-top:60px;
}
#blackfridey .products1 .product1{
	width: 106px;
	min-width: 101px;
	height:106px;
	border:1px solid #fff;
	padding:4px;
	position: relative;
	border-radius: 10px;
	margin:0 5px;
	margin-bottom:32px;
	background: url('image/black/fon.png') -22px -65px no-repeat;
}
#blackfridey .name{position: relative;z-index: 10;
    margin-bottom: 3px;
}
#blackfridey .name a{
	color: #000;font-family: "Helvetica";
	font-size:7px;
	text-decoration:none;
	height: 30px;
	overflow: hidden;
	display: block;
	    line-height: 10px;
}
#blackfridey .prices{
line-height: 15px;
}
/*#blackfridey .products1 .product1:after{
	content: '';
	background: url('image/black/fon.png') center center no-repeat;
	position: absolute;
	width: 181px;
	height: 150px;
	z-index:1;
	margin:auto;
	top: -60px;
    left: -35px;
}*/
#blackfridey .products1 .image{
	text-align:center;
	margin-top:-35px;
	position: relative;
	z-index: 10;
	margin-bottom:5px;
	
}
#blackfridey .products1 .image img{
	max-width: 70px;
	height: auto;
}
#blackfridey .product1 .special{
	font-family:'Roboto', sans-serif;
	font-weight:900;
	color:#000;
	font-size: 14px;
	    line-height: 10px;
}
#blackfridey .product1 .price{
	position: relative;
	font-family:'Roboto', sans-serif;
	font-weight:700;
	text-decoration:line-through;
	color:#fff;
	display: inline;
	font-size: 12px;
	    line-height: 10px;
}
#blackfridey .product1 .price:before{
	content:'';
	width: 100%;
	position: absolute;
	border:1px solid red;
	top: 50%;
}

#blackfridey .product1 .addcart{
	background: #37e454;
    color: #fff;
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    width: 41px;
    line-height: 20px;
    font-size: 9px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
}
.bot{
	justify-content: space-between;
	align-items: center;
}




.pop-up{display:none;position: fixed; overflow: auto; left: 0; top: 0; width: 100%; height: 100%; background: rgb(197,227,207,0.5);z-index:9999;}
.pop-up .box{
	/*width:600px; */
	width: 100%;
	position: absolute; left: 50%; 
	/*top: 5%; */
	top: 50%; 
	transform: translate(-50%,-50%); border-radius: 5px; font-family: "Segoe UI", Arial; }
.pop-up .close-button{width:42px;height:42px;
	position:absolute;
	border-radius: 50%;
	background: #fff;
	right:-17px;
	top:-19px;
	display:block;text-decoration:none;}
.pop-up .close-button:hover{text-decoration:none;}
.pop-up .close-button:before,
.pop-up .close-button:after{content:'';position:absolute;width:21px;height:2px; transform: rotate(0deg);top:0;background:#c0c0c0;
    top: 20px;
    left: 11px;
}
.pop-up .close-button:before{transform: rotate(90deg);left:-5px;
	left: 11px;
    top: 20px;
}

.b_top{height:65px;display:flex;justify-content:flex-end;align-items:center;padding: 0 30px;}

</style>

<div class="pop-up">
	<div class="box">
		<div id="blackfridey"><a href="#" id="setCookie" class="close-button">&nbsp;</a>
			<div class="boxfr">
			<div class="b-tile"><?php echo $heading_title1; ?></div>
			<div class="products1">
			<?php foreach($products as $product){ ?>
				<div class="product1">
					<div class="image">
					<a href="<?php echo $product['href'];?>"><img src="image/black/<?php echo $product['mpn']; ?>.png" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>"></a>
					</div>
					<div class="name">
					<a href="<?php echo $product['href'];?>"><?php echo $product['name']; ?></a>
					</div>
					<div class="d-flex bot">
						<div class="prices">
							<?php if ($product['price']) { ?>
			                	<?php if (!$product['special']) { ?>
			                		<div class="price"><?php echo $product['price']; ?></div>
			                	<?php } else { ?>
			                  		<div class="special"><?php echo $product['special']; ?></div> 
			                  		<div class="price"><?php echo $product['price']; ?></div>
			                  <?php } ?>
			                <?php } ?>
						</div>	
						<a href="<?php echo $product['href'];?>" class="addcart"><?php echo $text_addcart1; ?></a>
					</div>
				</div>
			<?php } ?>
			</div>
			</div>
	  	</div>
	</div>
</div>
<script type="text/javascript">
function setcookie(){
$.cookie("popup2", "24house", {expires: 0} );
$('.pop-up').hide();
return true;
}
$(document).ready(function(){
$("#setCookie, .product1 a").click(function () {
$.cookie("popup2", "24house", {expires: 1} );
//$.cookie("popup", "1", {expires: 1} ); // 1день
//$.cookie("popup", "3", {expires: 3} ); // 3дня
/*var date = new Date(); // одна минута
date.setTime(date.getTime() + (60 * 1000));
$.cookie("popup3", "", {expires: date} );*/
//$("#bg_popup").hide();
$('.pop-up').hide();
});
if($.cookie("popup2") == null){
	setTimeout(function(){
		$('.pop-up').hide();
		$('.pop-up').fadeIn(1000);
		$('.close-button').click(function (e) {
			$('.pop-up').fadeOut(700);
			$('#overlay').removeClass('blur-in');
			$('#overlay').addClass('blur-out');
			e.stopPropagation();
		});
	}, 10000)
}else{
	$('.pop-up').hide();
//$("#bg_popup").hide();
}
});
</script>
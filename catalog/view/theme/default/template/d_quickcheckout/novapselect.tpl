<div id="searchp" class="input-group searchp">
  <input id="searchp-input" type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_search; ?>" class="form-control input-lg search-autocomplete grey" />
  <span class="input-group-btn">
    <button type="button" id='search-btn1' class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
  </span>
</div>
<div id="result-search-autocomplete" class="result-search-autocomplete">
	<ul class="show-result" id="show-result">
	</ul>
</div>

<div id="searchp-prn" class="input-group searchp">
    <input id="searchp-prn-input" type="text" name="searchprn" value="<?php echo $searchprn; ?>" placeholder="<?php echo $print_search; ?>" class="form-control input-lg search-autocomplete green" />
    <span class="input-group-btn">
      <button type="button" id='search-btn2' class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
    </span>
</div>
<div id="result-search-autocomplete-prn" class="result-search-autocomplete" style="top: 84px;">
	<ul class="show-result" id="show-result-prn">
	</ul>
</div>

<script>
$(function(){
  $(document).click(function(event) {
    if ($(event.target).closest(".result-search-autocomplete").length) return;
    $(".result-search-autocomplete").hide("slow");
    event.stopPropagation();
  });
});

$("#searchp-input").keypress(function(e){
 	   if(e.keyCode==13){
 	   //нажата клавиша enter - здесь ваш код
     window.location='/search/?search=' + $("#searchp-input").val();
 	   }
});

$("#searchp-prn-input").keypress(function(e){
 	   if(e.keyCode==13){
 	   //нажата клавиша enter - здесь ваш код
     // window.location='/search/?prn=' + $("#searchp-input").val();
     // alert (2);
 	   }
});

$("#search-btn2").click(function(e){
     // window.location='/search/?prn=' + $("#searchp-input").val();
});

</script>

<script>
	var width_search = document.getElementById("searchp").offsetWidth+200;
	$('#result-search-autocomplete').css({"width":width_search});
	$('#searchp-input').keyup(function(event) {
		/* Act on the event */
		$('#result-search-autocomplete  ul').css({"overflow" : "hidden"});
		var search = $('input[name=search]').val();
		$.ajax({
		  method: "GET",
		  url: "<?php echo $search_action; ?>",
		  data: { search : search }
		}).done(function( result ) {
			var html = '';
			if(result && search != '')
			{
				var count = 0
				$.each(JSON.parse(result), function( index, value ) {
				  	
				  	html += '<li>';
				  	html += '<div class="row">';
            html += '<a href="'+value.href.replace('amp;', '')+'">';
				  	html += '<div class="col-md-2 row-result-search-autocomplete-image">';
				  	html += '<img class="result-search-autocomplete-image" src="'+value.thumb+'">';
				  	html += '</div>';
				  	html += '<div class="col-md-7 result-info">';
				  	html += '<h4>'+value.name+'</h4>';
				  	if(value.special == false)
				  	{
				  		html += '<h5>'+value.price+' <i></i></h5>';
				  	}else{
				  		html += '<h5>'+value.special+' <i>'+value.price+'</i></h5>';
				  	}
				  	
				  	html += '</div>';
            html += '</a>';
				  	html += '<div style="text-align:center" class="col-md-3 result-button">';
				  	html += '<button type="button" class="btn tagdattruoc" onclick="cart.add('+value.product_id+', \'0\'); $(\'.result-search-autocomplete\').hide(\'slow\');"><?php echo $button_cart; ?></button>';
				  	//html += '<h6>Xem them</h6>';
				  	html += '</div>';
				  	html += '</div>';
				  	html += '</li>';
				  	count++;
				});
					$('#result-search-autocomplete').css({"display":"block"});
				  	if(count > 5)
					{
						$('#result-search-autocomplete  ul').css({"overflow-y" : "scroll"});
					}else{
						$('#result-search-autocomplete  ul').css({"overflow" : "hidden"});
					}
			}else{
				html = '';
				$('#result-search-autocomplete').css({"display":"none"});
			}

			$('#show-result').html(html);
		});
	});
</script>

<script>
	var width_search = document.getElementById("searchp-prn").offsetWidth+200;
	$('#result-search-autocomplete-prn').css({"width":width_search});
	$('#searchp-prn-input').keyup(function(event) {
		/* Act on the event */
		$('#result-search-autocomplete-prn ul').css({"overflow" : "hidden"});
		var search = $('input[name=searchprn]').val();
		$.ajax({
		  method: "GET",
		  url: "<?php echo $search_action_prn; ?>",
		  data: { search : search }
		}).done(function( result ) {
			var html = '';
			if(result && search != '')
			{
				var count = 0
				$.each(JSON.parse(result), function( index, value ) {

				  	html += '<li>';
				  	html += '<div class="row">';
            html += '<a href="/search/?br='+value.brand.toLowerCase()+'&prn='+value.absnum+'">';
				  	html += '<div class="col-md-2 row-result-search-autocomplete-image">';
				  	html += '<img class="result-search-autocomplete-image" src="'+value.image+'">';
				  	html += '</div>';
				  	html += '<div class="col-md-7 result-info">';
				  	html += '<h4>'+value.title+'</h4>';
				  	html += '</div>';
            html += '</a>';
				  	html += '<div style="text-align:right" class="col-md-3 result-button">';
				  	// html += '<button type="button" class="btn tagdattruoc" onclick="cart.add('+value.product_id+', \'0\'); $(\'.result-search-autocomplete\').hide(\'slow\');"><?php echo $button_cart; ?></button>';
				  	//html += '<h6>Xem them</h6>';
            html += '<h4>'+value.brand+'</h4>';
				  	html += '</div>';
				  	html += '</div>';
				  	html += '</li>';
				  	count++;
				});
					$('#result-search-autocomplete-prn').css({"display":"block"});
				  	if(count > 5)
					{
						$('#result-search-autocomplete-prn  ul').css({"overflow" : "scroll"});
					}else{
						$('#result-search-autocomplete-prn  ul').css({"overflow" : "hidden"});
					}
			}else{
				html = '';
				$('#result-search-autocomplete-prn').css({"display":"none"});
			}

			$('#show-result-prn').html(html);
		});
	});
</script>

<style type="text/css" media="screen">
.result-search-autocomplete
{
	display: none;
	position: absolute;
	z-index: 1000;
	background-color: #FFF;
	border: 0px solid #ddd;
	/* top:40px; */
	max-height:468px;
  top: 35px;
  left: 25px;
}
.result-search-autocomplete h4
{
	  display: block;
	  /* width: 72%; */
	  line-height: 1.3em;
	  color: #333;
	  font-size: 14px;
	  font-weight: 700;
	  overflow: hidden;
	  text-overflow: ellipsis;
	  white-space: nowrap;
}
.result-search-autocomplete h5
{
	font-size: 14px;
    margin-top: 8px;
    color: red;
}
.result-search-autocomplete h5 i
{
	color: #999;
	font-style: normal;
	font-size: 11px;
	text-decoration: line-through;
}
.result-search-autocomplete h6
{
	text-transform: uppercase;
  	font-size: 9px;
  	font-weight: 700;
  	color: #0876e6;
  	display: block;
  	margin-top: 8px;
  	text-align: right;
}
.result-search-autocomplete ul, li
{
	list-style-type: none;
	margin: 0;
	padding: 0;
}
.result-search-autocomplete-image
{
	height: 50px;
	padding-left: 15px;
}
.result-search-autocomplete > ul
{
	max-height:468px;
	overflow: hidden;
	/*overflow: scroll;
	overflow-x:none;*/
}
.result-search-autocomplete > ul >li >a
{
	position: relative;
  	display: block;
  	overflow: hidden;
  	padding: 6px;
  	text-decoration: none;
}
.result-search-autocomplete > ul >li 
{
	display: block;
  	background: #fff;
  	overflow: hidden;
  	list-style: none;
  	border-bottom: 1px dotted #ccc;
  	float: none;
}
.result-search-autocomplete > ul >li > a:hover button
{
	color: #FFF;
}
.tagdattruoc {
  background: #00aeef;  
  font-size: 11px;   
  font-weight: 600;
  border: 0;  
  color: #fff;
  border-radius: 0px;
  margin-top: 18px;
}
.tagdattruoc :hover
{
	color: #FFF;
}
@media (max-width: 767px) {
		.result-button {
			width: 30%;
			float: left;
		}
		.row-result-search-autocomplete-image
		{
			width: 30%;
			float: left;
		}
		.result-info
		{
			width: 40%;
			float: left;
		}
	}

</style>
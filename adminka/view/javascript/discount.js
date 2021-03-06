
function changeCategoryFulltime(category_number){
  if(document.getElementById("category_"+category_number+"_fulltime").checked){
    document.getElementById("category_"+category_number+"_date_start").disabled = true;
    document.getElementById("category_"+category_number+"_date_stop").disabled  = true;
    $("#category-discount-"+category_number+" .datetime-block").addClass("datetime-block-disabled");
  }else{
    document.getElementById("category_"+category_number+"_date_start").disabled = false;
    document.getElementById("category_"+category_number+"_date_stop").disabled  = false;
    $("#category-discount-"+category_number+" .datetime-block").removeClass("datetime-block-disabled");
  }
}



function changeManufacturerFulltime(manufacturer_number){
  if(document.getElementById("manufacturer_"+manufacturer_number+"_fulltime").checked){
    document.getElementById("manufacturer_"+manufacturer_number+"_date_start").disabled = true;
    document.getElementById("manufacturer_"+manufacturer_number+"_date_stop").disabled  = true;
    $("#manufacturer-discount-"+manufacturer_number+" .datetime-block").addClass("datetime-block-disabled");
  }else{
    document.getElementById("manufacturer_"+manufacturer_number+"_date_start").disabled = false;
    document.getElementById("manufacturer_"+manufacturer_number+"_date_stop").disabled  = false;
    $("#manufacturer-discount-"+manufacturer_number+" .datetime-block").removeClass("datetime-block-disabled");
  }
}


function changeCustomerGroupFulltime(customer_group_number){
  if(document.getElementById("customer_group_"+customer_group_number+"_fulltime").checked){
    document.getElementById("customer_group_"+customer_group_number+"_date_start").disabled = true;
    document.getElementById("customer_group_"+customer_group_number+"_date_stop").disabled  = true;
    $("#customer-discount-"+customer_group_number+" .datetime-block").addClass("datetime-block-disabled");
  }else{
    document.getElementById("customer_group_"+customer_group_number+"_date_start").disabled = false;
    document.getElementById("customer_group_"+customer_group_number+"_date_stop").disabled  = false;
    $("#customer-discount-"+customer_group_number+" .datetime-block").removeClass("datetime-block-disabled");
  }
}


function selectTab(id){
  var radio_id = "";
  if(id == "discount-total"){radio_id = "total";}
  if(id == "discount-manufacturer"){radio_id = "manufacturer";}
  if(id == "discount-category"){radio_id = "category";}
  if(id == "discount-customer"){radio_id = "customer_group";}

  $('#discount_type_'+radio_id).click();
  $('.tab').css("color","gray");
  $('.tab').css("outline","none");
  $('#tab-'+id).css("color","black");
}



function setFullTimeDiscount(type){
  var fullTimeDiscount = $("#discount_"+type+"_fulltime_1:checked").length;

  if(fullTimeDiscount == 1){
    $("#discount_total_date").fadeOut("slow");
  }else{
    $("#discount_total_date").fadeIn("slow");
  }
}




function moduleStatus(status){
  if(status == 0){
//    $('.multi-discount-pack input').prop("disabled","disabled");
//    $('.multi-discount-pack select').prop("disabled","disabled");
//    $("#discount_setting_status").prop("disabled",false);
    $("#discount_setting_status").val('0');
  }else{
//    $('.multi-discount-pack input').prop("disabled",false);
//    $('.multi-discount-pack select').prop("disabled",false);
//    $("#discount_setting_status").prop("disabled",false);
    $("#discount_setting_status").val('1');
  }
}
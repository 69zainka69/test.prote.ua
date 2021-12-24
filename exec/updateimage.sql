update `oc_product` a 
set a.image=(select image from `oc_product_image` b where a.product_id=b.product_id limit 1) 
where a.image=''
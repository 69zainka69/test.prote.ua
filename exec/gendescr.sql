update `oc_product_description`
set meta_description=concat_ws(' ','Заказать', name, 'высокого качества и по доступным ценам | Prote.com.ua | ☎ (044) 379 09 62')
where language_id=1;

update `oc_product_description`
set meta_description=concat_ws(' ','Замовити', name, 'високої якості та за доступними цінам | Prote.com.ua | ☎ (044) 379 09 62')
where language_id=2;

update `oc_category_description`
set meta_description=concat_ws(' ', name, 'высокого качества | магазин доступной печати Prote')
where language_id=1;

update `oc_category_description`
set meta_description=concat_ws(' ', name, 'високої якості | магазин доступного друку Prote')
where language_id=2;


update `oc_product_description`
set meta_title=concat_ws(' ', name, 'высокого качества | магазин доступной печати Prote')
where language_id=1;

update `oc_product_description`
set meta_title=concat_ws(' ', name, 'високої якості | магазин доступного друку Prote')
where language_id=2;

update `oc_category_description`
set meta_title=concat_ws(' ', name, 'высокого качества | магазин доступной печати Prote')
where language_id=1;

update `oc_category_description`
set meta_title=concat_ws(' ', name, 'високої якості | магазин доступного друку Prote')
where language_id=2;

update `oc_information_description`
set meta_title=concat_ws(' ', title, '| магазин доступной печати Prote')
where language_id=1;

update `oc_information_description`
set meta_title=concat_ws(' ', title, '| магазин доступного друку Prote')
where language_id=2;

update `oc_information_description`
set meta_description=concat_ws(' ', title, 'высокое качество, гарантия, доступность | Prote.com.ua | ☎ (044) 379 09 62')
where language_id=1;

update `oc_information_description`
set meta_description=concat_ws(' ', title, 'высока якість, гарантія, доступність | Prote.com.ua | ☎ (044) 379 09 62')
where language_id=2;
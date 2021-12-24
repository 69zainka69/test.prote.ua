UPDATE prote.oc_product a, vm.cont_2130 b
set a.price=b.amount
where a.upc=b.absnum and b.langid=1 and b.price_group=15 and b.currency=1;

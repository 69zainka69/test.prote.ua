-- Adding columns is_complex by task VM-20 (10.02.2021)
alter table oc_order
    add is_complex int default 0 null;
alter table oc_product
    add is_complex int default 0 null;

SELECT * FROM "ShoppingCar";

create table ShoppingCar(
productEPC varchar(32),
userEPC    varchar(32),
time       varchar(32),
money      double
)
insert into ShoppingCar(productEPC,userEPC,time,money) values();
select productEPC,userEPC,time,money from ShoppingCar where productEPC = '' and userEPC = ''
delete from ShoppingCar where  productEPC = '' and userEPC = '';
update ShoppingCar set money =  ,time = ''  where  productEPC = '' and userEPC = '';



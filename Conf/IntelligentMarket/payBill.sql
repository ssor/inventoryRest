create table payBill(
productEPC varchar(32),
userEPC varchar(32),
time varchar(32),
productName varchar(32)
)
select productEPC , userEPC , time , productName from payBill where  productEPC = '' and userEPC = '';
insert into payBill(productEPC , userEPC , time , productName) values();
delete from payBill where productEPC = '' and userEPC = '';
update payBill set time = '', productName = '' where  productEPC = '' and userEPC = '';
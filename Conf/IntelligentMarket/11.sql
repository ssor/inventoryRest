[{"tag":"909602F00000000000000000","startTime":"2009-07-11 12:01:31","cmd":"inventory_pandian","state":""}]
http://192.168.1.103:9002/index.php/RFIDReader/Reader/addScanTags

delete from tbRfidScanTemp where tagID = '909602F00000000000000000'
delete FROM "communictionTemp";
delete FROM "tbRfidScanTemp";
很多人備份資料庫都用phpMyAdmin裡面的介面來備份，但是如果遇到較大的檔案要還還原就會出現問題。

因為網路通常只接受10MB的檔案上傳，大過10MB，那就哭哭了。

而且有時候還會因為Apache的語系問題，有些字體會不見或是變成問號。

這時你可以選擇用MySQL內建的指令 mysqldump 來做備份。

資料庫資料匯出(dump) 
範例: 
mysqldump -u test -h 192.168.0.100 -p testdb > alltable.sql 
mysqldump -u test -h 192.168.0.100 -p testdb testtable > alltesttable.sql 
mysqldump -u test -h 192.168.0.100 -d -p testdb testtable > schematesttable.sql 
mysqldump -u test -h 192.168.0.100 -d -p testdb testtable1 testtable2> schemasometable.sql

資料庫資料匯入 
範例: 
mysql -u test -p testdb < testtable.sql

參數說明 
>  表示匯出資料 
<  表示匯入資料
-u  mysql使用者 
-h  連線host IP或Domain Name 
-d  只需要匯出(dump)Table的結構, 若沒有此參數, 會將Table的結構和資料一併匯出 
-p:  需要密碼, 指令執行後待會會要求輸入 
testdb  指定要處理的DB名稱 
testtable 指定要處理的Table名稱 
testtable.sql 匯入或是匯出Table資料的SQL語法

如果你的 MySQL Server 不止一個資料庫，希望可以一次過將所有資料庫備份起來。可以參考下列的語法。
mysqldump --user=root -p --all-databases > /backup/mysql.sql
這個 --all-databases 代表所有資料庫，這樣 mysqldump 便會將所有資料庫備份到 /backup/mysql.sql。

 mysqldump --user=root -p Copy_date > /backup/Copy_date.sql
 mysqldump --user=root -p AP_data > /backup/AP_data.sql
 mysqldump --user=root -p csv1 > /backup/csv1.sql
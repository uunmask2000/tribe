<html>
  <head>
    <title>檔案上傳</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <p align="center"><img src="title.jpg"></p>  
    <p align="center">
      歡迎使用檔案上傳服務，您只可以上傳一個檔案。
    </p> 
    <p align="center">
      <form method="post" action="TXT2.php" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
        <input type="file" name="myfile" size="50"><br><br>
        <input type="submit" value="上傳">
        <input type="reset" value="重新設定">
      </form>
    </P>
  </body>
</html>
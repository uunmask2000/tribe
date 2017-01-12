 <?php 
  //$db=DB::connect("
  //mysql://okpawn_root:okpawn@localhost/okpawn_web");
   //$link = @mysqli_connect('localhost','okpawn_root','okpawn','okpawn_web');
   $link = @mysqli_connect('localhost','root','0932969495','TEST_DB');
   if( !$link ) 
   {
    echo "�s�����~�T��: ".mysqli_connect_error()."<br>";
    exit(); 
   }   
   mysqli_query($link,'set names utf8');   
   function checking($link,$value) 
   {
        if (function_exists ( 'get_magic_quotes_gpc' ))
        {
           if (get_magic_quotes_gpc( ))  
           {$value = stripslashes($value);} 
        }
        
        if (count($value)==1) 
        {
            $value[0] = mysqli_real_escape_string($link,$value[0]);
            return $value[0];
        }  
        else
        {    
            for($i=0; $i<count($value);$i++)
            {$value[$i] = mysqli_real_escape_string($link,$value[$i]);}
            return $value;            
        }         
    }

$AAAAAAAAAAAAAAAAAAAAAAAAA = '123456';	
 ?> 
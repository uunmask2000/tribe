


<?
function insert_data($a1,$a2,$a3)
{
    $str1="INSERT INTO ".$a1." (";
    $t1=count($a2);
    for($i=0;$i<$t1;$i++)
    {        
        if($i==$t1-1)
        {$str1=$str1.$a2[$i].") values (";}
        else
        {$str1=$str1.$a2[$i].",";}
    }

    for($i=0;$i<$t1;$i++)
    {        
        if($i==$t1-1)
        {$str1=$str1."'".$a3[$i]."')";}
        else
        {$str1=$str1."'".$a3[$i]."',";}
    }

    return $str1;
}


function fix_data($a1,$a2,$a3,$a4,$a5)
{
    $str1="UPDATE ".$a1." set ";
    $t1=count($a2);

    for($i=0;$i<$t1;$i++)
    {
        if($i==$t1-1)
        {$str1=$str1.$a2[$i]."='".$a3[$i]."' where ";}
        else
        {$str1=$str1.$a2[$i]."='".$a3[$i]."',";}
    }
    $str1=$str1.$a4."='".$a5."'";
    return $str1;
}






?>

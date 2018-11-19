<?
header("Content-type:application/text");
header("Content-Disposition: attachment; filename=test.txt"); 

    $content = file("BookChange.txt");
    for ($i = 0;$i < sizeof($content);$i++){
    $str = explode(',',$content[$i]); 
        header("Content-type:application/text");
        header("Content-Disposition: attachment; filename=test.txt"); 
        echo "$str[0]".","."$str[1]".","."$str[2]".","."$str[3]".","."$str[4]".","."$str[5]";
    }
?>

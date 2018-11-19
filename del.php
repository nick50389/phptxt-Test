<?  
    $delete = !empty($_GET['delete']) ? $_GET['delete'] : null;
    $i = !empty($_GET['del']) ? $_GET['del'] :"";
    
    if ($i == 0) $i = '0'; 
    $myfile = fopen("BookChange.txt",'a') or die ("無法打開檔案");
    $contents = file("BookChange.txt");


    if ($delete) {
        $finish = str_replace($contents[$i],"",$contents);
        file_put_contents("BookChange.txt", $finish);
        copy("BookChange.txt","Book.txt");
        echo "刪除成功";
        echo "<a href='txtphp.php'>回首頁</a>";
    }else{
        echo "刪除失敗";
        echo "<a href='txtphp.php'>回首頁</a>";
    }


?>

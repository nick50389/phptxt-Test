<?
$check = !empty($_POST['check'])? $_POST['check']: null;

if ($check != "yes") {
    echo "  
        <table border='1' align='center'>
        <tr>
        <th name='ISBN'>ISBN</th>
        <th name='publisher'>出版社</th>
        <th name='book'>書名</th>
        <th name='author'>作者</th>
        <th name='price'>定價</th>
        <th name='date'>發行日</th>
        <th>Add</th>
        </tr>
        <form method='post' action='add.php' name='addForm' onsubmit='return check(this)'>
        <tr>
        <td><input type = 'text' name = 'ISBN' pattern='\d{3}[\-]\d{3}[\-]\d{3}[\-]\d{1}'></td>
        <td><input type = 'text' name = 'publisher' pattern='[\u4e00-\u9fa5_a-zA-Z0-9]'></td>
        <td><input type = 'text' name = 'book' pattern='[\u4e00-\u9fa5_a-zA-Z0-9]'></td>
        <td><input type = 'text' name = 'author' pattern='[\u4e00-\u9fa5_a-zA-Z0-9]'></td>
        <td><input type = 'text' name = 'price' pattern='\d{1,10}'></td>
        <td><input type = 'text' name ='date' pattern='\d{4}-(1[0-2]|0[1-9])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])'></td>
        <td><input type ='submit' name='Send ' value = 'send'>
            <input name = 'check' type = 'hidden' id='check' value='yes'></td>
        </tr>
        </form>
        <a href='txtphp.php'>回首頁</a>";
}else{
    $ISBN = !empty($_POST["ISBN"]) ? $_POST["ISBN"] : null;
    $publisher = !empty($_POST["publisher"]) ? $_POST["publisher"] : null;
    $book = !empty($_POST["book"]) ? $_POST["book"] : null;
    $author = !empty($_POST["author"]) ? $_POST["author"] : null;
    $price = !empty($_POST['price']) ? $_POST['price'] : null;
    $date = !empty($_POST["date"]) ? $_POST["date"] : null;
    $Send = !empty($_POST["Send"]) ? $_POST["Send"] : null;    
    
    if($ISBN == "" || $publisher =="" ||  $book =="" || $author =="" || $price =="" || $date =="") {
        echo "欄位不可為空,請重新輸入 <br>";
        echo "<a href='txtphp.php'>回首頁</a>";
    }else{
        $myfile = fopen("Book.txt",'a') or die ("無法打開檔案");
        fwrite($myfile,$ISBN.',');
        fwrite($myfile,$publisher.',');
        fwrite($myfile,$book.',');
        fwrite($myfile,$author.',');
        fwrite($myfile,$price.',');
        fwrite($myfile,$date."\r\n");
        fclose($myfile);
        echo "新增成功";
        echo "<a href='txtphp.php'>回首頁</a>";
    }    
}
        
?>

<script>
     function check(editForm){
         if(editForm.ISBN.value == ""){
                alert("ISBN未填寫");
                editForm.ISBN.focus();
                return false;
         }
         if(editForm.publisher.value == ""){
                alert("出版社未填寫");
                editForm.publisher.focus();
                return false;
         }
         if(editForm.book.value == ""){
                alert("書名未填寫");
                editForm.book.focus();
                return false;
         }
         if(editForm.author.value == ""){
                alert("作者未填寫");
                editForm.author.focus();
                return false;
         }
         if(editForm.price.value == ""){
                alert("價錢未填寫");
                editForm.price.focus();
                return false;
         }
         if(editForm.date.value == ""){
                alert("發行日未填寫");
                editForm.date.focus();
                return false;
         }return true;
     }
</script>
<?
$id = !empty($_GET['id']) ? $_GET['id']:"";
$i = !empty($_GET['edit']) ? $_GET['edit'] :"";
if ($i == 0) $i = "0";
if ($id == "" ) {  ?>
    <table border="1">
    <tr>
        <th>ISBN</th>
        <th>出版社</th>
        <th>書名</th>
        <th>作者</th>
        <th>定價</th>
        <th>發行日</th>
        <th>編輯</th>
    </tr>
<?
    $myfile = fopen("BookChange.txt",'a') or die ("無法打開檔案");
    $contents = file("BookChange.txt");
    $str = explode(',',$contents[$i]);
    $id = $i + 1 ;
    $ISBN = $str[0];
    $publisher = $str[1];
    $book = $str[2];
    $author = $str[3];
    $price = $str[4];
    $date = $str[5]; 
    echo "<tr><form name='editForm' onsubmit='return check(this)'>
        <tr>
        <td><input type = 'text' name = 'ISBN'  value='$ISBN' pattern='\d{3}[\-]\d{3}[\-]\d{3}[\-]\d{1}'></td>
        <td><input type = 'text' name = 'publisher' value='$publisher' pattern='[\u4e00-\u9fa5_a-zA-Z0-9]'>
        <td><input type = 'text' name = 'book' value='$book' pattern='[\u4e00-\u9fa5_a-zA-Z0-9]'></td>
        <td><input type = 'text' name = 'author' value='$author' pattern='[\u4e00-\u9fa5_a-zA-Z0-9]'></td>
        <td><input type = 'text' name = 'price' value='$price' pattern='\d{2,5}'></td>
        <td><input type = 'text' name ='date' value='$date' pattern='\d{4}-(1[0-2]|0[1-9])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])'></td>
        <td><input type='submit' name='Submit' value='Edit'>
                    <input type='hidden' name='id' value='$id'>
        </from></tr>

        </table>
        <a href='txtphp.php'>回首頁</a>";
}else {
        $ISBNEdit = !empty($_GET["ISBN"]) ? $_GET["ISBN"] : null;
        $publisherEdit = !empty($_GET["publisher"]) ? $_GET["publisher"] : null;
        $bookEdit = !empty($_GET["book"]) ? $_GET["book"] : null;
        $authorEdit = !empty($_GET["author"]) ? $_GET["author"] : null;
        $priceEdit = !empty($_GET['price']) ? $_GET['price'] : null;
        $dateEdit = !empty($_GET["date"]) ? $_GET["date"] : null;
        $Submit = !empty($_GET["Submit"]) ? $_GET["Submit"] : null;
        $id2 = $id -1 ;

        if ($Submit == 'Edit'){
            $myfile = fopen("BookChange.txt",'a') or die ("無法打開檔案");
            $contents = file("BookChange.txt");
            $strEdit = $ISBNEdit . "," . $publisherEdit . "," . $bookEdit . "," . $authorEdit . "," . $priceEdit . "," . $dateEdit;
            $strEdit = "$strEdit\r\n";
            $finish = str_replace($contents[$id2],$strEdit,$contents);
            file_put_contents("BookChange.txt", $finish);
            copy("BookChange.txt","Book.txt");
            echo '修改完成';
            echo "<a href='txtphp.php'>回首頁</a>";     
        }else{
            echo '操作錯誤';
            echo "<a href='txtphp.php'>回首頁</a>";
            return;
        }
}
?>

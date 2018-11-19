<?session_start();?>
<style>
        #addForm {
            margin-top:10px;        
        }
    </style>
<body>
<center>
<div id="insertForm">
    <form action="input.php" method="post" enctype="multipart/form-data">
匯入資料
       <input type="file" name="file" accept="text/html,.txt">
       <input type="submit" name="submit" value="上傳">
    </form>
</div>    
<div>
<?
!empty($_SESSION['select']) ? $_SESSION['select'] : null ;
!empty($_POST['selectOrder']) ? $_POST['selectOrder'] : null;
!empty($_POST['direction']) ? $_POST['direction'] : null;
?>
    <form id="Order" action="txtphp.php" method="post">
        排序<select name="selectOrder" onchange="this.form.submit()">
            <option value="NO" selected>請選擇</option>
            <option value="ISBN" <? if(isset($_POST['selectOrder']) && $_POST['selectOrder'] =="ISBN") echo "selected";?>>ISBN</option>
            <option value="publisher" <? if(isset($_POST['selectOrder']) && $_POST['selectOrder'] =="publisher") echo "selected";?>>出版社</option>
            <option value="book" <? if(isset($_POST['selectOrder']) && $_POST['selectOrder'] =="book") echo "selected";?>>書名</option>
            <option value="author" <? if (isset($_POST['selectOrder']) && $_POST['selectOrder'] =="author") echo "selected";?>>作者</option>
            <option value="price" <? if (isset($_POST['selectOrder']) && $_POST['selectOrder'] =="price") echo "selected";?>>定價</option>
            <option value="date" <? if (isset($_POST['selectOrder']) && $_POST['selectOrder'] =="date") echo "selected";?>>發行日</option>

            </select>
        方向<select name="direction" id="select2" onchange="this.form.submit()">
            <option value="ASC" <? if(isset($_POST['direction']) && $_POST['direction'] =="ASC") echo "selected";?>>ASC</option>
            <option value="DESC" <? if(isset($_POST['direction']) && $_POST['direction'] =="DESC") echo "selected";?>>DESC</option>
            </select>
    </form>
    <table width="800" border="1" align="center">
        <tr>
            <th>ISBN</th>
            <th>出版社</th>
            <th>書名</th>
            <th>作者</th>
            <th>定價</th>
            <th>發行日</th>
            <th>編輯/刪除</th>
<? 
$content = file("Book.txt");

$books = [];
foreach ($content as $key => $value) {
$row = explode(',', $value);
array_push($books, [
"ISBN" => $row[0],
"publisher" => $row[1],
"book" => $row[2],
"author" => $row[3],
"price" => $row[4],
"date" => $row[5]
]);
}
function My_sort ($books, $attr){
    switch ($attr) {
    case "ISBN":
    usort($books,function($book1, $book2){
    return ($book1["ISBN"] >= $book2["ISBN"])? 1:-1; //ASC
});
break;

    case "publisher":
    usort($books,function($book1, $book2){
    return ($book1["publisher"] >= $book2["publisher"])? 1:-1;
});
break;

    case "book":
    usort($books,function($book1, $book2){
    return ($book1["book"] >= $book2["book"])? 1:-1 ;
});
break;

    case "author":
    usort($books,function($book1, $book2){
    return ($book1["author"] >= $book2["author"])? 1:-1 ;
});
break;

    case "price":
    usort($books,function($book1, $book2){
    return ($book1["price"] >= $book2["price"])? 1:-1;
});
break;
    
    case "date":
    usort($books,function($book1, $book2){
    return ($book1["date"] >= $book2["date"])? 1:-1;
});
break;
}
return $books;
}

function My_sortDESC ($books, $attr){
    switch ($attr) {
    case "ISBN":
    usort($books,function($book1, $book2){
    return ($book1["ISBN"] >= $book2["ISBN"])? -1:1; //DESC
});
break;

    case "publisher":
    usort($books,function($book1, $book2){
    return ($book1["publisher"] >= $book2["publisher"])? -1:1;
});
break;

    case "book":
    usort($books,function($book1, $book2){
    return ($book1["book"] >= $book2["book"])? -1:1 ;
});
break;

    case "author":
    usort($books,function($book1, $book2){
    return ($book1["author"] >= $book2["author"])? -1:1 ;
});
break;

    case "price":
    usort($books,function($book1, $book2){
    return ($book1["price"] >= $book2["price"])? -1:1;
});
break;
    
    case "date":
    usort($books,function($book1, $book2){
    return ($book1["date"] >= $book2["date"])? -1:1;
});
break;
}
return $books;
}
//print_r($books);
$file = fopen("Book.txt","a");
$select = !empty($_POST['selectOrder']) ? $_POST['selectOrder'] : "";
$select02 = !empty($_POST['direction']) ? $_POST['direction'] : "";

if(isset($_SESSION['select']) && $_SESSION['select'] == 'ISBN' && $select02 =='ASC'){
    $books = My_sort($books, "ISBN");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'publisher' && $select02 =='ASC'){
    $books = My_sort($books, "publisher");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'book' && $select02 =='ASC'){
    $books = My_sort($books, "book");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'author' && $select02 =='ASC'){
    $books = My_sort($books, "author");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'price' && $select02 =='ASC'){
    $books = My_sort($books, "price");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'date' && $select02 == 'ASC'){
    $books = My_sort($books, "date");
}
switch($select){
case 'ISBN':
    $books = My_sort($books, "ISBN");
    $_SESSION['select'] = 'ISBN';
break;

case 'publisher':
    $books = My_sort($books, "publisher");
    $_SESSION['select'] = 'publisher';
break;

case 'book':
    $books= My_sort($books, "book");
    $_SESSION['select'] = 'book';
break;

case 'author':
    $books = My_sort($books, "author");
    $_SESSION['select'] = 'author';
break;

case 'price':
    $books = My_sort($books, "price");
    $_SESSION['select'] = 'price';
break;

case 'date':
    $books = My_sort($books, "date");
    $_SESSION['select'] = 'date';
break;
}
if(isset($_SESSION['select']) && $_SESSION['select'] == 'ISBN' && $select02 =='DESC'){
    $books = My_sortDESC($books, "ISBN");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'publisher' && $select02 =='DESC'){
    $books = My_sortDESC($books, "publisher");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'book' && $select02 =='DESC'){
    $books = My_sortDESC($books, "book");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'author' && $select02 =='DESC'){
    $books = My_sortDESC($books, "author");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'price' && $select02 =='DESC'){
    $books = My_sortDESC($books, "price");
}elseif(isset($_SESSION['select']) && $_SESSION['select'] == 'date' && $select02 =='DESC'){
    $books = My_sortDESC($books, "date");
}else{

}
    $content = file("Book.txt");
    $newfile = fopen("BookChange.txt",'w') or die("無法打開檔案");
    for ($i = 0;$i < sizeof($books);$i++){
    $booksAll = $books[$i]['ISBN'].",".$books[$i]['publisher'].",".$books[$i]['book'].",".$books[$i]['author'].",".$books[$i]['price'].",".$books[$i]['date']; 
     fwrite($newfile,$booksAll);
?>
        </tr>
            <td><?echo $books[$i]['ISBN']?></td>      
            <td><?echo $books[$i]['publisher']?></td> 
            <td><?echo $books[$i]['book']?></td> 
            <td><?echo $books[$i]['author']?></td> 
            <td><?echo $books[$i]['price']?></td> 
            <td><?echo $books[$i]['date']?></td>          
            <td>
            <table>
            <form method="get" action="edit.php">
            <input type="submit" name="edit" value="EDIT">
            <input type="hidden" value="<? echo $i ?>" name="edit">
            </form>
            <form method="get" action="del.php"> 
            <input type="submit" name="delete" value="DEL">
            <input type="hidden" value="<? echo $i ?>" name="del">
            </form>
            </table>
            </td>      
        </tr>
<?
}
?>
    </table>
</div>
<div>
    <form id="addForm" action="add.php" method="post">
        <button type="submit" name="add">ADD</button>
    </form>
    <form action="output.php" method="get">
        <button type="submit" name="outfile">匯出</button>
    </form>
</div>
<center>
</body>

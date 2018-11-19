<?
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$name = $_FILES['file']['name'];
$error = $_FILES['file']['error'];

$a = 0;  //設定變數a初始值

if($error > 0){
    echo "Error:".$error;
    echo "檔案匯入失敗";
    echo "<a href='txtphp.php'>回首頁</a>";
}else{
    //利用函數取得迴圈值
    function inputCheck($a){    
    $myfile = fopen ("Book.txt" ,'a');
    $tmp_name = $_FILES['file']['tmp_name'];
    $contents = file($tmp_name);
    for($i = 0;$i < sizeof($contents);$i++){
        $str = explode(",",$contents[$i]);
        if (preg_match("/^\d{3}[\-]\d{3}[\-]\d{3}[\-]\d{1}$/",$str[0]) == "0"){
            //假設不符合格式，變數a為2
            $a = 2;
            break;
        }elseif (preg_match("/^([\x{4e00}-\x{9fa5}0-9A-Za-z]+)$/u",$str[1]) == "0"){
            $a = 2;
            break;
        }elseif (preg_match("/^([\x{4e00}-\x{9fa5}0-9A-Za-z]+)$/u",$str[2]) == "0"){
            $a = 2;
            break;
        }elseif (preg_match("/^([\x{4e00}-\x{9fa5}0-9A-Za-z]+)$/u",$str[3]) == "0"){
            $a = 2;
            break;
        }elseif (preg_match("/^\d{1,10}$/",$str[4]) == "0"){
            $a = 2;
            break;
        }elseif (preg_match("/^\d{4}-(1[0-2]|0[1-9])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/",$str[5]) == '0'){
            $a = 2;
            break;
        }else{
            //假設符合格式，變數a為1
            $a = 1;
        }
    }return $a;
    }
        $finish = inputCheck($a);

            if($finish == 1){
                $tmp_name = $_FILES['file']['tmp_name'];
                $myfile02 = fopen ("Book.txt" ,'a');
                $tmpfile = file_get_contents($tmp_name);
                fwrite($myfile02,$tmpfile);
                echo "檔案匯入成功";
                echo "<a href='txtphp.php'>回首頁</a>";
            }else{
                echo "檔案內容不符合規定";
                echo "<a href='txtphp.php'>回首頁</a>";         
            }
}
?>

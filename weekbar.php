<?php
header("Content-type=text/json;charset=UTF-8");
$host = "127.0.0.1";
$username = "root";
$password = "pwd";
$db = "dbname";
//连接数据库
$conn = new mysqli($host,$username,$password,$db);
if (!$conn) {
    exit;
}

$sql = "select * from test";
//把sql语句传送到数据中
$result = $conn->query($sql);

$data="";
$array= array();
class User{
    public $name;
    public $num;
}

while($row = mysqli_fetch_assoc($result)){
    $user=new User();
    $user->name = $row['name'];
    $user->num = $row['num'];
    $array[]=$user;
}
$data=json_encode($array);
echo $data;
?>
<?php
/*
  该php页面用于main页面，向客户端返回菜单数据，以json格式
  每次最多返回五条数据
  需要客户端从哪一条（0/5/10/15）开始读取数据
  客户端未提供起始行，默认从第行开始读取五条
*/
$output=[];
$count=5;
@$start=$_REQUEST['start'];//@符号的作用是压制警告信息
if($start==NULL){
  $start=0;
}
$conn=mysqli_connect(SAE_MYSQL_HOST_M , SAE_MYSQL_USER, SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish LIMIT $start,$count";
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!==NULL){
  $output[]=$row;
}
echo json_encode($output);
?>
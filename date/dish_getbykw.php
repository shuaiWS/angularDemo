<?php
/*
  该php页面用于order页面，根据电话号码向客户端返回该电话号码的所有订单信息，以json格式
*/
$output=[];
@$kw=$_REQUEST["kw"];
if(!$kw){//客户端未提交或空字符串
  echo '[]';
  return;//退出当前页面的执行
}

$conn=mysqli_connect(SAE_MYSQL_HOST_M , SAE_MYSQL_USER, SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%'";
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!==NULL){
  $output[]=$row;
}
echo json_encode($output);
?>
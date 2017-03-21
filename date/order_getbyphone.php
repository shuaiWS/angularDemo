<?php
/*
  该php页面用于main页面，向客户端返回菜单数据，以json格式
*/
$output=[];
@$phone=$_REQUEST['phone'];
if(!$phone){
  echo '[]';
  return;
}

$conn=mysqli_connect(SAE_MYSQL_HOST_M , SAE_MYSQL_USER, SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT oid,user_name,order_time,img_sm,kf_order.did FROM kf_order,kf_dish WHERE phone='$phone' AND kf_order.did=kf_dish.did ORDER BY order_time DESC";
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!==NULL){
  $output[]=$row;
}

echo json_encode($output);
?>
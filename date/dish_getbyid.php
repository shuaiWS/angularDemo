<?php
/*
  该php页面用于detail页面，根据菜品编号向客户端返回对应菜单数据，以json格式
*/
$output=[];
@$did=$_REQUEST['did'];
if(!$did){
  echo '[]';
  return;
}

$conn=mysqli_connect(SAE_MYSQL_HOST_M , SAE_MYSQL_USER, SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_lg,material,detail FROM kf_dish WHERE did=$did";
$result=mysqli_query($conn,$sql);
if(($row=mysqli_fetch_assoc($result))!==NULL){
  $output[]=$row;
}
echo json_encode($output);
?>
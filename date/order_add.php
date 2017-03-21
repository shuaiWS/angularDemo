<?php
/*
  该php页面用于main页面，向客户端返回菜单数据，以json格式
*/
$output=[];
@$user_name=$_REQUEST['user_name'];
@$phone=$_REQUEST['phone'];
@$sex=$_REQUEST['sex'];
@$addr=$_REQUEST['addr'];
@$did=$_REQUEST['did'];
$order_time=time()*1000;
if(!$user_name || !$addr || !$phone || !$did){
  echo '{"result":"err","msg":"INVALL"}';
  return;
}


$conn=mysqli_connect(SAE_MYSQL_HOST_M , SAE_MYSQL_USER, SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";
$result=mysqli_query($conn,$sql);
if($result){
  $output['result']='ok';
  $output['oid']=mysqli_insert_id($conn);
}else{
  $output['result']='fail';
  $output['msg']='添加失败，可能是SQL语句错误';

}

echo json_encode($output);
?>
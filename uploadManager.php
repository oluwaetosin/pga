<?php
if(isset($_FILES['file'])){
$filename = time().$_FILES['file']['name'];
 move_uploaded_file( $_FILES['file']['tmp_name'], "images/".$filename);
 echo json_encode(array("file"=>$filename));
 exit();
}
if(isset($_FILES['update_pic'])){
  $filename = time().$_FILES['update_pic']['name'];
 move_uploaded_file( $_FILES['update_pic']['tmp_name'], "images/".$filename);
 echo json_encode(array("file"=>$filename));
 exit();
}
 

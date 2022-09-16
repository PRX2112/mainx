<?php include 'conn.php';
include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- <title>Login~Admin</title> -->
    <style>
     .bodx::-webkit-scrollbar {
  display: none;
}
body{
    padding-top: 80px;
}
</style>
</head>
<body class="bodx">
<?php if(isset($_GET['type'])){
    $type=$_GET['type'];
    // echo $type;
    if($type=='servx'){
        
?>
<title>Register-Service Provider</title>
<section id="ServiceP">
<?php 
if(isset($_GET['update_id']))
{
    $update=$_GET['update_id'];

    // echo $update;
    $sql="select * from s_reg where sid='$update'"; 
    // echo $sql;
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)) 
    {
            $id = $_GET['update_id'];           
            $namex = $row["name"]; 
            $passx = $row["password"];
            $agex = $row["age"]; 
            $conx = $row["contact"]; 
            $photox = $row["photo"];               
    }
    
}
?>

<div class="container">
    <div class="row">
        <div class="card-body card my-5 ">
<form method="POST" enctype="multipart/form-data">
<h1 align="center">
        Service Provider Registration
    </h1>
        <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Id :</label>
    <input type="text" class="form-control" name="sid" value="<?php if(isset($_GET['update_id'])){ echo $update;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name :</label>
    <input type="text" class="form-control" name="name" value="<?php if(isset($_GET['update_id'])){ echo $namex;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Password :</label>
    <input type="password" class="form-control" name="password" value="<?php if(isset($_GET['update_id'])){ echo $passx;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Age</label>
    <input type="number" class="form-control" name="age" value="<?php if(isset($_GET['update_id'])){ echo $agex;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Contact No :</label>
    <input type="number" class="form-control" value="<?php if(isset($_GET['update_id'])){ echo $conx;}?>" name="contact" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Photo</label>
    <input type="file" class="form-control" value="<?php if(isset($_GET['update_id'])){ echo $photox;}?>" name="filep" >
  </div>
  <div class="mb-3 form-check">
    <!-- <input type="checkbox" class="form-check-input"  id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
  </div>
  <button type="submit" class="btn btn-dark " name="submit">Submit</button>
</form>
        </div>
    </div>
</div>
  

<?php 

if(isset($_POST['submit'])){
    $id = $_POST["sid"];           
    $name =$_POST["name"]; 
    $pass = $_POST["password"];
    $age = $_POST["age"]; 
    $conx = $_POST["contact"]; 
    
    // $photo = $_POST["photo"];
    $basename=$_FILES['filep']['name'];
    $tmp_name=$_FILES['filep']['tmp_name'];
    $allowedf=array('.png','.jpeg','.gif');
    $size=$_FILES['filep']['size'];
    $namex=substr($basename,0,strripos($basename,'.'));
    $ext=substr($basename,strripos($basename,'.'));
    // echo $name,$ext;

    if(in_array($ext,$allowedf) )
    {
        $newname=md5($namex).rand(100,500).$ext;
        // echo $newname;
        $uploadok=0;
        if(file_exists('upload/.'.$newname))
        {
            echo "<script> alert('😢') </script>";
        }else{
            move_uploaded_file($tmp_name,'upload/'.$newname) or die();
            $uploadok=1;
        }
        
    }elseif(empty($namex)){
        echo "<script> alert('Not Found😢'); </script>";
    }
    // elseif($size>200000){
    //     echo "<script> alert('ITS TOO LARGER😢'); </script>";
    // }
    else{
        echo "<script> alert('Only this files allowed :.jpeg ,.png ,.gif ') </script>";
    }
if($uploadok == 1){
    echo "<script> alert('Profile Uploaded Successfully😍😍😍'); </script>";
}
$x=$newname;
//end upload
if(isset($_GET['update_id'])){

    mysqli_query($conn,"update s_reg set name='$name',password='$pass',age='$age',contact='$conx', photo='$x' where sid='$id' ");
    header('location:dashboard.php');

}else{
    $str="insert into s_reg values ('$id' ,'$name','$pass','$age','$conx','$newname')" or die('error');
    $res = mysqli_query($conn,$str);
}
}
?>
</section>
<?php
    }else{
?>
<section id="Customer">
<title>Register-Customer</title>
<?php 
if(isset($_GET['update_c']))
{
    
    $update=$_GET['update_c'];

    // echo $update;
    $sql="select * from cust_reg where cid='$update'"; 
    // echo $sql;
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)) 
    {
            $id = $_GET['update_id'];           
            $namex = $row["name"]; 
            $passx = $row["password"];
            $agex = $row["age"]; 
            $conx = $row["contact"]; 
            $photox = $row["photo"];               
    }   
}
?>

<div class="container">
    <div class="row">
        <div class="card-body card my-5 ">
<form method="POST" enctype="multipart/form-data">
    <h1 align="center">
        Customer Registration
    </h1>
        <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Id :</label>
    <input type="text" class="form-control" name="cid" value="<?php if(isset($_GET['update_id'])){ echo $update;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name :</label>
    <input type="text" class="form-control" name="name" value="<?php if(isset($_GET['update_id'])){ echo $namex;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Password :</label>
    <input type="password" class="form-control" name="password" value="<?php if(isset($_GET['update_id'])){ echo $passx;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Age</label>
    <input type="number" class="form-control" name="age" value="<?php if(isset($_GET['update_id'])){ echo $agex;}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Contact No :</label>
    <input type="number" class="form-control" value="<?php if(isset($_GET['update_id'])){ echo $conx;}?>" name="contact" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Photo</label>
    <input type="file" class="form-control" value="<?php if(isset($_GET['update_id'])){ echo $photox;}?>" name="filep" >
  </div>
  <div class="mb-3 form-check">
    <!-- <input type="checkbox" class="form-check-input"  id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
  </div>
  <button type="submit" class="btn btn-dark" name="submit">Submit</button>
</form>
        </div>
    </div>
</div>
  

<?php 

if(isset($_POST['submit'])){
    $cid = $_POST["cid"];           
    $name =$_POST["name"]; 
    $pass = $_POST["password"];
    $age = $_POST["age"]; 
    $conx = $_POST["contact"]; 
    
    // $photo = $_POST["photo"];
    $basename=$_FILES['filep']['name'];
    $tmp_name=$_FILES['filep']['tmp_name'];
    $allowedf=array('.png','.jpeg','.gif');
    $size=$_FILES['filep']['size'];
    $namex=substr($basename,0,strripos($basename,'.'));
    $ext=substr($basename,strripos($basename,'.'));
    // echo $name,$ext;

    if(in_array($ext,$allowedf) )
    {
        $newname=md5($namex).rand(100,500).$ext;
        // echo $newname;
        $uploadok=0;
        if(file_exists('upload/.'.$newname))
        {
            echo "<script> alert('😢') </script>";
        }else{
            move_uploaded_file($tmp_name,'upload/'.$newname) or die();
            $uploadok=1;
        }
        
    }elseif(empty($namex)){
        echo "<script> alert('Not Found😢'); </script>";
    }
    // elseif($size>200000){
    //     echo "<script> alert('ITS TOO LARGER😢'); </script>";
    // }
    else{
        echo "<script> alert('Only this files allowed :.jpeg ,.png ,.gif ') </script>";
    }
if($uploadok == 1){
    echo "<script> alert('Profile Uploaded Successfully😍😍😍'); </script>";
}
$x=$newname;
//end upload
if(isset($_GET['update_id'])){

    mysqli_query($conn,"update cust_reg set name='$name',password='$pass',age='$age',contact='$conx', photo='$x' where sid='$id' ");
    header('location:dashboard.php');

}else{
    $str="insert into cust_reg values ('$cid' ,'$name','$pass','$age','$conx','$newname')" or die('error');
    $res = mysqli_query($conn,$str);
}
}
?>
</section>
<?php
    }
}
?>
</body>
</html>
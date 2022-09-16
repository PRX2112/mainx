<?php include 'conn.php';
session_start();
if($type=$_GET['type']){
    echo "<script>alert('Safe Activity...☣');</script>";
}else{
    echo "<script>alert('Anonuoumous Activity...☣');</script>";
    echo "<style> body{
        display:none;
    } </style>";

}

if($type == 'servx'){
   $x="Service Provider Login";
}else{
    $x="Customer Login";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- <title>Login~Admin</title> -->
</head>
<body>
<div class="container w-50 ">
    <div class="row">
        <div class="card-body  card my-5 mx-3">
<form method="POST"> 
<div class="mb-3">
<h1 class="text-center"><?php echo $x ?></h1>
<label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input"  id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
        </div>
    </div>
</div>
  

<?php 
if(isset($_GET['type'])){
    
    if($type == 'servx'){
        echo "<title>Login - Service Provider</title>";
       $x="Service Provider Login";
        if(isset($_POST['submit'])){
            $name=$_POST['username'];
            $_SESSION['usernames']=$name;
            $password=$_POST['password'];
            $str="select * from s_reg where name='$name' and password='$password' ";
            $res = mysqli_query($conn,$str);
            $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
            $count=mysqli_num_rows($res);
        
            if($count == 1){
                header('location:./ServiceProvider/compview.php');
            }else{
                echo "<script> alert('Login Failed...') </script>";
            }
        
        }
    }elseif($type == 'custx'){
        echo "<title>Login - Customer</title>";
       
        $x="Customer Login";

        if(isset($_POST['submit'])){
            
            $name=$_POST['username'];
            $_SESSION['username']=$name;
            $password=$_POST['password'];
            $str="select * from cust_reg where name='$name' and password='$password' ";
            $res = mysqli_query($conn,$str);
            $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
            $count=mysqli_num_rows($res);
            $id=$row['cid'];
            if($count == 1){
                header("location:./customer/getcomp.php?id=$id");
            }else{
                echo "<script> alert('Login Failed...') </script>";
            }
        
        }
    }else{
    }

}

?>

</body>
</html>